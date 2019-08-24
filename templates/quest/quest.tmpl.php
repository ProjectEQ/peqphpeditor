<script src="ace-builds/src/ace.js" type="text/javascript" charset="utf-8"></script>
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
            <div id="text" name="text" style="height: 600px;"><?
			if (file_exists($filename)) {
				@readfile("$filename");
			}
			else {
				echo "Unable to read from quest file.";
			}
			?></div>
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
<script>
var filename = "<?php echo $filename ?>"
var editor = ace.edit("text");
var mode = autoImplementedMode(filename);
editor.setTheme("ace/theme/monokai");
editor.getSession().setUseWrapMode(false);
editor.getSession().setMode(mode);
editor.resize();
editor.getSession().on('change', function() {
	DoSave()
});

function DoSave()
{
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "savefile.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("file="+filename+"&content=" + editor.getValue()); 
}
function autoImplementedMode(filename){
    var ext = filename.split('.').pop();
    var prefix = "ace/mode/";

    if(!ext){
        return prefix + "text";
    }
    switch (ext) {
		case "lua":
		return prefix + "lua";
		case "pl":
		return prefix + "perl"
        case "js":
        return prefix + "javascript";
        case "cs":
        return prefix + "csharp";
        case "php":
        return prefix + "php";
        case "rb":
        return prefix + "ruby";
    }
}
</script>