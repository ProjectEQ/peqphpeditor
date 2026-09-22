<?php require_once('templates/achievements/_common.tmpl.php'); ?>
<div class="achievement-editor-page achievement-error-page">
  <?php achievement_view_nav('definitions', isset($can_manage_character_achievements) && $can_manage_character_achievements); ?>
  <?php achievement_view_flash(isset($flash_messages) ? $flash_messages : array()); ?>

  <section class="achievement-panel achievement-panel-danger" role="alert">
    <p class="achievement-eyebrow">Request stopped safely</p>
    <h1><?=achievement_e(isset($error_title) ? $error_title : 'Achievement editor error')?></h1>
    <p><?=achievement_e(isset($error_message) ? $error_message : 'The request could not be completed.')?></p>
    <?php if (!empty($error_details) && is_array($error_details)): ?>
      <ul class="achievement-error-list">
        <?php foreach ($error_details as $detail): ?>
          <li><?=achievement_e($detail)?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <div class="achievement-actions">
      <a class="achievement-button" href="<?=achievement_e(achievement_url(0))?>" title="Return to the achievement definition catalog">Return to definitions</a>
      <button class="achievement-button is-secondary" type="button" onclick="history.back()" title="Return to the previous page">Go back</button>
    </div>
  </section>
</div>
