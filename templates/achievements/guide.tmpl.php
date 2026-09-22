<?php
require_once('templates/achievements/_common.tmpl.php');
$guideMetadata = achievement_view_array(isset($metadata) ? $metadata : array());
?>
<div class="achievement-editor-page achievement-guide-page">
  <?php achievement_view_nav('guide', isset($can_manage_character_achievements) && $can_manage_character_achievements); ?>
  <?php achievement_view_flash(isset($flash_messages) ? $flash_messages : array()); ?>

  <section class="achievement-page-heading">
    <div>
      <p class="achievement-eyebrow">Reference</p>
      <h1>Achievement authoring guide</h1>
      <p>Use this reference while designing criteria and rewards. Server-side validation remains authoritative and intentionally fails closed.</p>
    </div>
    <a class="achievement-button is-secondary" href="<?=achievement_e(achievement_url(0))?>" title="Return to the definition catalog">Back to definitions</a>
  </section>

  <section class="achievement-guide-grid">
    <article class="achievement-callout is-info">
      <h2>Safe publishing workflow</h2>
      <ol>
        <li>Create or clone a definition as <strong>disabled</strong>.</li>
        <li>Author categories, components, criteria, rewards, and restrictions.</li>
        <li>Resolve every blocking validation issue and review warnings.</li>
        <li>Keep a selectable achievement source disabled while its shared set is incomplete; enable the source and definition only when the full graph is coherent.</li>
        <li>Save, then run <code>#reload achievements global</code> in game.</li>
        <li>Confirm the server accepted the complete staged catalog before testing characters.</li>
      </ol>
      <p>A failed reload preserves the prior active snapshot. Increment the definition version when deployed semantics change incompatibly.</p>
    </article>
    <article class="achievement-callout is-warning">
      <h2>Durable-state rules</h2>
      <ul>
        <li>Achievement, category, and component identities are durable contracts. Reward and reward-set catalog rows are provider-neutral and may also be referenced by tasks or other systems.</li>
        <li>State-bearing component types are 0, 1, and 2. Type 3 is presentation only.</li>
        <li>Replayable or absolute facts should use Highest, Set, or Boolean—not Increment.</li>
        <li>Ordinary character resets preserve reward ledgers so rewards remain at-most-once.</li>
        <li>Retrying ambiguous delivery can duplicate value and always requires explicit review.</li>
      </ul>
    </article>
  </section>

  <section class="achievement-panel" aria-labelledby="achievement-event-guide-heading">
    <div class="achievement-panel-heading">
      <div>
        <h2 id="achievement-event-guide-heading">Criterion events</h2>
        <p>Target meanings and replay behavior change with the event. Read all four columns before authoring a row.</p>
      </div>
    </div>
    <div class="achievement-table-scroll">
      <table class="achievement-table achievement-guide-table">
        <thead>
          <tr><th scope="col">ID / event</th><th scope="col">When it advances</th><th scope="col">Primary target</th><th scope="col">Secondary target</th><th scope="col">Target value</th><th scope="col">Replay policy</th></tr>
        </thead>
        <tbody>
          <?php foreach (achievement_view_array(isset($guideMetadata['events']) ? $guideMetadata['events'] : array()) as $eventId => $event): ?>
            <tr>
              <th scope="row"><code><?=achievement_e($eventId)?></code> — <?=achievement_e(achievement_view_value($event, 'label', 'Unknown'))?></th>
              <td><?=achievement_e(achievement_view_value($event, 'help', ''))?></td>
              <td><strong><?=achievement_e(achievement_view_value($event, 'target_id_label', 'Primary target'))?></strong><br><?=achievement_e(achievement_view_value($event, 'target_id_help', ''))?></td>
              <td><strong><?=achievement_e(achievement_view_value($event, 'target_id2_label', 'Secondary target'))?></strong><br><?=achievement_e(achievement_view_value($event, 'target_id2_help', ''))?></td>
              <td><strong><?=achievement_e(achievement_view_value($event, 'target_value_label', 'Target value'))?></strong><br><?=achievement_e(achievement_view_value($event, 'target_value_help', ''))?></td>
              <td><?=achievement_e(achievement_view_value($event, 'replay', ''))?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <div class="achievement-two-column-layout">
    <section class="achievement-panel" aria-labelledby="achievement-progress-guide-heading">
      <div class="achievement-panel-heading"><div><h2 id="achievement-progress-guide-heading">Progress modes</h2><p>How observations update durable component progress.</p></div></div>
      <dl class="achievement-reference-list">
        <?php foreach (achievement_view_array(isset($guideMetadata['progress_modes']) ? $guideMetadata['progress_modes'] : array()) as $modeId => $mode): ?>
          <div><dt><code><?=achievement_e($modeId)?></code> — <?=achievement_e(achievement_view_value($mode, 'label', 'Unknown'))?></dt><dd><?=achievement_e(achievement_view_value($mode, 'help', ''))?></dd></div>
        <?php endforeach; ?>
      </dl>
    </section>
    <section class="achievement-panel" aria-labelledby="achievement-behavior-guide-heading">
      <div class="achievement-panel-heading"><div><h2 id="achievement-behavior-guide-heading">Component behaviors</h2><p>How a satisfied component affects completion and visibility.</p></div></div>
      <dl class="achievement-reference-list">
        <?php foreach (achievement_view_array(isset($guideMetadata['behaviors']) ? $guideMetadata['behaviors'] : array()) as $behaviorId => $behavior): ?>
          <div><dt><code><?=achievement_e($behaviorId)?></code> — <?=achievement_e(achievement_view_value($behavior, 'label', 'Unknown'))?></dt><dd><?=achievement_e(achievement_view_value($behavior, 'help', ''))?></dd></div>
        <?php endforeach; ?>
      </dl>
    </section>
  </div>

  <section class="achievement-panel" aria-labelledby="achievement-reward-guide-heading">
    <div class="achievement-panel-heading"><div><h2 id="achievement-reward-guide-heading">Rewards and delivery</h2><p>Canonical grants and selectable sets live in a shared provider-neutral catalog. Achievement mappings always use source type 1; automatic grants use source entries and selectable sets use a separately enabled source link.</p></div></div>
    <div class="achievement-guide-grid">
      <dl class="achievement-reference-list">
        <?php foreach (achievement_view_array(isset($guideMetadata['reward_types']) ? $guideMetadata['reward_types'] : array()) as $rewardType => $reward): ?>
          <div>
            <dt><code><?=achievement_e($rewardType)?></code> — <?=achievement_e(achievement_view_value($reward, 'label', 'Unknown'))?></dt>
            <dd>
              <?=achievement_e(achievement_view_value($reward, 'help', ''))?><br>
              <strong><?=achievement_e(achievement_view_value($reward, 'data_label', 'Referenced data'))?>:</strong>
              <?=achievement_e(achievement_view_value($reward, 'data_help', 'Type-specific reference.'))?><br>
              <strong>Amount:</strong> <?=achievement_e(achievement_view_value($reward, 'amount_help', 'Positive type-specific quantity.'))?>
            </dd>
          </div>
        <?php endforeach; ?>
      </dl>
      <dl class="achievement-reference-list">
        <?php foreach (achievement_view_array(isset($guideMetadata['reward_delivery']) ? $guideMetadata['reward_delivery'] : array()) as $deliveryKey => $delivery): ?>
          <div><dt><?=achievement_e(achievement_view_value($delivery, 'label', $deliveryKey))?></dt><dd><?=achievement_e(achievement_view_value($delivery, 'help', ''))?></dd></div>
        <?php endforeach; ?>
      </dl>
    </div>
    <div class="achievement-callout is-warning">
      <strong>Selectable reward invariant</strong>
      <p>When the definition, achievement source link, and shared catalog set are enabled, every enabled option—including a common option—must contain at least one enabled mapped grant. The set must offer an enabled non-common choice. Disable the source link to stage incomplete content without making it reachable.</p>
    </div>
    <div class="achievement-callout is-info">
      <strong>Specific AA rank and inverse-class fallback</strong>
      <p>Type 6 references an enabled <code>aa_ability.id</code>; Amount is the desired cumulative rank, not a rank-row ID or AA-point cost. The editor verifies that rank by walking from <code>aa_ability.first_rank_id</code> through <code>aa_ranks.next_id</code>, stopping successfully at the requested rank and failing closed above the 10,000-link editor safety limit. Type 7 is an optional server-only companion for an all-class automatic achievement: it awards the configured unspent AA points only to playable classes ineligible for the referenced class-limited ability. It must remain automatic, and each enabled type 7 row requires exactly one enabled automatic type 6 row with the same ability ID. Standalone type 6 rewards remain valid.</p>
    </div>
  </section>

  <section class="achievement-panel" aria-labelledby="achievement-skill-guide-heading">
    <div class="achievement-panel-heading">
      <div><h2 id="achievement-skill-guide-heading">Canonical EQEmu skills</h2><p>Skill IDs are zero-based. ID 0 is 1H Blunt; never shift this list or substitute language IDs.</p></div>
      <span class="achievement-badge">0–77</span>
    </div>
    <div class="achievement-skill-grid">
      <?php foreach (achievement_view_array(isset($guideMetadata['skills']) ? $guideMetadata['skills'] : array()) as $skillId => $skillName): ?>
        <div><code><?=achievement_e($skillId)?></code><span><?=achievement_e($skillName)?></span></div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="achievement-panel" aria-labelledby="achievement-npc-hash-guide-heading">
    <div class="achievement-panel-heading"><div><h2 id="achievement-npc-hash-guide-heading">NPC-name criteria</h2><p>The graph editor includes a helper that mirrors EQEmu canonicalization and unsigned FNV-1a hashing.</p></div></div>
    <ul>
      <li>ASCII letters are lowercased.</li>
      <li>Spaces and underscores collapse to one space between letter groups.</li>
      <li>Digits, punctuation, and non-ASCII bytes are removed.</li>
      <li>The resulting canonical name is hashed to one nonzero unsigned 32-bit target ID.</li>
      <li>A zone target can reduce the already-small collision risk and disambiguate reused NPC names.</li>
    </ul>
  </section>
</div>
