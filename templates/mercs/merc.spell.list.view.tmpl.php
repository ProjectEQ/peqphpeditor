  <div class="table_container" style="width: 250px;">
    <div class="table_header">
      <div style="float:right">
        <a href="index.php?editor=mercs&merc_spell_list_id=<?=$list['merc_spell_list_id']?>&action=41"><img src="images/edit2.gif" border="0" title="Edit Spell List"></a>          
        <a onClick="return confirm('Really delete spell list and all associated spells?');" href="index.php?editor=mercs&merc_spell_list_id=<?=$list['merc_spell_list_id']?>&action=43"><img src="images/remove3.gif" border="0" title="Delete this list"></a>
      </div>
      Spell List Data
    </div>
    <div class="table_content">
      <strong>ID:</strong> <?=$list['merc_spell_list_id']?><br>
      <strong>Class:</strong> <?=$classes[$list['class_id']]?> (<?=$list['class_id']?>)<br>
      <strong>Proficiency:</strong> <?=$list['proficiency_id']?><br>
      <strong>Name:</strong> <?=$list['name']?>
    </div>
  </div><br><br>
  <div class="table_container" style="width: 650px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Spells</td>
          <td align="right">    
            <a href="index.php?editor=mercs&merc_spell_list_id=<?=$list['merc_spell_list_id']?>&action=44"><img src="images/add.gif" border="0" title="Add a spell"></a>
          </td>
        </tr>        
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if(isset($spells)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="40%"><strong>Spell</strong></td>
        <td align="center" width="20%"><strong>Type</strong></td>
        <td align="center" width="10%"><strong>Min Level</strong></td>
        <td align="center" width="10%"><strong>Max Level</strong></td>
        <td width="10%"></td>
      </tr>
<?$x=0; foreach($spells as $spell):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$spell['merc_spell_list_entry_id']?></td>
        <td align="center" width="40%"><?=getSpellName($spell['spell_id'])?> (<?=$spell['spell_id']?>)</td>
        <td align="center" width="20%"><?echo ($spell['spell_type'] != 0) ? $spelltypes[$spell['spell_type']] : "Never";?> (<?=$spell['spell_type']?>)</td>
        <td align="center" width="10%"><?=$spell['minlevel']?></td>
        <td align="center" width="10%"><?=$spell['maxlevel']?></td>
        <td align="right">      
          <a href="index.php?editor=mercs&merc_spell_list_entry_id=<?=$spell['merc_spell_list_entry_id']?>&action=46"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
          <a onClick="return confirm('Really delete this spell?');" href="index.php?editor=mercs&merc_spell_list_id=<?=$spell['merc_spell_list_id']?>&merc_spell_list_entry_id=<?=$spell['merc_spell_list_entry_id']?>&action=48"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
        </td>
      </tr>
<?$x++;endforeach;?>
<?else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary Spells</td>
      </tr>
<?endif;?>
    </table>
  </div>
