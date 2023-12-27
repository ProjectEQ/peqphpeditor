  <form name="emotes" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=75">
    <div class="edit_form" style="width: 550px;">
      <div class="edit_form_header">
        Edit Emote <?=$id?>
      </div>
      <div class="edit_form_content">
        <table cellpadding="5" cellspacing="0" width="100%">
          <tr>
            <td>
              EmoteID:<br>
              <input id="id" type="text" name="emoteid" size="7" value="<?=$emoteid?>">
            </td>
            <td>
              Event:<br>
              <select name="event_">
<?foreach($eventtype as $key=>$value):?>
                <option value="<?=$key?>"<?echo ($key == $event_) ? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
              </select>
            </td>
            <td>
              Type:<br>
              <select name="type">
<?foreach($emotetype as $key=>$value):?>
                <option value="<?=$key?>"<?echo ($key == $type)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="3">
              Emote:<br>
              <textarea name="text" rows="6" cols="62"><?=$text?></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="3" align="center"><input type="submit" value="Submit Changes">&nbsp;<input type="button" value="Cancel" onClick="history.back();"></td>
          </tr>
        </table>
      </div>
    </div>
    <input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="oldemote" value="<?=$emoteid?>">
  </form>
