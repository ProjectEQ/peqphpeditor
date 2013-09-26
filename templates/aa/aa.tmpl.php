<?
function getExpansionName($expid) {
  global $eqexpansions, $aa_sof_expansion;
  if (!isset($expid)) return "";
  if ($expid < 0) return "$expid"; // Avoid hitting the 'None Selected'
  if (isset($aa_sof_expansion[$expid])) return $aa_sof_expansion[$expid]; // Drakkin
  if (isset($eqexpansions[$expid+1])) return $eqexpansions[$expid+1];
  return "$expid";
}

function getClasses($classes, $berserker) {
  if ($berserker == 0 && $classes == 0) {
    return "None";
  }
  if ($berserker == 1 && $classes == 65534) 
    return "ALL";
  else {
    $res = '';
    if ($berserker == 1)  $res .= "BER ";
    if ($classes &   256) $res .= "BRD ";
    if ($classes & 32768) $res .= "BST ";
    if ($classes &     4) $res .= "CLR ";
    if ($classes &    64) $res .= "DRU ";
    if ($classes & 16384) $res .= "ENC ";
    if ($classes &  8192) $res .= "MAG ";
    if ($classes &   128) $res .= "MNK ";
    if ($classes &  2048) $res .= "NEC ";
    if ($classes &     8) $res .= "PAL ";
    if ($classes &    16) $res .= "RNG ";
    if ($classes &   512) $res .= "ROG ";
    if ($classes &    32) $res .= "SHD ";
    if ($classes &  1024) $res .= "SHM ";
    if ($classes &     2) $res .= "WAR ";
    if ($classes &  4096) $res .= "WIZ ";
    $res = rtrim($res, " ");
    return $res;
  }
}
?>
<script>
  function showSearch() {
    document.getElementById("searchframe").style.display = "block";
    document.getElementById("button").style.display = "block";
  }

  function hideSearch() {
    document.getElementById("searchframe").style.display = "none";
    document.getElementById("button").style.display = "none";
  }

</script>
<center>
  <iframe id="searchframe" src='templates/iframes/aasearch.php'></iframe>
  <input id="button" type="button" value='Hide AA Search' onclick="hideSearch();" style='display:none; margin-bottom:20px;'>
</center>
<div class="table_container">
  <div class="table_header">
    <?=$aa_vars['skill_id']?> - <?=$aa_vars['name']?>
    <div style="float:right">
      <a href="index.php?editor=aa&action=3"><img src="images/add.gif" border="0" title="Create a new AA"></a>
      <a href="index.php?editor=aa&aaid=<?=$aa_vars['skill_id']?>&action=2"><img src="images/edit.gif" border="0" title="Edit this AA"></a>
      <a href="index.php?editor=aa&aaid=<?=$aa_vars['skill_id']?>&action=22" onclick="return confirm('Really delete <?=addslashes($aa_vars['name'])?>?');"><img src="images/remove.gif" border="0" title="Remove the AA completely"></a>
    </div>
  </div>
  <div class="table_content">
    <table cellspacing="0" border="0" width="100%">
      <tr>
        <td width="100%">
          <table cellspacing="0" border="0" width="100%">
            <tr>
              <td>
                <fieldset>
                  <legend><b>AA Variables</b></legend>
<? if($aaref) {?>
	<div style="text-align:right;">
Reference: <a href="index.php?editor=aa&aaid=<?=$aaref?>" target="_blank"><? echo "$aaref - $aarefname";?></a>
<img src="images/minus2.gif" onclick="document.aa_list_insert.aa_add.value=<?=$aaref?>" title="Set as what to be inserted"><br />
</div>
<? } ?>
	          <div class="table_container">
	            <div class="table_header">
	              <table width="100%" cellpadding="0" cellspacing="0">
	                <tr>
                          <td>SoF AA Group<td>
                          <td align="right">
                            <form name="aa_list_insert" method="post" action="index.php?editor=aa&aaid=<?=$aaid?>&action=24">
                              <a href="index.php?editor=aa&aaid=<?=$aaid?>&action=27" onclick="return confirm('Fix the offset and max fields for all AAs in this SoF AA Group?');" title="Fixes the Offset and Max entries. Only works if there are no group problems.">Fix Offset/Max</a>&nbsp;
                              <select name="movetype" style="font-size:9px;">
                                <option value="2">Move</option>
                                <option value="1" selected>Add</option>
                              </select>
                              <input type="text" id="searchtarget" name="aa_add" size="5" style="font-size:9px;" value='What' onfocus="if (this.value=='What') this.value='';" onblur="if (this.value=='') this.value='What';">
                              <img src="images/create.gif" title="Show the AA Search" onclick="showSearch();">
                              <select name="before" style="font-size:9px;">
                                <option value="2">Before</option>
                                <option value="1" selected>After</option>
                              </select>
                              <input type="text" name="aa_anchor" size="5" style="font-size:9px;" value='<?=$aa_vars['skill_id']?>' onfocus="if (this.value=='Where') this.value='';" onblur="if (this.value=='') this.value='Where';">
                              <input type="submit" style="font-size:9px;" value="Go">
                            </form>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <table class="table_content2" width="100%">
                      <tr>
                        <th width="2%"></th>
                        <th align="center" width="7%">ID</th>
                        <th align="center" width="7%">Seq</th>
                        <th align="center" width="29%">Name</th>
                        <th align="center" width="5%">Lvl</th>
                        <th align="center" width="4%">Rks</th>
                        <th align="center" width="4%">Off</th>
                        <th align="center" width="4%">Max</th>
                        <th align="center" width="4%">Tab</th>
                        <th align="center" width="16%">Expansion</th>
                        <th align="center" width="7%">Next ID</th>
                        <th width="7%"></th>
                      </tr>
                      <? $x=0;
                      $ranksum = 0;
                      if($aa_prev) {
                        $prevcount = count($aa_prev);
                        for ($i = $prevcount-1; $i >= 0; $i--) {
                          $prev_row = $aa_prev[$i];
                          $count = count($prev_row);
                          foreach($prev_row as $prev_sub) {
                      ?>
                      <tr bgcolor="#<? echo ($x % 2 == 0) ? "CCCCCC" : "AAAAAA";?>">
                        <td>&nbsp;</td>
                        <td align="center"><a href="index.php?editor=aa&aaid=<?=$prev_sub['skill_id']?>"><?=$prev_sub['skill_id']?></a></td>
                        <td></td>
                        <td><a href="index.php?editor=aa&aaid=<?=$prev_sub['skill_id']?>"><?=$prev_sub['name']?></a></td>
                        <td align="center"><?=$prev_sub['class_type']?></td>
                        <td align="center"><?=$prev_sub['max_level']?></td>
                        <td align="center"><?=$prev_sub['sof_current_level']?></td>
                        <td align="center"><?=$prev_sub['sof_max_level']?></td>
                        <td align="center"><?=$prev_sub['sof_type']?></td>
                        <td align="center"><?=getExpansionName($prev_sub['aa_expansion'])?></td>
                        <td align="center"><? if($count > 1) echo "<font color='red'><b>";?><?=$prev_sub['sof_next_id']?><?if($count > 1) echo "</b></font>";?></td>
                        <td align="right"><a href="index.php?editor=aa&aaid=<?=$aaid?>&aaref=<?=$prev_sub['skill_id']?>&action=25"><img src="images/minus.gif" border="0" title="Set Next ID to 0 for this AA"></a><a href="index.php?editor=aa&aaid=<?=$aaid?>&aaref=<?=$prev_sub['skill_id']?>&action=26" onclick="return confirm('Really remove <?=addslashes($prev_sub['name'])?> (<?=$prev_sub['skill_id']?>) from the SoF AA Group?');"><img src="images/minus2.gif" border="0" title="Remove this AA from the Group"></a><img src="images/add.gif" border="0" title="Set as where to insert" onclick="document.aa_list_insert.aa_anchor.value=<?=$prev_sub['skill_id']?>"></td>
                      </tr>
                      <?
                          $ranksum += $prev_sub['max_level'];
                          } // end foreach (row)
                          $x++;
                        } // end for(prev)
                      } // end if
                      ?>
                      <tr bgcolor="#FFFFFF">
                        <td>&gt;</td>
                        <td align="center"><?=$aa_vars['skill_id']?></td>
                        <td></td>
                        <td><?=$aa_vars['name']?></td>
                        <td align="center"><?=$aa_vars['class_type']?></td>
                        <td align="center"><?=$aa_vars['max_level']?></td>
                        <td align="center"><?=$aa_vars['sof_current_level']?></td>
                        <td align="center"><?=$aa_vars['sof_max_level']?></td>
                        <td align="center"><?=$aa_vars['sof_type']?></td>
                        <td align="center"><?=getExpansionName($aa_vars['aa_expansion'])?></td>
                        <td align="center"><?=$aa_vars['sof_next_id']?></td>
                        <td align="right"><a href="index.php?editor=aa&aaid=<?=$aaid?>&aaref=<?=$aa_vars['skill_id']?>&action=25"><img src="images/minus.gif" border="0" title="Set Next ID to 0 for this AA"></a><a href="index.php?editor=aa&aaid=<?=$aaid?>&aaref=<?=$aa_vars['skill_id']?>&action=26" onclick="return confirm('Really remove <?=addslashes($aa_vars['name'])?> (<?=$aa_vars['skill_id']?>) from the SoF AA Group?');"><img src="images/minus2.gif" border="0" title="Remove this AA from the Group"></a><img src="images/add.gif" border="0" title="Set as where to insert" onclick="document.aa_list_insert.aa_anchor.value=<?=$aa_vars['skill_id']?>"></td>
                      </tr>
                      <? $x++;
                      $ranksum += $aa_vars['max_level'];
                      if($aa_next) {
                        foreach($aa_next as $next_row) {
                      ?>
                      <tr bgcolor="#<? echo ($x % 2 == 0) ? "CCCCCC" : "AAAAAA";?>">
                        <td>&nbsp;</td>
                        <td align="center"><a href="index.php?editor=aa&aaid=<?=$next_row['skill_id']?>"><?=$next_row['skill_id']?></a></td>
                        <td></td>
                        <td><a href="index.php?editor=aa&aaid=<?=$next_row['skill_id']?>"><?=$next_row['name']?></a></td>
                        <td align="center"><?=$next_row['class_type']?></td>
                        <td align="center"><?=$next_row['max_level']?></td>
                        <td align="center"><?=$next_row['sof_current_level']?></td>
                        <td align="center"><?=$next_row['sof_max_level']?></td>
                        <td align="center"><?=$next_row['sof_type']?></td>
                        <td align="center"><?=getExpansionName($next_row['aa_expansion'])?></td>
                        <td align="center"><?=$next_row['sof_next_id']?></td>
                        <td align="right"><? if (isset($next_row['aa_expansion'])) { ?><a href="index.php?editor=aa&aaid=<?=$aaid?>&aaref=<?=$next_row['skill_id']?>&action=25"><img src="images/minus.gif" border="0" title="Set Next ID to 0 for this AA"></a><a href="index.php?editor=aa&aaid=<?=$aaid?>&aaref=<?=$next_row['skill_id']?>&action=26" onclick="return confirm('Really remove <?=addslashes($next_row['name'])?> (<?=$next_row['skill_id']?>) from the SoF AA Group?');"><img src="images/minus2.gif" border="0" title="Remove this AA from the Group"></a><img src="images/add.gif" border="0" title="Set as where to insert" onclick="document.aa_list_insert.aa_anchor.value=<?=$next_row['skill_id']?>"><? } ?></td>
                      </tr>
                      <?
                          $x++;
                          $ranksum += $next_row['max_level'];
                        } // end foreach (next)
                      } // end if (aa_next)
                      if ($aa_prev || $aa_next) {
                      ?>
                      <tr bgcolor="#FFFFFF">
                        <td colspan="5" align="right">Ranks Sum:</td>
                        <td align="center"><?=$ranksum?></td>
                        <td colspan="6">&nbsp;</td>
                      </tr>
                      <?
                      } // end if
                      ?>
                    </table>
                  </div>
                <br />
                Prerequisite AA: <? if($aa_vars['prereq_skill'] != 0 && $aa_vars['prereq_skill'] != 4294967295) echo "{$aa_vars['prereq_skill']} - (<a href=\"index.php?editor=aa&aaid={$aa_vars['prereq_skill']}\">". ((isset($prereq_name) && $prereq_name != null)?$prereq_name['name'] : "<span style=\"color:red;\"><b>Not Found</b></span>")."</a>) at Rank: {$aa_vars['prereq_minpoints']}<br />"; else echo "None<br />";?>
                Classes: <?=getClasses($aa_vars['classes'], $aa_vars['berserker'])?>
                <?
                if ($aa_vars['prereq_skill'] != 0 && $aa_vars['prereq_skill'] != 0xffffffff && $prereq_name != null) {
                  $rankcheck = $aa_vars['prereq_minpoints'] > $prereq_name['max_level'];
                  $classcheck = (((int)$aa_vars['classes'] & (int)$prereq_name['classes']) == 0) && (((int)$aa_vars['berserker'] & (int)$prereq_name['berserker']) == 0);
                  if ($rankcheck || $classcheck) {
                ?>
                <br /><font color='red'><b>Prerequisite Mismatch:</b><br />
                <?if($classcheck) {?>Classes: <?=getClasses($prereq_name['classes'], $prereq_name['berserker'])?><?} if ($classcheck && $rankcheck) {?> - <?} if ($rankcheck) {?>Max Rank: <?=$prereq_name['max_level']?><br /><?}?></font>
                <? }} ?>
<br /><br />
<table>
  <tr>
    <td>
      <fieldset>
        <legend><b>Costs</b></legend>
        <table cellpadding="0">
          <tr>
            <td style="width:140px;">
              <table cellpadding="0">
                <tr>
                  <td align="right">
                    Cost:<br />
                  </td>
                  <td>
                     <?=$aa_vars['cost']?><br />
                  </td>
                </tr>
                <tr>
                  <td align="right">
                    Cost Increment:<br />
                  </td>
                  <td>
                    <?=$aa_vars['cost_inc']?><br />
                  </td>
                </tr>
                <tr>
                  <td align="right">
                    SoF Cost Inc:<br />
                  </td>
                  <td>
                    <?=$aa_vars['sof_cost_inc']?><br />
                  </td>
                </tr>
              </table>
            </td>
            <td style="width:100px;">
              <table cellpadding="0">
                <tr>
                  <td align="right">
                    Level Req:<br />
                  </td>
                  <td>
                    <?=$aa_vars['class_type']?><br />
                  </td>
                </tr>
                  <td align="right">
                    Level Inc:<br />
                  </td>
                  <td>
                    <?=$aa_vars['level_inc']?><br />
                  </td>
                <tr>
                </tr>
                <tr>
                  <td align="right">
                    Ranks:<br />
                  </td>
                  <td>
                    <?=$aa_vars['max_level']?><br />
                  </td>
                </tr>
              </table>
            </td>
            <td style="width:140px;">
              <table cellpadding="0">
                <tr>
                  <td align="right">
                    SoF Group Offset:<br />
                  </td>
                  <td>
                    <?=$aa_vars['sof_current_level']?><br />
                  </td>
                </tr>
                  <td align="right">
                    SoF Max Level:<br />
                  </td>
                  <td>
                    <?=$aa_vars['sof_max_level']?><br />
                  </td>
                <tr>
                </tr>
                <tr>
                  <td align="right">
                    <br />
                  </td>
                  <td>
                    <br />
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </fieldset>
    </td>
    <td>
      <fieldset>
        <legend><b>Spell Action</b></legend>
          <table cellpadding="0" style="width:310px;">
            <tr>
              <td align="right" style="width:70px;">
                Spell ID:<br />
              </td>
              <td rowspan="2" style="vertical-align:top;">
              <? if ($aa_vars['spellid'] == '0' || $aa_vars['spellid'] == 0xffffffff) { ?>
                <?=$aa_vars['spellid']?><br />
              <? } else {?>
                <a href="index.php?editor=spells&id=<?=$aa_vars['spellid']?>&action=2" target="_blank"><?=$aa_vars['spellid']?> - <?=getSpellName($aa_vars['spellid'])?></a> [<a href='http://lucy.allakhazam.com/spell.html?id=<?=$aa_vars['spellid']?>' target='_blank'>Lucy</a>]<br />
              <? } ?>
              </td>
            </tr>
            <tr>
              <td><br /></td>
            </tr>
            <tr>
              <td colspan="2">
              <table cellpadding="0">
                <tr>
                  <td align="right" style="width:70px;">
                    Spell Type:<br />
                  </td>
                  <td style="width: 40px;">
                    <?=$aa_vars['spell_type']?><br />
                  </td>
                  <td align="right" style="width:80px;">
                    Spell Refresh:<br />
                  </td>
                  <td style="width:70px;">
                    <?=$aa_vars['spell_refresh']?><br />
                  </td>
                </tr>
              </table>
              </td>
            </tr>
          </table>
      </fieldset>
    </td>
  </tr>
</table>
<table>
  <tr>
    <td style="width:300px;">
      <fieldset>
        <legend><b>Categories</b></legend>
        <table cellpadding="0">
          <tr>
            <td align="right">
              Display Tab:<br />
            </td>
            <td>
              <?=$aa_type[$aa_vars['type']]?><br />
            </td>
          </td>
          <tr>
            <td align="right">
              SoF Tab:<br />
            </td>
            <td>
              <? echo ($aa_sof_type[$aa_vars['sof_type']])? "{$aa_sof_type[$aa_vars['sof_type']]}" : "{$aa_vars['sof_type']}";?><br />
            </td>
          </td>
          <tr>
            <td align="right">
              Expansion:<br />
            </td>
            <td>
              <?=getExpansionName($aa_vars['aa_expansion'])?> (<?=$aa_vars['aa_expansion']?>)<br />
            </td>
          </td>
          <tr>
            <td align="right">
              Special Category:<br />
            </td>
            <td>
              <? echo (isset($aa_special_category[$aa_vars['special_category']])) ? "{$aa_special_category[$aa_vars['special_category']]}" : "{$aa_vars['special_category']}";?><br />
            </td>
          </td>
          <tr>
            <td align="right">
              Client Version:<br />
            </td>
            <td>
              <?=$aa_vars['clientver']?><br />
            </td>
          </td>
        </table>
      </fieldset>
    </td>
    <td style="width:200px;">
      <fieldset>
        <legend><b>String IDs</b></legend>
        <table cellpadding="0">
          <tr>
            <td style="text-align:right;">
              Hotkey SID 1:<br />
            </td>
            <td>
              <?=$aa_vars['hotkey_sid']?><br />
            </td>
          </tr>
          <tr>
            <td style="text-align:right;">
              Hotkey SID 2:<br />
            </td>
            <td>
              <?=$aa_vars['hotkey_sid2']?><br />
            </td>
          </tr>
          <tr>
            <td style="text-align:right;">
              Title SID:<br />
            </td>
            <td>
              <?=$aa_vars['title_sid']?><br />
            </td>
          </tr>
          <tr>
            <td style="text-align:right;">
              Desc. SID:<br />
            </td>
            <td>
              <?=$aa_vars['desc_sid']?><br />
            </td>
          </tr>
          <tr>
            <td style="text-align:right;">
              SoF SID:<br />
            </td>
            <td>
              <?=$aa_vars['sof_next_skill']?><br />
            </td>
          </tr>
        </table>
      </fieldset>
    </td>
    <td style="vertical-align:top; width:216px;">
      <fieldset>
      <legend><b>Other</b></legend>
        Account Time Required: <?=$aa_vars['account_time_required']?><br />
      </fieldset>
      <br />
    </td>
  </tr>
</table>
                </fieldset>
                
<?
$aa_ranks = $aa_vars['max_level'];
for ($i = 0; $i < $aa_ranks; $i++) {
  $aarank = $i+1;
  echo "<a name=\"rank$aarank\"></a><fieldset>";
  echo "<legend><b>Rank $aarank</b></legend>";
?>
<div style="float:left;width:200px;">
  <fieldset>
  <legend>Calculated</legend>
    Level required: <?=$aa_vars['class_type']+($aa_vars['level_inc']*$i)?><br />
    Cost: <?=$aa_vars['cost']+($aa_vars['cost_inc']*$i)?><br />
  </fieldset>
</div>
<div style="float:left;width:200px;">
  <fieldset>
  <legend>Specific</legend>
<?
  $found = 0;
  if ($aa_cost)
  foreach ($aa_cost as $aac) {
    if ($aac['skill_id'] == $aaid+$i) {
      echo "Level required: ".$aac['level']."<br />";
      echo "Cost: ".$aac['cost']."<br />";
      $found = 1;
    }
  }
  if(!$found) {
    echo "Not set<br /><br />";
  }
?>
  </fieldset>
</div>
<div style="float:left;width:270px;height:40px;padding-top:10px;">
<?
  //echo "<a href=\"index.php?editor=aa&aaid=$aaid&rank=$aarank&action=19\">Click here to edit the specific</a><br />";
  echo "<a href=\"index.php?editor=aa&aaid=$aaid&rank=$aarank&action=19\"><button type=\"button\">Edit Specific</button></a>";
  if ($found) {
    //echo "<a href=\"index.php?editor=aa&aaid=$aaid&rank=$aarank&action=21\">Click here to remove the specific</a>";
    echo "<a href=\"index.php?editor=aa&aaid=$aaid&rank=$aarank&action=21\"><button type=\"button\">Delete Specific</button></a>";
  }
  echo "<br />";
?>
</div>
<div style="clear:both;"></div>
<?

  $found = 0;
  if ($aa_actions) {
    foreach ($aa_actions as $aa_action) {
      if ($aa_action['rank'] == $i) {
?>
	<br />
	<div class="table_container">
	<div class="table_header">
	  <table width="100%" cellpadding="0" cellspacing="0">
	    <tr>
              <td>AA Action<td>
              <td align="right">
                <a href="index.php?editor=aa&aaid=<?=$aaid?>&rank=<?=$aarank?>&action=4"><img src="images/edit2.gif" border="0" title="Edit AA Action"></a>
                <a href="index.php?editor=aa&aaid=<?=$aaid?>&rank=<?=$aarank?>&action=10" onclick="return confirm('Really delete the AA Action for this rank?');"><img src="images/remove.gif" border="0" title="Remove the AA Action for this Rank"></a>
              </td>
            </tr>
          </table>
        </div>
	<table class="table_content2" width="100%">
	  <tr>
	    <td>
              Spell ID: <a href="index.php?editor=spells&id=<?=$aa_action['spell_id']?>&action=2" target="_blank"><?=$aa_action['spell_id']?> - <?=getSpellName($aa_action['spell_id'])?></a> [<a href='http://lucy.allakhazam.com/spell.html?id=<?=$aa_action['spell_id']?>' target='_blank'>Lucy</a>]<br />
              Target Override: <? echo (isset($aa_action_target[$aa_action['target']]) ? "{$aa_action_target[$aa_action['target']]} - " : "");?>(raw:<?=$aa_action['target']?>)<br />
              Reuse Time: <?=$aa_action['reuse_time']?><br />
              <br />
	    </td>
	    <td>
              Non-Spell Action: <?=$aa_action['nonspell_action']?><br />
              Non-Spell Mana: <?=$aa_action['nonspell_mana']?><br />
              Non-Spell Duration: <?=$aa_action['nonspell_duration']?><br />
              <br />
	    </td>
	    <td>
              Redux AA 1: <?=$aa_action['redux_aa']?><br />
              Redux Rate 1: <?=$aa_action['redux_rate']?><br />
              Redux AA 2: <?=$aa_action['redux_aa2']?><br />
              Redux Rate 2: <?=$aa_action['redux_rate2']?><br />
	    </td>
	  </tr>
	</table>
	</div>
<?
        $found = 1;
        break;
      }
    }
  }
  if ($found == 0) { 
?>
    <br /><b>AA Action</b> - None<br />
    <a href="index.php?editor=aa&aaid=<?=$aaid?>&rank=<?=$aarank?>&action=5"><button type="button">Add Action</button></a>
    <br />
<?
  }
  
  $showcopy = 1;
  if ($aa_effects) {
    $found = 0;
    $x=0;
    foreach ($aa_effects as $aa_effect) {
      if ($aa_effect['aaid'] == ($aaid+$i)) {
        if ($found == 0) {
          // Only show the table head if we actually have data
?>
	<br />
	<div class="table_container">
	<div class="table_header">
	  <table width="100%" cellpadding="0" cellspacing="0">
	    <tr>
              <td>AA Effects<td>
              <td align="right">
                <a href="index.php?editor=aa&aaid=<?=$aaid?>&rank=<?=$aarank?>&action=7"><img src="images/add.gif" border="0" title="Add AA Effect Slot"></a>
                <a href="index.php?editor=aa&aaid=<?=$aaid?>&rank=<?=$aarank?>&action=9" onclick="return confirm('Really delete all AA Effects from this rank?');"><img src="images/table.gif" border="0" title="Remove all AA Effect Slots for this Rank"></a>
              </td>
            </tr>
          </table>
        </div>
        
	<table class="table_content2" width="100%">
	  <tr>
	    <th align="center" width="8%">Slot</th>
	    <th align="center" width="54%">Effect</th>
	    <th align="center" width="15%">Base1</th>
	    <th align="center" width="15%">Base2</th>
	    <th width="8%"></th>
	  </tr>
<?
        }
?>
	  <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
<?
        echo "<td align=\"center\">" . $aa_effect['slot'] . "</td>";
        echo "<td>" . $aa_effect['effectid'] . " - ";
        if (isset($sp_effects[$aa_effect['effectid']]))
          echo $sp_effects[$aa_effect['effectid']];
        else
          echo "Unknown";
        echo "</td>";
        echo "<td align=\"center\">" . $aa_effect['base1'] . "</td>";
        echo "<td align=\"center\">" . $aa_effect['base2'] . "</td>";
?>
        <td align="right"><a href="index.php?editor=aa&aaid=<?=$aaid?>&rank=<?=$aarank?>&aaeffectid=<?=$aa_effect['id']?>&action=6"><img src="images/edit2.gif" border="0" title="Edit Slot"></a>
        <a href="index.php?editor=aa&aaid=<?=$aaid?>&rank=<?=$aarank?>&aaeffectid=<?=$aa_effect['id']?>&action=8" onclick="return confirm('Really delete this AA Effect?');"><img src="images/remove.gif" border="0" title="Remove Slot"></a></td>
<?
        echo "</tr>";
        $found = 1;
        $showcopy = 0;
        $x++;
      }
    }
    if ($found) {
      echo "</table></div>";
    }
  }
  if ($showcopy) {
?>
      <br />
      <b>AA Effect</b><br />
      <table>
        <tr>
          <td>
            <a href="index.php?editor=aa&aaid=<?=$aaid?>&rank=<?=$aarank?>&slot=1&action=7"><button type="button">Add Effect</button></a>
            or&nbsp;
          </td>
          <td align="right">
            <form method="post" action="index.php?editor=aa&aaid=<?=$aaid?>&rank=<?=$aarank?>&action=23">
              <input name="aaid" type="text" size="5" value="AA ID" onfocus="if (this.value=='AA ID') this.value='';" onblur="if (this.value=='') this.value='AA ID';" title="Optional AAID from which to copy">
              <input name="rank" type="text" size="5" value="Rank" onfocus="if (this.value=='Rank') this.value='';" onblur="if (this.value=='') this.value='Rank';" title="The rank to copy from. Uses the current AA if AA ID is not set.">
              <input type="submit" value="Copy Slots From">
            </form>
          </td>
        </tr>
      </table>
<?
  }
  
  echo "</fieldset>";
}

?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
</div>
