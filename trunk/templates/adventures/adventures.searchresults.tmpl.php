      <div class="table_container" style="width:250px;">
        <div class="table_header">
          NPCs with Adventures:
        </div>
        <div class="table_content">
<?if($results != ''):?>
<?foreach($results as $result): extract($result);?>
          <center><a href="index.php?editor=adventures&z=<?=get_zone_by_npcid($id)?>&zoneid=<?=get_zoneid_by_npcid($id)?>&npcid=<?=$id?>"><?=$name?> - (<?=get_zone_by_npcid($id)?>)</a><br></center>
<?endforeach;?>
<?endif;?>
<?if($results == ''):?>
          No NPCs have Adventures!
<?endif;?>
        </div>
      </div>