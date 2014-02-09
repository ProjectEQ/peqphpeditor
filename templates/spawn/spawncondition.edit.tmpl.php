<div class="edit_form" style="width: 300px">
      <div class="edit_form_header">
        Edit Spawn Condition: <?=$id?>
      </div>

      <div class="edit_form_content">
        <form name="spawncondition" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&action=43">
        <table width="100%">
          <tr>
            <th>Value:</th>
            <th>Name:</th>
            <th>Onchange:</th>
          </tr>
          <tr>
            <td><input type="text" size="7" name="value" value="<?=$value?>"></td>
            <td><input type="text" size="15" name="name" value="<?=$name?>"></td>
            <td>
                 <select name="onchange">
                   <option value="0"<?echo ($onchange == 0) ? " selected" : ""?>>Nothing</option>
                   <option value="1"<?echo ($onchange == 1) ? " selected" : ""?>>Depop</option>
                   <option value="2"<?echo ($onchange == 2) ? " selected" : ""?>>Repop</option>
		     <option value="3"<?echo ($onchange == 3) ? " selected" : ""?>>RepopIfReady</option>
                 </select>
               </td>
          </tr>
        </table><br><br>

        <center>
          <input type="hidden" name="scid" value="<?=$id?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>