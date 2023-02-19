  <div>
    <center>
      <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
      <input id="button" type="button" value='Hide Item Search' onclick='hideSearch("searchframe");' style='display:none; margin-bottom: 20px;'>
    </center>
  </div>
  <div>
    <form method="post" name="merchant_item" action="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=5">
      <div class="edit_form" style="width: 500px">
        <div class="edit_form_header">Add an Item to Merchant</div>
        <div class="edit_form_content">
          <table width="100%" cellpadding="3" cellspacing="3">
            <tr>
              <td>
                <strong>Merchant ID:</strong><br>
                <input type="text" size="10" value="<?=$mid?>" disabled>
              </td>
              <td>
                <strong>Slot:</strong><br>
                <input type="text" size="10" value="<?=$slot?>" disabled>
              </td>
              <td>
                <strong>Item ID:</strong> (<a href="javascript:showSearch('searchframe');">search</a>)<br>
                <input id="id" type="text" size="10" name="itemid" value="0">
              </td>
              <td>
                <strong>Faction Required:</strong><br>
                <input id="faction_required" type="text" size="10" name="faction_required" value="-100">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Level Required:</strong><br>
                <input id="level_required" type="text" size="10" name="level_required" value="0">
              </td>
              <td>
                <strong>Min Status:</strong><br>
                <input id="min_status" type="text" size="10" name="min_status" value="0">
              </td>
              <td>
                <strong>Max Status:</strong><br>
                <input id="max_status" type="text" size="10" name="max_status" value="255">
              </td>
              <td>
                <strong>Alt Currency Cost:</strong><br>
                <input id="alt_currency_cost" type="text" size="10" name="alt_currency_cost" value="0">
              </td>
            </tr>
              <td>
                <strong>Probability:</strong><br>
                <input id="probability" type="text" size="10" name="probability" value="100">
              </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            <tr>
            </tr>
            <tr>
              <td>
                <strong>Min Expansion:</strong><br>
                <input id="min_expansion" type="text" size="10" name="min_expansion" value="-1">
              </td>
              <td colspan="3">
                <strong>Content Flags:</strong><br>
                <input id="content_flags" type="text" size="52" name="content_flags" value="">
              </td>
            </tr>
            <tr>
              <td>
                <strong>Max Expansion:</strong><br>
                <input id="max_expansion" type="text" size="10" name="max_expansion" value="-1">
              </td>
              <td colspan="3">
                <strong>Content Flags Disabled:</strong><br>
                <input id="content_flags_disabled" type="text" size="52" name="content_flags_disabled" value="">
              </td>
            </tr>
            <tr>
              <td colspan="4">
                <fieldset style="text-align:left;">
                  <legend><strong>Classes Required</strong></legend>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><input type="checkbox" name="classes_required[]" value="1" onChange="box_changed('classes_required[]', 'all_classes');" checked>Warrior</td>
                      <td><input type="checkbox" name="classes_required[]" value="2" onChange="box_changed('classes_required[]', 'all_classes');" checked>Cleric</td>
                      <td><input type="checkbox" name="classes_required[]" value="4" onChange="box_changed('classes_required[]', 'all_classes');" checked>Paladin</td>
                      <td><input type="checkbox" name="classes_required[]" value="8" onChange="box_changed('classes_required[]', 'all_classes');" checked>Ranger</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="classes_required[]" value="16" onChange="box_changed('classes_required[]', 'all_classes');" checked>Shadowknight</td>
                      <td><input type="checkbox" name="classes_required[]" value="32" onChange="box_changed('classes_required[]', 'all_classes');" checked>Druid</td>
                      <td><input type="checkbox" name="classes_required[]" value="64" onChange="box_changed('classes_required[]', 'all_classes');" checked>Monk</td>
                      <td><input type="checkbox" name="classes_required[]" value="128" onChange="box_changed('classes_required[]', 'all_classes');" checked>Bard</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="classes_required[]" value="256" onChange="box_changed('classes_required[]', 'all_classes');" checked>Rogue</td>
                      <td><input type="checkbox" name="classes_required[]" value="512" onChange="box_changed('classes_required[]', 'all_classes');" checked>Shaman</td>
                      <td><input type="checkbox" name="classes_required[]" value="1024" onChange="box_changed('classes_required[]', 'all_classes');" checked>Necromancer</td>
                      <td><input type="checkbox" name="classes_required[]" value="2048" onChange="box_changed('classes_required[]', 'all_classes');" checked>Wizard</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="classes_required[]" value="4096" onChange="box_changed('classes_required[]', 'all_classes');" checked>Magician</td>
                      <td><input type="checkbox" name="classes_required[]" value="8192" onChange="box_changed('classes_required[]', 'all_classes');" checked>Enchanter</td>
                      <td><input type="checkbox" name="classes_required[]" value="16384" onChange="box_changed('classes_required[]', 'all_classes');" checked>Beastlord</td>
                      <td><input type="checkbox" name="classes_required[]" value="32768" onChange="box_changed('classes_required[]', 'all_classes');" checked>Berserker</td>
                    </tr>
                    <tr>
                      <td colspan="8" align="center"><br><input type="checkbox" id="all_classes" onChange="all_boxes_changed('classes_required[]', 'all_classes');" checked>All Classes</td>
                    </tr>
                  </table>
                </fieldset>
              </td>
            </tr>
            <tr>
              <td colspan="4">
                <fieldset>
                  <legend><strong>Bucket</strong></legend>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <strong>Name:</strong><br>
                        <input type="text" size="20" name="bucket_name" value="">
                      </td>
                      <td>
                        <strong>Value:</strong><br>
                        <input type="text" size="20" name="bucket_value" value="">
                      </td>
                      <td>
                        <strong>Comparison:</strong><br>
                        <select name="bucket_comparison">
<?foreach ($comparison as $k=>$v):?>
                          <option value="<?=$k?>"><?=$k?>: <?=$v?></option>
<?endforeach;?>
                        </select>
                      </td>
                    </tr>
                  </table>
                </fieldset><br>
              </td>
            </tr>
          </table>
          <center>
            <input type="hidden" name="mid" value="<?=$mid?>">
            <input type="hidden" name="slot" value="<?=$slot?>">
            <input type="submit" name="submit" value="Add Item">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.back();">
          </center>
        </div>
      </div>
    </form>
  </div>
