  <table class="edit_form">
    <tr>
      <td class="edit_form_header">Edit Global Lootdrop</td>
    </tr>
    <tr>
      <td class="edit_form_content">
        <form name="lootdrop" method="POST" action="index.php?editor=loot&action=63">
          Loottable ID:<br>
          <input type="text" size="25" value="<?=$loottable_id?>" disabled><br><br>
          Lootdrop ID:<br>
          <input type="text" size="25" value="<?=$id?>" disabled><br><br>
          Name:<br>
          <input type="text" name="name" size="25" value="<?=$name?>"><br><br>
          Mindrop:<br>
          <input type="text" name="mindrop" size="25" value="<?=$mindrop?>"><br><br>
          Droplimit:<br>
          <input type="text" name="droplimit" size="25" value="<?=$droplimit?>"><br><br>
          Multiplier:<br>
          <input type="text" name="multiplier" size="25" value="<?=$multiplier?>"><br><br>
          Probability:<br>
          <input type="text" name="probability" size="25" value="<?=$probability?>"><br><br>
          <center>
            <input type="hidden" name="global_loot" value="<?=$global_loot?>">
            <input type="hidden" name="loottable_id" value="<?=$loottable_id?>">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="submit" name="submit" value="Update Lootdrop">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </td>
    </tr>
  </table>
