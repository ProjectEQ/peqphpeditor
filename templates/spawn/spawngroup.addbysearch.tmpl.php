  <form name="addspawngroup" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&sid=<?=$sid?>&action=9">
    <table class="edit_form">
      <tr>
        <td class="edit_form_header">Add NPC to Spawngroup</td>
      </tr>
      <tr>
        <td class="edit_form_content">
          Spawngroup ID:<br>
          <input type="text" name="sid" value="<?=$sid?>">
        </td>
      </tr>
      <tr>
        <td class="edit_form_content"><center>Spawn Chance:<br><input type="checkbox" name="balance" id="balance" onclick="if(this.checked){document.getElementById('chance').disabled='disabled';} else {document.getElementById('chance').disabled='';}">Balance spawn <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <input type="text" name="chance" id="chance" value="0" size="3"> %&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center></td>
      </tr>
      <tr>
        <td align="center" class="edit_form_content">
          <input type="hidden" name="npc" value=<?=$npcid?>>
          <input type="submit" name="submit" value=" Submit ">
        </td>
      </tr>
    </table>
  </form>
