<div class="edit_form" style="width: 500px">
      <div class="edit_form_header">
        Add Spawn Event
      </div>

      <div class="edit_form_content">
        <form name="spawnevent" method="post" action=index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&action=41">
        <table width="100%">
          <tr>
            <th>Name:</th>
            <th>Cond ID:</th>
            <th>Period:</th>
            <th>Next Min:</th>
            <th>Next Hour:</th>
            <th>Next Day:</th>
          </tr>
          <tr>
            <td><input type="text" size="15" name="sename" value=""></td>
            <td><input type="text" size="7" name="cond_id" value="0"></td>
            <td><input type="text" size="7" name="period" value="0"></td>
            <td><input type="text" size="7" name="next_minute" value="0"></td>
            <td><input type="text" size="7" name="next_hour" value="1"></td>
            <td><input type="text" size="7" name="next_day" value="1"></td>
          </tr>
          <tr>
            <th>Next Month:</th>
            <th>Next Year:</th>
            <th>Argument:</th>
            <th>Action:</th>
            <th>Enabled:</th>
            <th>Strict:</th>
            
          </tr>
          <tr>
            <td><input type="text" size="15" name="next_month" value="1"></td>
            <td><input type="text" size="7" name="next_year" value="3100"></td>
            <td><input type="text" size="7" name="argument" value="0"></td>
            <td>
                 <select name="action">
                   <option value="0"<?echo ($action == 0) ? " selected" : ""?>>Set</option>
                   <option value="1"<?echo ($action == 1) ? " selected" : ""?>>Add</option>
                   <option value="2"<?echo ($action == 0) ? " selected" : ""?>>Subtract</option>
                   <option value="3"<?echo ($action == 1) ? " selected" : ""?>>Multiply</option>
                   <option value="4"<?echo ($action == 0) ? " selected" : ""?>>Divide</option>
                 </select>
               </td>
            <td>
                 <select name="enabled">
                   <option value="0"<?echo ($enabled == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($enabled == 1) ? " selected" : ""?>>Yes</option>
                 </select>
               </td>
	     <td>
            	   <select name="strict">
                   <option value="0"<?echo ($strict == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($strict == 1) ? " selected" : ""?>>Yes</option>
                 </select>
               </td>
           </tr>
        </table><br><br>

        <center>
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>