  <div class="table_container" style="width: 400px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Create Reserved Name</td>
        </tr>
      </table>
    </div>
    <div class="table_content">
      <form name="add_reserved_name" method="post" action="index.php?editor=chat&action=8">
        <table width="100%" cellpadding="5" cellspacing="5">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" name="id" size="10" value="<?=$suggest_id?>">
            </td>
            <td>
              <strong>Name:</strong><br>
              <input type="text" name="name" size="32" value="">
            </td>
          </tr>
        </table><br>
        <center>
          <input type="submit" value="Insert Name">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back()">
        </center>
      </form>
    </div>
  </div>
