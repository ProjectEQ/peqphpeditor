  <center>
    <iframe id='searchframe' src='templates/iframes/spellsearch.php'></iframe>
    <input id="button" type="button" value='Hide Spell Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
  </center>
  <div class="table_container" style="width: 700px">
    <div class="edit_form_header">Edit Spellset</div>
    <div class="edit_form_content">
      <form method="post" action="index.php?editor=spellset&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&spellset=<?=$spellset?>&action=2">
        <table width="100%" cellpadding="5" cellspacing="3">
          <tr>
            <td colspan="2">
              <strong>Spellset Name:</strong><br>
              <input type="text" name="name" size="25" value="<?=$name?>">
            </td>
            <td colspan="2">
              <strong>Parent list:</strong><br>
              <input type="text" name="parent_list" size="10" value="<?=$parent_list?>">
            </td>
            <td>
              <strong>Fail Recast:</strong><br>
              <input type="text" name="fail_recast" size="3" value="<?=$fail_recast?>">
            </td>
          </tr>
          <tr>
            <td>
              <fieldset>
                <legend><strong>Attack Proc</strong></legend>
                <strong>Spell ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
                <input id="id" type="text" name="attack_proc" size="10" value="<?=$attack_proc?>"><br>
                (-1 = No Proc)<br><br>
                <strong>Chance:</strong><br>
                <input type="text" name="proc_chance" size="2" value="<?=$proc_chance?>">%
              </fieldset>
            </td>
            <td>&nbsp;</td>
            <td>
              <fieldset>
                <legend><strong>Range Proc</strong></legend>
                <strong>Spell ID:</strong><br>
                <input id="rid" type="text" name="range_proc" size="10" value="<?=$range_proc?>"><br>
                (-1 = No Proc)<br><br>
                <strong>Chance:</strong><br>
                <input type="text" name="rproc_chance" size="2" value="<?=$rproc_chance?>">%
              </fieldset>
            </td>
            <td>&nbsp;</td>
            <td>
              <fieldset>
                <legend><strong>Defensive Proc</strong></legend>
                <strong>Spell ID:</strong><br>
                <input id="d_id" type="text" name="defensive_proc" size="10" value="<?=$defensive_proc?>"><br>
                (-1 = No Proc)<br><br>
                <strong>Chance:</strong><br>
                <input type="text" name="dproc_chance" size="2" value="<?=$dproc_chance?>">%
              </fieldset>
            </td>
          </tr>
          <tr>
            <td>
              <fieldset>
                <legend><strong>Engaged</strong></legend>
                <table width="100%" cellpadding="3" cellspacing="2">
                  <tr>
                    <td>
                      <strong>b_self_chance</strong><br>
                      <input type="text" name="engaged_b_self_chance" size="3" value="<?=$engaged_b_self_chance?>">
                    </td>
                    <td>
                      <strong>no_sp_recast_min</strong><br>
                      <input type="text" name="engaged_no_sp_recast_min" size="3" value="<?=$engaged_no_sp_recast_min?>">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>b_other_chance</strong><br>
                      <input type="text" name="engaged_b_other_chance" size="3" value="<?=$engaged_b_other_chance?>">
                    </td>
                    <td>
                      <strong>no_sp_recast_max</strong><br>
                      <input type="text" name="engaged_no_sp_recast_max" size="3" value="<?=$engaged_no_sp_recast_max?>">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>d_chance</strong><br>
                      <input type="text" name="engaged_d_chance" size="3" value="<?=$engaged_d_chance?>">
                    </td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </fieldset>
            </td>
            <td>&nbsp;</td>
            <td>
              <fieldset>
                <legend><strong>Pursue</strong></legend>
                <table width="100%" cellpadding="3" cellspacing="2">
                  <tr>
                    <td>
                      <strong>no_sp_recast_min</strong><br>
                      <input type="text" name="pursue_no_sp_recast_min" size="3" value="<?=$pursue_no_sp_recast_min?>">
                    </td>
                    <td>
                      <strong>d_chance</strong><br>
                      <input type="text" name="pursue_d_chance" size="3" value="<?=$pursue_d_chance?>">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>no_sp_recast_max</strong><br>
                      <input type="text" name="pursue_no_sp_recast_max" size="3" value="<?=$pursue_no_sp_recast_max?>">
                    </td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </fieldset>
            </td>
            <td>&nbsp;</td>
            <td>
              <fieldset>
                <legend><strong>Idle</strong></legend>
                <table width="100%" cellpadding="3" cellspacing="2">
                  <tr>
                    <td>
                      <strong>no_sp_recast_min</strong><br>
                      <input type="text" name="idle_no_sp_recast_min" size="3" value="<?=$idle_no_sp_recast_min?>">
                    </td>
                    <td>
                      <strong>b_chance</strong><br>
                      <input type="text" name="idle_b_chance" size="3" value="<?=$idle_b_chance?>">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>no_sp_recast_max</strong><br>
                      <input type="text" name="idle_no_sp_recast_max" size="3" value="<?=$idle_no_sp_recast_max?>">
                    </td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </fieldset>
            </td>
          </tr>
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="submit" name="submit" value="Update">&nbsp;&nbsp;<input type="button" name="cancel" value="Cancel" onClick="history.back();">
        </center>
      </form>
    </div>
  </div>
