  <div class="table_container" style="width: 400px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Edit Reserved Name</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="edit_reserved_name" method="post" action="index.php?editor=chat&action=10">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="10" value="<?=$reserved_name['id']?>" disabled>
            </td>
            <td>
              <strong>Name:</strong><br>
              <input type="text" name="name" size="32" value="<?=$reserved_name['name']?>">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$reserved_name['id']?>">
          <input type="submit" value="Update Name">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
