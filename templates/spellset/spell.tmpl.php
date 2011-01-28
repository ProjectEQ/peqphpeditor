<?if(isset($id) && ($id != 0)):?>
      <div class="table_container" style="width: 350px;">
        <div class="table_header">
          <div style="float:right">
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&action=1">
              <img src="images/c_table.gif" border="0" title="Edit Spellset">
            </a>
<? if(!$spellset):?>
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=9">
              <img src="images/create.gif" border="0" title="Change Spellset">
            </a>
           <a onClick="return confirm('Really Copy Spellset <?=$id?>?');" href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellsetid=<?=$id?>&action=16"><img src="images/last.gif" border="0" title="Copy Spellset"></a>&nbsp;
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=14" onClick="return confirm('Really unassign this NPC\'s spellset?')">
              <img src="images/minus2.gif" border="0" title="Unassign Spellset">
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$id?>&action=17"><img src="images/upgrade.gif" border="0" title="Apply Spellset to Multiple NPCs"></a>&nbsp;
            </a>
<?endif;?>
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$id?>&action=7" onClick="return confirm('Really delete this spellset? This will affect all NPCs that share this list!')">
              <img src="images/table.gif" border="0" title="Delete Spellset">
            </a>
          </div>
          Spellset: <?=$name?> (<?=$id?>)
        </div>
        <div class="table_content">
          <strong>Attack Proc:</strong> <? echo ($attack_proc != -1) ? "$proc_name ($attack_proc) [<a href=\"http://lucy.allakhazam.com/spell.html?source=Live&id=$attack_proc\">Lucy</a>]" : "none";?><br>
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
          Spellset: <?=$name?> (<?=$id?>)
        </div>
        <div class="table_content">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr bgcolor="#BBBBBB">
              <th width="35%">Spell</th>
              <th width="9%" align="center">Type</th>
              <th width="9%" align="center">minlevel</th>
              <th width="9%" align="center">maxlevel</th>
              <th width="9%" align="center">manacost</th>
              <th width="10%" align="center">recast delay</th>
              <th width="9%" align="center">priority</th>
              <th width="10%" align="center"></th>
            </tr>
<?$x=0; foreach($spells as $spell): extract($spell);?>
            <tr<?echo($x % 2 == 1) ? " bgcolor=\"#BBBBBB\"" : "";?>>
              <td><?=$name?> (<?=$spellid?>) [<a href="http://lucy.allakhazam.com/spell.html?source=Live&id=<?=$spellid?>">Lucy</a>]</td>
              <td align="center"><?=$spelltypes[$type]?></td>
              <td align="center"><?=$minlevel?></td>
              <td align="center"><?=$maxlevel?></td>
              <td align="center"><?echo ($manacost != -1) ? $manacost : "Default";?></td>
              <td align="center"><?echo ($recast_delay != -1) ? $recast_delay : "Default";?></td>
              <td align="center"><?=$priority?></td>
              <td align="right">
                <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&id=<?=$id?>&action=6">
                  <img src="images/edit2.gif" border="0" title="Edit Spell">
                </a>&nbsp;
                <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&id=<?=$id?>&action=5" onClick="return confirm('Really remove this spell from the spellset?');">
                  <img src="images/remove3.gif" border="0" title="Remove Spell from Spellset">
                </a>
              </td>
            </tr>
<?$x++; endforeach;?>
          </table>
        </div>
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
        <div class="table_content">
          <table width="100%" cellpadding="0" cellspacing="0">
<? if ($parent['spells']):?>
            <tr bgcolor="#BBBBBB">
              <th width="35%">Spell</th>
              <th width="9%" align="center">Type</th>
              <th width="9%" align="center">minlevel</th>
              <th width="9%" align="center">maxlevel</th>
              <th width="9%" align="center">manacost</th>
              <th width="10%" align="center">recast delay</th>
              <th width="9%" align="center">priority</th>
              <th width="10%" align="center"></th>
            </tr>
<?$x=0; foreach($parent['spells'] as $spell): extract($spell);?>
            <tr<?echo($x % 2 == 1) ? " bgcolor=\"#BBBBBB\"" : "";?>>
              <td><?=$name?> (<?=$spellid?>) [<a href="http://lucy.allakhazam.com/spell.html?source=Live&id=<?=$spellid?>">Lucy</a>]</td>
              <td align="center"><?=$spelltypes[$type]?></td>
              <td align="center"><?=$minlevel?></td>
              <td align="center"><?=$maxlevel?></td>
              <td align="center"><?echo ($manacost != -1) ? $manacost : "Default";?></td>
              <td align="center"><?echo ($recast_delay != -1) ? $recast_delay : "Default";?></td>
              <td align="center"><?=$priority?></td>
              <td align="right">
                <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&id=<?=$id?>&action=6">
                  <img src="images/edit2.gif" border="0" title="Edit Spell">
                </a>&nbsp;
                <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&id=<?=$id?>&action=5" onClick="return confirm('Really remove this spell from the spellset?');">
                  <img src="images/remove3.gif" border="0" title="Remove Spell from Spellset">
                </a>
              </td>
            </tr>
<?$x++; endforeach;?>
<? endif;?>
<? if (!isset($parent['spells'])):?>
            <tr>
              <td colspan="8">
                No spells currently assigned
              </td>
            </tr>
<? endif;?>
          </table>
        </div>
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
