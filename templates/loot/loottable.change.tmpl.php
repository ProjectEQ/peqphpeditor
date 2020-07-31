  <div class="edit_form" style="width:240px;">
    <div class="edit_form_header">Change Loottable:</div>
    <div class="edit_form_content">
      <form name="searchmethod" method="get" action="index.php">
        <input type="hidden" name="editor" value="loot">
        <input type="hidden" name="z" value="<?=$currzone?>">
        <input type="hidden" name="zoneid" value="<?=$currzoneid?>">
        <input type="hidden" name="npcid" value="<?=$npcid?>">
        <input type="radio" name="action" value="14">Search for a Loottable by Name<br>
        <input type="radio" name="action" value="12">Enter a Loottable ID<br>
        <input type="radio" name="action" value="9">Create a New Loottable<br><br>
        <center>
          <input type="submit" value="Continue">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
