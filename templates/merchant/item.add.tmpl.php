  <center>
    <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
    <input id="button" type="button" value='Hide Item Search' onclick='hideSearch("searchframe");' style='display:none; margin-bottom: 20px;'>
  </center>
  <form method="post" action="index.php?editor=merchant&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=5">
    <div class="edit_form" style="width: 200px">
      <div class="edit_form_header">
        Add an Item to Merchant <?=$mid?>
      </div>
      <div class="edit_form_content">
        <strong>Enter an Item ID:</strong> (<a href="javascript:showSearch('searchframe');">search</a>)<br>
        <input class="indented" id="id" type="text" name="itemid"><br><br>
        <strong>Faction Required:</strong>
        <input class="indented" id="faction_required" type="text" name="faction_required" value="-100"><br><br>
        <strong>Level Required:</strong>
        <input class="indented" id="level_required" type="text" name="level_required" value="0"><br><br>
        <strong>Alt Currency Cost:</strong>
        <input class="indented" id="alt_currency_cost" type="text" name="alt_currency_cost" value="0"><br><br>
        <strong>Classes Required:</strong>
        <input class="indented" id="classes_required" type="text" name="classes_required" value="65535"><br><br>
        <strong>Probability:</strong>
        <input class="indented" id="probability" type="text" name="probability" value="100"><br><br>
        <center>
          <input type="hidden" name="mid" value="<?=$mid?>">
          <input type="submit" name="submit" value=" Submit ">
        </center>
      </div>
    </div>
  </form>
