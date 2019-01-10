    <table class="edit_form">
      <tr>
        <td class="edit_form_header">
          Manage Spells
        </td>
      </tr>
      <tr>
        <td class="edit_form_content">
          <center>
            <a href="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>">View Spell Sets</a><br>
            <a href="index.php?editor=spells">View Spells</a><br>
            <a href="index.php?editor=spells&action=11">View NPC Spells Effects</a><br>
<?if ($mysql_class == "mysqli") {?>
            <a onClick="return confirm('Depending on the network, drive access, etc., this can take a long time. Are you sure you want to run this process now? (Oh, and do not use the back button!)')" href="index.php?editor=spells&action=10">Generate spells_us.txt</a>
<?} else {?>
            <a onClick="alert('MySQLi is required for this operation. You should upgrade your PHP and/or use MySQLi.');">Generate spells_us.txt</a>
<?}?>
          </center>
        </td>
      </tr>
    </table>
