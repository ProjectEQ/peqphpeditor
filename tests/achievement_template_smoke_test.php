<?php

/**
 * Dependency-free smoke coverage for the achievement editor templates.
 *
 * This intentionally renders through PEQ's real Template class under a strict
 * error handler. Warnings and notices are failures because an incomplete view
 * payload otherwise becomes a production-only blank page in the legacy editor.
 *
 * To emit the rendered JavaScript without its outer <script> element for an
 * additional syntax check, set ACHIEVEMENT_TEMPLATE_JS_OUT to a writable path:
 *
 *   ACHIEVEMENT_TEMPLATE_JS_OUT=/tmp/achievement-editor.js php tests/achievement_template_smoke_test.php
 *   node --check /tmp/achievement-editor.js
 */

$achievementTemplateRoot = dirname(__DIR__);
chdir($achievementTemplateRoot);

require_once $achievementTemplateRoot . '/classes/template.php';
require_once $achievementTemplateRoot . '/lib/achievement_http.php';
require_once $achievementTemplateRoot . '/lib/achievement_metadata.php';

error_reporting(E_ALL);
set_error_handler(function ($severity, $message, $file, $line) {
  if (!(error_reporting() & $severity)) {
    return false;
  }
  throw new ErrorException($message, 0, $severity, $file, $line);
});

set_exception_handler(function ($exception) {
  fwrite(
    STDERR,
    'FAIL: uncaught ' . get_class($exception) . ': ' . $exception->getMessage()
      . ' at ' . $exception->getFile() . ':' . $exception->getLine() . PHP_EOL
  );
  exit(1);
});

$achievementTemplateAssertions = 0;

function achievement_template_test_assert($condition, $message)
{
  global $achievementTemplateAssertions;
  ++$achievementTemplateAssertions;
  if (!$condition) {
    fwrite(STDERR, 'FAIL: ' . $message . PHP_EOL);
    exit(1);
  }
}

function achievement_template_test_contains($haystack, $needle, $message)
{
  achievement_template_test_assert(
    strpos($haystack, $needle) !== false,
    $message . ' (missing ' . var_export($needle, true) . ')'
  );
}

function achievement_template_test_not_contains($haystack, $needle, $message)
{
  achievement_template_test_assert(
    strpos($haystack, $needle) === false,
    $message . ' (unexpected ' . var_export($needle, true) . ')'
  );
}

function achievement_template_test_render($file, $variables)
{
  $template = new Template($file);
  foreach ($variables as $name => $value) {
    $template->set($name, $value);
  }
  $rendered = $template->fetch();
  achievement_template_test_assert(is_string($rendered), $file . ' returns a string');
  achievement_template_test_assert(trim($rendered) !== '', $file . ' returns nonempty output');
  achievement_template_test_not_contains($rendered, '<?', $file . ' leaves no unrendered PHP tag');
  return $rendered;
}

function achievement_template_test_json($value)
{
  $encoded = json_encode(
    $value,
    JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES
  );
  achievement_template_test_assert($encoded !== false, 'fixture JSON encodes successfully');
  return $encoded;
}

$hostile = '\"><script data-achievement-hostile>alert(1)</script>&';
$csrfToken = 'template-smoke-token-' . $hostile;
$metadata = achievement_metadata();

$definition = array(
  'id' => 100010,
  'name' => 'Conqueror ' . $hostile,
  'description' => 'Complete every nested path ' . $hostile,
  'icon_id' => 42,
  'points' => 10,
  'reward_display' => 1,
  'world_display_flag' => 0,
  'definition_version' => 7,
  'reset_on_version_change' => 1,
  'enabled' => 1,
  'associations' => array(
    array(
      'category_id' => 7,
      'sequence' => 3,
      'display_text' => 'Category presentation ' . $hostile,
    ),
  ),
  'components' => array(
    array(
      'component_type' => 1,
      'sequence' => 5,
      'component_id' => 152250,
      'description' => 'Reach the maximum skill in Dual Wield ' . $hostile,
      'description_2' => 'Optional secondary text ' . $hostile,
      'presentation_count' => 1,
      'criteria' => array(
        array(
          'id' => 21412,
          'event_type' => 13,
          'progress_mode' => 3,
          'behavior' => 0,
          'target_id' => 22,
          'target_id2' => 1,
          'target_value' => 50,
          'required_count' => 1,
          'enabled' => 1,
        ),
      ),
    ),
  ),
  'rewards' => array(
    array(
      'reward_id' => '9900601',
      'sequence' => 100100,
      'reward_type' => 0,
      'reward_data_id' => 990061,
      'amount' => '1',
      'description' => 'Rallos Zek ornament ' . $hostile,
      'enabled' => 1,
      'option_id' => 100,
    ),
    array(
      'reward_id' => '9900602',
      'sequence' => 100010,
      'reward_type' => 2,
      'reward_data_id' => 0,
      'amount' => '1',
      'description' => 'Common AA point ' . $hostile,
      'enabled' => 1,
      'option_id' => 1,
    ),
  ),
  'reward_set' => array(
    'reward_set_id' => 3000100060,
    'title' => 'Conqueror choices ' . $hostile,
    'enabled' => 1,
    'options' => array(
      array(
        'option_id' => 1,
        'sequence' => 1,
        'label' => 'All choices include ' . $hostile,
        'common_to_all' => 1,
        'flags' => 0,
        'enabled' => 1,
      ),
      array(
        'option_id' => 100,
        'sequence' => 100,
        'label' => 'Axe ornament ' . $hostile,
        'common_to_all' => 0,
        'flags' => 0,
        'enabled' => 1,
      ),
    ),
  ),
  'restrictions' => array(
    array('restriction_id' => 407, 'requires_completed' => 1),
  ),
  'suggested_achievement_id' => 100011,
  'suggested_component_id' => 153350,
  'suggested_reward_set_id' => 3000100060,
  'is_create' => false,
);

$commonView = array(
  'csrf_token' => $csrfToken,
  'flash_messages' => array(
    array(
      'type' => 'warning',
      'message' => 'Strict render message ' . $hostile,
      'details' => array('Strict render detail ' . $hostile),
    ),
  ),
  'can_edit_achievements' => true,
  'can_manage_character_achievements' => true,
);

$definitionView = array_merge($commonView, array(
  'definition' => $definition,
  'metadata' => $metadata,
  'issues' => array(
    array(
      'path' => 'reward_set.options.1',
      'message' => 'Representative validation message ' . $hostile,
      'severity' => 'warning',
    ),
  ),
  'is_create' => false,
  'form_action' => achievement_url(4),
));

$definitionHtml = achievement_template_test_render(
  'templates/achievements/definition.form.tmpl.php',
  $definitionView
);

achievement_template_test_contains(
  $definitionHtml,
  achievement_e($definition['name']),
  'definition name is HTML escaped'
);
achievement_template_test_contains(
  $definitionHtml,
  achievement_e($definition['description']),
  'definition description is HTML escaped'
);
achievement_template_test_contains(
  $definitionHtml,
  achievement_e($csrfToken),
  'definition CSRF token is HTML escaped'
);
achievement_template_test_not_contains(
  $definitionHtml,
  '<script data-achievement-hostile>',
  'definition rendering does not create an injected script element'
);
achievement_template_test_contains(
  $definitionHtml,
  'name="graph_json"',
  'definition form submits one bounded graph payload'
);
foreach (array(4, 5, 6) as $action) {
  achievement_template_test_contains(
    $definitionHtml,
    'action="' . achievement_e(achievement_url($action)) . '"',
    'definition template exposes POST action ' . $action
  );
}
achievement_template_test_contains(
  $definitionHtml,
  'Type DELETE 100010',
  'definition deletion teaches the exact confirmation phrase'
);
achievement_template_test_contains(
  $definitionHtml,
  'data-achievement-add-component',
  'definition graph exposes dynamic component controls'
);
achievement_template_test_contains(
  $definitionHtml,
  'data-achievement-add-reward',
  'definition graph exposes dynamic reward controls'
);
achievement_template_test_contains(
  $definitionHtml,
  'Current authoring checks',
  'definition form exposes client-side validation education'
);

$createView = $definitionView;
$createView['is_create'] = true;
$createView['form_action'] = achievement_url(2);
$createHtml = achievement_template_test_render(
  'templates/achievements/definition.form.tmpl.php',
  $createView
);
achievement_template_test_contains(
  $createHtml,
  'action="' . achievement_e(achievement_url(2)) . '"',
  'create mode targets the create action'
);
achievement_template_test_contains(
  $createHtml,
  'Create achievement definition',
  'create mode renders draft-first guidance'
);
achievement_template_test_not_contains(
  $createHtml,
  'Delete authored content',
  'create mode does not expose delete controls'
);

$javascriptView = array(
  'definition_json' => achievement_template_test_json($definition),
  'metadata_json' => achievement_template_test_json($metadata),
  'category_options' => array(
    7 => 'General ' . $hostile,
    407 => 'Highpass ' . $hostile,
  ),
  'lookup_url' => achievement_url(60, array('source' => $hostile)),
  'is_create' => false,
  'persisted_reward_set_id' => 3000100060,
  'persisted_component_keys' => array('1:152250'),
  'persisted_reward_ids' => array('9900601', '9900602'),
  'persisted_option_ids' => array('1', '100'),
);
$javascriptHtml = achievement_template_test_render(
  'templates/achievements/js.tmpl.php',
  $javascriptView
);
achievement_template_test_contains(
  $javascriptHtml,
  'var INITIAL_DEFINITION = {',
  'JavaScript receives the initial nested graph'
);
achievement_template_test_contains(
  $javascriptHtml,
  '\\u003Cscript data-achievement-hostile\\u003E',
  'JavaScript graph JSON hex-escapes hostile tags'
);
achievement_template_test_not_contains(
  $javascriptHtml,
  '<script data-achievement-hostile>',
  'JavaScript payload cannot terminate into an injected script element'
);
achievement_template_test_assert(
  substr_count($javascriptHtml, '</script>') === 1,
  'rendered JavaScript has exactly one closing script element'
);
achievement_template_test_contains(
  $javascriptHtml,
  'MAX_GRAPH_BYTES = 2 * 1024 * 1024',
  'client graph-size safety limit is present'
);
achievement_template_test_contains(
  $javascriptHtml,
  'fetch(',
  'dynamic reference lookups are present'
);
achievement_template_test_contains(
  $javascriptHtml,
  'data-achievement-validation-summary',
  'dynamic validation is wired to the visible summary'
);
achievement_template_test_contains(
  $javascriptHtml,
  'Persisted - retire only',
  'persisted definition identities expose retire-only guidance'
);
achievement_template_test_contains(
  $javascriptHtml,
  'Set Enabled to 0 to retire it safely.',
  'persisted grant and option controls explain the safe retirement path'
);

$retryLedger = array(
  'reward_id' => '9900601',
  'status' => 0,
  'granted_at' => 0,
  'attempt_count' => 2,
  'last_attempt_at' => 1770000000,
  'last_error' => 'Ambiguous delivery ' . $hostile,
);
$selection = array(
  'reward_set_id' => 3000100060,
  'selected_option_id' => 100,
  'status' => 2,
  'attempt_count' => 3,
  'claimed_at' => 0,
  'last_attempt_at' => 1770000050,
  'last_error' => 'Selection failed ' . $hostile,
);
$matchedProgress = array(
  'component_type' => 1,
  'component_id' => 152250,
  'component_sequence' => 5,
  'current_count' => 0,
  'completed' => 0,
  'definition_version' => 7,
  'updated_at' => 1770000100,
);
$unmatchedProgress = array(
  'component_type' => 2,
  'component_id' => 999,
  'component_sequence' => 99,
  'current_count' => 4,
  'completed' => 0,
  'definition_version' => 6,
  'updated_at' => 1770000200,
);

$currentCharacterDefinition = array(
  'id' => 100010,
  'name' => 'Conqueror state ' . $hostile,
  'description' => 'Current definition state ' . $hostile,
  'points' => 10,
  'definition_version' => 7,
  'reset_on_version_change' => 1,
  'enabled' => 1,
  'definition_missing' => 0,
  'completion' => null,
  'components' => array(
    array(
      'component_type' => 1,
      'component_id' => 152250,
      'sequence' => 5,
      'description' => 'Dual Wield maximum ' . $hostile,
      'presentation_count' => 1,
      'state_bearing' => true,
      'effective_count_conflict' => false,
      'effective_required_count' => 1,
      'progress' => $matchedProgress,
      'criteria' => array(
        array(
          'id' => 21412,
          'enabled' => 1,
          'event_type' => 13,
          'progress_mode' => 3,
          'behavior' => 0,
          'target_id' => 22,
          'target_id2' => 1,
          'target_value' => 50,
          'required_count' => 1,
        ),
      ),
    ),
  ),
  'progress' => array($matchedProgress, $unmatchedProgress),
  'rewards' => array(
    array(
      'reward_id' => '9900601',
      'sequence' => 100100,
      'reward_type' => 0,
      'reward_data_id' => 990061,
      'amount' => '1',
      'description' => 'Axe ornament ' . $hostile,
      'enabled' => 1,
      'ledger' => $retryLedger,
    ),
  ),
  'reward_sets' => array(
    array(
      'reward_set_id' => 3000100060,
      'title' => 'Conqueror reward choice ' . $hostile,
      'enabled' => 1,
      'selection' => $selection,
      'options' => array(
        array(
          'option_id' => 1,
          'label' => 'Common AA ' . $hostile,
          'common_to_all' => 1,
          'enabled' => 1,
          'entries' => array(
            array(
              'reward_id' => '9900602',
              'reward' => array('reward_type' => 2),
            ),
          ),
        ),
        array(
          'option_id' => 100,
          'label' => 'Axe choice ' . $hostile,
          'common_to_all' => 0,
          'enabled' => 1,
          'entries' => array(
            array(
              'reward_id' => '9900601',
              'reward' => array('reward_type' => 0),
            ),
          ),
        ),
      ),
    ),
  ),
  'reward_ledgers' => array($retryLedger),
  'reward_selections' => array($selection),
  'orphan_reward_ledgers' => array(
    array(
      'reward_id' => '9999998',
      'status' => 2,
      'granted_at' => 0,
      'attempt_count' => 1,
      'last_error' => 'Missing canonical reward ' . $hostile,
    ),
  ),
  'orphan_reward_selections' => array(
    array(
      'reward_set_id' => 9999997,
      'selected_option_id' => 9,
      'status' => 3,
      'attempt_count' => 1,
      'claimed_at' => 0,
      'last_attempt_at' => 1770000300,
      'last_error' => 'Missing canonical set ' . $hostile,
    ),
  ),
  'pending_mutations' => array(
    array(
      'mutation_id' => '9223372036854775806',
      'status' => 1,
      'definition_version' => 7,
      'source_target_type' => 0,
      'source_target_id' => 407,
      'operation' => 0,
      'component_type' => 1,
      'component_id' => 152250,
      'requested_value' => 1,
      'created_at' => 1770000400,
      'attempt_count' => 2,
      'last_attempt_at' => 1770000450,
      'last_error' => 'Blocked mutation ' . $hostile,
    ),
    array(
      'mutation_id' => '9223372036854775805',
      'status' => 2,
      'definition_version' => 7,
      'source_target_type' => 0,
      'source_target_id' => 407,
      'operation' => 0,
      'component_type' => 1,
      'component_id' => 152250,
      'requested_value' => 1,
      'created_at' => 1770000500,
      'attempt_count' => 1,
      'last_attempt_at' => 1770000550,
      'last_error' => 'Processing mutation ' . $hostile,
    ),
  ),
  'durable_state' => 'in_progress',
  'has_version_mismatch' => false,
  'reward_needs_attention' => true,
);

$deletedCharacterDefinition = array(
  'id' => 999999,
  'name' => 'Deleted definition #999999',
  'description' => 'Preserved durable history ' . $hostile,
  'points' => 0,
  'definition_version' => 4,
  'reset_on_version_change' => 0,
  'enabled' => 0,
  'definition_missing' => 1,
  'completion' => array('completed_at' => 1760000000, 'definition_version' => 4),
  'components' => array(),
  'progress' => array($unmatchedProgress),
  'rewards' => array(),
  'reward_sets' => array(),
  'reward_ledgers' => array(),
  'reward_selections' => array(),
  'orphan_reward_ledgers' => array(
    array(
      'reward_id' => '9999999',
      'status' => 1,
      'granted_at' => 1760000100,
      'attempt_count' => 1,
      'last_error' => 'Historical grant ' . $hostile,
    ),
  ),
  'orphan_reward_selections' => array(),
  'pending_mutations' => array(),
  'durable_state' => 'completed',
  'has_version_mismatch' => false,
  'reward_needs_attention' => false,
);

$characterView = array_merge($commonView, array(
  'character' => array(
    'id' => 1015,
    'name' => 'Lyric ' . $hostile,
    'level' => 60,
    'class' => 8,
    'ingame' => 0,
    'last_login' => 1770000000,
  ),
  'catalog' => array(
    'rows' => array($currentCharacterDefinition, $deletedCharacterDefinition),
    'total' => 2,
    'page' => 1,
    'per_page' => 25,
    'pages' => 2,
    'orphan_total' => 1,
  ),
  'filters' => array(
    'q' => 'Conqueror ' . $hostile,
    'category' => 7,
    'state' => 'all',
    'page' => 1,
    'per_page' => 25,
  ),
  'category_options' => array(7 => 'General ' . $hostile),
  'metadata' => $metadata,
  'classes' => array(8 => 'Bard ' . $hostile),
  'orphan_state' => array(
    'character' => array('id' => 1015),
    'achievement_ids' => array(999999),
    'completions' => array($deletedCharacterDefinition['completion']),
    'progress' => array($unmatchedProgress),
    'reward_ledgers' => $deletedCharacterDefinition['orphan_reward_ledgers'],
    'reward_selections' => array($selection),
    'pending_mutations' => array(),
  ),
));

$characterHtml = achievement_template_test_render(
  'templates/achievements/character.tmpl.php',
  $characterView
);
achievement_template_test_contains(
  $characterHtml,
  achievement_e($characterView['character']['name']),
  'character name is HTML escaped'
);
achievement_template_test_contains(
  $characterHtml,
  achievement_e($currentCharacterDefinition['description']),
  'nested character definition text is HTML escaped'
);
achievement_template_test_contains(
  $characterHtml,
  achievement_e($retryLedger['last_error']),
  'nested reward diagnostic is HTML escaped'
);
achievement_template_test_not_contains(
  $characterHtml,
  '<script data-achievement-hostile>',
  'character state rendering does not create an injected script element'
);
foreach (range(42, 48) as $action) {
  achievement_template_test_contains(
    $characterHtml,
    'action="' . achievement_e(achievement_url($action)) . '"',
    'character template exposes POST action ' . $action
  );
}
foreach (array(
  'FORCE COMPLETE 100010',
  'RESET 100010',
  'RESET REWARDS 100010',
  'RETRY 9900601',
  'RETRY SET 3000100060',
  'DISCARD 9223372036854775806',
) as $confirmationMarker) {
  achievement_template_test_contains(
    $characterHtml,
    $confirmationMarker,
    'character template teaches confirmation ' . $confirmationMarker
  );
}
achievement_template_test_contains(
  $characterHtml,
  'accept_duplicate_risk',
  'reward retry controls require duplicate-risk acceptance'
);
achievement_template_test_contains(
  $characterHtml,
  'Processing rows cannot be discarded.',
  'processing mutations are visibly protected from discard'
);
achievement_template_test_contains(
  $characterHtml,
  'The authored definition is missing.',
  'deleted definitions are clearly distinguished from current content'
);
achievement_template_test_contains(
  $characterHtml,
  'deleted definition',
  'preserved orphaned history is surfaced to administrators'
);
achievement_template_test_contains(
  $characterHtml,
  'Offline',
  'runtime safety state is visible'
);

$onlineCharacterView = $characterView;
$onlineCharacterView['character']['ingame'] = 1;
$onlineCharacterHtml = achievement_template_test_render(
  'templates/achievements/character.tmpl.php',
  $onlineCharacterView
);
achievement_template_test_contains(
  $onlineCharacterHtml,
  'Log this character out before using offline-only controls.',
  'online characters receive explicit offline-only guidance'
);
achievement_template_test_contains(
  $onlineCharacterHtml,
  'Online / in game',
  'online runtime state is visible'
);

$javascriptOutput = getenv('ACHIEVEMENT_TEMPLATE_JS_OUT');
if ($javascriptOutput !== false && trim((string) $javascriptOutput) !== '') {
  $javascriptProgram = preg_replace('/^\s*<script>\s*/', '', $javascriptHtml, 1);
  $javascriptProgram = preg_replace('/\s*<\/script>\s*$/', '', $javascriptProgram, 1);
  achievement_template_test_not_contains(
    $javascriptProgram,
    '<script>',
    'emitted JavaScript excludes the outer opening element'
  );
  achievement_template_test_not_contains(
    $javascriptProgram,
    '</script>',
    'emitted JavaScript excludes the outer closing element'
  );
  $written = file_put_contents((string) $javascriptOutput, $javascriptProgram);
  achievement_template_test_assert($written !== false, 'rendered JavaScript is written for syntax checking');
  fwrite(STDOUT, 'Rendered JavaScript: ' . (string) $javascriptOutput . PHP_EOL);
}

fwrite(
  STDOUT,
  'Achievement template smoke tests passed: ' . $achievementTemplateAssertions . ' assertions.' . PHP_EOL
);
