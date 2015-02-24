    <div class="table_container" style="width: 200px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td>
             Change Task Set for Task <a href="index.php?editor=tasks&tskid=<?=$tskid?>"><?=$tskid?>
            </td>
          </tr>
        </table>
      </div>
      <div class="edit_form_content">
        <form name="id" method="post" action="index.php?editor=tasks&action=31">
          <table width="100%">
            <tr>
<?if($id == ''):?>
              <th>Suggested ID</th>
<?endif;?>
<?if($id != ''):?>
              <th>Task Set</th>
<?endif;?>
              <th>Task ID</th>
            </tr>
            <tr>
<?if($id == ''):?>
              <td><input type="text" size="5" name="id" value="<?=$suggested_id?>"></td>
<?endif;?>
<?if($id != ''):?>
              <td><input type="text" size="5" name="id" value="<?=$id?>"></td>
<?endif;?>
<?if($taskid == ''):?>
              <td><input type="text" size="5" name="taskid" value="<?=$tskid?>"></td>
<?endif;?>
<?if($taskid != ''):?>
              <td><input type="text" size="5" name="taskid" value=""></td>
<?endif;?>
              <td>
                <br/><br/>
                <center>
                  <input type="submit" value="Submit">
                </center>
              </td>
            </tr>
         </table>
       </form>
     </div>
   </div>
