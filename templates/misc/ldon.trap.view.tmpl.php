  <div class="table_container" style="width: 250px;">
    <div class="table_header">
      <div style="float:right">
        <a href="index.php?editor=misc&id=<?=$template['id']?>&action=67"><img src="images/edit2.gif" border="0" title="Edit Template"></a>          
        <a href="index.php?editor=misc&id=<?=$template['id']?>&action=69"onClick="return confirm('Really delete template and all associated traps?');" ><img src="images/remove3.gif" border="0" title="Delete this template"></a>
      </div>
      Template Data
    </div>
    <div class="table_content">
      <strong>ID:</strong> <?=$template['id']?><br>
      <strong>Type:</strong> <?=$template['type']?><br>
      <strong>Spell:</strong> <?=getSpellName($template['spell_id'])?> (<?=$template['spell_id']?>)<br>
      <strong>Skill:</strong> <?=$template['skill']?><br>
      <strong>Locked?:</strong> <?=$yesno[$template['locked']]?> (<?=$template['locked']?>)
    </div>
  </div><br><br>
  <div class="table_container" style="width: 200px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Traps</td>
          <td align="right">    
            <a href="index.php?editor=misc&template_id=<?=$template['id']?>&action=71"><img src="images/add.gif" border="0" title="Add a trap"></a>
          </td>
        </tr>        
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if(isset($traps)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td width="10%"></td>
      </tr>
<?$x=0; foreach($traps as $trap):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="90%"><?=$trap['id']?></td>
        <td align="right" width="10%">      
          <a href="index.php?editor=misc&id=<?=$trap['id']?>&template_id=<?=$template['id']?>&action=73"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
        </td>
      </tr>
<?$x++;endforeach;?>
<?else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No LDoN Traps</td>
      </tr>
<?endif;?>
    </table>
  </div>
