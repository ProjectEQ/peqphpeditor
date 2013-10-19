  <form name="emoteadd" method="post" action="index.php?editor=npc&z=<?=$currzone?>&npcid=<?=$npcid?>&zoneid=<?=$currzoneid?>&action=80">
    <table class="edit_form">
      <tr>
        <td class="edit_form_header">Add Emote:</td>
      </tr>
      <tr>
        <td class="edit_form_content">
          <input type="radio" name="method" value="1">Create new emote set<br/>
          <input type="radio" name="method" value="2">Enter an existing emote ID: <input type="text" name="emoteid" size="5" value="0"><br/><br/>
          <center><input type="submit" value="Continue">&nbsp;<input type="button" value="Cancel" onClick="history.back();"></center>
        </td>
      </tr>
    </table>
  </form>
