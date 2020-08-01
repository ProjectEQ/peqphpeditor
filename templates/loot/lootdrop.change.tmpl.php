  <div class="edit_form" style="width:240px;">
    <div class="edit_form_header">Change Lootdrop:</div>
    <div class="edit_form_content">
      <form name="searchmethod" method="get" action="index.php">
        <input type="hidden" name="editor" value="loot">
        <input type="hidden" name="z" value="<?=$currzone?>">
        <input type="hidden" name="zoneid" value="<?=$currzoneid?>">
        <input type="hidden" name="npcid" value="<?=$npcid?>">
        <input type="hidden" name="ltid" value="<?=$ltid?>">
        <input type="radio" name="action" value="25">Search for a Lootdrop by Name<br>
        <input type="radio" name="action" value="23">Enter a Lootdrop ID<br>
        <input type="radio" name="action" value="30">Create a New Lootdrop<br><br>
        <center>
          <input type="submit" value="Continue">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
