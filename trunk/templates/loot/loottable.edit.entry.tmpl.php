      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            <?=$ltname?>
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <strong>LootTable:</strong> <?=$ltid?><br>
            <strong>LootDrop:</strong> <?=$ldid?><br><br>
            <form name="loottable" id="loottable" method="post" action="index.php?editor=loot&z=<?=$currzone?>&action=8&npcid=<?=$npcid?>&ltid=<?=$ltid?>&ldid=<?=$ldid?>">
              Probability: <br><input type="text" name="prob" value="<?=$probability?>"><br><br>
              Multiplier: <br><input type="text" name="mult" value="<?=$multiplier?>"><br><br>
              <center>
                <input type="submit" name="submit" value="Submit Changes">
              </center>
            </form>
          </td>
        </tr>
      </table>
