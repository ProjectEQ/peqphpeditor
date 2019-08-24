<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.1.01/ace.js" type="text/javascript" charset="utf-8"></script>
  <div class="table_container" style="width: 100%;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Quest Script for NPC: <?=getNPCName($npcid)?> (<?=$npcid?>)</td>
          <td align="right">
            <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>">Go back to current NPC</a>
          </td>
        </tr>
      </table>
    </div>
    <div class="edit_form_content">
<?
  if ($filename) {
?>
      <p style="text-align: center; font-weight: bold; font-size: 14px;">Filename: <?=$filename?></p><br/>
      <table width="100%">
        <tr>
          <td>
            <div id="text" name="text">
<?
    if (file_exists($filename)) {
      @readfile("$filename");
    }
    else {
      echo "Unable to read from quest file.";
    }
?>
            </div>
          </td>
        </tr>
      </table>
<?
  }
  else {
?>
      No quest file found for this NPC.
<?
  }
?>
    </div>
  </div>
 <?
 if(strtolower(substr($filename, -3)) == "lua") { $mode = "lua"; }
else { $mode = "perl"; }
 ?>
<script>
window.onload = function() {
    editor = ace.edit("text");
    editor.setTheme("ace/theme/monokai");
    editor.setShowPrintMargin(false);
	editor.getSession().setUseWrapMode(false)
    editor.getSession().setMode("ace/mode/<? echo $mode ?>");
    editor.getSession().setUseWorker(true);
	document.getElementById("text").style.height = "300px"; //we need to make it so the user can change this as wanted.
	editor.resize();
}
</script>