      <div class="edit_form" style="margin-bottom: 15px;">
      <div class="edit_form_header">
        <table width="100%">
          <tr>
            <td>
              Add a Spawnpoint
            </td>
          </tr>
        </table>
      </div>

      <div class="edit_form_content">
        <form name="spawnpoint" method="post" action="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&action=15">
        Suggested ID:<br>
        <input type="text" name="id" value="<?=$suggestedid?>"><br><br>
        <table width="100%" cellspacing="0">
          <tr>
            <td width="33%">
			  x:<br>
			  <input type="text" name="x" value="">
			</td>
            <td width="33%">
			  y:<br>
			  <input type="text" name="y" value="">
			</td>
            <td width="34%">
			  z:<br>
			  <input type="text" name="z" value="">
			</td>
          </tr>
          <tr>
            <td width="33%">
			  respawn:<br>
			  <input type="text" name="respawntime" value="1200">
			</td>
            <td width="33%">
			  pathgrid:<br>
			  <input type="text" name="pathgrid" value="0">
			</td>
            <td width="34%">
			  timeleft:<br>
			  <input type="text" name="timeleft" value="0">
			</td>
          </tr>
          <tr>
            <td width="33%">
			  heading:<br>
			  <input type="text" name="heading" value="0">
			</td>
            <td width="33%">
			  variance:<br>
			  <input type="text" name="variance" value="0">
			</td>
            <td width="34%">
			  condition:<br>
			  <input type="text" name="_condition" value="0">
			</td>
          </tr>
          <tr>
            <td width="33%">
			  cond_value:<br>
			  <input type="text" name="cond_value" value="1">
			</td>
            <td width="33%">&nbsp;</td>
            <td width="34%">&nbsp;</td>
          </tr>
		</table><br><br>

        <center>
          <input type="hidden" name="zone" value="<?=$zone?>">
          <input type="hidden" name="spawngroupID" value="<?=$spawngroupID?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>