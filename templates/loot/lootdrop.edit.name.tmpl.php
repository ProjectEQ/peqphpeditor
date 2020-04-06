  <table class="edit_form">
    <tr>
      <td class="edit_form_header">LootDrop <?=$ldid?></td>
    </tr>
    <tr>
      <td class="edit_form_content">
        <form method="post" action="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$ldid?>&action=4">
          <strong>LootDrop Name:</strong><br>
          <input type="text" name="ldname" size="35" value="<?=$ldname?>"><br><br>
          <center>
            <input type="submit" name="submit" value="Submit Changes">
          </center>
        </form>
      </td>
    </tr>
  </table>
