      <div class="table_container" style="width:400px;">
        <div class="table_header">
          NPC Search Results
        </div>
        <div class="table_content">
<?if($npcpri != ''):?>
  	<?foreach($npcpri as $npcpri): extract($npcpri);?>
		<a href="index.php?editor=npc&npcid=<?=$npcid?>&z=<?=get_zone_by_npcid($npcid)?>&zoneid=<?=get_zoneid_by_npcid($npcid)?>"><?=$npcname?> - (<?=get_zone_by_npcid($npcid)?>) -- ((<?=$faction_value[$factionvalue]?>))</a><br>
 	<?endforeach;?>
<?endif;?>

<?if ($npcpri == ''):?>
       No NPCs are assigned to this faction.
<?endif;?>
</div>
      </div>