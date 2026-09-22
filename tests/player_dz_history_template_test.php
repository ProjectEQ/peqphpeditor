<?php

// Run with: php tests/player_dz_history_template_test.php
// Exercise the real renderer without a database or third-party dependencies.
require_once dirname(__DIR__) . '/classes/template.php';

error_reporting(E_ALL);
date_default_timezone_set('UTC');
set_error_handler(function ($severity, $message, $file, $line) {
  if (!(error_reporting() & $severity)) {
    return false;
  }
  throw new ErrorException($message, 0, $severity, $file, $line);
});
set_exception_handler(function ($exception) {
  fwrite(STDERR, 'FAIL: ' . $exception->getMessage() . PHP_EOL);
  exit(1);
});

$dzTemplateAssertions = 0;

function dz_template_assert($condition, $message)
{
  global $dzTemplateAssertions;
  ++$dzTemplateAssertions;
  if (!$condition) {
    throw new RuntimeException($message);
  }
}

function dz_template_contains($html, $text, $message)
{
  dz_template_assert(strpos($html, $text) !== false, $message);
}

function dz_template_render($history, $zones)
{
  $template = new Template(dirname(__DIR__) . '/templates/player/player.dz.history.tmpl.php');
  $template->set('dz_history', $history);
  $template->set('zoneids', $zones);
  $html = $template->fetch();
  dz_template_assert(trim($html) !== '', 'The history view renders content.');
  dz_template_assert(
    preg_match('/<(?:form|input|button|select|textarea|script)\b/i', $html) === 0,
    'The history view exposes no mutation controls or scripts.'
  );
  return $html;
}

$hostile = '<script data-dz-test="x">alert(1)</script>&\'';
$entry = array(
  'dz_id' => 42,
  'name' => 'Expedition ' . $hostile,
  'uuid' => 'UUID ' . $hostile,
  'season_id' => 3,
  'zone_id' => 124,
  'zone_version' => 2,
  'instance_id' => 88,
  'leader_id' => 456,
  'leader_name' => 'Leader ' . $hostile,
  'members' => 4,
  'max_players' => 6,
  'expires' => 1800003661,
  'status' => 'Eligible ' . $hostile,
);
$history = array(
  'player_id' => 123,
  'player_name' => 'Player ' . $hostile,
  'character_season' => 3,
  'checked_at' => 1800000000,
  'error' => '',
  'missing' => array(),
  'enabled' => true,
  'transactional' => true,
  'entries' => array($entry),
);
$zones = array(124 => 'Zone ' . $hostile);
$html = dz_template_render($history, $zones);
foreach (array($history['player_name'], $entry['name'], $entry['uuid'], $entry['leader_name'], $zones[124], $entry['status']) as $value) {
  dz_template_contains($html, htmlspecialchars($value, ENT_QUOTES, 'UTF-8'), 'Dynamic history text is escaped: ' . $value);
}
dz_template_contains($html, 'index.php?editor=player&amp;playerid=123', 'The player navigation uses the character ID.');
dz_template_contains($html, 'index.php?editor=player&amp;playerid=456', 'The leader links to the correct player.');
dz_template_contains($html, 'index.php?editor=expeditions&amp;action=4&amp;id=42', 'The expedition links to its detail page.');
dz_template_contains($html, 'Instance 88', 'The saved instance is visible.');
dz_template_contains($html, '4 / 6', 'The current roster and capacity are visible.');
dz_template_contains($html, '1h 1m 1s', 'Remaining time is calculated from the checked snapshot.');
dz_template_contains($html, 'DZManager checks live rules', 'Eligibility explains the live rejoin checks.');

$fallback = $history;
$fallback['entries'][0]['zone_id'] = 9999;
$fallback['entries'][0]['leader_name'] = '';
$fallbackHtml = dz_template_render($fallback, $zones);
dz_template_contains($fallbackHtml, 'Zone 9999', 'An unknown zone displays its numeric ID.');
dz_template_contains($fallbackHtml, '<td>None</td>', 'A missing leader has a readable fallback.');

$empty = $history;
$empty['entries'] = array();
$emptyHtml = dz_template_render($empty, $zones);
dz_template_contains($emptyHtml, 'No active saved expeditions with return permission.', 'An empty result has a clear explanation.');
dz_template_assert(strpos($emptyHtml, '<th') === false, 'An empty result has no misleading roster table.');

$missing = $history;
$missing['missing'] = array('character_dynamic_zone_resume', 'Missing ' . $hostile);
$missingHtml = dz_template_render($missing, $zones);
dz_template_contains($missingHtml, 'migrations must be installed', 'Missing schema explains the required server update.');
dz_template_contains($missingHtml, 'character_dynamic_zone_resume', 'Missing schema identifies the required table.');
dz_template_contains($missingHtml, htmlspecialchars($missing['missing'][1], ENT_QUOTES, 'UTF-8'), 'Schema diagnostics are escaped.');
dz_template_assert(strpos($missingHtml, 'id=42') === false, 'Missing schema does not display stale entries.');

$failed = $history;
$failed['error'] = 'History read failed ' . $hostile;
$failedHtml = dz_template_render($failed, $zones);
dz_template_contains($failedHtml, htmlspecialchars($failed['error'], ENT_QUOTES, 'UTF-8'), 'Read failures render an escaped diagnostic.');
dz_template_assert(strpos($failedHtml, 'id=42') === false, 'Read failures do not display stale entries.');
dz_template_assert(strpos($failedHtml, 'No active saved expeditions') === false, 'Read failures are distinct from an empty history.');

$disabled = $history;
$disabled['enabled'] = false;
$disabled['transactional'] = false;
$disabledHtml = dz_template_render($disabled, $zones);
dz_template_contains($disabledHtml, 'Saved rejoin is disabled', 'Disabled server rules are visible.');
dz_template_contains($disabledHtml, 'Retained history is shown below.', 'Disabled rules explain why retained history is displayed.');
dz_template_contains($disabledHtml, 'all participating expedition tables to use InnoDB', 'Unsupported storage explains the rejoin requirement.');
dz_template_contains($disabledHtml, 'id=42', 'Retained history remains visible when rejoin is unavailable.');

fwrite(STDOUT, 'DZ history template tests passed: ' . $dzTemplateAssertions . ' assertions.' . PHP_EOL);
