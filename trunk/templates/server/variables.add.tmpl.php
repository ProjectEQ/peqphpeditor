  <div class="edit_form" style="width: 750px">
    <div class="edit_form_header">Add Variable</div>
      <div class="edit_form_content">
        <form name="variables" method="post" action="index.php?editor=server&action=47">
          <b>Variable Name:</b><br/>
          <input type="text" size="30" name="varname" value=""><br/><br/>
          <b>Value:</b><br/>
          <textarea cols="87" rows="3" name="value"></textarea><br/><br/>
          <b>Information:</b><br/>
          <textarea cols="87" rows="3" name="information"></textarea><br/><br/>
          <b>Timestamp:</b><br/>
          <input type="text" size="25" name="ts" value="<?=get_current_time();?>"><br/><br/>
          <center>
            <input type="submit" value="Create Variable">&nbsp;<input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </div>
    </div>
