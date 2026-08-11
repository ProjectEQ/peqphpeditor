<?php
require_once('templates/achievements/_common.tmpl.php');
$formMetadata = achievement_view_array(isset($metadata) ? $metadata : array());
$formDefinition = achievement_view_array(isset($definition) ? $definition : array());
$formIssues = achievement_view_array(isset($issues) ? $issues : array());
$creatingDefinition = !empty($is_create);
$definitionId = achievement_view_value($formDefinition, 'id', '');
$generalFields = array(
  'id' => array('required' => true, 'input' => 'text', 'inputmode' => 'numeric', 'pattern' => '[0-9]+'),
  'name' => array('required' => true, 'input' => 'text', 'maxlength' => '255'),
  'description' => array('input' => 'textarea'),
  'icon_id' => array('input' => 'text', 'inputmode' => 'numeric', 'pattern' => '[0-9]+'),
  'points' => array('input' => 'text', 'inputmode' => 'numeric', 'pattern' => '[0-9]+'),
  'client_flag' => array('input' => 'text', 'inputmode' => 'numeric', 'pattern' => '[0-9]+'),
  'version' => array('required' => true, 'input' => 'text', 'inputmode' => 'numeric', 'pattern' => '[0-9]+'),
);
?>
<div class="achievement-editor-page achievement-definition-editor-page" data-achievement-editor-page>
  <?php achievement_view_nav('definitions', isset($can_manage_character_achievements) && $can_manage_character_achievements); ?>
  <?php achievement_view_flash(isset($flash_messages) ? $flash_messages : array()); ?>

  <section class="achievement-page-heading">
    <div>
      <p class="achievement-eyebrow"><?=$creatingDefinition ? 'New disabled draft' : 'Atomic definition graph'?></p>
      <h1><?=$creatingDefinition ? 'Create achievement definition' : achievement_e(achievement_view_value($formDefinition, 'name', 'Unnamed achievement'))?></h1>
      <p><?=$creatingDefinition ? 'Build the complete graph, resolve validation, and enable it only when it is ready to publish.' : 'Achievement ' . achievement_e($definitionId) . ' · Version ' . achievement_e(achievement_view_value($formDefinition, 'version', 0))?></p>
    </div>
    <div class="achievement-heading-actions">
      <span class="achievement-badge <?=!empty($formDefinition['enabled']) ? 'is-success' : 'is-muted'?>" data-achievement-state-badge><?=!empty($formDefinition['enabled']) ? 'Enabled' : 'Draft / disabled'?></span>
      <a class="achievement-button is-secondary" href="<?=achievement_e(achievement_url(0))?>" title="Return to the definition catalog">Back to catalog</a>
    </div>
  </section>

  <noscript>
    <section class="achievement-flash achievement-flash-error" role="alert">
      <strong>JavaScript is required for the graph editor.</strong>
      <p>The definition is serialized as one bounded JSON graph so nested identities and reward-option mappings remain consistent.</p>
    </section>
  </noscript>

  <form id="achievement-definition-form" method="post" action="<?=achievement_e(isset($form_action) ? $form_action : achievement_url($creatingDefinition ? 2 : 4))?>" data-achievement-definition-form>
    <input type="hidden" name="csrf_token" value="<?=achievement_e($csrf_token)?>">
    <input type="hidden" id="achievement-graph-json" name="graph_json" value="">

    <div class="achievement-graph-tabs" role="tablist" aria-label="Achievement graph sections">
      <?php
        $graphTabs = array(
          'general' => array('label' => 'General', 'count' => null),
          'categories' => array('label' => 'Categories', 'count' => count(achievement_view_array(achievement_view_value($formDefinition, 'associations', array())))),
          'components' => array('label' => 'Components', 'count' => count(achievement_view_array(achievement_view_value($formDefinition, 'components', array())))),
          'rewards' => array('label' => 'Rewards', 'count' => count(achievement_view_array(achievement_view_value($formDefinition, 'rewards', array())))),
          'restrictions' => array('label' => 'Cast Restrictions', 'count' => count(achievement_view_array(achievement_view_value($formDefinition, 'restrictions', array())))),
          'validation' => array('label' => 'Validation', 'count' => count($formIssues)),
          'guide' => array('label' => 'Authoring Guide', 'count' => null),
        );
      ?>
      <?php foreach ($graphTabs as $tabKey => $tab): ?>
        <button type="button" role="tab" id="achievement-tab-<?=achievement_e($tabKey)?>" aria-controls="achievement-panel-<?=achievement_e($tabKey)?>" aria-selected="<?=$tabKey === 'general' ? 'true' : 'false'?>" tabindex="<?=$tabKey === 'general' ? '0' : '-1'?>" data-achievement-tab="<?=achievement_e($tabKey)?>" title="Open the <?=achievement_e($tab['label'])?> section">
          <?=achievement_e($tab['label'])?>
          <?php if ($tab['count'] !== null): ?><span data-achievement-tab-count="<?=achievement_e($tabKey)?>"><?=achievement_e($tab['count'])?></span><?php endif; ?>
        </button>
      <?php endforeach; ?>
    </div>

    <section class="achievement-graph-panel is-active" id="achievement-panel-general" role="tabpanel" aria-labelledby="achievement-tab-general" data-achievement-panel="general">
      <div class="achievement-panel-heading">
        <div><h2>General definition</h2><p>Presentation, score, durable version policy, and publication state.</p></div>
      </div>
      <div class="achievement-form-grid">
        <?php foreach ($generalFields as $field => $settings): ?>
          <?php
            $controlId = 'achievement-definition-' . str_replace('_', '-', $field);
            $label = achievement_view_label($formMetadata, 'achievements', $field, ucwords(str_replace('_', ' ', $field)));
            $help = achievement_view_help($formMetadata, 'achievements', $field, 'Achievement definition value.');
            $fieldClass = in_array($field, array('name', 'description'), true) ? ' achievement-field-span-2' : '';
          ?>
          <div class="achievement-field<?=$fieldClass?>">
            <?php achievement_view_field_heading($controlId, $label, $help, !empty($settings['required'])); ?>
            <?php if ($settings['input'] === 'textarea'): ?>
              <textarea id="<?=achievement_e($controlId)?>" rows="5" data-achievement-field="<?=achievement_e($field)?>" aria-describedby="<?=achievement_e($controlId)?>-help"><?=achievement_e(achievement_view_value($formDefinition, $field, ''))?></textarea>
            <?php else: ?>
              <input id="<?=achievement_e($controlId)?>" type="<?=achievement_e($settings['input'])?>" value="<?=achievement_e(achievement_view_value($formDefinition, $field, ''))?>" data-achievement-field="<?=achievement_e($field)?>" aria-describedby="<?=achievement_e($controlId)?>-help"<?=isset($settings['inputmode']) ? ' inputmode="' . achievement_e($settings['inputmode']) . '"' : ''?><?=isset($settings['pattern']) ? ' pattern="' . achievement_e($settings['pattern']) . '"' : ''?><?=isset($settings['maxlength']) ? ' maxlength="' . achievement_e($settings['maxlength']) . '"' : ''?><?=!empty($settings['required']) ? ' required' : ''?><?=(!$creatingDefinition && $field === 'id') ? ' readonly' : ''?>>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>

        <?php foreach (array('has_reward', 'reset_on_version_change', 'enabled') as $field): ?>
          <?php
            $controlId = 'achievement-definition-' . str_replace('_', '-', $field);
            $label = achievement_view_label($formMetadata, 'achievements', $field, ucwords(str_replace('_', ' ', $field)));
            $help = achievement_view_help($formMetadata, 'achievements', $field, 'Enable or disable this policy.');
          ?>
          <div class="achievement-field">
            <?php achievement_view_field_heading($controlId, $label, $help); ?>
            <select id="<?=achievement_e($controlId)?>" data-achievement-field="<?=achievement_e($field)?>" aria-describedby="<?=achievement_e($controlId)?>-help">
              <option value="1"<?=(int) achievement_view_value($formDefinition, $field, 0) === 1 ? ' selected' : ''?>>Enabled (1)</option>
              <option value="0"<?=(int) achievement_view_value($formDefinition, $field, 0) === 0 ? ' selected' : ''?>>Disabled (0)</option>
            </select>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="achievement-callout is-info">
        <strong>Versioning reminder</strong>
        <p>Increment the definition version only when deployed semantics change incompatibly. Reset-on-change also clears reward and selection ledgers, allowing grants to occur again.</p>
      </div>
    </section>

    <section class="achievement-graph-panel" id="achievement-panel-categories" role="tabpanel" aria-labelledby="achievement-tab-categories" data-achievement-panel="categories" hidden>
      <div class="achievement-panel-heading">
        <div><h2>Category associations</h2><p>Place this definition in one or more existing client categories. Each category can use its own order and optional display text.</p></div>
        <button class="achievement-button is-small" type="button" data-achievement-add-association title="Add a category association">+ Add category</button>
      </div>
      <div class="achievement-repeat-list" data-achievement-associations></div>
      <div class="achievement-empty-state" data-achievement-associations-empty><strong>No category associations.</strong><p>The definition can be saved as a draft, but enabled content normally needs a client category.</p></div>
    </section>

    <section class="achievement-graph-panel" id="achievement-panel-components" role="tabpanel" aria-labelledby="achievement-tab-components" data-achievement-panel="components" hidden>
      <div class="achievement-panel-heading">
        <div><h2>Components and criteria</h2><p>Components are visible client steps. Criteria define the engine event, target, progress policy, and completion behavior.</p></div>
        <button class="achievement-button is-small" type="button" data-achievement-add-component title="Add a visible component with a stable wire identity">+ Add component</button>
      </div>
      <div class="achievement-repeat-list achievement-component-list" data-achievement-components></div>
      <div class="achievement-empty-state" data-achievement-components-empty><strong>No components.</strong><p>Add a state-bearing step or a presentation-only type 3 row.</p></div>
    </section>

    <section class="achievement-graph-panel" id="achievement-panel-rewards" role="tabpanel" aria-labelledby="achievement-tab-rewards" data-achievement-panel="rewards" hidden>
      <div class="achievement-panel-heading">
        <div><h2>Rewards</h2><p>Author canonical grants once. Leave a grant automatic, or map it to one common or selectable option without changing its reward identity.</p></div>
        <button class="achievement-button is-small" type="button" data-achievement-add-reward title="Add a canonical automatic or selectable grant">+ Add grant</button>
      </div>
      <section class="achievement-subpanel" aria-labelledby="achievement-reward-set-heading">
        <div class="achievement-panel-heading">
          <div><h3 id="achievement-reward-set-heading">Selectable reward set</h3><p>Optional. Common options accompany the one non-common option the player selects from the enabled choices.</p></div>
          <label class="achievement-switch-label" title="Create or remove the selectable set from this graph"><input type="checkbox" data-achievement-use-reward-set> Use selectable rewards</label>
        </div>
        <div data-achievement-reward-set></div>
      </section>
      <section class="achievement-subpanel" aria-labelledby="achievement-grants-heading">
        <div class="achievement-panel-heading"><div><h3 id="achievement-grants-heading">Canonical grants</h3><p>Existing reward IDs are immutable. Blank IDs on new grants are allocated atomically when saved.</p></div></div>
        <div class="achievement-repeat-list" data-achievement-rewards></div>
        <div class="achievement-empty-state" data-achievement-rewards-empty><strong>No grants.</strong><p>This achievement will complete without delivering authored rewards.</p></div>
      </section>
    </section>

    <section class="achievement-graph-panel" id="achievement-panel-restrictions" role="tabpanel" aria-labelledby="achievement-tab-restrictions" data-achievement-panel="restrictions" hidden>
      <div class="achievement-panel-heading">
        <div><h2>Spell cast restrictions</h2><p>Attach the achievement to existing spell restriction IDs. Every row sharing one restriction ID must pass.</p></div>
        <button class="achievement-button is-small" type="button" data-achievement-add-restriction title="Add an achievement-backed spell restriction requirement">+ Add restriction</button>
      </div>
      <div class="achievement-repeat-list" data-achievement-restrictions></div>
      <div class="achievement-empty-state" data-achievement-restrictions-empty><strong>No cast restrictions.</strong><p>Spell casting is not gated by this achievement.</p></div>
    </section>

    <section class="achievement-graph-panel" id="achievement-panel-validation" role="tabpanel" aria-labelledby="achievement-tab-validation" data-achievement-panel="validation" hidden>
      <div class="achievement-panel-heading">
        <div><h2>Validation</h2><p>Immediate browser checks help authoring. Saving repeats and expands them with authoritative server and database validation.</p></div>
        <button class="achievement-button is-small is-secondary" type="button" data-achievement-run-validation title="Re-run immediate graph checks">Run checks</button>
      </div>
      <?php if ($formIssues): ?>
        <section class="achievement-server-issues" aria-labelledby="achievement-server-issues-heading">
          <h3 id="achievement-server-issues-heading">Server validation from the last save attempt</h3>
          <ul>
            <?php foreach ($formIssues as $issue): ?>
              <?php $severity = in_array(achievement_view_value($issue, 'severity', 'error'), array('error', 'warning', 'info'), true) ? $issue['severity'] : 'error'; ?>
              <li class="is-<?=achievement_e($severity)?>">
                <?php if (achievement_view_value($issue, 'path', '') !== ''): ?><code><?=achievement_e($issue['path'])?></code><?php endif; ?>
                <span><?=achievement_e(achievement_view_value($issue, 'message', 'Invalid value.'))?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </section>
      <?php endif; ?>
      <section class="achievement-client-issues" aria-live="polite" aria-atomic="true">
        <h3>Current authoring checks</h3>
        <div data-achievement-validation-summary></div>
      </section>
    </section>

    <section class="achievement-graph-panel" id="achievement-panel-guide" role="tabpanel" aria-labelledby="achievement-tab-guide" data-achievement-panel="guide" hidden>
      <div class="achievement-panel-heading"><div><h2>Authoring guide</h2><p>Compact reminders for this graph. Open the full reference for every event and skill ID.</p></div><a class="achievement-button is-small is-secondary" href="<?=achievement_e(achievement_url(70))?>">Open full guide</a></div>
      <div class="achievement-guide-grid">
        <article class="achievement-callout is-info"><h3>Criteria</h3><p>Use Increment only for non-replayed events. Enabled alternatives under one component must agree on event, mode, behavior, and required count.</p></article>
        <article class="achievement-callout is-info"><h3>Targets</h3><p>Target meanings are event-specific. Skill IDs are 0–77; skill 0 is 1H Blunt. NPC Name Kill requires the canonical hash helper.</p></article>
        <article class="achievement-callout is-warning"><h3>Rewards</h3><p>Every enabled selectable option needs an enabled mapped grant. Keep existing reward and reward-set IDs unchanged.</p></article>
        <article class="achievement-callout is-warning"><h3>Publishing</h3><p>Save as disabled, clear validation, enable, save again, then run <code>#reload achievements global</code> and confirm server acceptance.</p></article>
      </div>
    </section>

    <div class="achievement-form-actions">
      <div>
        <strong data-achievement-save-summary><?=$creatingDefinition ? 'New definition' : 'Achievement ' . achievement_e($definitionId)?></strong>
        <span>One submit writes the complete graph transactionally or writes nothing.</span>
      </div>
      <button class="achievement-button" type="submit" title="Validate and atomically save the complete definition graph"><?=$creatingDefinition ? 'Create definition graph' : 'Save definition graph'?></button>
    </div>
  </form>

  <?php if (!$creatingDefinition && !empty($can_edit_achievements)): ?>
    <div class="achievement-danger-grid">
      <section class="achievement-panel achievement-clone-zone">
        <h2>Safe clone</h2>
        <p>Creates a disabled copy, retains component presentation identities, allocates new reward identities, and intentionally omits cast restrictions.</p>
        <form method="post" action="<?=achievement_e(achievement_url(5))?>" class="achievement-form-grid">
          <input type="hidden" name="csrf_token" value="<?=achievement_e($csrf_token)?>">
          <input type="hidden" name="achievement_id" value="<?=achievement_e($definitionId)?>">
          <div class="achievement-field">
            <?php achievement_view_field_heading('achievement-clone-id', 'New achievement ID', 'Optional. Leave blank to atomically allocate the next safe stable ID.'); ?>
            <input id="achievement-clone-id" name="new_achievement_id" type="text" inputmode="numeric" pattern="[0-9]+" aria-describedby="achievement-clone-id-help">
          </div>
          <div class="achievement-field">
            <?php achievement_view_field_heading('achievement-clone-name', 'New name', 'Optional. Leave blank to append “(Copy)” to the current name.'); ?>
            <input id="achievement-clone-name" name="new_name" type="text" maxlength="255" aria-describedby="achievement-clone-name-help">
          </div>
          <button class="achievement-button is-secondary achievement-field-span-2" type="submit" title="Create a safe disabled clone">Create disabled clone</button>
        </form>
      </section>
      <section class="achievement-panel achievement-danger-zone">
        <h2>Delete authored definition</h2>
        <p>Deletes content rows only. Character completion, progress, reward history, and global component counts remain as durable history. Incoming achievement dependencies block deletion.</p>
        <form method="post" action="<?=achievement_e(achievement_url(6))?>" class="achievement-stacked-form">
          <input type="hidden" name="csrf_token" value="<?=achievement_e($csrf_token)?>">
          <input type="hidden" name="achievement_id" value="<?=achievement_e($definitionId)?>">
          <div class="achievement-field">
            <?php achievement_view_field_heading('achievement-delete-confirmation', 'Type DELETE ' . $definitionId, 'Exact confirmation prevents accidental deletion of the complete authored graph.', true); ?>
            <input id="achievement-delete-confirmation" name="confirmation" type="text" autocomplete="off" aria-describedby="achievement-delete-confirmation-help" required>
          </div>
          <button class="achievement-button is-danger" type="submit" title="Permanently delete this authored definition graph">Delete authored content</button>
        </form>
      </section>
    </div>
  <?php endif; ?>
</div>
