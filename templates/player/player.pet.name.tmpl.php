  <table class="edit_form">
    <tr>
      <td class="edit_form_header">&nbsp;</td>
    </tr>
    <tr>
      <td class="edit_form_content">
        <form name="pet_name" method="post" action="index.php?editor=player&playerid=<?=$playerid?>&action=16">
          Player ID: <input type="text" size="10" value="<?=$playerid?>" disabled><br><br>
          Pet Name: <input type="text" name="name" size="20" value="<?=$name?>"><br><br>
          <center>
            <input type="hidden" name="playerid" value="<?=$playerid?>">
            <input type="submit" value="Set Name">&nbsp;&nbsp;
            <input type="button" value="Cancel" onClick="history.back();">
          </center>
        </form>
      </td>
    </tr>
  </table>
