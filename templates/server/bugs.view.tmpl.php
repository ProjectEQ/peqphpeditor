        <form name="bug_edit" method="post" action="index.php?editor=server&action=3">
          <div class="table_container" style="width: 600px;">
            <div class="table_header">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="left">View Bug <?=$bid?></td>
                  <td align="right"><a href="index.php?editor=server&action=1">View Open Bugs</a></td>
                </tr>
              </table>
            </div>
            <div class="edit_form_content">
              <center>
                <fieldset style="text-align: left;">
                  <table width="100%">
                    <tr>
                      <td align="center" width="5%"><strong>ID</strong></td>
                      <td align="center" width="19%"><strong>Zone</strong></td>
                      <td align="center" width="19%"><strong>Toon</strong></td>
                      <td align="center" width="19%"><strong>Type</strong></td>
                      <td align="center" width="19%"><strong>Target</strong></td>
                      <td align="center" width="19%"><strong>Date</strong></td>
                    </tr>
                    <tr>
                      <td align="center" width="5%"><?=$bid?></td>
                      <td align="center" width="19%"><?=$zone?></td>
                      <td align="center" width="19%"><?=$name?></td>
                      <td align="center" width="19%"><?=$type?></td>
                      <td align="center" width="19%"><?=$target?></td>
                      <td align="center" width="19%"><?=$date?></td>
                    </tr>
                    <tr>
                      <td align="center" width="5%">&nbsp;</td>
                      <td align="center" width="19%"><strong>UI</strong></td>
                      <td align="center" width="19%"><strong>X</strong></td>
                      <td align="center" width="19%"><strong>Y</strong></td>
                      <td align="center" width="19%"><strong>Z</strong></td>
                      <td align="center" width="19%"><strong>Flag</strong></td>
                    </tr>
                    <tr>
                      <td align="center" width="5%">&nbsp;</td>
                      <td align="center" width="19%"><?=$ui?></td>
                      <td align="center" width="19%"><?=$x?></td>
                      <td align="center" width="19%"><?=$y?></td>
                      <td align="center" width="19%"><?=$z?></td>
                      <td align="center" width="19%"><?=$flags[$flag]?></td>
                    </tr>
                  </table>
                </fieldset><br>
                <fieldset>
                  <legend><strong>Bug</strong></legend>
                  <table width="100%">
                    <tr>
                      <td align="center" width="10%"><select name="status" onChange="toggleNotify();">
<?foreach($bugstatus as $key=>$value):?>
                        <option value="<?=$key?>"<?echo ($key == $status)? " selected" : "";?>><?=$value?></option>
<?endforeach;?>
                      </select></td>
                      <td align="center" width="90%"><?=$bug?></td>
                    </tr>
                  </table>
                </fieldset><br>
              </center>
              <fieldset id="notify" style="display:none">
                <legend><strong>Player Notification</strong></legend>
                <br><input type="checkbox" name="notify" value="notify" onChange="toggleNote();">Notify player of status change<br><br>
                Note to Player: (Optional)<br>
                <textarea name="optional_note" id="note" cols="68" rows="5" disabled="true"></textarea>
              </fieldset><br><br>
              <center>
                <input type="hidden" name="bid" value="<?=$bid?>">
                <input type="hidden" name="bug_date" value="<?=$date?>">
                <input type="hidden" name="name" value="<?=$name?>">
                <input type="hidden" name="bug" value="<?=$bug?>">
                <input type="submit" value="Submit Changes">
              </center>
            </div>
          </div>
        </form>
