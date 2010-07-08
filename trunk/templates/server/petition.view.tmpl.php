        <form name="bug_edit" method="post" action="index.php?editor=server&action=14">
          <div class="table_container" style="width: 700px;">
            <div class="table_header">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>View Petition <?=$petid?></tr>
              </table>
            </div>
            <div class="edit_form_content">
              <center>
                <fieldset style="text-align: left;">
                  <table width="100%">
                    <tr>
                      <td align="center" width="5%"><strong>ID</strong></td>
                      <td align="center" width="19%"><strong>PetID</strong></td>
                      <td align="center" width="19%"><strong>Toon</strong></td>
                      <td align="center" width="19%"><strong>Account</strong></td>
                      <td align="center" width="19%"><strong>Race</strong></td>
                      <td align="center" width="19%"><strong>Class</strong></td>
                      <td align="center" width="19%"><strong>Level</strong></td>
                    </tr>
                    <tr>
                      <td align="center" width="5%"><?=$dib?></td>
                      <td align="center" width="19%"><?=$petid?></td>
                      <td align="center" width="19%"><?=$charname?></td>
                      <td align="center" width="19%"><?=$accountname?></td>
                      <td align="center" width="19%"><?=$races[$charrace]?></td>
                      <td align="center" width="19%"><?=$classes[$charclass]?></td>
                      <td align="center" width="19%"><?=$charlevel?></td>
                    </tr>
                    <tr>
                      <td align="center" width="5%">&nbsp;</td>
                      <td align="center" width="19%">&nbsp;</td>
                      <td align="center" width="19%"><strong>Zone</strong></td>
                      <td align="center" width="19%"><strong>Urgency</strong></td>
                      <td align="center" width="19%"><strong>Checkouts</strong></td>
                      <td align="center" width="19%"><strong>Unavailables</strong></td>
                      <td align="center" width="19%"><strong>Date</strong></td>
                    </tr>
                    <tr>
                      <td align="center" width="5%">&nbsp;</td>
                      <td align="center" width="19%">&nbsp;</td>
                      <td align="center" width="19%"><?=getZoneName($zone)?></td>
                      <td align="center" width="19%"><?=$urgency?></td>
                      <td align="center" width="19%"><?=$checkouts?></td>
                      <td align="center" width="19%"><?=$unavailables?></td>
                      <td align="center" width="19%"><? echo date("Y-m-d H:i:s", $senttime)?></td>
                    </tr>
                  </table>
                </fieldset><br>
                <fieldset>
                  <legend><strong>Petition</strong></legend>
                  <table width="100%">
                    <tr>
                      <td align="center" width="90%"><?=$petitiontext?></td>
                    </tr>
                  </table>
                </fieldset><br>
                <fieldset>
                  <table width="100%">
                    <tr>
                      <td align="center" width="1%"><strong>Checked Out</strong></td>
                      <td align="center" width="1%"><strong>GM</strong></td>
                      <td align="center" width="4%"><strong>GM Text</strong></td>
                    </tr>
                    <tr>
                      <td><select name="ischeckedout">
<?foreach($yesno as $key=>$value):?>
                        <option value="<?=$key?>"<?echo ($key == $ischeckedout)? " selected" : "";?>><?=$value?></option>
<?endforeach;?>
                      </select></td>
                      <td><input type="text" size="15" name="lastgm" value="<?=$lastgm?>"></td>
                      <td><textarea name="gmtext" rows=4 cols=54><?=$gmtext?></textarea></td>
                    </tr>
                  </table>
                </fieldset><br>
                <input type="hidden" name="dib" value="<?=$dib?>">
                <input type="submit" value="Submit Changes">
              </center>
            </div>
          </div>
        </form>
