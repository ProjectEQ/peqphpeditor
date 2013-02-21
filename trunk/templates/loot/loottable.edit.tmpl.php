      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            Loottable <?=$loottable_id?>
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
          <form method="post" action="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=2&npcid=<?=$npcid?>">
            <strong>LootTable Name:</strong><br>
            <input class="indented" type="text" name="name" size="25" value="<?=$loottable_name?>"><br><br>
            <strong>Min. Cash:</strong><br>
            <input class="indented" type="text" name="mincash" size="5" value="<?=$mincash?>"><br><br>
            <strong>Max. Cash:</strong><br>
            <input class="indented" type="text" name="maxcash" size="5" value="<?=$maxcash?>"><br><br>
            <center>
              <input type="hidden" name="loottable_id" value="<?=$loottable_id?>">
		<input type="hidden" name="avgcoin" value="0">
              <input type="submit" name="submit" value="Submit Changes">
            </center>
          </form>
          </td>
        </tr>
      </table>
