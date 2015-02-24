  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Book text for <?=$name?>:</td>
        </tr>
      </table>
    </div>
    <div class="edit_form_content">
      <form name="booktext" method="post" action="index.php?editor=items&id=<?=$id?>&name=<?=$name?>&action=4">
        <table width="100%">
            <tr>
                <td><textarea name="txtfile" rows="20" cols="88"><?=$txtfile?></textarea></td>
                <td align="right">&nbsp;</td>
            </tr>
        </table><br/>
        <center>
          <input type="hidden" name="name" value="<?=$name?>">
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
    </div>
  </div>
