<div class="edit_form" style="margin-bottom: 15px;">
      <div class="edit_form_header">
        <table width="100%">
          <tr>
            <td>
              Add a grid
            </td>
          </tr>
        </table>
      </div>

      <div class="edit_form_content">
        <form name="grid" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&action&action=34">
        <table width="100%" cellspacing="0">
          <tr>
            <td width="33%">
                       Suggested ID:<br>
                       <input type="text" name="id" value="<?=$suggestedid?>">
                     </td>
            <td width="33%">
			  Wander Type:<br>
			  <select class="indented" name="type">
<?foreach($wandertype as $k => $v):?>
              <option value="<?=$k?>"<? echo ($k == $type) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>
            </select><br><br>
			</td>
            <td width="34%">
			  Pause Type:<br>
                       <select class="indented" name="type2">
<?foreach($pausetype as $k => $v):?>
              <option value="<?=$k?>"<? echo ($k == $type2) ? " selected" : ""?>><?=$v?></option>
<?endforeach;?>
            </select><br><br>
			</td>
          </tr>
		</table><br><br>

        <center>
          <input type="hidden" name="zoneid" value="<?=$zid?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>