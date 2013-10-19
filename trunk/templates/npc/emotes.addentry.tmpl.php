  <form method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=77">
    <div class="edit_form" style="width: 550px;">
      <div class="edit_form_header">
        Add emote to set <?=$emoteid?>
      </div>
      <div class="edit_form_content">
        <table cellpadding="5" cellspacing="0" width="100%">
          <tr>
            <td>
              EmoteID:<br/>
              <input id="id" type="text" name="emoteid" size="7" value="<?=$emoteid?>">
            </td>
            <td>
              Event:<br/>
              <select name="event_"<?echo (count($eventtype) == count($existing)) ? " disabled" : "";?>>
<?foreach($eventtype as $key=>$value):?>
                <option value="<?=$key?>"<?echo (in_array($key, $existing)) ? " disabled" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
              </select>
            </td>
            <td>
              Type:<br/>
              <select name="type">
<?foreach($emotetype as $key=>$value):?>
                <option value="<?=$key?>"><?=$key?>: <?=$value?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="3">
              Emote:<br/>
              <textarea name="text" rows="6" cols="62"></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="3" align="center"><input type="submit" value="Add Emote"<?echo (count($eventtype) == count($existing)) ? " disabled" : "";?>>&nbsp;<input type="button" value="Cancel" onClick="history.back();"</td>
          </tr>
        </table>
      </div>
    </div>
  </form>
