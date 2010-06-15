      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            Create a New NPC Faction
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="npcfaction" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=9">
              Suggested ID:<br>
              <input type="text" name="id" size="25" value="<?=$id?>"><br><br>
              Suggested Name:<br>
              <input type="text" name="name" size="25" value="<?=$npc_name?>"><br><br>
	          Ignore Primary Assist:  <br>
			      <select name="ipa">
			      <option value="0"<?echo ($ipa == 0) ? " selected" : ""?>>False</option>
			      <option value="1"<?echo ($ipa == 1) ? " selected" : ""?>>True</option>
                 </select><br><br>
              <center>
                <input type="submit" name="submit" value="Submit Changes">
              </center>
            </form>
          </td>
        </tr>
      </table>
