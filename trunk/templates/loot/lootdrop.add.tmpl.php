      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            Add New Lootdrop
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="loottable" method="post" action="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=31">
              <input type="hidden" name="ltid" value="<?=$ltid?>">
              Suggested ID:<br>
              <input type="text" name="ldid" size="25" value="<?=$id?>"><br><br>
              Suggested Name:<br>
              <input type="text" name="name" size="25" value="<?=$name?>"><br><br>
              Mindrop: <br>
              <input type="text" name="mindrop" size="25" value="0"><br><br>
              Droplimit: <br>
              <input type="text" name="droplimit" size="25" value="0"><br><br>
              Multiplier: <br>
              <input type="text" name="multiplier" size="25" value="1"><br><br>
		Probability: <br>
              <input type="text" name="probability" size="25" value="100"><br><br>
              <center>
                <input type="submit" name="submit" value="Submit Changes">
              </center>
            </form>
          </td>
        </tr>
      </table>
