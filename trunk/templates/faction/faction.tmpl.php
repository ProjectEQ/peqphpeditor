  <center>
    <table style="border: 1px solid black; background-color: #CCC;">
      <tr><td colspan="3"><b>Legend:</b></td></tr>
      <tr><td align="right">1101 and Above</td><td>&nbsp;</td><td align="left">Ally</td></tr>
      <tr><td align="right">701 to 1100</td><td>&nbsp;</td><td align="left">Warmly</td></tr>
      <tr><td align="right">401 to 700</td><td>&nbsp;</td><td align="left">Kindly</td></tr>
      <tr><td align="right">101 to 400</td><td>&nbsp;</td><td align="left">Amiably</td></tr>
      <tr><td align="right">0 to 100</td><td>&nbsp;</td><td align="left">Indifferently</td></tr>
      <tr><td align="right">-100 to -1</td><td>&nbsp;</td><td align="left">Apprehensively</td></tr>
      <tr><td align="right">-700 to -101</td><td>&nbsp;</td><td align="left">Dubiously</td></tr>
      <tr><td align="right">-999 to -701</td><td>&nbsp;</td><td align="left">Threateningly</td></tr>
      <tr><td align="right">-1000 and Below</td><td>&nbsp;</td><td align="left">Ready to attack</td></tr>
    </table><br/><br/>
  </center>
  <div style="border: 1px solid black; width: 500px; margin: auto;">
    <div class="edit_form_header" style="height: 16px; line-height: 16px;">
      <div style="float: right;">
	    <a href="index.php?editor=faction&fid=<?=$faction_info['id']?>&action=16"><img src="images/view_all.gif" title="Search for NPCs using this faction" border="0" /></a>
      </div>
      Faction Data for <?=$faction_info['name']?> (<?=$faction_info['id']?>)
    </div>
    <div class="edit_form_content">
      <fieldset style="width: 450px; margin: auto;">
        <legend><strong>Faction Info</strong></legend>
        <table width="100%">
          <tr>
            <th width="15%">ID</th>
            <th width="60%">Name</th>
            <th width="15%">Base</th>
            <th width="10%">&nbsp;</th>
          </tr>
          <tr>
            <td width="15%" align="center"><?=$faction_info['id']?></td>
            <td width="60%" align="center"><?=$faction_info['name']?></td>
            <td width="15%" align="center"><?=$faction_info['base']?></td>
            <td width="10%" align="right"><a href="index.php?editor=faction&fid=<?=$faction_info['id']?>&action=1"><img src="images/c_table.gif" title="Edit this Faction" border="0"></a>&nbsp;<a onClick="return confirm('Really delete faction <?=$faction_info['id']?>? This will also remove all faction mods.');" href="index.php?editor=faction&fid=<?=$faction_info['id']?>&action=6"><img src="images/remove3.gif" title="Delete this Faction" border="0"></a></td>
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
            <th width="15%">ID</th>
            <th width="15%">Type</th>
            <th width="30%">Name</th>
            <th width="15%">Mod</th>
            <th width="15%">Effective<br/>Faction</th>
            <th width="10%"><a href="index.php?editor=faction&fid=<?=$faction_info['id']?>&action=20"><img src="images/add.gif" border="0" title="Create a new faction mod" /></a><br/></th>
          </tr>
<?
    foreach ($faction_mods as $mod) {
      $mod_type = deconstruct_mod($mod['mod_name']);
?>
          <tr>
            <td width="15%" align="center"><?=$mod['id']?></td>
            <td width="15%" align="center"><?=$mod_type['category']?></td>
            <td width="30%" align="center"><?=$mod_type['name']?></td>
            <td width="15%" align="center"><?=$mod['mod']?></td>
            <td width="15%" align="center"><?echo $faction_info['base'] + $mod['mod'];?></td>
            <td width="10%" align="center"><a href="index.php?editor=faction&fid=<?=$faction_info['id']?>&fmid=<?=$mod['id']?>&action=22"><img src="images/c_table.gif" title="Edit this Faction Mod" border="0"></a>&nbsp;<a onClick="return confirm('Really delete faction mod <?=$mod['id']?>?');" href="index.php?editor=faction&fid=<?=$faction_info['id']?>&fmid=<?=$mod['id']?>&action=24"><img src="images/remove3.gif" title="Delete this Faction Mod" border="0"></a></td>
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
            <td width="10%" align="right"><a href="index.php?editor=faction&fid=<?=$faction_info['id']?>&action=20"><img src="images/add.gif" border="0" title="Create a new faction mod" /></a></td>
          </tr>
        </table>
<?
  }
?>
      </fieldset>
    </div>
  </div>
