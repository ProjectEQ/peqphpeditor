  <div class="table_container" style="width:350px;">
    <div class="table_header">
      NPCs assigned to grid
    </div>
    <div class="table_content">
<?if($grid_npcs != ''):?>
<?foreach($grid_npcs as $grid_npc): extract($grid_npc);?>
      <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>"><?=$name?> (<?=$spawngroupid?>) - <?=getNPCName($npcid)?></a><br>
<?endforeach;?>
<?endif;?>
<?if($grid_npcs == ''):?>
      Your search produced no results!
<?endif;?>
    </div>
  </div>
