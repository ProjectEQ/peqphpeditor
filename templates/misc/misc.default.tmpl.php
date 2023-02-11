  <table class="edit_form">
    <tr>
      <td class="edit_form_header">Options</td>
    </tr>
    <tr>
      <td class="edit_form_content">
        <center>
<?if (isset($currzone) && isset($currzoneid)):?>
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=1">Fishing</a><br>
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=7">Foraging</a><br>
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=13">Ground Spawns</a><br>
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=19">Traps</a><br>
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=35">Doors</a><br>
          <a href="index.php?editor=misc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=41">Objects</a><br>
<?endif;?>
          <a href="index.php?editor=misc&action=63">LDoN Traps</a>
        </center> 
      </td>
    </tr>
  </table>
