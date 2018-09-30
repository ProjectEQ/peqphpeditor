  <table class="edit_form">
    <tr>
      <td class="edit_form_header">Add New Lootdrop</td>
    </tr>
    <tr>
      <td class="edit_form_content">
        <form name="lootdrop" method="POST" action="index.php?editor=loot&action=61">
          Loottable ID:<br>
          <input type="text" size="25" value="<?=$loottable_id?>" disabled><br><br>
          Lootdrop ID:<br>
          <input type="text" name="id" size="25" value="<?=$lootdrop_id?>"><br><br>
          Name:<br>
          <input type="text" name="name" size="25" value=""><br><br>
          Mindrop:<br>
          <input type="text" name="mindrop" size="25" value="0"><br><br>
          Droplimit:<br>
          <input type="text" name="droplimit" size="25" value="0"><br><br>
          Multiplier:<br>
          <input type="text" name="multiplier" size="25" value="1"><br><br>
          Probability:<br>
          <input type="text" name="probability" size="25" value="100"><br><br>
          <center>
            <input type="hidden" name="global_loot" value="<?=$global_loot?>">
            <input type="hidden" name="loottable_id" value="<?=$loottable_id?>">
            <input type="submit" name="submit" value="Add Lootdrop">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </td>
    </tr>
  </table>
