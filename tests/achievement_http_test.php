<?php

$_SESSION = array();
$_POST = array();
$_GET = array();
$_SERVER['REQUEST_METHOD'] = 'POST';

require_once dirname(__DIR__) . '/lib/achievement_http.php';

$achievement_http_assertions = 0;

function achievement_http_test_assert($condition, $message)
{
    global $achievement_http_assertions;
    ++$achievement_http_assertions;
    if (!$condition) {
        fwrite(STDERR, 'FAIL: ' . $message . PHP_EOL);
        exit(1);
    }
}

function achievement_http_test_throws($callback, $message)
{
    try {
        call_user_func($callback);
    } catch (AchievementHttpException $exception) {
        achievement_http_test_assert(true, $message);
        return;
    }

    achievement_http_test_assert(false, $message);
}

$token = achievement_csrf_token();
achievement_http_test_assert(is_string($token) && strlen($token) === 64, 'CSRF token is a 256-bit hex value');
achievement_http_test_assert($token === achievement_csrf_token(), 'CSRF token remains stable for the session');

$_POST = array(
    'csrf_token' => $token,
    'graph_json' => json_encode(array(
        'id' => 10,
        'components' => array(),
        'rewards' => array(),
        'restrictions' => array(),
    )),
);
$graph = achievement_decode_graph();
achievement_http_test_assert(isset($graph['id']) && $graph['id'] === 10, 'bounded graph JSON decodes');

$_POST['csrf_token'] = 'invalid';
achievement_http_test_throws(function () {
    achievement_decode_graph();
}, 'invalid CSRF token is rejected');

$_POST['csrf_token'] = $token;
$_POST['graph_json'] = '{invalid';
achievement_http_test_throws(function () {
    achievement_decode_graph();
}, 'malformed graph JSON is rejected');

$_POST['graph_json'] = json_encode(array('components' => array_fill(0, 1001, array())));
achievement_http_test_throws(function () {
    achievement_decode_graph();
}, 'component row cap is enforced');

$_POST['graph_json'] = json_encode(array(
    'components' => array(
        array('criteria' => array_fill(0, 2001, array())),
    ),
));
achievement_http_test_throws(function () {
    achievement_decode_graph();
}, 'criterion row cap is enforced');

achievement_http_test_assert(achievement_uint('0', 'Value') === 0, 'unsigned zero parses');
achievement_http_test_assert(achievement_uint('4294967295', 'Value') === 4294967295, 'uint32 maximum parses');
achievement_http_test_throws(function () {
    achievement_uint('-1', 'Value');
}, 'negative integers are rejected');
achievement_http_test_throws(function () {
    achievement_uint('4294967296', 'Value');
}, 'values above uint32 are rejected');
achievement_http_test_throws(function () {
    achievement_uint('1.5', 'Value');
}, 'decimal values are rejected');
achievement_http_test_assert(
    achievement_positive_platform_int((string) PHP_INT_MAX, 'Update ID') === PHP_INT_MAX,
    'platform-sized BIGINT identities parse without a uint32 cap'
);
achievement_http_test_throws(function () {
    achievement_positive_platform_int((string) PHP_INT_MAX . '0', 'Update ID');
}, 'BIGINT identities above the platform-safe range are rejected');

$_POST = array('csrf_token' => $token, 'confirmation' => 'DELETE 10');
achievement_require_confirmation('DELETE 10');
achievement_http_test_assert(true, 'exact destructive confirmation succeeds');
$_POST['confirmation'] = 'delete 10';
achievement_http_test_throws(function () {
    achievement_require_confirmation('DELETE 10');
}, 'destructive confirmation is exact and case-sensitive');

achievement_flash('success', '<saved>', array('<detail>'));
$flash = achievement_take_flash();
achievement_http_test_assert(count($flash) === 1 && $flash[0]['message'] === '<saved>', 'flash messages round-trip once');
achievement_http_test_assert(achievement_take_flash() === array(), 'flash messages are consumed');

achievement_store_failed_graph(array('id' => 77), array('bad row'), 'edit:77');
achievement_store_failed_graph(array('id' => 88), array('another row'), 'edit:88');
$failed = achievement_take_failed_graph('edit:77');
achievement_http_test_assert($failed['graph']['id'] === 77 && count($failed['errors']) === 1, 'failed graph round-trips once');
achievement_http_test_assert(achievement_take_failed_graph('edit:77')['graph'] === null, 'failed graph is consumed');
achievement_http_test_assert(achievement_take_failed_graph('edit:88')['graph']['id'] === 88, 'concurrent edit failures remain isolated');

achievement_store_failed_category(array('id' => 12, 'name' => 'Typed value'), array('bad category'), 12);
$failedCategory = achievement_take_failed_category(12);
achievement_http_test_assert($failedCategory['category']['name'] === 'Typed value', 'failed category input round-trips');
achievement_http_test_assert(achievement_take_failed_category(12)['category'] === null, 'failed category input is consumed');

achievement_http_test_assert(
    achievement_e('<script>"x"</script>') === '&lt;script&gt;&quot;x&quot;&lt;/script&gt;',
    'HTML output is escaped'
);
achievement_http_test_assert(
    achievement_url(3, array('achievement_id' => 10, 'q' => 'a b')) === 'index.php?editor=achievements&action=3&achievement_id=10&q=a+b',
    'feature URLs are bounded to the achievement editor'
);

fwrite(STDOUT, 'achievement_http_test: ' . $achievement_http_assertions . " assertions passed" . PHP_EOL);
