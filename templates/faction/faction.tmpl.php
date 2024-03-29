  <center>
    <table style="border: 1px solid black; background-color: #CCC;">
      <tr><td colspan="3"><b>Legend:</b></td></tr>
      <tr><td align="right">1100 and Above</td><td>&nbsp;</td><td align="left">Ally</td></tr>
      <tr><td align="right">750 to 1099</td><td>&nbsp;</td><td align="left">Warmly</td></tr>
      <tr><td align="right">500 to 749</td><td>&nbsp;</td><td align="left">Kindly</td></tr>
      <tr><td align="right">100 to 499</td><td>&nbsp;</td><td align="left">Amiable</td></tr>
      <tr><td align="right">0 to 99</td><td>&nbsp;</td><td align="left">Indifferent</td></tr>
      <tr><td align="right">-100 to -1</td><td>&nbsp;</td><td align="left">Apprehensive</td></tr>
      <tr><td align="right">-500 to -101</td><td>&nbsp;</td><td align="left">Dubious</td></tr>
      <tr><td align="right">-750 to -501</td><td>&nbsp;</td><td align="left">Threatening</td></tr>
      <tr><td align="right">-751 and Below</td><td>&nbsp;</td><td align="left">Scowls</td></tr>
    </table><br><br>
  </center>
  <div style="border: 1px solid black; width: 500px; margin: auto;">
    <div class="edit_form_header" style="height: 16px; line-height: 16px;">
      <div style="float: right;">
	    <a href="index.php?editor=faction&fid=<?=$faction_info['id']?>&action=16"><img src="images/view_all.gif" title="Search for NPCs using this faction" border="0"></a>&nbsp;
        <a href="index.php?editor=faction&fid=<?=$faction_info['id']?>&action=1"><img src="images/c_table.gif" title="Edit this Faction" border="0"></a>&nbsp;
        <a onClick="return confirm('Really delete faction <?=$faction_info['id']?>? This will also remove all faction mods.');" href="index.php?editor=faction&fid=<?=$faction_info['id']?>&action=6"><img src="images/remove3.gif" title="Delete this Faction" border="0"></a>
      </div>
      Faction Data for <?=$faction_info['name']?> (<?=$faction_info['id']?>)
    </div>
    <div class="edit_form_content">
      <fieldset style="width: 450px; margin: auto;">
        <legend><strong>Faction Info</strong></legend>
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td width="30%" align="left"><strong>ID</strong><br><?=$faction_info['id']?></td>
            <td width="60%" align="left" colspan="2"><strong>Name</strong><br><?=$faction_info['name']?></td>
            <td width="10%" align="left">&nbsp;</td>
          </tr>
          <tr>
            <td width="30%" align="left"><strong>Min</strong><br><?echo (isset($faction_base) && $faction_base['min'] != "") ? $faction_base['min'] : "N/A";?></td>
            <td width="30%" align="left"><strong>Max</strong><br><?echo (isset($faction_base) && $faction_base['max'] != "") ? $faction_base['max'] : "N/A";?></td>
            <td width="30%" align="left"><strong>Base</strong><br><?=$faction_info['base']?></td>
            <td width="10%" align="left">&nbsp;</td>
          </tr>
          <tr>
            <td width="30%" align="left"><strong>Hero1</strong><br><?echo (isset($faction_base) && $faction_base['unk_hero1'] != "") ? $faction_base['unk_hero1'] : "N/A";?></td>
            <td width="30%" align="left"><strong>Hero2</strong><br><?echo (isset($faction_base) && $faction_base['unk_hero2'] != "") ? $faction_base['unk_hero2'] : "N/A";?></td>
            <td width="30%" align="left"><strong>Hero3</strong><br><?echo (isset($faction_base) && $faction_base['unk_hero3'] != "") ? $faction_base['unk_hero3'] : "N/A";?></td>
            <td width="10%" align="left">&nbsp;</td>
          </tr>
        </table>
      </fieldset>
      <fieldset style="width: 450px; margin: auto;">
        <legend><strong>Faction Mods</strong></legend>
<?
  if (isset($faction_mods)) {
?>
        <table width="100%">
          <tr>
            <td width="10%" align="center"><strong>Type</strong></td>
            <td width="40%" align="center"><strong>Name</strong></td>
            <td width="20%" align="center"><strong>Mod</strong></td>
            <td width="20%" align="center"><strong>Effective<br>Faction</strong></td>
            <td width="10%" align="right"><a href="index.php?editor=faction&fid=<?=$faction_info['id']?>&action=20"><img src="images/add.gif" border="0" title="Create a new faction mod"></a><br></th>
          </tr>
<?
    foreach ($faction_mods as $mod) {
      $mod_type = deconstruct_mod($mod['mod_name']);
?>
          <tr>
            <td width="10%" align="center"><?=$mod_type['category']?></td>
            <td width="40%" align="center"><?=$mod_type['name']?></td>
            <td width="20%" align="center"><?=$mod['mod']?></td>
            <td width="20%" align="center"><?echo $faction_info['base'] + $mod['mod'];?></td>
            <td width="10%" align="right"><a href="index.php?editor=faction&fid=<?=$faction_info['id']?>&fmid=<?=$mod['id']?>&action=22"><img src="images/c_table.gif" title="Edit this Faction Mod" border="0"></a>&nbsp;<a onClick="return confirm('Really delete faction mod <?=$mod['id']?>?');" href="index.php?editor=faction&fid=<?=$faction_info['id']?>&fmid=<?=$mod['id']?>&action=24"><img src="images/remove3.gif" title="Delete this Faction Mod" border="0"></a></td>
          </tr>
<?
    }
?>
        </table>
<?
  }
  else {
?>
        <table width="100%">
          <tr>
            <td width="90%" align="left">No faction mods</td>
            <td width="10%" align="right"><a href="index.php?editor=faction&fid=<?=$faction_info['id']?>&action=20"><img src="images/add.gif" border="0" title="Create a new faction mod"></a></td>
          </tr>
        </table>
<?
  }
?>
      </fieldset>
    </div>
  </div>
