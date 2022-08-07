  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch("searchframe");' style='display:none; margin-bottom: 20px;'>
  </center>
  <form method="post" action="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=13">
    <div class="edit_form" style="width: 200px">
      <div class="edit_form_header">Add Temp Item</div>
      <div class="edit_form_content">
        <strong>Zone:</strong><br>
        <select name="zone_id">
<?foreach ($zoneids as $key=>$value):?>
          <option value="<?=$key?>"><?=$value?> (<?=$key?>)</option>
<?endforeach;?>
        </select><br><br>
        <strong>Instance:</strong><br>
        <input id="instance_id" type="text" name="instance_id" value="0"><br><br>
        <strong>Enter an Item ID:</strong> (<a href="javascript:showSearch('searchframe');">search</a>)<br>
        <input id="id" type="text" name="itemid"><br><br>
        <strong>Charges:</strong><br>
        <input id="charges" type="text" name="charges" value="1"><br><br>
        <center>
          <input type="submit" name="submit" value=" Submit ">&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
