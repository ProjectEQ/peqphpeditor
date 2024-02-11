  <form name="addspawngroup" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=58">
    <table class="edit_form">
      <tr>
        <td class="edit_form_header">Add NPC to Spawngroup</td>
      </tr>
      <tr>
        <td class="edit_form_content">
          Enter Spawngroup ID:<br>
          <input type="text" name="new_sid">
        </td>
      </tr>
      <tr>
        <td align="center" class="edit_form_content">
          <input type="hidden" name="npc" value=<?=$npcid?>>
          <input type="submit" name="submit" value="Submit">
        </td>
      </tr>
    </table>
  </form>
