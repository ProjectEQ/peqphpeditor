      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            Lootdrop: <?=$ldid?>
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
          <form name="item" method="post" action="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=42&npcid=<?=$npcid?>&ldid=<?=$ldid?>">
            <strong>Merge with:</strong> <br>
            <input class="indented" type="text" size="10" name="lootdropid" value=""><br><br>
            <center>
              <input type="submit" name="submit" value="Submit Changes">
            </center>
          </form>
          </td>
        </tr>
      </table>
