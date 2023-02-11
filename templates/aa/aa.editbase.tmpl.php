  <script type="text/javascript">
    function Toggle() {
      document.aa_edit.class_ber.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_brd.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_bst.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_clr.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_dru.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_enc.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_mag.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_mnk.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_nec.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_pal.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_rng.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_rog.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_shd.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_shm.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_war.checked = document.aa_edit.all_none.checked;
      document.aa_edit.class_wiz.checked = document.aa_edit.all_none.checked;
    }

    function fill8F(elem) {
      elem.value = 4294967295;
    }

    function updateRawCat(val) {
      if (val == "useraw") {
        document.aa_edit.raw_special_category.disabled = false;
      }
      else {
        document.aa_edit.raw_special_category.value = val;
        document.aa_edit.raw_special_category.disabled = true;
      }
    }

    function updateRawExpansion(val) {
      if (val == "useraw") {
        document.aa_edit.raw_aa_expansion.disabled = false;
      }
      else {
        document.aa_edit.raw_aa_expansion.value = val;
        document.aa_edit.raw_aa_expansion.disabled = true;
      }
    }

    function rankCheck(oldmax) {
      //?
    }

    function showSearch() {
      document.getElementById("searchframe").style.display = "block";
      document.getElementById("button").style.display = "block";
    }

    function hideSearch() {
      document.getElementById("searchframe").style.display = "none";
      document.getElementById("button").style.display = "none";
    }
  </script>
<?if($errors):?>
  <?foreach($errors as $error):?>
    <div class="error">
      <table width="100%">
        <tr>
          <td valign="middle" width="30px">
            <img src="images/caution.gif">
          </td>
          <td style="padding:0px 5px;">
            <?=$error?>
          </td>
        </tr>
      </table>
    </div>
  <?endforeach;?>
<?endif;?>
  <center>
    <iframe id="searchframe" src="templates/iframes/aasearch.php"></iframe>
    <input id="button" type="button" value="Hide AA Search" onclick="hideSearch();" style="display:none; margin-bottom:20px;">
  </center>
  <div class="edit_form" style="width:500px;">
    <div class="edit_form_header">
<?if ($editmode == 2) echo "Create a new AA"; else echo "Edit AA: {$aa_vars['name']} ($aaid)";?>
    </div>
    <div class="edit_form_content">
      <form name="aa_edit" method="post" action="index.php?editor=aa<?if($editmode == 1) echo "&aaid=$aaid";?>&action=<? if($editmode == 1) echo "15"; else echo "16";?>">
        <table>
          <tr>
            <td>
              ID:<br>
              <input type="text" name="skill_id" size="6" value="<?echo "{$aa_vars['skill_id']}";?>"><br>
            </td>
            <td>
              Name:<br>
              <input type="text" name="aaname" size="50" value="<?echo "{$aa_vars['name']}";?>"><br>
            </td>
          </tr>
        </table><br>
        <table>
          <tr>
            <td style="width:228px;">
              <fieldset>
                <legend><b>Level and Cost</b></legend>
                <table>
                  <tr>
                    <td>
                      Ranks:<br>
                      <input type="text" name="max_level" size="5" value="<?echo "{$aa_vars['max_level']}";?>"><br>
                    </td>
                    <td>
                      Req Level:<br>
                      <input type="text" name="class_type" size="5" value="<?echo "{$aa_vars['class_type']}";?>"><br>
                    </td>
                    <td>
                      Level Inc:<br>
                      <input type="text" name="level_inc" size="5" value="<?echo "{$aa_vars['level_inc']}";?>"><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Cost:<br>
                      <input type="text" name="cost" size="5" value="<?echo "{$aa_vars['cost']}";?>"><br>
                    </td>
                    <td>
                      Cost Inc:<br>
                      <input type="text" name="cost_inc" size="5" value="<?echo "{$aa_vars['cost_inc']}";?>"><br>
                    </td>
                    <td>
                      SoF Cost Inc:<br>
                      <input type="text" name="sof_cost_inc" size="5" value="<?echo "{$aa_vars['sof_cost_inc']}";?>"><br>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      SoF Next ID:<br>
                      <input type="text" name="sof_next_id" size="5" value="<?echo "{$aa_vars['sof_next_id']}";?>"><br>
                    </td>
                    <td>
                      SoF Max: <br>
                      <input type="text" name="sof_max_level" size="5" value="<?echo "{$aa_vars['sof_max_level']}";?>"><br>
                    </td>
                    <td>
                      SoF Offset:<br>
                      <input type="text" name="sof_current_level" size="5" value="<?echo "{$aa_vars['sof_current_level']}";?>"><br>
                    </td>
                  </tr>
                </table>
              </fieldset>
              <fieldset>
                <legend><b>Categories</b></legend>
                <table>
                  <tr>
                    <td>
                      Display Tab:<br>
                      <select class="left" name="type" style="width:125px;">
<? foreach($aa_type as $key => $val) {?>
                        <option value="<?=$key?>"<?if($aa_vars['type'] == $key) echo " selected"?>><?=$val?></option>
<? } ?>
                      </select><br>
                    </td>
                    <td>
                      SoF Tab:<br>
                      <select class="left" name="sof_type" style="width:90px;">
<? foreach($aa_sof_type as $key => $val) {?>
                        <option value="<?=$key?>"<?if($aa_vars['sof_type'] == $key) echo " selected"?>><?=$val?></option>
<? } ?>
                      </select><br>
                    </td>
                  </tr>
                </table><br>
                <table>
                  <tr>
                    <td>
                      Expansion:<br>
                      <select class="left" name="aa_expansion" style="width:150px;" onchange="updateRawExpansion(this.value);">
<? for ($i=0; isset($eqexpansions[$i]); $i++) {?>
                        <option value="<?=$i?>"<?if($aa_vars['aa_expansion'] == $i) echo " selected"?>><? echo "$i: {$eqexpansions[$i]}";?></option>
<? } ?>
<? foreach($aa_sof_expansion as $key => $val) {?>
                        <option value="<?=$key?>"<?if($aa_vars['aa_expansion'] == $key) echo " selected"?>><?echo "$val"?></option>
<? } ?>
                        <option value="useraw"<?if(!(($eqexpansions[$aa_vars['aa_expansion']]) || ($aa_sof_expansion[$aa_vars['aa_expansion']]))) echo " selected";?>>Use Raw</option>
                      </select><br>
                    </td>
                    <td>
                      Raw:<br>
                      <input type="text" name="raw_aa_expansion" size="5" value="<?echo "{$aa_vars['aa_expansion']}";?>"<?echo (($eqexpansions[$aa_vars['aa_expansion']]) || ($aa_sof_expansion[$aa_vars['aa_expansion']])) ? " disabled" : "";?>><br>
                    </td>
                  </tr>
                </table><br>
                <table>
                  <tr>
                    <td>
                      Special Category:<br>
                      <select class="left" name="special_category" style="width:150px;" onchange="updateRawCat(this.value);">
<? foreach($aa_special_category as $key => $val) { ?>
                        <option value="<?=$key?>"<?if($aa_vars['special_category'] == $key) echo " selected";?>><?=$val?></option>
<? }?>
                        <option value="useraw"<?if(!isset($aa_special_category[$aa_vars['special_category']])) echo " selected";?>>Use Raw</option>
                      </select><br>
                    </td>
                    <td>
                      Raw:<br>
                      <input type="text" name="raw_special_category" size="5" value="<?echo "{$aa_vars['special_category']}";?>"<?echo (isset($aa_special_category[$aa_vars['special_category']])) ? " disabled" : "";?>><br>
                    </td>
                  </tr>
                </table><br>
                Client Version:<br>
                <input type="text" name="clientver" size="5" value="<?echo "{$aa_vars['clientver']}";?>"><br><br>
              </fieldset>
            </td>
            <td style="width:240px;">
              <fieldset>
                <legend><b>Prerequisite</b></legend>
                <table>
                  <tr>
                    <td width="50%">
                      AA: (<a href="javascript:showSearch();" title="Show the AA search frame">Search</a>)<br>
                      <input id="searchtarget" type="text" name="prereq_skill" size="10" value="<?echo "{$aa_vars['prereq_skill']}";?>">
                    </td>
                    <td width="50%">
                      Points:<br>
                      <input type="text" name="prereq_minpoints" size="6" value="<?echo "{$aa_vars['prereq_minpoints']}";?>">
                    </td>
                  </tr>
                </table>
              </fieldset>
              <div style="margin-top:2px;">
                <fieldset>
                  <legend><b>Classes</b></legend>
                  <table>
                    <tr>
                      <td>
                        <input type="checkbox" name="class_ber" value="65536"<?echo ($aa_vars['berserker'] == 1) ? " checked" : "";?>> BER<br>
                        <input type="checkbox" name="class_brd" value="256"<?echo ($aa_vars['classes'] & 256) ? " checked" : "";?>> BRD<br>
                        <input type="checkbox" name="class_bst" value="32768"<?echo ($aa_vars['classes'] & 32768) ? " checked" : "";?>> BST<br>
                        <input type="checkbox" name="class_clr" value="4"<?echo ($aa_vars['classes'] & 4) ? " checked" : "";?>> CLR<br>
                      </td>
                      <td>
                        <input type="checkbox" name="class_dru" value="64"<?echo ($aa_vars['classes'] & 64) ? " checked" : "";?>> DRU<br>
                        <input type="checkbox" name="class_enc" value="16384"<?echo ($aa_vars['classes'] & 16384) ? " checked" : "";?>> ENC<br>
                        <input type="checkbox" name="class_mag" value="8192"<?echo ($aa_vars['classes'] & 8192) ? " checked" : "";?>> MAG<br>
                        <input type="checkbox" name="class_mnk" value="128"<?echo ($aa_vars['classes'] & 128) ? " checked" : "";?>> MNK<br>
                      </td>
                      <td>
                        <input type="checkbox" name="class_nec" value="2048"<?echo ($aa_vars['classes'] & 2048) ? " checked" : "";?>> NEC<br>
                        <input type="checkbox" name="class_pal" value="8"<?echo ($aa_vars['classes'] & 8) ? " checked" : "";?>> PAL<br>
                        <input type="checkbox" name="class_rng" value="16"<?echo ($aa_vars['classes'] & 16) ? " checked" : "";?>> RNG<br>
                        <input type="checkbox" name="class_rog" value="512"<?echo ($aa_vars['classes'] & 512) ? " checked" : "";?>> ROG<br>
                      </td>
                      <td>
                        <input type="checkbox" name="class_shd" value="32"<?echo ($aa_vars['classes'] & 32) ? " checked" : "";?>> SHD<br>
                        <input type="checkbox" name="class_shm" value="1024"<?echo ($aa_vars['classes'] & 1024) ? " checked" : "";?>> SHM<br>
                        <input type="checkbox" name="class_war" value="2"<?echo ($aa_vars['classes'] & 2) ? " checked" : "";?>> WAR<br>
                        <input type="checkbox" name="class_wiz" value="4096"<?echo ($aa_vars['classes'] & 4096) ? " checked" : "";?>> WIZ<br>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="4">
                        <input type="checkbox" name="all_none" value="yes" onClick="Toggle();"<?if($aa_vars['berserker']==1 && $aa_vars['classes'] == 65534) echo " checked";?>><b>All/None</b><br>
                      </td>
                    </tr>
                  </table>
                </fieldset>
              </div>
              <div style="margin-top:2px;">
                <fieldset>
                  <legend><b>String IDs</b></legend>
                  <table>
                    <tr>
                      <td style="width:110px;">
                        Hotkey SID 1:<br>
                        <input type="text" name="hotkey_sid" size="10" value="<?echo "{$aa_vars['hotkey_sid']}";?>"><img src="images/minus.gif" border="0" title="Fill in the Not Used value for this field" onclick="fill8F(document.aa_edit.hotkey_sid)"><br><br>
                      </td>
                      <td style="width:110px;">
                        Hotkey SID 2:<br>
                        <input type="text" name="hotkey_sid2" size="10" value="<?echo "{$aa_vars['hotkey_sid2']}";?>"><img src="images/minus.gif" border="0" title="Fill in the Not Used value for this field" onclick="fill8F(document.aa_edit.hotkey_sid2)"><br><br>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Title SID:<br>
                        <input type="text" name="title_sid" size="10" value="<?echo "{$aa_vars['title_sid']}";?>"><br><br>
                      </td>
                      <td>
                        Description SID:<br>
                        <input type="text" name="desc_sid" size="10" value="<?echo "{$aa_vars['desc_sid']}";?>"><br><br>
                      </td>
                    </tr>
                  </table>
                  <table>
                    <tr>
                      <td>
                        SoF SID (sof_next_skill):<br>
                        <input type="text" name="sof_next_skill" size="10" value="<?echo "{$aa_vars['sof_next_skill']}";?>"><br>
                      </td>
                    </tr>
                  </table>
                </fieldset>
              </div>
            </td>
          </tr>
        </table>
        <table>
          <tr>
            <td>
              <fieldset>
                <legend><b>Spell</b></legend>
                <table cellpadding="0">
                  <tr>
                    <td style="width:110px;">
                      Spell ID:<br>
                      <input type="text" name="spellid" size="10" value="<?echo "{$aa_vars['spellid']}";?>"><img src="images/minus.gif" border="0" title="Fill in the Not Used value for this field" onclick="fill8F(document.aa_edit.spellid);"><br>
                    </td>
                    <td style="width:95px;">
                      Spell Type:<br>
                      <input type="text" name="spell_type" size="10" value="<?echo "{$aa_vars['spell_type']}";?>"><br>
                    </td>
                    <td style="width:95px;">
                      Spell Refresh:<br>
                      <input type="text" name="spell_refresh" size="10" value="<?echo "{$aa_vars['spell_refresh']}";?>"><br>
                    </td>
                  </tr>
                </table>
              </fieldset>
            </td>
            <td style="width:157px;">
              <fieldset>
                <legend><b>Other</b></legend>
                Account Time Required:<br>
                <input type="text" name="account_time_required" size="10" value="<?echo "{$aa_vars['account_time_required']}";?>"><br>
              </fieldset>
            </td>
          </tr>
        </table><br>
        <center>
          <input type="submit" name="submit" value="<? if($editmode == 1) echo "Submit Changes"; else echo "Create AA"; ?>"<?if($editmode == 1) echo " onclick=\"return rankCheck({$aa_vars['max_level']});\"";?>>
        </center>
      </form>
    </div>
  </div>
