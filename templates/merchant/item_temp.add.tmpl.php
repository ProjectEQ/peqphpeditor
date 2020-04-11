  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch("searchframe");' style='display:none; margin-bottom: 20px;'>
  </center>
  <form method="post" action="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=13">
    <div class="edit_form" style="width: 200px">
      <div class="edit_form_header">
        Add a Temp Item to Merchant NPC <?=$npcid?>
      </div>
      <div class="edit_form_content">
        <strong>Enter an Item ID:</strong> (<a href="javascript:showSearch('searchframe');">search</a>)<br>
        <input class="indented" id="id" type="text" name="itemid"><br><br>
        <strong>Charges:</strong>
        <input class="indented" id="charges" type="text" name="charges" value="1"><br><br>
        <center><input type="submit" name="submit" value=" Submit "></center>
      </div>
    </div>
  </form>
