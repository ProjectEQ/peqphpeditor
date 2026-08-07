<?php
require_once('templates/achievements/_common.tmpl.php');
$categoryMetadata = function_exists('achievement_metadata') ? achievement_metadata() : array();
$categoryRows = achievement_view_array(isset($categories) ? $categories : array());
$categoryChoices = achievement_view_array(isset($category_options) ? $category_options : array());
$editing = is_array(isset($editing_category) ? $editing_category : null) ? $editing_category : null;
$submittedCategory = is_array(isset($category_form_values) ? $category_form_values : null)
  ? $category_form_values
  : null;
$categoryIssues = achievement_view_array(isset($category_issues) ? $category_issues : array());
$isEditing = isset($category_form_is_editing)
  ? (bool) $category_form_is_editing
  : $editing !== null;
$suggestions = achievement_view_array(isset($suggested_ids) ? $suggested_ids : array());
$category = $submittedCategory !== null ? $submittedCategory : ($isEditing ? $editing : array(
  'id' => achievement_view_value($suggestions, 'category_id', 1),
  'parent_id' => 0,
  'sequence' => 0,
  'name' => '',
  'description' => '',
  'icon' => '',
));
$editingSummary = null;
if ($isEditing) {
  foreach ($categoryRows as $candidate) {
    if ((int) achievement_view_value($candidate, 'id', 0) === (int) $category['id']) {
      $editingSummary = $candidate;
      break;
    }
  }
}
$childrenCount = (int) achievement_view_value($editingSummary, 'children_count', 0);
$associationCount = (int) achievement_view_value($editingSummary, 'associations_count', 0);
$deleteBlocked = $childrenCount > 0 || $associationCount > 0;
?>
<div class="achievement-editor-page achievement-categories-page">
  <?php achievement_view_nav('categories', isset($can_manage_character_achievements) && $can_manage_character_achievements); ?>
  <?php achievement_view_flash(isset($flash_messages) ? $flash_messages : array()); ?>

  <section class="achievement-page-heading">
    <div>
      <p class="achievement-eyebrow">World data</p>
      <h1>Achievement categories</h1>
      <p>Maintain the client-facing hierarchy while preserving stable IDs and preventing parent cycles or destructive deletes.</p>
    </div>
    <?php if (!empty($can_edit_achievements) && $isEditing): ?>
      <a class="achievement-button is-secondary" href="<?=achievement_e(achievement_url(20))?>" title="Clear the editor and prepare a new category">+ New category</a>
    <?php endif; ?>
  </section>

  <div class="achievement-two-column-layout">
    <section class="achievement-panel" aria-labelledby="achievement-category-tree-heading">
      <div class="achievement-panel-heading">
        <div>
          <h2 id="achievement-category-tree-heading">Category hierarchy</h2>
          <p>Indentation shows the parent chain. Order sorts siblings; ID breaks ties.</p>
        </div>
        <span class="achievement-badge"><?=count($categoryRows)?> categories</span>
      </div>
      <?php if (!$categoryRows): ?>
        <div class="achievement-empty-state"><strong>No categories exist.</strong><p>Create a root category to begin the hierarchy.</p></div>
      <?php else: ?>
        <div class="achievement-table-scroll">
          <table class="achievement-table achievement-category-table">
            <thead>
              <tr>
                <th scope="col">Category</th>
                <th scope="col">ID</th>
                <th scope="col">Order</th>
                <th scope="col">Definitions</th>
                <th scope="col">Children</th>
                <?php if (!empty($can_edit_achievements)): ?><th scope="col">Action</th><?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categoryRows as $row): ?>
                <?php $categoryId = (int) achievement_view_value($row, 'id', 0); ?>
                <tr<?=$isEditing && (int) $category['id'] === $categoryId ? ' class="is-selected"' : ''?>>
                  <th scope="row" class="achievement-table-primary">
                    <span style="padding-left: <?=achievement_e(max(0, (int) achievement_view_value($row, 'depth', 0)) * 18)?>px">
                      <?=achievement_e(achievement_view_value($row, 'name', 'Unnamed category'))?>
                    </span>
                    <span><?=achievement_e(achievement_view_value($row, 'description', ''))?></span>
                  </th>
                  <td><code><?=achievement_e($categoryId)?></code></td>
                  <td><?=achievement_e(achievement_view_value($row, 'sequence', 0))?></td>
                  <td><?=achievement_e(achievement_view_value($row, 'associations_count', 0))?></td>
                  <td><?=achievement_e(achievement_view_value($row, 'children_count', 0))?></td>
                  <?php if (!empty($can_edit_achievements)): ?>
                    <td><a class="achievement-button is-small" href="<?=achievement_e(achievement_url(20, array('category_id' => $categoryId)))?>" title="Edit this category and inspect delete blockers">Edit</a></td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </section>

    <?php if (!empty($can_edit_achievements)): ?>
    <aside class="achievement-panel achievement-sticky-panel" aria-labelledby="achievement-category-form-heading">
      <div class="achievement-panel-heading">
        <div>
          <h2 id="achievement-category-form-heading"><?=$isEditing ? 'Edit category ' . achievement_e($category['id']) : 'Create category'?></h2>
          <p><?=$isEditing ? 'The stable ID cannot be changed after creation.' : 'The suggested ID is calculated from current content and is rechecked when saved.'?></p>
        </div>
      </div>

      <?php if ($categoryIssues): ?>
        <section class="achievement-server-issues" aria-labelledby="achievement-category-issues-heading" role="alert">
          <h3 id="achievement-category-issues-heading">Category validation</h3>
          <ul>
            <?php foreach ($categoryIssues as $issue): ?>
              <li class="is-<?=achievement_e(achievement_view_value($issue, 'severity', 'error'))?>">
                <?php if (achievement_view_value($issue, 'path', '') !== ''): ?><code><?=achievement_e($issue['path'])?></code><?php endif; ?>
                <span><?=achievement_e(achievement_view_value($issue, 'message', 'Invalid category value.'))?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </section>
      <?php endif; ?>

      <form method="post" action="<?=achievement_e(achievement_url($isEditing ? 24 : 22))?>" class="achievement-stacked-form">
        <input type="hidden" name="csrf_token" value="<?=achievement_e($csrf_token)?>">

        <div class="achievement-field">
          <?php achievement_view_field_heading('achievement-category-id', achievement_view_label($categoryMetadata, 'achievement_categories', 'id', 'Category ID'), achievement_view_help($categoryMetadata, 'achievement_categories', 'id', 'Stable category identity.'), true); ?>
          <input id="achievement-category-id" name="id" type="text" inputmode="numeric" pattern="[0-9]+" value="<?=achievement_e($category['id'])?>" aria-describedby="achievement-category-id-help"<?=$isEditing ? ' readonly' : ''?> required>
        </div>

        <div class="achievement-field">
          <?php achievement_view_field_heading('achievement-category-parent', achievement_view_label($categoryMetadata, 'achievement_categories', 'parent_id', 'Parent category'), achievement_view_help($categoryMetadata, 'achievement_categories', 'parent_id', 'Use 0 for a root category.')); ?>
          <select id="achievement-category-parent" name="parent_id" aria-describedby="achievement-category-parent-help">
            <option value="0">0 — Root category</option>
            <?php foreach ($categoryChoices as $categoryId => $categoryName): ?>
              <option value="<?=achievement_e($categoryId)?>"<?=(int) $category['parent_id'] === (int) $categoryId ? ' selected' : ''?>><?=achievement_e($categoryName)?> (<?=achievement_e($categoryId)?>)</option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="achievement-field">
          <?php achievement_view_field_heading('achievement-category-order', achievement_view_label($categoryMetadata, 'achievement_categories', 'sequence', 'Order'), achievement_view_help($categoryMetadata, 'achievement_categories', 'sequence', 'Sort order among siblings.')); ?>
          <input id="achievement-category-order" name="sequence" type="text" inputmode="numeric" pattern="[0-9]+" value="<?=achievement_e($category['sequence'])?>" aria-describedby="achievement-category-order-help" required>
        </div>

        <div class="achievement-field">
          <?php achievement_view_field_heading('achievement-category-name', achievement_view_label($categoryMetadata, 'achievement_categories', 'name', 'Name'), achievement_view_help($categoryMetadata, 'achievement_categories', 'name', 'Visible category name.'), true); ?>
          <input id="achievement-category-name" name="name" type="text" maxlength="255" value="<?=achievement_e($category['name'])?>" aria-describedby="achievement-category-name-help" required>
        </div>

        <div class="achievement-field">
          <?php achievement_view_field_heading('achievement-category-description', achievement_view_label($categoryMetadata, 'achievement_categories', 'description', 'Description'), achievement_view_help($categoryMetadata, 'achievement_categories', 'description', 'Client-facing category description.')); ?>
          <textarea id="achievement-category-description" name="description" rows="4" aria-describedby="achievement-category-description-help"><?=achievement_e($category['description'])?></textarea>
        </div>

        <div class="achievement-field">
          <?php achievement_view_field_heading('achievement-category-icon', achievement_view_label($categoryMetadata, 'achievement_categories', 'icon', 'Icon resource'), achievement_view_help($categoryMetadata, 'achievement_categories', 'icon', 'Optional client texture/resource name.')); ?>
          <input id="achievement-category-icon" name="icon" type="text" maxlength="255" value="<?=achievement_e($category['icon'])?>" aria-describedby="achievement-category-icon-help" placeholder="Example: A_Hunter">
        </div>

        <button class="achievement-button" type="submit" title="Validate and save this category"><?=$isEditing ? 'Save category' : 'Create category'?></button>
      </form>

      <?php if ($isEditing): ?>
        <hr class="achievement-divider">
        <section class="achievement-danger-zone" aria-labelledby="achievement-category-delete-heading">
          <h3 id="achievement-category-delete-heading">Delete category</h3>
          <p>Deletion is blocked while the category has child categories or achievement associations.</p>
          <dl class="achievement-mini-stats">
            <div><dt>Child categories</dt><dd><?=achievement_e($childrenCount)?></dd></div>
            <div><dt>Associated definitions</dt><dd><?=achievement_e($associationCount)?></dd></div>
          </dl>
          <?php if ($deleteBlocked): ?>
            <div class="achievement-callout is-warning"><strong>Delete blocked</strong><p>Move or remove the listed children and definition associations first.</p></div>
          <?php else: ?>
            <form method="post" action="<?=achievement_e(achievement_url(25))?>" class="achievement-stacked-form">
              <input type="hidden" name="csrf_token" value="<?=achievement_e($csrf_token)?>">
              <input type="hidden" name="category_id" value="<?=achievement_e($category['id'])?>">
              <div class="achievement-field">
                <?php achievement_view_field_heading('achievement-category-delete-confirmation', 'Type DELETE ' . $category['id'], 'Exact confirmation prevents accidental category deletion.', true); ?>
                <input id="achievement-category-delete-confirmation" name="confirmation" type="text" autocomplete="off" aria-describedby="achievement-category-delete-confirmation-help" required>
              </div>
              <button class="achievement-button is-danger" type="submit" title="Permanently delete this empty category">Delete empty category</button>
            </form>
          <?php endif; ?>
        </section>
      <?php endif; ?>
    </aside>
    <?php endif; ?>
  </div>
</div>
