<?php require_once('templates/achievements/_common.tmpl.php'); ?>
<div class="achievement-editor-page achievement-schema-page">
  <?php achievement_view_nav('definitions', isset($can_manage_character_achievements) && $can_manage_character_achievements); ?>
  <?php achievement_view_flash(isset($flash_messages) ? $flash_messages : array()); ?>

  <section class="achievement-page-heading">
    <div>
      <p class="achievement-eyebrow">Schema diagnostics</p>
      <h1>Achievement editor is not ready</h1>
      <p>The editor is intentionally read-only until every required table, identity, and InnoDB safety requirement is available.</p>
    </div>
  </section>

  <?php
    $definitionDiagnostics = achievement_view_array(isset($diagnostics) ? $diagnostics : array());
    $characterDiagnostics = is_array(isset($character_diagnostics) ? $character_diagnostics : null)
      ? $character_diagnostics
      : null;
  ?>
  <section class="achievement-panel achievement-panel-danger" aria-labelledby="achievement-definition-schema-title">
    <div class="achievement-panel-heading">
      <div>
        <h2 id="achievement-definition-schema-title">Definition schema</h2>
        <p>Content database: <strong><?=achievement_e(achievement_view_value($definitionDiagnostics, 'database', 'unknown'))?></strong></p>
      </div>
      <span class="achievement-badge <?=!empty($definitionDiagnostics['ready']) ? 'is-success' : 'is-danger'?>">
        <?=!empty($definitionDiagnostics['ready']) ? 'Ready' : 'Blocked'?>
      </span>
    </div>

    <?php if (!empty($definitionDiagnostics['errors'])): ?>
      <div class="achievement-callout is-danger" role="alert">
        <strong>Blocking requirements</strong>
        <ul>
          <?php foreach ($definitionDiagnostics['errors'] as $error): ?>
            <li><?=achievement_e($error)?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if (!empty($definitionDiagnostics['warnings'])): ?>
      <div class="achievement-callout is-warning">
        <strong>Optional lookup warnings</strong>
        <ul>
          <?php foreach ($definitionDiagnostics['warnings'] as $warning): ?>
            <li><?=achievement_e($warning)?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <?php if (!empty($definitionDiagnostics['tables'])): ?>
      <div class="achievement-table-scroll">
        <table class="achievement-table">
          <thead>
            <tr>
              <th scope="col">Table</th>
              <th scope="col">Exists</th>
              <th scope="col">Engine</th>
              <th scope="col">Missing columns</th>
              <th scope="col">Column issues</th>
              <th scope="col">Missing identities / indexes</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($definitionDiagnostics['tables'] as $tableName => $table): ?>
              <tr>
                <th scope="row"><code><?=achievement_e($tableName)?></code></th>
                <td><?=!empty($table['exists']) ? 'Yes' : 'No'?></td>
                <td><?=achievement_e(isset($table['engine']) && $table['engine'] !== null ? $table['engine'] : 'missing')?></td>
                <td><?=achievement_e(!empty($table['missing_columns']) ? implode(', ', $table['missing_columns']) : 'None')?></td>
                <td><?=achievement_e(!empty($table['column_mismatches']) ? implode(', ', $table['column_mismatches']) : 'None')?></td>
                <td><?=achievement_e(!empty($table['missing_indexes']) ? implode(', ', $table['missing_indexes']) : 'None')?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </section>

  <?php if ($characterDiagnostics !== null): ?>
    <section class="achievement-panel achievement-panel-danger" aria-labelledby="achievement-character-schema-title">
      <div class="achievement-panel-heading">
        <div>
          <h2 id="achievement-character-schema-title">Character-state schema</h2>
          <p>These tables belong in the primary EQEmu character database, even when content is hosted separately.</p>
        </div>
        <span class="achievement-badge <?=!empty($characterDiagnostics['ready']) ? 'is-success' : 'is-danger'?>">
          <?=!empty($characterDiagnostics['ready']) ? 'Ready' : 'Blocked'?>
        </span>
      </div>
      <?php
        $characterErrors = !empty($characterDiagnostics['character_errors'])
          ? achievement_view_array($characterDiagnostics['character_errors'])
          : array();
        $contentErrors = !empty($characterDiagnostics['content_errors'])
          ? achievement_view_array($characterDiagnostics['content_errors'])
          : array();
        $combinedErrors = !empty($characterDiagnostics['errors'])
          ? achievement_view_array($characterDiagnostics['errors'])
          : array_merge($characterErrors, $contentErrors);
      ?>
      <?php if ($combinedErrors): ?>
        <div class="achievement-callout is-danger" role="alert">
          <strong>Blocking character-state requirements</strong>
          <ul>
            <?php foreach ($combinedErrors as $error): ?><li><?=achievement_e($error)?></li><?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
      <dl class="achievement-diagnostic-list">
        <div>
          <dt>Character database</dt>
          <dd><?=achievement_e(achievement_view_value($characterDiagnostics, 'character_database', achievement_view_value($characterDiagnostics, 'database', 'unknown')))?></dd>
        </div>
        <div>
          <dt>Content database</dt>
          <dd><?=achievement_e(achievement_view_value($characterDiagnostics, 'content_database', 'unknown'))?></dd>
        </div>
        <div>
          <dt>Missing character tables</dt>
          <dd><?=achievement_e(!empty($characterDiagnostics['character_missing']) ? implode(', ', $characterDiagnostics['character_missing']) : 'None')?></dd>
        </div>
        <div>
          <dt>Missing content tables</dt>
          <dd><?=achievement_e(!empty($characterDiagnostics['content_missing']) ? implode(', ', $characterDiagnostics['content_missing']) : 'None')?></dd>
        </div>
      </dl>

      <?php foreach (array('character_tables' => 'Character database tables', 'content_tables' => 'Content database tables') as $diagnosticKey => $diagnosticLabel): ?>
        <?php $diagnosticTables = achievement_view_array(achievement_view_value($characterDiagnostics, $diagnosticKey, array())); ?>
        <?php if ($diagnosticTables): ?>
          <h3><?=achievement_e($diagnosticLabel)?></h3>
          <div class="achievement-table-scroll">
            <table class="achievement-table">
              <thead><tr><th scope="col">Table</th><th scope="col">Exists</th><th scope="col">Engine</th><th scope="col">Missing columns</th><th scope="col">Column issues</th><th scope="col">Missing identities / indexes</th></tr></thead>
              <tbody>
                <?php foreach ($diagnosticTables as $tableName => $table): ?>
                  <?php $table = achievement_view_array($table); ?>
                  <tr>
                    <th scope="row"><code><?=achievement_e($tableName)?></code></th>
                    <td><?=!empty($table['exists']) ? 'Yes' : 'No'?></td>
                    <td><?=achievement_e(achievement_view_value($table, 'engine', 'missing'))?><?=array_key_exists('engine_ok', $table) && !$table['engine_ok'] ? ' (must be InnoDB)' : ''?></td>
                    <td><?=achievement_e(achievement_view_diagnostic_values(achievement_view_value($table, 'missing_columns', array())))?></td>
                    <td><?=achievement_e(achievement_view_diagnostic_values(achievement_view_value($table, 'column_mismatches', array())))?></td>
                    <td><?=achievement_e(achievement_view_diagnostic_values(achievement_view_value($table, 'missing_indexes', array())))?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </section>
  <?php endif; ?>

  <section class="achievement-callout is-info">
    <strong>How to recover</strong>
    <p>Install or update the achievement SQL supplied by the source workspace, verify the configured content and character databases, then reload this page. This editor never creates or alters emulator schema automatically.</p>
  </section>
</div>
