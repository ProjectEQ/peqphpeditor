<?if(isset($id) && ($id != 0)):?>
      <div class="table_container" style="width: 400px;">
        <div class="table_header">
          <div style="float:right">
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&action=1"><img src="images/c_table.gif" border="0" title="Edit Spellset"></a>&nbsp;
<? if(!$spellset):?>
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=9"><img src="images/create.gif" border="0" title="Change Spellset"></a>&nbsp;
            <a onClick="return confirm('Really Copy Spellset <?=$id?>?');" href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellsetid=<?=$id?>&action=16"><img src="images/last.gif" border="0" title="Copy Spellset"></a>&nbsp;
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=14" onClick="return confirm('Really unassign this NPC\'s spellset?')"><img src="images/minus2.gif" border="0" title="Unassign Spellset"></a>&nbsp;
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$id?>&action=17"><img src="images/upgrade.gif" border="0" title="Apply Spellset to Multiple NPCs"></a>&nbsp;
<?endif;?>
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$id?>&action=7" onClick="return confirm('Really delete this spellset? This will affect all NPCs that share this list!')"><img src="images/table.gif" border="0" title="Delete Spellset"></a>
          </div>
          Spellset: <?=$name?> (<?=$id?>)
        </div>
        <div class="table_content">
          <strong>Attack Proc:</strong> <? echo ($attack_proc != -1) ? "$proc_name ($attack_proc) [<a href=\"https://lucy.allakhazam.com/spell.html?source=Live&id=$attack_proc\" target=\"_blank\">Lucy</a>]" : "none";?><br>
<?if($attack_proc != -1):?>
          <strong>Proc Chance:</strong> <?=$proc_chance?>%<br>
<?endif;?>
          <br><strong>Parent List:</strong> <? echo ($parent_list != 0) ? "{$parent['name']} ({$parent['id']})" : "none";?><br>
        </div>
      </div>
<?endif;?>

<?if((isset($spells)) && ($spells != 0)):?>
      <br>
      <div class="table_container">
        <div class="table_header">
          <div style="float:right">
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&id=<?=$id?>&action=3">
              <img src="images/add.gif" border="0" title="Add a Spell">
            </a>
          </div>
          Spell List:
        </div>
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr bgcolor="#AAAAAA">
            <th width="28%" align="center">Spell</th>
            <th width="17%" align="center">Type</th>
            <th width="8%" align="center">Min<br>Level</th>
            <th width="8%" align="center">Max<br>Level</th>
            <th width="10%" align="center">Mana<br>Cost</th>
            <th width="10%" align="center">Recast<br>Delay</th>
            <th width="8%" align="center">Priority</th>
            <th width="5%" align="center">Flags</th>
            <th width="6%" align="center">&nbsp;</th>
          </tr>
<?$x=0; foreach($spells as $spell): extract($spell);?>
          <tr<?echo($x % 2 == 1) ? " bgcolor=\"#AAAAAA\"" : " bgcolor=\"#BBBBBB\"";?>>
            <td><?=$name?> [<a href="https://lucy.allakhazam.com/spell.html?source=Live&id=<?=$spellid?>" target="_blank">Lucy</a>]</td>
            <td align="center"><?=$spelltypes[$type]?></td>
            <td align="center"><?=$minlevel?></td>
            <td align="center"><?=$maxlevel?></td>
            <td align="center"><?echo ($manacost != -1) ? $manacost : "Default";?></td>
            <td align="center"><?echo ($recast_delay != -1) ? $recast_delay : "Default";?></td>
            <td align="center"><?=$priority?></td>
            <td align="center"><?echo ($min_expansion != -1 || $max_expansion != -1 || $content_flags != "" || $content_flags_disabled != "") ? "Yes" : "No";?></td>
            <td align="right">
              <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&id=<?=$id?>&action=6"><img src="images/edit2.gif" border="0" title="Edit Spell"></a>&nbsp;
              <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&id=<?=$id?>&action=5" onClick="return confirm('Really remove this spell from the spellset?');"><img src="images/remove3.gif" border="0" title="Remove Spell from Spellset"></a>
            </td>
          </tr>
<?$x++; endforeach;?>
        </table>
      </div>
<?endif;?>

<?if((isset($id)) &&  (!isset($spells) || ($spells == 0))):?>
      <br>
      <div class="table_container">
        <div class="table_header">
          <div style="float:right">
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$id?>&action=3">
              <img src="images/add.gif" border="0" title="Add a Spell">
            </a>
          </div>
          Spellset: <?=$name?> (<?=$id?>)
        </div>
        <div class="table_content">
          No spells currently assigned
        </div>
      </div>
<?endif;?>

<?if(isset($parent_list) && ($parent_list != 0)):?>
      <br>
      <div class="table_container">
        <div class="table_header">
          <div style="float:right">
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&id=<?=$parent['id']?>&action=3">
              <img src="images/add.gif" border="0" title="Add a Spell">
            </a>
          </div>
          Parent List: <?=$parent['name']?> (<?=$parent['id']?>)
        </div>
        <table width="100%" cellpadding="0" cellspacing="0">
<? if ($parent['spells']):?>
          <tr bgcolor="#AAAAAA">
            <th width="28%" align="center">Spell</th>
            <th width="17%" align="center">Type</th>
            <th width="8%" align="center">Min<br>Level</th>
            <th width="8%" align="center">Max<br>Level</th>
            <th width="10%" align="center">Mana<br>Cost</th>
            <th width="10%" align="center">Recast<br>Delay</th>
            <th width="8%" align="center">Priority</th>
            <th width="5%" align="center">Flags</th>
            <th width="6%" align="center">&nbsp;</th>
          </tr>
<?$x=0; foreach($parent['spells'] as $spell): extract($spell);?>
          <tr<?echo($x % 2 == 1) ? " bgcolor=\"#AAAAAA\"" : " bgcolor=\"#BBBBBB\"";?>>
            <td><?=$name?> [<a href="https://lucy.allakhazam.com/spell.html?source=Live&id=<?=$spellid?>" target="_blank">Lucy</a>]</td>
            <td align="center"><?=$spelltypes[$type]?></td>
            <td align="center"><?=$minlevel?></td>
            <td align="center"><?=$maxlevel?></td>
            <td align="center"><?echo ($manacost != -1) ? $manacost : "Default";?></td>
            <td align="center"><?echo ($recast_delay != -1) ? $recast_delay : "Default";?></td>
            <td align="center"><?=$priority?></td>
            <td align="center"><?echo ($min_expansion != -1 || $max_expansion != -1 || $content_flags != "" || $content_flags_disabled != "") ? "Yes" : "No";?></td>
            <td align="right">
              <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&id=<?=$id?>&action=6"><img src="images/edit2.gif" border="0" title="Edit Spell"></a>&nbsp;
              <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&id=<?=$id?>&action=5" onClick="return confirm('Really remove this spell from the spellset?');"><img src="images/remove3.gif" border="0" title="Remove Spell from Spellset"></a>
            </td>
          </tr>
<?$x++; endforeach;?>
<? endif;?>
<? if (!isset($parent['spells'])):?>
          <tr>
            <td colspan="9">No spells currently assigned</td>
          </tr>
<? endif;?>
        </table>
      </div>
<?endif;?>
<?if(!isset($id)):?>
      <div class="table_container" style="width: 350px;">
        <div class="table_header">
          No assigned spellset
        </div>
        <div class="table_content">
          <center>
            No spellset currently assigned.<br><br>
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=9">Click to change</a>
          </center>
        </div>
      </div>
<?endif;?>
