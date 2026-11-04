<?php

// Run with: php -d short_open_tag=1 tests/php_version_test.php
require_once __DIR__ . '/../lib/common.php';
require_once __DIR__ . '/../classes/template.php';

$cases = array(
  '5.6.40' => false,
  '7.1.33' => false,
  '7.4.33' => false,
  '8.0.30' => false,
  '8.1.34' => false,
  '8.2.0' => false,
  '8.2.34' => false,
  '8.2.35' => true,
  '8.2.36' => true,
  '8.3.0' => false,
  '8.3.35' => false,
  '8.3.36' => true,
  '8.3.37' => true,
  '8.4.0' => false,
  '8.4.26' => false,
  '8.4.27' => true,
  '8.4.28' => true,
  '8.5.0' => false,
  '8.5.11' => false,
  '8.5.12' => true,
  '8.5.13' => true,
  '8.2.35RC1' => false,
  '8.3.36-RC1' => false,
  '8.4.27beta1' => false,
  '8.5.12-dev' => false,
  '8.5.13RC1' => false,
  '8.6.0RC3' => false,
  '8.6.0' => false,
  '9.0.0' => false,
  '8.2.34-1+deb12u1' => false,
  '8.2.35-1+deb12u1' => true,
  '8.3.36-1ubuntu1' => true,
  '8.5.12-1-dev' => false,
  '' => false,
  'unknown' => false,
  '8.2' => false,
  '8.2.35garbage' => false
);

$checks = 0;
function check($condition, $message) {
  global $checks;
  $checks++;
  if (!$condition) {
    fwrite(STDERR, "FAIL: $message\n");
    exit(1);
  }
}

check(ini_get('short_open_tag') == 1, 'short_open_tag must be enabled for template tests');
foreach ($cases as $version => $expected) {
  check(php_version_meets_security_baseline($version) === $expected, "version $version");
}

// Exercise the real template with this process's runtime, without a database.
$intro = new Template(__DIR__ . '/../templates/intro.tmpl.php');
$intro->set('current_revision', 'security test');
$html = $intro->fetch();
$warning = 'does not match a known patched upstream release';
check((strpos($html, $warning) !== false) === !php_version_meets_security_baseline(PHP_VERSION), 'runtime warning visibility');
check(strpos($html, 'security test') !== false, 'revision still renders');
check(strpos($html, 'upgrade to PHP 7') === false, 'no obsolete PHP 7 recommendation');

class VersionTestDatabase {
  public $queries = 0;
  function query_assoc($query) {
    $this->queries++;
    return array('version' => 1);
  }
}

$mysql = new VersionTestDatabase();
$intro->set('current_db_version', 2);
$html = $intro->fetch();
check($mysql->queries === 1, 'database version check still runs');
check(strpos($html, 'Your database schema (1)') !== false, 'database mismatch warning still renders');

echo "PASS: $checks checks on PHP " . PHP_VERSION . "\n";
