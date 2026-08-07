<?php

/**
 * Dependency-free shell and legacy-theme regression coverage.
 *
 * The achievement feature has a large inner UI, so it must not widen or
 * restyle PEQ's shared 900px banner/navigation shell. Navigation placement is
 * also source-checked because the legacy menu uses tightly packed floats.
 */

$achievementLayoutRoot = dirname(__DIR__);
chdir($achievementLayoutRoot);

require_once $achievementLayoutRoot . '/classes/template.php';

$achievementLayoutAssertions = 0;

function achievement_layout_test_assert($condition, $message)
{
  global $achievementLayoutAssertions;
  ++$achievementLayoutAssertions;
  if (!$condition) {
    fwrite(STDERR, 'FAIL: ' . $message . PHP_EOL);
    exit(1);
  }
}

function achievement_layout_test_contains($haystack, $needle, $message)
{
  achievement_layout_test_assert(
    strpos($haystack, $needle) !== false,
    $message . ' (missing ' . var_export($needle, true) . ')'
  );
}

function achievement_layout_test_not_contains($haystack, $needle, $message)
{
  achievement_layout_test_assert(
    strpos($haystack, $needle) === false,
    $message . ' (unexpected ' . var_export($needle, true) . ')'
  );
}

function achievement_layout_test_render_shell($editor, $body)
{
  $template = new Template('templates/index.tmpl.php');
  $template->set('editor', $editor);
  $template->set('body', $body);
  $template->set('headbar', '<div id="menubar">test navigation</div>');
  return $template->fetch();
}

$achievementBody = '<div class="achievement-editor-page">achievement fixture</div>';
$achievementHtml = achievement_layout_test_render_shell('achievements', $achievementBody);
$ordinaryHtml = achievement_layout_test_render_shell('items', '<div>item fixture</div>');

achievement_layout_test_contains(
  $achievementHtml,
  '<meta name="viewport" content="width=900">',
  'achievement routes retain PEQ\'s fixed-width viewport'
);
achievement_layout_test_contains(
  $achievementHtml,
  '<body class="achievement-editor-shell">',
  'achievement routes use a shell-only body marker'
);
achievement_layout_test_contains(
  $achievementHtml,
  $achievementBody,
  'the feature root remains independently scoped inside the shell'
);
achievement_layout_test_not_contains(
  $achievementHtml,
  '<body class="achievement-editor-page">',
  'the feature root class never leaks onto the shared body shell'
);
achievement_layout_test_contains(
  $ordinaryHtml,
  '<body class="">',
  'ordinary routes retain the unmodified stock body'
);
achievement_layout_test_not_contains(
  $ordinaryHtml,
  'achievement-editor-shell',
  'ordinary routes receive no achievement shell styling'
);

$css = file_get_contents($achievementLayoutRoot . '/css/peq.css');
achievement_layout_test_assert($css !== false, 'achievement stylesheet is readable');
achievement_layout_test_contains($css, 'body.achievement-editor-shell {', 'shell styles use the isolated body marker');
achievement_layout_test_contains($css, 'body.achievement-editor-shell #container {', 'achievement shell has an explicit container contract');
achievement_layout_test_contains($css, 'width: 900px;', 'the stock 900px shell width remains present');
achievement_layout_test_contains($css, 'body.achievement-editor-shell #menubar {', 'achievement shell preserves stock menu geometry');
achievement_layout_test_contains($css, 'width: 890px;', 'the stock 890px menu width remains present');
achievement_layout_test_contains($css, '/* Legacy PEQ presentation', 'the inner feature uses the legacy PEQ skin');
achievement_layout_test_contains($css, 'background: #000000;', 'legacy table/header black remains in the feature skin');
achievement_layout_test_contains($css, 'background: #cccccc;', 'legacy PEQ gray remains in the feature skin');
achievement_layout_test_not_contains($css, 'body.achievement-editor-page', 'inner feature selectors cannot target the outer body');
achievement_layout_test_not_contains($css, 'min(1480px', 'achievement routes cannot widen the PEQ shell');

$headbars = file_get_contents($achievementLayoutRoot . '/lib/headbars.php');
achievement_layout_test_assert($headbars !== false, 'navigation source is readable');
$achievementLink = 'index.php?editor=achievements';
achievement_layout_test_assert(
  substr_count($headbars, $achievementLink) === 1,
  'navigation contains exactly one Achievements entry'
);

$tasksPosition = strpos($headbars, 'index.php?editor=tasks');
$itemsPosition = strpos($headbars, 'index.php?editor=items');
$playersPosition = strpos($headbars, 'index.php?editor=player');
$pvpPosition = strpos($headbars, 'index.php?editor=pvp');
$achievementPosition = strpos($headbars, $achievementLink);
$dataBucketsPosition = strpos($headbars, 'index.php?editor=databuckets');

achievement_layout_test_assert(
  $tasksPosition !== false && $itemsPosition !== false && $playersPosition !== false
    && $tasksPosition < $itemsPosition && $itemsPosition < $playersPosition,
  'the stock first row still ends with Items before the player row'
);
achievement_layout_test_assert(
  $pvpPosition !== false && $achievementPosition !== false && $dataBucketsPosition !== false
    && $pvpPosition < $achievementPosition && $achievementPosition < $dataBucketsPosition,
  'Achievements begins the third World Data row before Data Buckets'
);

fwrite(
  STDOUT,
  'OK: ' . $achievementLayoutAssertions . ' achievement layout assertions passed.' . PHP_EOL
);
