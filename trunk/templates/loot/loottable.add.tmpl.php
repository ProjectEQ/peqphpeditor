      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            Add New Loottable
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="loottable" method="post" action="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=10&npcid=<?=$npcid?>">
              Suggested ID:<br>
              <input type="text" name="id" size="25" value="<?=$id?>"><br><br>
              Suggested Name:<br>
              <input type="text" name="name" size="25" value="<?=$name?>"><br><br>
              Min. Cash: <br>
              <input type="text" name="mincash" size="25" value="0"><br><br>
              Max. Cash: <br>
              <input type="text" name="maxcash" size="25" value="0"><br><br>
              <center>
		  <input type="hidden" name="avgcoin" value="0">
                <input type="submit" name="submit" value="Submit Changes">
              </center>
            </form>
          </td>
        </tr>
      </table>
