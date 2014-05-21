      <div class="edit_form" style="width: 500px">
      <div class="edit_form_header">
        Edit Spawn Event: <?=$id?>
      </div>

      <div class="edit_form_content">
        <form name="spawnevent" method="post" action=index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&action=38">
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
            <td><input type="text" size="15" name="sename" value="<?=$name?>"></td>
            <td><input type="text" size="7" name="cond_id" value="<?=$cond_id?>"></td>
            <td><input type="text" size="7" name="period" value="<?=$period?>"></td>
            <td><input type="text" size="7" name="next_minute" value="<?=$next_minute?>"></td>
            <td><input type="text" size="7" name="next_hour" value="<?=$next_hour?>"></td>
            <td><input type="text" size="7" name="next_day" value="<?=$next_day?>"></td>
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
            <td><input type="text" size="15" name="next_month" value="<?=$next_month?>"></td>
            <td><input type="text" size="7" name="next_year" value="<?=$next_year?>"></td>
            <td><input type="text" size="7" name="argument" value="<?=$argument?>"></td>
            <td>
                 <select name="action">
                   <option value="0"<?echo ($action == 0) ? " selected" : ""?>>Set</option>
                   <option value="1"<?echo ($action == 1) ? " selected" : ""?>>Add</option>
                   <option value="2"<?echo ($action == 2) ? " selected" : ""?>>Subtract</option>
                   <option value="3"<?echo ($action == 3) ? " selected" : ""?>>Multiply</option>
                   <option value="4"<?echo ($action == 4) ? " selected" : ""?>>Divide</option>
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
          <input type="hidden" name="seid" value="<?=$id?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>