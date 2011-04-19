  <form name="adventure_edit" method="post" action="index.php?editor=adventures&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=9">
    <div class="edit_form">
      <div class="edit_form_header">
        Edit Adventure: <?=$id?>
        <div style="float:right">
          <a href="index.php?editor=adventures&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$id?>&action=19"><img src="images/next.gif" border="0" title="Copy single entry"></a>
          <a href="index.php?editor=adventures&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&id=<?=$id?>&action=18"><img src="images/last.gif" border="0" title="Create all instances"></a>
        </div>
      </div>
      <div class="edit_form_content">
        <fieldset>
          <legend><strong><font size="4">General</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="25%">Zone:<br/><input type="text" name="zone" size="10" value="<?=$zone?>"></td>
              <td align="left" width="25%">Zone Version:<br/><input type="text" name="zone_version" size="7" value="<?=$zone_version?>"></td>
              <td align="left" width="25%">Is Hard:<br/>
                <select name="is_hard">
                  <option value="0"<?echo ($is_hard == 0) ? " selected" : ""?>>No</option>
                  <option value="1"<?echo ($is_hard == 1) ? " selected" : ""?>>Yes</option>
                </select>
              </td>
              <td align="left" width="25%">Is Raid:<br/>
                <select name="is_raid">
                  <option value="0"<?echo ($is_raid == 0) ? " selected" : ""?>>No</option>
                  <option value="1"<?echo ($is_raid == 1) ? " selected" : ""?>>Yes</option>
                </select>
              </td>
            </tr>
            <tr>
              <td align="left" width="25%">Min Level:<br/><input type="text" name="min_level" size="7" value="<?=$min_level?>"/></td>
              <td align="left" width="25%">Max Level:<br/><input type="text" name="max_level" size="7" value="<?=$max_level?>"/></td>
              <td align="left" width="25%">Duration:<br/><input type="text" name="duration" size="7" value="<?=$duration?>"/></td>
              <td align="left" width="25%">Zone In Time:<br/><input type="text" name="zone_in_time" size="7" value="<?=$zone_in_time?>"/></td>
            </tr>
            <tr>
              <td align="left" width="25%">Win Pts:<br/><input type="text" name="win_points" size="7" value="<?=$win_points?>"/></td>
              <td align="left" width="25%">Lose Pts:<br/><input type="text" name="lose_points" size="7" value="<?=$lose_points?>"/></td>
              <td align="left" width="25%">Theme:<br/>
                <select name="theme" style="width: 180px;">
<?foreach($themetype as $key=>$value):?>
                  <option value="<?=$key?>"<?echo ($key == $theme)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="25%">&nbsp;</td>
            </tr>
          </table>
        </fieldset><br/>
        <fieldset>
          <legend><strong><font size="4">Objective</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="25%">Type:<br/>
                <select name="type" style="width: 125px;">
<?foreach($advtype as $key=>$value):?>
                  <option value="<?=$key?>"<?echo ($key == $type)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                </select>
              </td>
              <td align="left" width="25%">Data:<br/><input type="text" name="type_data" size="7" value="<?=$type_data?>"/></td>
              <td align="left" width="25%">Count:<br/><input type="text" name="type_count" size="7" value="<?=$type_count?>"/></td>
              <td align="left" width="25%">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" width="25%">Boss X:<br/><input type="text" name="assa_x" size="7" value="<?=$assa_x?>"/></td>
              <td align="left" width="25%">Boss Y:<br/><input type="text" name="assa_y" size="7" value="<?=$assa_y?>"/></td>
              <td align="left" width="25%">Boss Z:<br/><input type="text" name="assa_z" size="7" value="<?=$assa_z?>"/></td>
              <td align="left" width="25%">Boss Heading:<br/><input type="text" name="assa_h" size="7" value="<?=$assa_h?>"/></td>
            </tr>
          </table>
        </fieldset><br/>
        <fieldset>
          <legend><strong><font size="4">Zoning</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="25%">Zone in Zone:<br/><input type="text" name="zone_in_zone_id" size="7" value="<?=$zone_in_zone_id?>"/></td>
              <td align="left" width="25%">Compass X:<br/><input type="text" name="zone_in_x" size="7" value="<?=$zone_in_x?>"/></td>
              <td align="left" width="25%">Compass Y:<br/><input type="text" name="zone_in_y" size="7" value="<?=$zone_in_y?>"/></td>
              <td align="left" width="25%">Zone in Object:<br/><input type="text" name="zone_in_object_id" size="7" value="<?=$zone_in_object_id?>"/></td>
            </tr>
            <tr>
              <td align="left" width="25%">Dest X:<br/><input type="text" name="dest_x" size="7" value="<?=$dest_x?>"/></td>
              <td align="left" width="25%">Dest Y:<br/><input type="text" name="dest_y" size="7" value="<?=$dest_y?>"/></td>
              <td align="left" width="25%">Dest Z:<br/><input type="text" name="dest_z" size="7" value="<?=$dest_z?>"/></td>
              <td align="left" width="25%">Dest Heading:<br/><input type="text" name="dest_h" size="7" value="<?=$dest_h?>"/></td>
            </tr>
          </table>
        </fieldset><br/>
        <fieldset>
          <legend><strong><font size="4">Graveyard</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td align="left" width="25%">Graveyard Zone ID:<br/><input type="text" name="graveyard_zone_id" size="7" value="<?=$graveyard_zone_id?>"/></td>
              <td align="left" width="25%">Graveyard X:<br/><input type="text" name="graveyard_x" size="7" value="<?=$graveyard_x?>"/></td>
              <td align="left" width="25%">Graveyard Y:<br/><input type="text" name="graveyard_y" size="7" value="<?=$graveyard_y?>"/></td>
              <td align="left" width="25%">Graveyard Z:<br/><input type="text" name="graveyard_z" size="7" value="<?=$graveyard_z?>"/></td>
            </tr>
            <tr>
              <td align="left" width="25%">Graveyard Radius:<br/><input type="text" name="graveyard_radius" size="7" value="<?=$graveyard_radius?>"/></td>
              <td align="left" width="25%">&nbsp;</td>
              <td align="left" width="25%">&nbsp;</td>
              <td align="left" width="25%">&nbsp;</td>
            </tr>
          </table>
        </fieldset><br/>
        <fieldset>
          <legend><strong><font size="4">Text</font></strong></legend>
          <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td><textarea name="text" rows="6" cols="86"><?=$text?></textarea></td>
              <td align="right"></td>
            </tr>
          </table>
        </fieldset><br/>
        <center>
          <input type="hidden" name="id" value="<?=$id?>"/>
          <input type="submit" value="Submit Changes"/>
        </center>
      </div>
    </div>
  </form>
