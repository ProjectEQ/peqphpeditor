<?php
require_once('templates/achievements/_common.tmpl.php');

$characterRow = achievement_view_array(isset($character) ? $character : array());
$catalogPage = achievement_view_array(isset($catalog) ? $catalog : array());
$achievementRows = isset($catalogPage['rows']) && is_array($catalogPage['rows']) ? $catalogPage['rows'] : array();
$characterFilters = achievement_view_array(isset($filters) ? $filters : array());
$categoryOptions = achievement_view_array(isset($category_options) ? $category_options : array());
$achievementMetadata = achievement_view_array(isset($metadata) ? $metadata : array());
$classLabels = achievement_view_array(isset($classes) ? $classes : array());
$orphanState = achievement_view_array(isset($orphan_state) ? $orphan_state : array());
$characterId = (int) achievement_view_value($characterRow, 'id', 0);
$classId = (int) achievement_view_value($characterRow, 'class', 0);
$className = isset($classLabels[$classId]) ? $classLabels[$classId] : (isset($achievementMetadata['classes'][$classId]) ? $achievementMetadata['classes'][$classId] : 'Unknown class ' . $classId);
$isOnline = (int) achievement_view_value($characterRow, 'ingame', 0) !== 0;
$orphanIds = achievement_view_array(achievement_view_value($orphanState, 'achievement_ids', array()));
$orphanCompletionRows = achievement_view_array(achievement_view_value($orphanState, 'completions', array()));
$orphanProgressRows = achievement_view_array(achievement_view_value($orphanState, 'progress', array()));
$orphanLedgerRows = achievement_view_array(achievement_view_value($orphanState, 'reward_ledgers', array()));
$orphanSelectionRows = achievement_view_array(achievement_view_value($orphanState, 'reward_selections', array()));
$orphanUpdateRows = achievement_view_array(achievement_view_value($orphanState, 'pending_updates', array()));
$orphanHistoryCount = count($orphanCompletionRows) + count($orphanProgressRows) + count($orphanLedgerRows) + count($orphanSelectionRows) + count($orphanUpdateRows);
$queryText = isset($characterFilters['q']) ? (string) $characterFilters['q'] : '';
$categoryFilter = isset($characterFilters['category']) ? (int) $characterFilters['category'] : 0;
$stateFilter = isset($characterFilters['state']) ? (string) $characterFilters['state'] : 'all';
$perPage = isset($characterFilters['per_page']) ? (int) $characterFilters['per_page'] : 25;
$stateOptions = array(
  'all' => 'All current definitions',
  'completed' => 'Completed',
  'not_completed' => 'Not completed',
  'in_progress' => 'In progress',
  'not_started' => 'Not started',
  'version_mismatch' => 'Version mismatch',
  'reward_attention' => 'Reward attention',
  'pending_update' => 'Pending update',
  'orphaned' => 'Deleted definition / orphaned history',
);
$pagerParameters = array(
  'playerid' => $characterId,
  'q' => $queryText,
  'category' => $categoryFilter,
  'state' => $stateFilter,
  'per_page' => $perPage,
);

if (!function_exists('achievement_character_enum')) {
  function achievement_character_enum($metadata, $group, $value) {
    $value = (int) $value;
    return isset($metadata[$group][$value]['label'])
      ? (string) $metadata[$group][$value]['label']
      : 'Unknown (' . $value . ')';
  }
}

if (!function_exists('achievement_character_enum_help')) {
  function achievement_character_enum_help($metadata, $group, $value, $fallback) {
    $value = (int) $value;
    return isset($metadata[$group][$value]['help'])
      ? (string) $metadata[$group][$value]['help']
      : (string) $fallback;
  }
}

if (!function_exists('achievement_character_post_identity')) {
  function achievement_character_post_identity($csrfToken, $characterId, $achievementId) {
    echo '<input type="hidden" name="csrf_token" value="' . achievement_e($csrfToken) . '">';
    echo '<input type="hidden" name="playerid" value="' . achievement_e($characterId) . '">';
    echo '<input type="hidden" name="achievement_id" value="' . achievement_e($achievementId) . '">';
  }
}

if (!function_exists('achievement_character_definition_status')) {
  function achievement_character_definition_status($definition) {
    if (!empty($definition['definition_missing'])) {
      return 'Deleted definition';
    }
    return !empty($definition['enabled']) ? 'Enabled definition' : 'Disabled definition';
  }
}
?>
<div class="achievement-editor-page achievement-character-detail-page">
  <?php achievement_view_nav('characters', true); ?>
  <?php achievement_view_flash(isset($flash_messages) ? $flash_messages : array()); ?>

  <section class="achievement-page-heading">
    <div>
      <p class="achievement-eyebrow">Administrative character state</p>
      <h1><?=achievement_e(achievement_view_value($characterRow, 'name', 'Unnamed character'))?> achievements</h1>
      <p>Inspect durable completion, component progress, reward idempotency ledgers, selections, and cross-zone update history.</p>
    </div>
    <div class="achievement-heading-actions">
      <a class="achievement-button is-secondary" href="<?=achievement_e(achievement_url(40))?>" title="Return to the character achievement picker">Back to characters</a>
      <a class="achievement-button is-secondary" href="<?=achievement_e(achievement_url(0))?>" title="Open global achievement definitions">Achievement content</a>
    </div>
  </section>

  <section class="achievement-character-summary" aria-label="Character identity and runtime status">
    <span class="achievement-badge" title="character_data.id">ID <?=achievement_e($characterId)?></span>
    <span class="achievement-badge" title="Saved character level and class">Level <?=achievement_e(achievement_view_value($characterRow, 'level', 0))?> <?=achievement_e($className)?></span>
    <span class="achievement-badge <?=$isOnline ? 'is-warning' : 'is-success'?>" title="character_data.ingame is <?=$isOnline ? 'nonzero' : 'zero'?>"><?=$isOnline ? 'Online / in game' : 'Offline'?></span>
    <span class="achievement-badge" title="Most recent recorded character login">Last login: <?=achievement_e(achievement_view_timestamp(achievement_view_value($characterRow, 'last_login', 0)))?></span>
  </section>

  <section class="achievement-callout is-warning" role="note">
    <strong>These controls edit server-owned durable state.</strong>
    <p>Exact progress, completion, resets, and reward retry overrides are offline-only because a zone server caches character state. Reward ledgers are at-most-once safety boundaries and survive an ordinary reset. All actions are serialized with the EQEmu character-achievement lock.</p>
    <?php if ($isOnline): ?><p><strong>Log this character out before using offline-only controls.</strong> The controls remain visible for education, but are disabled.</p><?php endif; ?>
  </section>

  <?php if ($orphanIds): ?>
    <section class="achievement-callout is-danger" role="alert">
      <strong><?=achievement_e(count($orphanIds))?> deleted definition<?=count($orphanIds) === 1 ? '' : 's'?> still own durable history.</strong>
      <p><?=achievement_e($orphanHistoryCount)?> preserved state row<?=($orphanHistoryCount === 1 ? '' : 's')?> reference content definitions that no longer exist. This evidence is never silently discarded; review it before using a reset.</p>
      <a class="achievement-button is-small is-danger" href="<?=achievement_e(achievement_url(41, array('playerid' => $characterId, 'state' => 'orphaned', 'per_page' => $perPage)))?>" title="Show only state whose global achievement definition is missing">Review orphaned history</a>
    </section>
  <?php endif; ?>

  <section class="achievement-panel achievement-filter-panel" aria-labelledby="achievement-character-filters-heading">
    <div class="achievement-panel-heading">
      <div><h2 id="achievement-character-filters-heading">Catalog filters</h2><p>State filters are derived only from persisted rows. Category filtering matches direct associations.</p></div>
      <span class="achievement-badge"><?=achievement_e(achievement_view_value($catalogPage, 'total', 0))?> matches</span>
    </div>
    <form method="get" action="index.php" class="achievement-filter-grid">
      <input type="hidden" name="editor" value="achievements">
      <input type="hidden" name="action" value="41">
      <input type="hidden" name="playerid" value="<?=achievement_e($characterId)?>">
      <div class="achievement-field achievement-field-span-2">
        <?php achievement_view_field_heading('achievement-character-definition-search', 'Achievement ID, name, or description', 'Search presentation text and stable global achievement identity.'); ?>
        <input id="achievement-character-definition-search" name="q" type="search" maxlength="255" value="<?=achievement_e($queryText)?>" aria-describedby="achievement-character-definition-search-help" placeholder="Example: Conqueror or 100010">
      </div>
      <div class="achievement-field">
        <?php achievement_view_field_heading('achievement-character-category', 'Category', 'Matches a direct authored category association; descendants are not automatically included.'); ?>
        <select id="achievement-character-category" name="category" aria-describedby="achievement-character-category-help">
          <option value="0">All categories</option>
          <?php foreach ($categoryOptions as $categoryId => $categoryLabel): ?>
            <option value="<?=achievement_e($categoryId)?>" <?=$categoryFilter === (int) $categoryId ? 'selected' : ''?>><?=achievement_e($categoryLabel)?> [<?=achievement_e($categoryId)?>]</option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="achievement-field">
        <?php achievement_view_field_heading('achievement-character-state', 'Durable state', 'Computed from completion, progress, reward, selection, pending-update, and missing-definition rows.'); ?>
        <select id="achievement-character-state" name="state" aria-describedby="achievement-character-state-help">
          <?php foreach ($stateOptions as $stateValue => $stateLabel): ?>
            <option value="<?=achievement_e($stateValue)?>" <?=$stateFilter === $stateValue ? 'selected' : ''?>><?=achievement_e($stateLabel)?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="achievement-field">
        <?php achievement_view_field_heading('achievement-character-per-page', 'Rows per page', 'Limits graph hydration and keeps the detail page responsive.'); ?>
        <select id="achievement-character-per-page" name="per_page" aria-describedby="achievement-character-per-page-help">
          <?php foreach (array(10, 25, 50, 100) as $pageSize): ?><option value="<?=achievement_e($pageSize)?>" <?=$perPage === $pageSize ? 'selected' : ''?>><?=achievement_e($pageSize)?></option><?php endforeach; ?>
        </select>
      </div>
      <div class="achievement-filter-actions">
        <button class="achievement-button" type="submit" title="Apply all character achievement filters">Filter</button>
        <a class="achievement-button is-secondary" href="<?=achievement_e(achievement_url(41, array('playerid' => $characterId)))?>" title="Clear all filters">Clear</a>
      </div>
    </form>
  </section>

  <div class="achievement-result-meta">
    <span>Page <?=achievement_e(achievement_view_value($catalogPage, 'page', 1))?> of <?=achievement_e(max(1, (int) achievement_view_value($catalogPage, 'pages', 0)))?></span>
    <span>Definition graphs are expanded below; risky actions require explicit confirmation.</span>
  </div>
  <?php achievement_view_pager(41, achievement_view_value($catalogPage, 'page', 1), achievement_view_value($catalogPage, 'pages', 0), $pagerParameters); ?>

  <?php if (!$achievementRows): ?>
    <section class="achievement-empty-state"><strong>No achievements match these filters.</strong><p>Clear one or more filters, or use the orphan-history filter if the global definition was deleted.</p></section>
  <?php endif; ?>

  <div class="achievement-character-achievement-list">
  <?php foreach ($achievementRows as $definition): ?>
    <?php
      $definition = achievement_view_array($definition);
      $achievementId = (int) achievement_view_value($definition, 'id', 0);
      $definitionMissing = !empty($definition['definition_missing']);
      $definitionEnabled = !empty($definition['enabled']);
      $completion = isset($definition['completion']) && is_array($definition['completion']) ? $definition['completion'] : null;
      $components = achievement_view_array(achievement_view_value($definition, 'components', array()));
      $rawProgress = achievement_view_array(achievement_view_value($definition, 'progress', array()));
      $rewards = achievement_view_array(achievement_view_value($definition, 'rewards', array()));
      $rewardSets = achievement_view_array(achievement_view_value($definition, 'reward_sets', array()));
      $rewardLedgers = achievement_view_array(achievement_view_value($definition, 'reward_ledgers', array()));
      $rewardSelections = achievement_view_array(achievement_view_value($definition, 'reward_selections', array()));
      $orphanRewardLedgers = achievement_view_array(achievement_view_value($definition, 'orphan_reward_ledgers', array()));
      $orphanSelections = achievement_view_array(achievement_view_value($definition, 'orphan_reward_selections', array()));
      $updates = achievement_view_array(achievement_view_value($definition, 'pending_updates', array()));
      $durableState = (string) achievement_view_value($definition, 'durable_state', 'not_started');
      $hasVersionMismatch = !empty($definition['has_version_mismatch']);
      $forceCompleteDisabled = $isOnline || $definitionMissing || !$definitionEnabled || $completion || $hasVersionMismatch;
      $forceCompleteTitle = $hasVersionMismatch
        ? 'Force completion is disabled because existing durable progress uses another exact definition version. Reset or reconcile it first.'
        : 'Writes durable completion only; rewards and dependencies reconcile on next load';
      $componentKeys = array();
      foreach ($components as $componentIndexRow) {
        $componentKeys[(int) achievement_view_value($componentIndexRow, 'component_type', -1) . ':' . (string) achievement_view_value($componentIndexRow, 'component_id', '')] = true;
      }
      $unmatchedProgress = array();
      foreach ($rawProgress as $progressIndexRow) {
        $progressKey = (int) achievement_view_value($progressIndexRow, 'component_type', -1) . ':' . (string) achievement_view_value($progressIndexRow, 'component_id', '');
        if (!isset($componentKeys[$progressKey])) { $unmatchedProgress[] = $progressIndexRow; }
      }
      $openCard = $definitionMissing || $hasVersionMismatch || !empty($definition['reward_needs_attention']) || count($updates) > 0;
    ?>
    <details class="achievement-panel achievement-character-achievement <?=$definitionMissing ? 'is-danger' : ''?>" <?=$openCard ? 'open' : ''?>>
      <summary class="achievement-character-achievement-summary">
        <span class="achievement-character-achievement-title"><?=achievement_e(achievement_view_value($definition, 'name', '(Unnamed achievement)'))?></span>
        <span class="achievement-badge" title="Stable global achievement ID">ID <?=achievement_e($achievementId)?></span>
        <span class="achievement-badge <?=$definitionMissing ? 'is-danger' : ($definitionEnabled ? 'is-success' : '')?>" title="<?=achievement_e(achievement_character_definition_status($definition))?>"><?=achievement_e(achievement_character_definition_status($definition))?></span>
        <span class="achievement-badge" title="Derived from durable completion and positive progress rows"><?=achievement_e(ucwords(str_replace('_', ' ', $durableState)))?></span>
        <?php if ($hasVersionMismatch): ?><span class="achievement-badge is-danger" title="At least one durable row uses another definition version">Version mismatch</span><?php endif; ?>
        <?php if (!empty($definition['reward_needs_attention'])): ?><span class="achievement-badge is-warning" title="A reward or selection ledger is in-flight, failed, or ambiguous">Reward attention</span><?php endif; ?>
        <?php if ($updates): ?><span class="achievement-badge is-warning" title="Durable cross-zone state-update requests"><?=achievement_e(count($updates))?> queued</span><?php endif; ?>
      </summary>

      <div class="achievement-character-achievement-body">
        <p><?=achievement_e(achievement_view_value($definition, 'description', 'No presentation description.'))?></p>
        <div class="achievement-summary-grid">
          <div><strong>Definition</strong><span>Version <?=achievement_e(achievement_view_value($definition, 'version', 0))?> · <?=achievement_e(achievement_view_value($definition, 'points', 0))?> points</span></div>
          <div><strong>Completion</strong><span><?=$completion ? 'Completed ' . achievement_e(achievement_view_timestamp(achievement_view_value($completion, 'completed_at', 0))) . ' · saved version ' . achievement_e(achievement_view_value($completion, 'version', 0)) : 'No durable completion row'?></span></div>
          <div><strong>Recovery state</strong><span><?=achievement_e(count($rewardLedgers))?> reward ledgers · <?=achievement_e(count($rewardSelections))?> selections · <?=achievement_e(count($updates))?> updates</span></div>
        </div>

        <?php if ($definitionMissing): ?>
          <section class="achievement-callout is-danger" role="alert"><strong>The authored definition is missing.</strong><p>The rows below are preserved character history, not a usable definition graph. Content-dependent progress, completion, reward-retry, and update-retry actions are disabled. An offline reset can remove selected state after review; queued stable updates may be discarded independently.</p></section>
        <?php elseif ($hasVersionMismatch): ?>
          <section class="achievement-callout is-danger" role="alert"><strong>Durable definition-version mismatch.</strong><p>Current version <?=achievement_e(achievement_view_value($definition, 'version', 0))?>; persisted row versions are shown below. The runtime may reset or retain stale state according to <code>reset_on_version_change=<?=achievement_e(achievement_view_value($definition, 'reset_on_version_change', 0))?></code>. Force complete is disabled until version-mismatched progress is reset or reconciled.</p></section>
        <?php endif; ?>

        <section class="achievement-action-strip" aria-label="Definition-level state actions">
          <?php if (!$definitionMissing): ?><a class="achievement-button is-small is-secondary" href="<?=achievement_e(achievement_url(3, array('achievement_id' => $achievementId)))?>" title="Edit the global definition; this does not change character state">Edit definition</a><?php endif; ?>

          <form method="post" action="<?=achievement_e(achievement_url(43))?>" class="achievement-inline-form">
            <?php achievement_character_post_identity($csrf_token, $characterId, $achievementId); ?>
            <label title="Exact phrase prevents accidental durable completion">Type <code>FORCE COMPLETE <?=achievement_e($achievementId)?></code>
              <input name="confirmation" type="text" autocomplete="off" required <?=$forceCompleteDisabled ? 'disabled' : ''?>>
            </label>
            <button class="achievement-button is-small is-warning" type="submit" <?=$forceCompleteDisabled ? 'disabled' : ''?> title="<?=achievement_e($forceCompleteTitle)?>">Force complete offline</button>
          </form>

          <form method="post" action="<?=achievement_e(achievement_url(44))?>" class="achievement-inline-form achievement-danger-form">
            <?php achievement_character_post_identity($csrf_token, $characterId, $achievementId); ?>
            <label title="Ordinary reset preserves reward idempotency ledgers">Type <code>RESET <?=achievement_e($achievementId)?></code>
              <input name="confirmation" type="text" autocomplete="off" required <?=$isOnline ? 'disabled' : ''?>>
            </label>
            <label title="Deletes reward and selection ledgers, allowing later delivery to grant again"><input name="reset_rewards" type="checkbox" value="1" <?=$isOnline ? 'disabled' : ''?>> Also reset reward ledgers</label>
            <label title="Required only when reward ledgers are also reset">If selected, type <code>RESET REWARDS <?=achievement_e($achievementId)?></code>
              <input name="reward_confirmation" type="text" autocomplete="off" <?=$isOnline ? 'disabled' : ''?>>
            </label>
            <button class="achievement-button is-small is-danger" type="submit" <?=$isOnline ? 'disabled' : ''?> title="Deletes completion, progress, and queued update rows; reward rows only when separately confirmed">Reset state</button>
          </form>
        </section>

        <section class="achievement-character-section" aria-labelledby="achievement-components-<?=achievement_e($achievementId)?>">
          <div class="achievement-section-heading"><h3 id="achievement-components-<?=achievement_e($achievementId)?>">Components and exact progress</h3><p>Exact edits are clamped to the authoritative component requirement. They do not create whole-achievement completion and are disabled while online.</p></div>
          <?php if (!$components && !$unmatchedProgress): ?><div class="achievement-empty-state"><strong>No component or durable progress rows.</strong></div><?php endif; ?>
          <?php foreach ($components as $component): ?>
            <?php
              $component = achievement_view_array($component);
              $componentType = (int) achievement_view_value($component, 'component_type', 0);
              $componentId = achievement_view_value($component, 'component_id', 0);
              $stateBearing = !empty($component['state_bearing']);
              $progressRow = isset($component['progress']) && is_array($component['progress']) ? $component['progress'] : null;
              $requiredCount = max(1, (int) achievement_view_value($component, 'effective_required_count', achievement_view_value($component, 'presentation_count', 1)));
              $criteriaRows = achievement_view_array(achievement_view_value($component, 'criteria', array()));
              $progressVersionMismatch = $progressRow
                && (int) achievement_view_value($progressRow, 'version', 0) !== (int) achievement_view_value($definition, 'version', 0);
              $editDisabled = $isOnline || $definitionMissing || !$definitionEnabled || $completion
                || !$stateBearing || !empty($component['effective_count_conflict']) || $progressVersionMismatch;
            ?>
            <details class="achievement-subpanel">
              <summary><strong><?=achievement_e(achievement_view_value($component, 'description', 'Component ' . $componentId))?></strong> <span class="achievement-badge" title="<?=achievement_e(achievement_character_enum_help($achievementMetadata, 'component_types', $componentType, 'Unknown wire component type.'))?>"><?=achievement_e(achievement_character_enum($achievementMetadata, 'component_types', $componentType))?></span> <span class="achievement-badge">ID <?=achievement_e($componentId)?></span> <span><?=achievement_e($progressRow ? achievement_view_value($progressRow, 'current_count', 0) : 0)?> / <?=achievement_e($requiredCount)?></span></summary>
              <?php if (!empty($component['effective_count_conflict'])): ?><div class="achievement-callout is-danger"><strong>Conflicting criterion counts.</strong><p>Exact editing is disabled because enabled criteria do not agree on one nonzero effective required count.</p></div><?php endif; ?>
              <?php if ($progressVersionMismatch): ?><div class="achievement-callout is-danger"><strong>Stored progress uses another definition version.</strong><p>Reset this achievement before exact-editing this component so the runtime does not mix progress policies.</p></div><?php endif; ?>
              <div class="achievement-summary-grid">
                <div><strong><?=achievement_e(achievement_view_label($achievementMetadata, 'achievement_components', 'sequence', 'Sequence'))?></strong><span><?=achievement_e(achievement_view_value($component, 'sequence', 0))?></span></div>
                <div><strong>Effective required count</strong><span><?=achievement_e($requiredCount)?></span></div>
                <div><strong>Persisted version</strong><span><?=achievement_e($progressRow ? achievement_view_value($progressRow, 'version', 0) : 'No row')?></span></div>
              </div>
              <?php if ($stateBearing): ?>
                <form method="post" action="<?=achievement_e(achievement_url(42))?>" class="achievement-progress-form">
                  <?php achievement_character_post_identity($csrf_token, $characterId, $achievementId); ?>
                  <input type="hidden" name="component_type" value="<?=achievement_e($componentType)?>">
                  <input type="hidden" name="component_id" value="<?=achievement_e($componentId)?>">
                  <div class="achievement-field">
                    <?php $progressInputId = 'achievement-progress-' . $achievementId . '-' . $componentType . '-' . $componentId; achievement_view_field_heading($progressInputId, achievement_view_label($achievementMetadata, 'character_achievement_progress', 'current_count', 'Current count'), achievement_view_help($achievementMetadata, 'character_achievement_progress', 'current_count', 'Exact durable progress count.'), true); ?>
                    <input id="<?=achievement_e($progressInputId)?>" name="current_count" type="number" min="0" max="<?=achievement_e($requiredCount)?>" step="1" value="<?=achievement_e($progressRow ? achievement_view_value($progressRow, 'current_count', 0) : 0)?>" aria-describedby="<?=achievement_e($progressInputId)?>-help" required <?=$editDisabled ? 'disabled' : ''?>>
                  </div>
                  <button class="achievement-button is-small" type="submit" <?=$editDisabled ? 'disabled' : ''?> title="Store an exact count clamped to the effective requirement">Save exact progress</button>
                </form>
              <?php else: ?><p class="achievement-muted">Presentation-only component types have no durable progress channel.</p><?php endif; ?>
              <?php if ($criteriaRows): ?>
                <div class="achievement-table-scroll"><table class="achievement-table"><thead><tr><th>ID</th><th>Enabled</th><th>Event</th><th>Progress mode</th><th>Behavior</th><th>Targets</th><th>Required</th></tr></thead><tbody>
                <?php foreach ($criteriaRows as $criterion): ?><tr>
                  <td><?=achievement_e(achievement_view_value($criterion, 'id', 0))?></td>
                  <td><?=!empty($criterion['enabled']) ? 'Yes' : 'No'?></td>
                  <td title="<?=achievement_e(achievement_character_enum_help($achievementMetadata, 'events', achievement_view_value($criterion, 'event_type', -1), 'Unknown event type.'))?>"><?=achievement_e(achievement_character_enum($achievementMetadata, 'events', achievement_view_value($criterion, 'event_type', -1)))?></td>
                  <td><?=achievement_e(achievement_character_enum($achievementMetadata, 'progress_modes', achievement_view_value($criterion, 'progress_mode', -1)))?></td>
                  <td><?=achievement_e(achievement_character_enum($achievementMetadata, 'behaviors', achievement_view_value($criterion, 'behavior', -1)))?></td>
                  <td><?=achievement_e(achievement_view_value($criterion, 'target_id', 0))?> / <?=achievement_e(achievement_view_value($criterion, 'target_id2', 0))?>; value <?=achievement_e(achievement_view_value($criterion, 'target_value', 0))?></td>
                  <td><?=achievement_e(achievement_view_value($criterion, 'required_count', 0))?></td>
                </tr><?php endforeach; ?>
                </tbody></table></div>
              <?php endif; ?>
            </details>
          <?php endforeach; ?>

          <?php if ($unmatchedProgress): ?>
            <div class="achievement-callout is-danger"><strong>Unmatched durable progress history</strong><p>These rows reference component identities no longer present in the current definition. They are shown verbatim and cannot be exact-edited without restoring the authored component.</p></div>
            <div class="achievement-table-scroll"><table class="achievement-table"><thead><tr><th>Type / component</th><th>Sequence</th><th>Count</th><th>Completed</th><th>Saved version</th><th>Updated</th></tr></thead><tbody>
            <?php foreach ($unmatchedProgress as $progressRow): ?><tr>
              <td><?=achievement_e(achievement_view_value($progressRow, 'component_type', ''))?> / <?=achievement_e(achievement_view_value($progressRow, 'component_id', ''))?></td>
              <td><?=achievement_e(achievement_view_value($progressRow, 'component_sequence', ''))?></td>
              <td><?=achievement_e(achievement_view_value($progressRow, 'current_count', ''))?></td>
              <td><?=!empty($progressRow['completed']) ? 'Yes' : 'No'?></td>
              <td><?=achievement_e(achievement_view_value($progressRow, 'version', ''))?></td>
              <td><?=achievement_e(achievement_view_timestamp(achievement_view_value($progressRow, 'updated_at', 0)))?></td>
            </tr><?php endforeach; ?></tbody></table></div>
          <?php endif; ?>
        </section>

        <section class="achievement-character-section" aria-labelledby="achievement-rewards-<?=achievement_e($achievementId)?>">
          <div class="achievement-section-heading"><h3 id="achievement-rewards-<?=achievement_e($achievementId)?>">Individual reward ledgers</h3><p>Status 0 can be ambiguous after interruption. Retry overrides are individual, offline-only, and require explicit acceptance that delivery may be duplicated.</p></div>
          <?php if (!$rewards && !$orphanRewardLedgers): ?><div class="achievement-empty-state"><strong>No mapped reward definitions or ledgers.</strong></div><?php else: ?>
          <div class="achievement-table-scroll"><table class="achievement-table"><thead><tr><th>Reward</th><th>Authored grant</th><th>Ledger status</th><th>Attempts / diagnostic</th><th>Recovery action</th></tr></thead><tbody>
          <?php foreach ($rewards as $reward): ?>
            <?php
              $reward = achievement_view_array($reward);
              $ledger = isset($reward['ledger']) && is_array($reward['ledger']) ? $reward['ledger'] : null;
              $ledgerStatus = $ledger ? (int) achievement_view_value($ledger, 'status', -1) : null;
              $canRetryReward = $ledger && in_array($ledgerStatus, array(0, 2), true) && !$isOnline && !$definitionMissing;
              $rewardType = (int) achievement_view_value($reward, 'reward_type', -1);
              $rewardData = achievement_view_value($reward, 'reward_data_id', 0);
              $rewardAmount = achievement_view_value($reward, 'amount', 0);
              if ($rewardType === 6) {
                $rewardDetail = 'AA ability ' . $rewardData . ' · desired cumulative rank ' . $rewardAmount;
              } elseif ($rewardType === 7) {
                $rewardDetail = 'paired AA ability ' . $rewardData . ' · ineligible-class AA points ' . $rewardAmount . ' · automatic only';
              } else {
                $rewardDetail = 'data ' . $rewardData . ' · amount ' . $rewardAmount;
              }
            ?>
            <tr>
              <td><strong><?=achievement_e(achievement_view_value($reward, 'reward_id', 0))?></strong><span class="achievement-muted">sequence <?=achievement_e(achievement_view_value($reward, 'sequence', 0))?> · <?=!empty($reward['enabled']) ? 'enabled' : 'disabled'?></span></td>
              <td><strong><?=achievement_e(achievement_character_enum($achievementMetadata, 'reward_types', $rewardType))?></strong><span class="achievement-muted"><?=achievement_e($rewardDetail)?> · <?=achievement_e(achievement_view_value($reward, 'description', 'No description'))?></span></td>
              <td><?=$ledger ? '<span class="achievement-badge" title="' . achievement_e(achievement_character_enum_help($achievementMetadata, 'character_reward_statuses', $ledgerStatus, 'Unknown persisted reward status.')) . '">' . achievement_e(achievement_character_enum($achievementMetadata, 'character_reward_statuses', $ledgerStatus)) . '</span><span class="achievement-muted">granted ' . achievement_e(achievement_view_timestamp(achievement_view_value($ledger, 'granted_at', 0))) . '</span>' : '<span class="achievement-muted">Not claimed; no ledger row</span>'?></td>
              <td><?=$ledger ? achievement_e(achievement_view_value($ledger, 'attempt_count', 0)) . ' attempts<span class="achievement-muted">last ' . achievement_e(achievement_view_timestamp(achievement_view_value($ledger, 'last_attempt_at', 0))) . '<br>' . achievement_e(achievement_view_value($ledger, 'last_error', 'No diagnostic')) . '</span>' : '—'?></td>
              <td>
                <?php if ($ledger && in_array($ledgerStatus, array(0, 2), true)): ?>
                <form method="post" action="<?=achievement_e(achievement_url(45))?>" class="achievement-risk-form">
                  <?php achievement_character_post_identity($csrf_token, $characterId, $achievementId); ?>
                  <input type="hidden" name="reward_id" value="<?=achievement_e(achievement_view_value($reward, 'reward_id', 0))?>">
                  <label>Type <code>RETRY <?=achievement_e(achievement_view_value($reward, 'reward_id', 0))?></code><input name="confirmation" type="text" autocomplete="off" required <?=$canRetryReward ? '' : 'disabled'?>></label>
                  <label><input name="accept_duplicate_risk" type="checkbox" value="1" required <?=$canRetryReward ? '' : 'disabled'?>> I checked the character's relevant item, currency, title, experience, and AA state and accept duplicate-delivery risk.</label>
                  <button class="achievement-button is-small is-warning" type="submit" <?=$canRetryReward ? '' : 'disabled'?>>Mark retryable</button>
                </form>
                <?php elseif ($ledger): ?><span class="achievement-muted"><?=$ledgerStatus === 1 ? 'Durably granted rows are protected from retry.' : 'This unknown ledger status is protected; investigate the stored value before changing it.'?></span>
                <?php else: ?><span class="achievement-muted">No ledger row exists, so there is nothing to retry.</span><?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php foreach ($orphanRewardLedgers as $ledger): ?>
            <?php $ledger = achievement_view_array($ledger); $ledgerStatus = (int) achievement_view_value($ledger, 'status', -1); ?>
            <tr class="achievement-row-danger"><td><strong><?=achievement_e(achievement_view_value($ledger, 'reward_id', 0))?></strong></td><td><span class="achievement-badge is-danger">Missing canonical reward</span></td><td><?=achievement_e(achievement_character_enum($achievementMetadata, 'character_reward_statuses', $ledgerStatus))?><span class="achievement-muted">granted <?=achievement_e(achievement_view_timestamp(achievement_view_value($ledger, 'granted_at', 0)))?></span></td><td><?=achievement_e(achievement_view_value($ledger, 'attempt_count', 0))?> attempts<span class="achievement-muted"><?=achievement_e(achievement_view_value($ledger, 'last_error', 'No diagnostic'))?></span></td><td>Preserved history only. Restore/correct content before retrying.</td></tr>
          <?php endforeach; ?>
          </tbody></table></div><?php endif; ?>
        </section>

        <section class="achievement-character-section" aria-labelledby="achievement-selections-<?=achievement_e($achievementId)?>">
          <div class="achievement-section-heading"><h3 id="achievement-selections-<?=achievement_e($achievementId)?>">Selectable reward sets</h3><p>A selection locks one option. Ambiguous selections never retry automatically; individual grants remain protected by the reward ledgers above.</p></div>
          <?php foreach ($rewardSets as $rewardSet): ?>
            <?php
              $rewardSet = achievement_view_array($rewardSet);
              $setId = achievement_view_value($rewardSet, 'reward_set_id', 0);
              $selection = isset($rewardSet['selection']) && is_array($rewardSet['selection']) ? $rewardSet['selection'] : null;
              $selectionStatus = $selection ? (int) achievement_view_value($selection, 'status', -1) : null;
              $selectedOptionId = $selection ? (int) achievement_view_value($selection, 'selected_option_id', 0) : 0;
              $sourceEnabled = (int) achievement_view_value($rewardSet, 'source_enabled', 0) === 1;
              $setEnabled = (int) achievement_view_value($rewardSet, 'enabled', 0) === 1;
              $canRetrySelection = $selection && $sourceEnabled && $setEnabled && $definitionEnabled && $selectedOptionId !== 0 && (in_array($selectionStatus, array(2, 3), true) || $selectionStatus === 0) && !$isOnline && !$definitionMissing;
            ?>
            <div class="achievement-subpanel">
              <div class="achievement-panel-heading"><div><h4><?=achievement_e(achievement_view_value($rewardSet, 'title', 'Selectable reward'))?> · Set <?=achievement_e($setId)?></h4><p><?=$sourceEnabled ? 'Achievement source enabled' : 'Achievement source disabled / staged'?> · <?=$setEnabled ? 'shared catalog enabled' : 'shared catalog disabled / staged'?>.</p></div><?php if ($selection): ?><span class="achievement-badge" title="<?=achievement_e(achievement_character_enum_help($achievementMetadata, 'character_selection_statuses', $selectionStatus, 'Unknown persisted selection status.'))?>"><?=achievement_e(achievement_character_enum($achievementMetadata, 'character_selection_statuses', $selectionStatus))?></span><?php endif; ?></div>
              <?php if ($selection): ?><p>Selected option: <strong><?=achievement_e($selectedOptionId === 0 ? 'not chosen' : $selectedOptionId)?></strong> · <?=achievement_e(achievement_view_value($selection, 'attempt_count', 0))?> attempts · claimed <?=achievement_e(achievement_view_timestamp(achievement_view_value($selection, 'claimed_at', 0)))?>. <span class="achievement-muted"><?=achievement_e(achievement_view_value($selection, 'last_error', 'No diagnostic'))?></span></p><?php else: ?><p class="achievement-muted">No durable selection row.</p><?php endif; ?>
              <?php $options = achievement_view_array(achievement_view_value($rewardSet, 'options', array())); ?>
              <div class="achievement-option-grid">
              <?php foreach ($options as $option): ?><div class="achievement-option-card"><strong><?=achievement_e(achievement_view_value($option, 'label', 'Option ' . achievement_view_value($option, 'option_id', 0)))?></strong><span>ID <?=achievement_e(achievement_view_value($option, 'option_id', 0))?> · <?=!empty($option['common_to_all']) ? 'common to all choices' : 'selectable'?> · <?=!empty($option['enabled']) ? 'enabled' : 'disabled'?></span><ul><?php foreach (achievement_view_array(achievement_view_value($option, 'entries', array())) as $entry): ?><li>Reward <?=achievement_e(achievement_view_value($entry, 'reward_id', 0))?><?=isset($entry['reward']) && is_array($entry['reward']) ? ' · ' . achievement_e(achievement_character_enum($achievementMetadata, 'reward_types', achievement_view_value($entry['reward'], 'reward_type', -1))) : ' · missing canonical reward'?></li><?php endforeach; ?></ul></div><?php endforeach; ?>
              </div>
              <?php if ($selection && ($selectionStatus !== 1)): ?>
              <form method="post" action="<?=achievement_e(achievement_url(46))?>" class="achievement-risk-form">
                <?php achievement_character_post_identity($csrf_token, $characterId, $achievementId); ?>
                <input type="hidden" name="reward_set_id" value="<?=achievement_e($setId)?>">
                <label>Type <code>RETRY SET <?=achievement_e($setId)?></code><input name="confirmation" type="text" autocomplete="off" required <?=$canRetrySelection ? '' : 'disabled'?>></label>
                <label><input name="accept_duplicate_risk" type="checkbox" value="1" required <?=$canRetrySelection ? '' : 'disabled'?>> I accept duplicate-delivery risk for this locked selection.</label>
                <button class="achievement-button is-small is-warning" type="submit" <?=$canRetrySelection ? '' : 'disabled'?>>Mark selection retryable</button>
              </form>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
          <?php if (!$rewardSets && !$orphanSelections): ?><div class="achievement-empty-state"><strong>No selectable reward sets or selection ledgers.</strong></div><?php endif; ?>
          <?php if ($orphanSelections): ?>
            <div class="achievement-callout is-danger"><strong>Orphan reward-selection history</strong><p>The authored set is missing or no longer belongs to this achievement. Raw rows are preserved below and cannot be retried until content is repaired.</p></div>
            <div class="achievement-table-scroll"><table class="achievement-table"><thead><tr><th>Set</th><th>Option</th><th>Status</th><th>Attempts</th><th>Claimed / last attempt</th><th>Diagnostic</th></tr></thead><tbody><?php foreach ($orphanSelections as $selection): ?><tr class="achievement-row-danger"><td><?=achievement_e(achievement_view_value($selection, 'reward_set_id', 0))?></td><td><?=achievement_e(achievement_view_value($selection, 'selected_option_id', 0))?></td><td><?=achievement_e(achievement_character_enum($achievementMetadata, 'character_selection_statuses', achievement_view_value($selection, 'status', -1)))?></td><td><?=achievement_e(achievement_view_value($selection, 'attempt_count', 0))?></td><td><?=achievement_e(achievement_view_timestamp(achievement_view_value($selection, 'claimed_at', 0)))?><br><?=achievement_e(achievement_view_timestamp(achievement_view_value($selection, 'last_attempt_at', 0)))?></td><td><?=achievement_e(achievement_view_value($selection, 'last_error', 'No diagnostic'))?></td></tr><?php endforeach; ?></tbody></table></div>
          <?php endif; ?>
        </section>

        <section class="achievement-character-section" aria-labelledby="achievement-updates-<?=achievement_e($achievementId)?>">
          <div class="achievement-section-heading"><h3 id="achievement-updates-<?=achievement_e($achievementId)?>">Pending cross-zone updates</h3><p>Advance requests are monotonic floors. Retrying preserves the original definition version and request; processing rows cannot be discarded while a zone owns their lease.</p></div>
          <?php if (!$updates): ?><div class="achievement-empty-state"><strong>No pending, blocked, or processing updates.</strong></div><?php else: ?>
          <div class="achievement-table-scroll"><table class="achievement-table"><thead><tr><th>Update</th><th>Source</th><th>Request</th><th>Version</th><th>Status</th><th>Attempts / diagnostic</th><th>Actions</th></tr></thead><tbody>
          <?php foreach ($updates as $update): ?>
            <?php
              $update = achievement_view_array($update);
              $updateId = achievement_view_value($update, 'update_id', 0);
              $updateStatus = (int) achievement_view_value($update, 'status', -1);
              $updateVersion = (int) achievement_view_value($update, 'version', 0);
              $currentVersion = (int) achievement_view_value($definition, 'version', 0);
              $retryVersionOkay = $updateVersion === $currentVersion;
              $canRetryUpdate = $updateStatus === 1 && !$definitionMissing && $definitionEnabled && $retryVersionOkay;
              $canDiscardUpdate = in_array($updateStatus, array(0, 1), true);
            ?>
            <tr <?=$updateStatus === 2 ? 'class="achievement-row-warning"' : ''?>>
              <td><strong><?=achievement_e($updateId)?></strong><span class="achievement-muted">created <?=achievement_e(achievement_view_timestamp(achievement_view_value($update, 'created_at', 0)))?></span></td>
              <td title="<?=achievement_e(achievement_character_enum_help($achievementMetadata, 'update_target_types', achievement_view_value($update, 'source_target_type', -1), 'Unknown original target scope.'))?>"><?=achievement_e(achievement_character_enum($achievementMetadata, 'update_target_types', achievement_view_value($update, 'source_target_type', -1)))?> #<?=achievement_e(achievement_view_value($update, 'source_target_id', 0))?></td>
              <td><?=achievement_e(achievement_character_enum($achievementMetadata, 'update_operations', achievement_view_value($update, 'operation', -1)))?><span class="achievement-muted">type <?=achievement_e(achievement_view_value($update, 'component_type', 0))?> · component <?=achievement_e(achievement_view_value($update, 'component_id', 0))?> · value <?=achievement_e(achievement_view_value($update, 'requested_value', 0))?></span></td>
              <td><?=achievement_e($updateVersion)?><?php if (!$definitionMissing && !$retryVersionOkay): ?><span class="achievement-badge is-danger">current <?=achievement_e($currentVersion)?></span><?php endif; ?></td>
              <td><span class="achievement-badge" title="<?=achievement_e(achievement_character_enum_help($achievementMetadata, 'character_update_statuses', $updateStatus, 'Unknown persisted update status.'))?>"><?=achievement_e(achievement_character_enum($achievementMetadata, 'character_update_statuses', $updateStatus))?></span></td>
              <td><?=achievement_e(achievement_view_value($update, 'attempt_count', 0))?> attempts<span class="achievement-muted">last <?=achievement_e(achievement_view_timestamp(achievement_view_value($update, 'last_attempt_at', 0)))?><br><?=achievement_e(achievement_view_value($update, 'last_error', 'No diagnostic'))?></span></td>
              <td>
                <?php if ($updateStatus === 1): ?><form method="post" action="<?=achievement_e(achievement_url(47))?>" class="achievement-inline-form" onsubmit="return confirm('Retry this blocked update with its original version and requested value?');"><?php achievement_character_post_identity($csrf_token, $characterId, $achievementId); ?><input type="hidden" name="update_id" value="<?=achievement_e($updateId)?>"><button class="achievement-button is-small is-warning" type="submit" <?=$canRetryUpdate ? '' : 'disabled'?> title="Return this blocked row to pending without changing its exact version guard">Retry blocked</button></form><?php endif; ?>
                <form method="post" action="<?=achievement_e(achievement_url(48))?>" class="achievement-risk-form"><?php achievement_character_post_identity($csrf_token, $characterId, $achievementId); ?><input type="hidden" name="update_id" value="<?=achievement_e($updateId)?>"><label>Type <code>DISCARD <?=achievement_e($updateId)?></code><input name="confirmation" type="text" autocomplete="off" required <?=$canDiscardUpdate ? '' : 'disabled'?>></label><button class="achievement-button is-small is-danger" type="submit" <?=$canDiscardUpdate ? '' : 'disabled'?> title="Permanently delete this queued request without applying it">Discard</button><?php if (!$canDiscardUpdate): ?><span class="achievement-muted"><?=$updateStatus === 2 ? 'Processing rows cannot be discarded.' : 'Only pending or blocked rows can be discarded; unknown statuses are protected.'?></span><?php endif; ?></form>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody></table></div><?php endif; ?>
        </section>
      </div>
    </details>
  <?php endforeach; ?>
  </div>

  <?php achievement_view_pager(41, achievement_view_value($catalogPage, 'page', 1), achievement_view_value($catalogPage, 'pages', 0), $pagerParameters); ?>
</div>
