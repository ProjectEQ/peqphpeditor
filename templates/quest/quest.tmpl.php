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
            <textarea name="text" rows="82" cols="90">
<?
    if (file_exists($filename)) {
      @readfile("$filename");
    }
    else {
      echo "Unable to read from quest file.";
    }
?>
            </textarea>
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
