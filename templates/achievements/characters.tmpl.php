<?php
require_once('templates/achievements/_common.tmpl.php');
$characterPage = achievement_view_array(isset($characters) ? $characters : array());
$characterRows = isset($characterPage['items']) && is_array($characterPage['items']) ? $characterPage['items'] : array();
$classLabels = achievement_view_array(isset($classes) ? $classes : array());
$characterSearch = isset($search) ? (string) $search : '';
?>
<div class="achievement-editor-page achievement-characters-page">
  <?php achievement_view_nav('characters', true); ?>
  <?php achievement_view_flash(isset($flash_messages) ? $flash_messages : array()); ?>

  <section class="achievement-page-heading">
    <div>
      <p class="achievement-eyebrow">Administrative state</p>
      <h1>Character achievements</h1>
      <p>Locate a character, inspect durable completion and delivery state, and use guarded repair actions only after reviewing the evidence.</p>
    </div>
  </section>

  <section class="achievement-callout is-warning">
    <strong>Prefer offline maintenance</strong>
    <p>Character and zone processes can update the same rows. This editor uses the server-compatible character lock, but force completion is intentionally unavailable while a character is online.</p>
  </section>

  <section class="achievement-panel achievement-filter-panel" aria-labelledby="achievement-character-search-heading">
    <div class="achievement-panel-heading">
      <div>
        <h2 id="achievement-character-search-heading">Find a character</h2>
        <p>Search by partial character name or exact numeric character ID. Deleted characters are excluded.</p>
      </div>
      <span class="achievement-badge"><?=achievement_e(achievement_view_value($characterPage, 'total', 0))?> characters</span>
    </div>
    <form method="get" action="index.php" class="achievement-filter-grid">
      <input type="hidden" name="editor" value="achievements">
      <input type="hidden" name="action" value="40">
      <div class="achievement-field achievement-field-span-3">
        <?php achievement_view_field_heading('achievement-character-search', 'Character name or ID', 'Enter part of a name, or an exact numeric character ID. Results are capped at 50 per page.'); ?>
        <input id="achievement-character-search" name="q" type="search" maxlength="255" value="<?=achievement_e($characterSearch)?>" aria-describedby="achievement-character-search-help" placeholder="Example: Lyric or 1015">
      </div>
      <div class="achievement-filter-actions">
        <button class="achievement-button" type="submit" title="Search the primary character database">Search characters</button>
        <a class="achievement-button is-secondary" href="<?=achievement_e(achievement_url(40))?>" title="Clear the character search">Clear</a>
      </div>
    </form>
  </section>

  <section class="achievement-panel" aria-labelledby="achievement-character-results-heading">
    <div class="achievement-panel-heading">
      <div>
        <h2 id="achievement-character-results-heading">Character results</h2>
        <p>Counts are durable rows in the primary database, not client-cache estimates.</p>
      </div>
      <?php achievement_view_pager(40, achievement_view_value($characterPage, 'page', 1), achievement_view_value($characterPage, 'pages', 0), array('q' => $characterSearch)); ?>
    </div>

    <?php if (!$characterRows): ?>
      <div class="achievement-empty-state"><strong>No characters matched.</strong><p>Try a shorter name fragment or verify the exact character ID.</p></div>
    <?php else: ?>
      <div class="achievement-table-scroll">
        <table class="achievement-table achievement-character-table">
          <thead>
            <tr>
              <th scope="col">Character</th>
              <th scope="col">Level / class</th>
              <th scope="col">Runtime</th>
              <th scope="col" title="Durable character_achievements rows">Completed</th>
              <th scope="col" title="Progress rows whose current count is greater than zero">Active progress</th>
              <th scope="col" title="All durable component progress rows">Progress rows</th>
              <th scope="col" title="Sum of durable component current counts">Count total</th>
              <th scope="col">Last login</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($characterRows as $characterRow): ?>
              <?php
                $characterId = (int) achievement_view_value($characterRow, 'id', 0);
                $classId = (int) achievement_view_value($characterRow, 'class', 0);
                $className = isset($classLabels[$classId]) ? $classLabels[$classId] : 'Unknown class ' . $classId;
              ?>
              <tr>
                <th scope="row" class="achievement-table-primary">
                  <a href="<?=achievement_e(achievement_url(41, array('playerid' => $characterId)))?>" title="Manage this character's achievement state"><?=achievement_e(achievement_view_value($characterRow, 'name', 'Unnamed'))?></a>
                  <span>ID <?=achievement_e($characterId)?> · Account <a href="<?=achievement_e('index.php?editor=account&acctid=' . (int) achievement_view_value($characterRow, 'account_id', 0))?>"><?=achievement_e(achievement_view_value($characterRow, 'account_id', 0))?></a></span>
                </th>
                <td><?=achievement_e(achievement_view_value($characterRow, 'level', 0))?> <?=achievement_e($className)?></td>
                <td><span class="achievement-badge <?=!empty($characterRow['ingame']) ? 'is-warning' : 'is-success'?>"><?=!empty($characterRow['ingame']) ? 'Online' : 'Offline'?></span></td>
                <td><?=achievement_e(achievement_view_value($characterRow, 'achievement_completion_count', 0))?></td>
                <td><?=achievement_e(achievement_view_value($characterRow, 'achievement_progress_count', 0))?></td>
                <td><?=achievement_e(achievement_view_value($characterRow, 'achievement_progress_row_count', 0))?></td>
                <td><?=achievement_e(achievement_view_value($characterRow, 'achievement_progress_total', '0'))?></td>
                <td><?=achievement_e(achievement_view_timestamp(achievement_view_value($characterRow, 'last_login', 0)))?></td>
                <td><a class="achievement-button is-small" href="<?=achievement_e(achievement_url(41, array('playerid' => $characterId)))?>" title="Inspect completion, progress, rewards, selections, and pending state updates">Manage</a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
    <?php achievement_view_pager(40, achievement_view_value($characterPage, 'page', 1), achievement_view_value($characterPage, 'pages', 0), array('q' => $characterSearch)); ?>
  </section>
</div>
