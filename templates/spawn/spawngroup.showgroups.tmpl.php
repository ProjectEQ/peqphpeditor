      <div class="table_container" style="width:250px;">
        <div class="table_header">
          Spawngroups for <?=$currzone?>
        </div>
        <div class="table_content">
<?if($results != ''):?>
<?foreach($results as $result): extract($result)?>
          <a href="index.php?editor=spawn&npcid=<?=$npcID?>&z=<?=$currzone?>&zoneid=<?=$currzoneid?>"><?=$name?> - (<?=$spawngroupID?>)</a><br>
<?endforeach;?>
<?endif;?>
<?if($results == ''):?>
          Your search produced no results!
<?endif;?>
        </div>
      </div>
