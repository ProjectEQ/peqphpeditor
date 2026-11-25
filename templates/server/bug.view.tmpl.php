          <div class="table_container" style="width: 700px;">
            <div class="table_header">
            </div>
            <div class="edit_form_content">
              <form name="bug_status_change" method="post" action="index.php?editor=server&action=3">
              <table width="100%" cellpadding="3" cellspacing="3">
                <tr>
                  <td width="40%">
                    <fieldset>
                      <legend><strong>Bug Info</strong></legend>
                      <strong>ID:</strong> <?=$id?><br>
                      <strong>Date/Time:</strong> <?=htmlspecialchars((string)($report_datetime), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')?><br>
                      <strong>Category:</strong> <?echo $category_name . " (" . $category_id . ")";?><br>
                      <strong>Reporter:</strong> <?=htmlspecialchars((string)($reporter_name), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')?><br>
                      <strong>Zone:</strong> <?=htmlspecialchars((string)($zone), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')?><br>
                      <strong>Location:</strong> <?=$pos_x?>, <?=$pos_y?>, <?=$pos_z?>, <?=$heading?><br>
                      <strong>Target:</strong> <?echo ($target_name) ? $target_name . " (" . $target_id . ")" : "N/A";?>
                    </fieldset>
                  </td>
                  <td width="60%">
                    <fieldset>
                      <legend><strong>Client Info</strong></legend>
                      <strong>Account:</strong> <?echo getAccountName($account_id) . " (" . $account_id . ")";?><br>
                      <strong>Player:</strong> <?echo $character_name . " (" . $character_id . ")";?><br>
                      <strong>Client:</strong> <?echo $client_version_name . " (" . $client_version_id . ")";?><br>
                      <strong>Time Played:</strong> <?=$time_played?><br>
                      <strong>UI:</strong> <?=htmlspecialchars((string)($ui_path), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')?><br>
                      <strong>System:</strong> <?=htmlspecialchars((string)($system_info), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')?>
                    </fieldset>
                  </td>
                </tr>
              </table>
              <table width="100%" cellpadding="3" cellspacing="3">
                <tr>
                  <td>
                    <fieldset>
                      <legend><strong>Bug Report</strong></legend>
                      <table width="100%" cellpadding="3" cellspacing="3">
                        <tr>
                          <td width="25%"><input type="checkbox" name="_can_duplicate"<?echo ($_can_duplicate) ? " checked" : "";?> disabled><strong>Can Duplicate</strong></td>
                          <td width="25%"><input type="checkbox" name="_crash_bug"<?echo ($_crash_bug) ? " checked" : "";?> disabled><strong>Crash Bug</strong></td>
                          <td width="25%"><input type="checkbox" name="_target_info"<?echo ($_target_info) ? " checked" : "";?> disabled><strong>Target Info</strong></td>
                          <td width="25%"><input type="checkbox" name="_character_flags"<?echo ($_character_flags) ? " checked" : "";?> disabled><strong>Character Flags</strong></td>
                        </tr>
                        <tr>
                          <td colspan="4"><strong>Report Text:</strong><div style="white-space: pre-wrap; overflow-wrap: anywhere;"><?=htmlspecialchars((string)($bug_report), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')?></div></td>
                        </tr>
                        <tr>
                          <td>
                            <strong>Bug Status:</strong><br>
                            <select name="bug_status" onChange="toggleNotify();">
<?foreach($bugstatus as $key=>$value):?>
                              <option value="<?=$key?>"<?echo ($key == $bug_status)? " selected" : "";?>><?=$value?></option>
<?endforeach;?>
                            </select>
                          </td>
                        </tr>
                      </table>
                    </fieldset>
              <fieldset id="notify" style="display:none;">
                <legend><strong>Player Notification</strong></legend>
                <br><input type="checkbox" name="notify" value="notify" onChange="toggleNote();">Notify player of status change<br><br>
                Note to Player: (Optional)<br>
                <textarea name="optional_note" id="note" cols="80" rows="5" disabled="true"></textarea><br><br>
              <center>
                <input type="hidden" name="id" value="<?=$id?>">
                <input type="hidden" name="report_datetime" value="<?=htmlspecialchars((string)($report_datetime), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')?>">
                <input type="hidden" name="bug_report" value="<?=htmlspecialchars((string)($bug_report), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')?>">
                <input type="hidden" name="character_name" value="<?=htmlspecialchars((string)($character_name), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')?>">
                <input type="hidden" name="character_id" value="<?=$character_id?>">
                <input type="submit" value="Update Status">&nbsp;&nbsp;
                <input type="button" value="Cancel" onClick="history.back();">
              </center>
              </fieldset>
                  </td>
                </tr>
              </table>
              </form>
              <table width="100%" cellpadding="3" cellspacing="3">
                <tr>
                  <td>
                    <fieldset>
                      <legend><strong>Bug Review</strong></legend>
                      <form name="bug_review" method="post" action="index.php?editor=server&id=<?=$id?>&action=75">
                      <strong>Reviewed:</strong> <?echo ($last_reviewer != "None") ? $last_review . " by " . $last_reviewer : "Not Reviewed";?><br>
                      <strong>Review Notes:</strong> <?echo ($reviewer_notes) ? htmlspecialchars((string)($reviewer_notes), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : "N/A";?><br><br>
                      <strong>New Review:</strong><br>
                      <textarea name="new_review" cols="80" rows="5"></textarea><br>
                      <strong>New Reviewer Name:</strong><br>
                      <input type="text" name="new_reviewer" size="10" value="Admin"><br>
                      <center>
                        <input type="hidden" name="id" value="<?=$id?>">
                        <input type="submit" value="Add New Review">&nbsp;&nbsp;
                        <input type="button" value="Cancel" onClick="history.back();">
                      </center>
                      </form>
                    </fieldset>
                  </td>
                </tr>
              </table>
            </div>
          </div>
