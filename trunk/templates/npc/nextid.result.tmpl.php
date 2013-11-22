  <div class="table_container" style="width:200px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Result:</td>
          <td align="right"><a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>">Go Back</a></td>
        </tr>        
      </table>
    </div>
    <form method="POST" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>">
      <div class="table_content">
        <center>
          Next available ID: <?=$next_npcid?><br/><br/>
          <input type="hidden" name="selected_id" value="<?=$next_npcid?>">
          <input type="submit" value="Use this ID">
        </center>
      </div>
    </form>
  </div>
