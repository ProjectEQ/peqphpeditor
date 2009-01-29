    <div class="table_container" style="width:250px;">
        <div class="table_header">
          Misc Search Results
        </div>
        <div class="table_content">
<?if($fishing != ''):?>
<?foreach($fishing as $fishing): extract($fishing);?>
          <a href="index.php?editor=misc&fsid=<?=$fsid?>&action=26"><?=get_item_name($fiid)?></a><br>
<?endforeach;?>
<?endif;?>
<?if($forage != ''):?>
<?foreach($forage as $forage): extract($forage);?>
          <a href="index.php?editor=misc&fgid=<?=$fgid?>&action=27"><?=get_item_name($fgiid)?></a><br>
<?endforeach;?>
<?endif;?>
<?if($gspawn != ''):?>
<?foreach($gspawn as $gspawn): extract($gspawn);?>
          <a href="index.php?editor=misc&gsid=<?=$gsid?>&action=28"><?=get_item_name($giid)?></a><br>
<?endforeach;?>
<?endif;?>
<?if($fishing == '' && $forage == '' && $gspawn == ''):?>
          Your search produced no results!
<?endif;?>
        </div>
      </div>