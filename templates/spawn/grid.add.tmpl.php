  <div class="edit_form" style="margin-bottom: 15px;">
    <div class="edit_form_header">
      <table width="100%">
        <tr>
          <td>Add a grid</td>
        </tr>
      </table>
    </div>
    <div class="edit_form_content">
      <form name="grid" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&sid=<?=$sid?>&action=19">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td width="34%" align="left">
              <strong>Suggested ID:</strong><br>
              <input type="text" name="id" value="<?=$suggestedid?>">
            </td>
            <td width="33%" align="left">
              <strong>Wander Type:</strong><br>
              <select name="type">
<?foreach($wandertype as $k=>$v):?>
                <option value="<?=$k?>"><?=$v?></option>
<?endforeach;?>
              </select>
            </td>
            <td width="33%" align="left">
              <strong>Pause Type:</strong><br>
              <select name="type2">
<?foreach($pausetype as $k=>$v):?>
                <option value="<?=$k?>"><?=$v?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>
        </table><br><br>
        <center>
          <input type="hidden" name="zoneid" value="<?=$zid?>">
          <input type="hidden" name="spid" value="<?=$spid?>">
          <input type="hidden" name="npcid" value="<?=$npcid?>">
          <input type="hidden" name="sid" value="<?=$sid?>">
          <input type="submit" value="Add Grid">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
