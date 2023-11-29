  <div class="edit_form" style="width: 650px; margin-bottom: 15px;">
    <div class="edit_form_header">Edit Spawnpoint</div>
    <div class="edit_form_content">
      <form name="spawnpoint" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=12">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="15" value="<?=$id?>" disabled>
            </td>
            <td>
              <strong>Spawngroup ID:</strong><br>
              <input type="text" size="15" value="<?=$spawngroupID?>" disabled>
            </td>
            <td>
              <strong>Zone:</strong><br>
              <input type="text" size="15" value="<?=$zone?>" disabled>
            </td>
            <td>
              <strong>Version:</strong><br>
              <input type="text" size="15" name="version" value="<?=$version?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>X:</strong><br>
              <input type="text" name="x" size="15" value="<?=$x?>">
            </td>
            <td>
              <strong>Y:</strong><br>
              <input type="text" name="y" size="15" value="<?=$y?>">
            </td>
            <td>
              <strong>Z:</strong><br>
              <input type="text" name="z" size="15" value="<?=$z?>">
            </td>
            <td>
              <strong>Heading:</strong><br>
              <input type="text" name="heading" size="15" value="<?=$heading?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Respawn:</strong><br>
              <input type="text" name="respawntime" size="15" value="<?=$respawntime?>">s
            </td>
            <td>
              <strong>Variance:</strong><br>
              <input type="text" name="variance" size="15" value="<?=$variance?>">s
            </td>
            <td>
              <strong>Condition:</strong><br>
              <input type="text" name="_condition" size="15" value="<?=$_condition?>">
            </td>
            <td>
              <strong>Cond Value:</strong><br>
              <input type="text" name="cond_value" size="15" value="<?=$cond_value?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Pathgrid:</strong><br>
              <input type="text" name="pathgrid" size="15" value="<?=$pathgrid?>">
            </td>
            <td>
              <strong>Idle Zone Pathing</strong><br>
              <select name="path_when_zone_idle">
                <option value="0"<?echo ($path_when_zone_idle == 0) ? " selected" : "";?>>No (0)</option>
                <option value="1"<?echo ($path_when_zone_idle == 1) ? " selected" : "";?>>Yes (1)</option>
            </td>
            <td>
              <strong>Enabled:</strong><br>
              <select name="disabled">
                <option value="1"<?echo ($disabled == 1) ? " selected" : "";?>>No</option>
                <option value="0"<?echo ($disabled == 0) ? " selected" : "";?>>Yes</option>
              </select>
            </td>
            <td align="left">
              <strong>Animation:</strong><br>
              <select name="animation">
<?foreach($animations as $k => $v):?>
                <option value="<?=$k?>"<? echo ($k == $animation) ? " selected" : ""?>><?=$v?> (<?=$k?>)</option>
<?endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Min Expansion:</strong><br>
              <input type="text" name="min_expansion" size="15" value="<?=$min_expansion?>">
            </td>
            <td>
              <strong>Max Expansion:</strong><br>
              <input type="text" name="max_expansion" size="15" value="<?=$max_expansion?>">
            </td>
            <td>
              <strong>Disabled Instance:</strong><br>
              <input type="text" name="instance_id" size="15" value="<?=$instance_id?>">
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Content Flags:</strong><br>
              <input type="text" name="content_flags" size="42" value="<?=$content_flags?>">
            </td>
            <td colspan="2">
              <strong>Content Flags Disabled:</strong><br>
              <input type="text" name="content_flags_disabled" size="42" value="<?=$content_flags_disabled?>">
            </td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="hidden" name="spawngroupID" value="<?=$spawngroupID?>">
          <input type="hidden" name="zone" value="<?=$zone?>">
          <input type="submit" value="Update Spawnpoint">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
