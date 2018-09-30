  <form method="post" action="index.php?editor=loot&id=<?=$global_loot?>&action=57">
    <div class="edit_form" style="width: 300px;">
      <div class="edit_form_header">Edit Global Loottable</div>
      <div class="edit_form_content">
        <table width="100%" cellpadding="3" cellspacing="3">
          <tr>
            <td>
              <strong>Global Loot ID:</strong><br>
              <input type="text" size="5" value="<?=$global_loot?>" disabled>
            </td>
            <td>
              <strong>Loottable ID:</strong><br>
              <input type="text" size="5" value="<?=$id?>" disabled>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <strong>Name:</strong><br>
              <input type="text" name="name" size="36" value="<?=$name?>">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Min. Cash:</strong><br>
              <input type="text" name="mincash" size="5" value="<?=$mincash?>">
            </td>
            <td>
              <strong>Max. Cash:</strong><br>
              <input type="text" name="maxcash" size="5" value="<?=$maxcash?>">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="global_loot" value="<?=$global_loot?>">
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="hidden" name="avgcoin" value="0">
          <input type="submit" name="submit" value="Submit Changes">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
