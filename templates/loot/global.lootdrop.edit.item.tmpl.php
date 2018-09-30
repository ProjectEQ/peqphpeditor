  <table class="edit_form">
    <tr>
      <td class="edit_form_header">Edit Global Lootdrop Item</td>
    </tr>
    <tr>
      <td class="edit_form_content">
        <form name="item" method="POST" action="index.php?editor=loot&action=68">
          <strong>Lootdrop ID:</strong><br>
          <input type="text" value="<?=$ldid?>" disabled><br><br>
          <strong>Item ID:</strong><br>
          <input type="text" value="<?=$itemid?>" disabled><br><br>
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
            <input type="hidden" name="global_loot" value="<?=$global_loot?>">
            <input type="hidden" name="ldid" value="<?=$ldid?>">
            <input type="hidden" name="itemid" value="<?=$itemid?>">
            <input type="submit" name="submit" value="Submit Changes">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </td>
    </tr>
  </table>
