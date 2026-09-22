<?php
require_once('templates/achievements/_common.tmpl.php');
$definitionPage = achievement_view_array(isset($definitions) ? $definitions : array());
$rows = isset($definitionPage['rows']) && is_array($definitionPage['rows']) ? $definitionPage['rows'] : array();
$activeFilters = achievement_view_array(isset($filters) ? $filters : array());
$definitionMetadata = achievement_view_array(isset($metadata) ? $metadata : array());
$categoryChoices = achievement_view_array(isset($category_options) ? $category_options : array());
$filterParameters = array(
  'q' => achievement_view_value($activeFilters, 'q', ''),
  'enabled' => achievement_view_value($activeFilters, 'enabled', ''),
  'category_id' => achievement_view_value($activeFilters, 'category_id', 0),
  'event_type' => achievement_view_value($activeFilters, 'event_type', ''),
  'reward' => achievement_view_value($activeFilters, 'reward', ''),
  'sort' => achievement_view_value($activeFilters, 'sort', 'name'),
  'direction' => achievement_view_value($activeFilters, 'direction', 'asc'),
  'per_page' => achievement_view_value($activeFilters, 'per_page', 50),
);
$sortLink = function ($key) use ($filterParameters) {
  $nextDirection = $filterParameters['sort'] === $key && $filterParameters['direction'] === 'asc' ? 'desc' : 'asc';
  return achievement_url(0, array_merge($filterParameters, array('sort' => $key, 'direction' => $nextDirection, 'page' => 1)));
};
$sortText = function ($key) use ($filterParameters) {
  if ($filterParameters['sort'] !== $key) {
    return 'Sort ascending';
  }
  return $filterParameters['direction'] === 'asc' ? 'Sorted ascending; choose descending' : 'Sorted descending; choose ascending';
};
?>
<div class="achievement-editor-page achievement-definitions-page">
  <?php achievement_view_nav('definitions', isset($can_manage_character_achievements) && $can_manage_character_achievements); ?>
  <?php achievement_view_flash(isset($flash_messages) ? $flash_messages : array()); ?>

  <section class="achievement-page-heading">
    <div>
      <p class="achievement-eyebrow">World data</p>
      <h1>Achievement definitions</h1>
      <p>Browse the complete content catalog, then edit each definition as one validated, transactional graph.</p>
    </div>
    <?php if (!empty($can_edit_achievements)): ?>
      <a class="achievement-button" href="<?=achievement_e(achievement_url(1))?>" title="Create a disabled achievement definition with a new stable ID">+ New definition</a>
    <?php endif; ?>
  </section>

  <section class="achievement-panel achievement-filter-panel" aria-labelledby="achievement-definition-filter-heading">
    <div class="achievement-panel-heading">
      <div>
        <h2 id="achievement-definition-filter-heading">Catalog filters</h2>
        <p>All filters are database-bounded. Text searches match IDs, names, and descriptions.</p>
      </div>
      <span class="achievement-badge"><?=achievement_e(achievement_view_value($definitionPage, 'total', 0))?> definitions</span>
    </div>
    <form method="get" action="index.php" class="achievement-filter-grid">
      <input type="hidden" name="editor" value="achievements">
      <input type="hidden" name="action" value="0">

      <div class="achievement-field achievement-field-span-2">
        <?php achievement_view_field_heading('definition-filter-q', 'Name, description, or ID', 'Enter all or part of a definition name or description, or an exact numeric achievement ID.'); ?>
        <input id="definition-filter-q" name="q" type="search" maxlength="255" value="<?=achievement_e($filterParameters['q'])?>" aria-describedby="definition-filter-q-help">
      </div>
      <div class="achievement-field">
        <?php achievement_view_field_heading('definition-filter-enabled', 'Published state', 'Enabled definitions enter the active server snapshot; disabled definitions remain safe drafts.'); ?>
        <select id="definition-filter-enabled" name="enabled" aria-describedby="definition-filter-enabled-help">
          <option value="">All states</option>
          <option value="1"<?=$filterParameters['enabled'] === '1' ? ' selected' : ''?>>Enabled</option>
          <option value="0"<?=$filterParameters['enabled'] === '0' ? ' selected' : ''?>>Disabled</option>
        </select>
      </div>
      <div class="achievement-field">
        <?php achievement_view_field_heading('definition-filter-category', 'Category', 'Limit the catalog to definitions associated with one client category.'); ?>
        <select id="definition-filter-category" name="category_id" aria-describedby="definition-filter-category-help">
          <option value="0">All categories</option>
          <?php foreach ($categoryChoices as $categoryId => $categoryName): ?>
            <option value="<?=achievement_e($categoryId)?>"<?=(int) $filterParameters['category_id'] === (int) $categoryId ? ' selected' : ''?>><?=achievement_e($categoryName)?> (<?=achievement_e($categoryId)?>)</option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="achievement-field">
        <?php achievement_view_field_heading('definition-filter-event', 'Criterion event', 'Show definitions containing at least one criterion using the selected engine event.'); ?>
        <select id="definition-filter-event" name="event_type" aria-describedby="definition-filter-event-help">
          <option value="">All events</option>
          <?php foreach (achievement_view_array(isset($definitionMetadata['events']) ? $definitionMetadata['events'] : array()) as $eventId => $event): ?>
            <option value="<?=achievement_e($eventId)?>"<?=(string) $filterParameters['event_type'] === (string) $eventId ? ' selected' : ''?>><?=achievement_e($eventId)?> — <?=achievement_e(achievement_view_value($event, 'label', 'Unknown'))?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="achievement-field">
        <?php achievement_view_field_heading('definition-filter-reward', 'Reward content', 'Filter by automatic grants, selectable sets, any authored reward, or definitions with no rewards.'); ?>
        <select id="definition-filter-reward" name="reward" aria-describedby="definition-filter-reward-help">
          <?php foreach (array('' => 'All reward states', 'any' => 'Any reward', 'automatic' => 'Automatic grant', 'selectable' => 'Selectable reward set', 'none' => 'No rewards') as $rewardValue => $rewardLabel): ?>
            <option value="<?=achievement_e($rewardValue)?>"<?=$filterParameters['reward'] === $rewardValue ? ' selected' : ''?>><?=achievement_e($rewardLabel)?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="achievement-field">
        <?php achievement_view_field_heading('definition-filter-size', 'Rows per page', 'Choose a bounded page size so catalog queries and rendering remain predictable.'); ?>
        <select id="definition-filter-size" name="per_page" aria-describedby="definition-filter-size-help">
          <?php foreach (array(25, 50, 100, 200) as $size): ?>
            <option value="<?=$size?>"<?=(int) $filterParameters['per_page'] === $size ? ' selected' : ''?>><?=$size?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="achievement-filter-actions achievement-field-span-2">
        <button class="achievement-button" type="submit" title="Apply these catalog filters">Apply filters</button>
        <a class="achievement-button is-secondary" href="<?=achievement_e(achievement_url(0))?>" title="Remove all definition filters and restore the default sort">Clear filters</a>
      </div>
    </form>
  </section>

  <section class="achievement-panel" aria-labelledby="achievement-definition-results-heading">
    <div class="achievement-panel-heading">
      <div>
        <h2 id="achievement-definition-results-heading">Definition catalog</h2>
        <p>Counts summarize authored graph rows; open a definition to inspect criteria, mappings, restrictions, and validation.</p>
      </div>
      <?php achievement_view_pager(0, achievement_view_value($definitionPage, 'page', 1), achievement_view_value($definitionPage, 'pages', 0), $filterParameters); ?>
    </div>

    <?php if (!$rows): ?>
      <div class="achievement-empty-state">
        <strong>No definitions matched.</strong>
        <p>Clear one or more filters, or create a disabled draft definition.</p>
      </div>
    <?php else: ?>
      <div class="achievement-table-scroll">
        <table class="achievement-table achievement-definition-table">
          <thead>
            <tr>
              <?php foreach (array('id' => 'ID', 'name' => 'Definition', 'points' => 'Points', 'version' => 'Version', 'enabled' => 'State', 'component_count' => 'Components', 'category_count' => 'Categories', 'reward_count' => 'Rewards') as $sortKey => $heading): ?>
                <th scope="col">
                  <a href="<?=achievement_e($sortLink($sortKey))?>" title="<?=achievement_e($sortText($sortKey))?>">
                    <?=achievement_e($heading)?><?=$filterParameters['sort'] === $sortKey ? ($filterParameters['direction'] === 'asc' ? ' ▲' : ' ▼') : ''?>
                  </a>
                </th>
              <?php endforeach; ?>
              <th scope="col">Criteria / restrictions</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $definition): ?>
              <?php $definitionId = (int) achievement_view_value($definition, 'id', 0); ?>
              <tr>
                <td><code><?=achievement_e($definitionId)?></code></td>
                <td class="achievement-table-primary">
                  <?php if (!empty($can_edit_achievements)): ?>
                    <a href="<?=achievement_e(achievement_url(3, array('achievement_id' => $definitionId)))?>" title="Open the complete definition graph">
                      <?=achievement_e(achievement_view_value($definition, 'name', 'Unnamed achievement'))?>
                    </a>
                  <?php else: ?>
                    <strong title="Opening the full graph requires achievement-editor authorization"><?=achievement_e(achievement_view_value($definition, 'name', 'Unnamed achievement'))?></strong>
                  <?php endif; ?>
                  <span><?=achievement_e(achievement_view_value($definition, 'description', ''))?></span>
                </td>
                <td><?=achievement_e(achievement_view_value($definition, 'points', 0))?></td>
                <td><?=achievement_e(achievement_view_value($definition, 'version', 0))?></td>
                <td><span class="achievement-badge <?=!empty($definition['enabled']) ? 'is-success' : 'is-muted'?>"><?=!empty($definition['enabled']) ? 'Enabled' : 'Draft'?></span></td>
                <td><?=achievement_e(achievement_view_value($definition, 'component_count', 0))?></td>
                <td>
                  <span title="<?=achievement_e(achievement_view_value($definition, 'category_names', 'No categories'))?>">
                    <?=achievement_e(achievement_view_value($definition, 'category_count', achievement_view_value($definition, 'category_names', '') === '' ? 0 : count(explode(',', $definition['category_names']))))?>
                  </span>
                </td>
                <td><?=achievement_e(achievement_view_value($definition, 'reward_count', 0))?><?=!empty($definition['reward_set_count']) ? ' + selectable' : ''?></td>
                <td><?=achievement_e(achievement_view_value($definition, 'criterion_count', 0))?> criteria / <?=achievement_e(achievement_view_value($definition, 'restriction_count', 0))?> cast</td>
                <td class="achievement-table-actions">
                  <?php if (!empty($can_edit_achievements)): ?>
                    <a class="achievement-button is-small" href="<?=achievement_e(achievement_url(3, array('achievement_id' => $definitionId)))?>" title="Edit every part of this definition graph">Manage</a>
                    <details class="achievement-inline-details">
                      <summary title="Create a disabled copy with new reward identities">Safe clone</summary>
                      <form method="post" action="<?=achievement_e(achievement_url(5))?>" class="achievement-compact-form">
                        <input type="hidden" name="csrf_token" value="<?=achievement_e($csrf_token)?>">
                        <input type="hidden" name="achievement_id" value="<?=achievement_e($definitionId)?>">
                        <label for="clone-id-<?=$definitionId?>">New ID <span>Optional; blank allocates the next safe ID.</span></label>
                        <input id="clone-id-<?=$definitionId?>" name="new_achievement_id" type="text" inputmode="numeric" pattern="[0-9]+" title="Optional stable ID for the disabled clone">
                        <label for="clone-name-<?=$definitionId?>">New name <span>Optional; blank appends “(Copy)”.</span></label>
                        <input id="clone-name-<?=$definitionId?>" name="new_name" type="text" maxlength="255" title="Optional visible name for the clone">
                        <p class="achievement-help">Cast restrictions are intentionally omitted. Rewards and the selectable set receive new canonical identities.</p>
                        <button class="achievement-button is-small" type="submit" title="Create the disabled safe clone">Create clone</button>
                      </form>
                    </details>
                  <?php else: ?>
                    <span class="achievement-badge is-muted" title="Achievement-editor authorization is required">Editor only</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>

    <?php achievement_view_pager(0, achievement_view_value($definitionPage, 'page', 1), achievement_view_value($definitionPage, 'pages', 0), $filterParameters); ?>
  </section>
</div>
