  <div class="edit_form" style="width: 750px">
    <div class="edit_form_header">Edit Variable</div>
      <div class="edit_form_content">
        <form name="variables" method="post" action="index.php?editor=server&action=45">
          <b>Variable Name:</b><br/>
          <input type="text" size="30" name="varname" value="<?=$varname?>"><br/><br/>
          <b>Value:</b><br/>
          <textarea cols="87" rows="3" name="value"><?=$value?></textarea><br/><br/>
          <b>Information:</b><br/>
          <textarea cols="87" rows="3" name="information"><?=$information?></textarea><br/><br/>
          <b>Timestamp:</b><br/>
          <input type="text" size="25" name="ts" value="<?=$ts?>"><br/><br/>
          <center>
            <input type="submit" value="Submit Changes">&nbsp;<input type="button" value="Cancel Changes" onClick="history.back();">
          </center>
        </form>
      </div>
    </div>
