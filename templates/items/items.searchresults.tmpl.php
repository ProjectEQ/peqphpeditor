      <div class="table_container" style="width:450px;">
        <div class="table_header">
          Item Search Results
        </div>
        <div class="table_content">
<?php if (isset($error)): ?>
          <?=htmlspecialchars($error, ENT_QUOTES, 'UTF-8')?>
<?php endif; ?>
<?php if (!empty($results_truncated)): ?>
          <p>Showing the first 500 matches. Narrow your search by item name or ID to see the remaining matches.</p>
<?php endif; ?>
<?if(!empty($results)):?>
<?foreach($results as $result): extract($result);?>
          <a href="index.php?editor=items&id=<?=$id?>&action=2"><?=$id?> - <?=htmlspecialchars($name, ENT_QUOTES, 'UTF-8')?></a><?php if (array_key_exists('kinbound', $result)): ?> <span style="font-size: 11px;">[<?=item_kinbound_label($result['kinbound'])?>]</span><?php endif; ?><br>
<?endforeach;?>
<?endif;?>
<?if(empty($results) && !isset($error)):?>
          Your search produced no results!
<?endif;?>
        </div>
      </div>
