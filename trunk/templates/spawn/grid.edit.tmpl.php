      <table class="edit_form">
        <tr>
          <td class="edit_form_header">
            Grid: <?=$pathgrid?>
          </td>
        </tr>
        <tr>
          <td class="edit_form_content">
            <form name="grid" id="grid" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spid=<?=$spid?>&pathgrid=<?=$pathgrid?>&action=22">
              <strong>Wander Type:</strong><br>
              <select class="indented" name="type">
<?foreach($wandertype as $k => $v):?>
              <option value="<?=$k?>"<? echo ($k == $type) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>
            </select><br><br>
              <strong>Pause Type:</strong><br>
              <select class="indented" name="type2">
<?foreach($pausetype as $k => $v):?>
              <option value="<?=$k?>"<? echo ($k == $type2) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>
            </select><br><br>
              <center>
                <input type="hidden" name="pathgrid" value="<?=$pathgrid?>">
                <input type="submit" name="submit" value="Submit Changes">
              </center>
            </form>
          </td>
        </tr>
      </table>