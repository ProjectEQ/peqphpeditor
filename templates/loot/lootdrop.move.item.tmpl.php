      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            <?=$ldname?>
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
          <form name="item" method="post" action="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=48&npcid=<?=$npcid?>&ldid=<?=$ldid?>&itemid=<?=$itemid?>">
            <strong>Lootdrop:</strong> <?=$ldid?><br>
            <strong>Item:</strong> <?=$itemid?><br><br>
            <strong>Move to Lootdrop:</strong></br>
	     <input type="radio" name="move_copy_item" value="1" " checked " "">Copy Item<br>
            <input type="radio" name="move_copy_item" value="0">Move Item<br>
            <input class="indented" type="text" size="5" name="movetolootdrop" value="<?=$new_ldid?>"><br><br>
            <strong>Equipped:</strong><br>
            <input type="radio" name="equip_item" value="0"<?echo ($equip_item == 0) ? " checked" : ""?>>no<br>
            <input type="radio" name="equip_item" value="1"<?echo ($equip_item == 1) ? " checked" : ""?>>yes<br><br>
            <strong>Item Charges:</strong> <br>
            <input class="indented" type="text" size="5" name="charges" value="<?=$item_charges?>"><br><br>
            <strong>Min Level:</strong> <br>
            <input class="indented" type="text" size="5" name="minlevel" value="<?=$minlevel?>"><br><br>
            <strong>Max Level:</strong> <br>
            <input class="indented" type="text" size="5" name="maxlevel" value="<?=$maxlevel?>"><br><br>
            <strong>Multiplier:</strong> <br>
            <input class="indented" type="text" size="5" name="multiplier" value="<?=$multiplier?>"><br><br>
            <strong>Chance:</strong> <br>
            <input class="indented" type="text" size="5" name="chance" value="<?=$chance?>">%<br><br>
            <center>
              <input type="submit" name="submit" value="Submit Changes">
            </center>
          </form>
          </td>
        </tr>
      </table>
