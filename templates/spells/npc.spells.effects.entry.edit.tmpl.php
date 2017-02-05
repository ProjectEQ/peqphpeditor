    <div class="table_container" style="width: 450px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td>Edit NPC Spells Effects Entry</td>
          </tr>
        </table>
      </div>
      <div class="table_content">
        <form name="nsee" method="post" action="index.php?editor=spells&action=21&nseid=<?=$npc_spells_effects_id?>">
          <table width="100%" cellpadding="6" cellspacing="0">
            <tr>
              <td>
                <strong>ID:</strong><br>
                <input type="text" name="id" value="<?=$id?>" disabled="disabled" size="5">
              </td>
              <td>
                <strong>NPC SE ID:</strong><br>
                <input type="text" name="npc_spells_effects_id" value="<?=$npc_spells_effects_id?>" disabled="disabled" size="5">
              </td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3">
                <strong>Spell Effect ID:</strong><br>
                <select name="spell_effect_id">
<?
  foreach ($sp_effects as $k=>$v):
?>
                  <option value="<?=$k?>"<?echo ($k == $spell_effect_id) ? " selected" : (($current && in_array($k, $current)) ? " disabled" : "");?>><?=$k?> - <?=$v?></option>
<?
  endforeach;
?>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Min Level:</strong><br>
                <input type="text" name="minlevel" value="<?=$minlevel?>" size="3">
              </td>
              <td>
                <strong>Max Level:</strong><br>
                <input type="text" name="maxlevel" value="<?=$maxlevel?>" size="3">
              </td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
                <strong>SE Base:</strong><br>
                <input type="text" name="se_base" value="<?=$se_base?>" size="7">
              </td>
              <td>
                <strong>SE Limit:</strong><br>
                <input type="text" name="se_limit" value="<?=$se_limit?>" size="7">
              </td>
              <td>
                <strong>SE Max:</strong><br>
                <input type="text" name="se_max" value="<?=$se_max?>" size="7">
              </td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
          </table>
          <center>
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="hidden" name="npc_spells_effects_id" value="<?=$npc_spells_effects_id?>">
            <input type="submit" value="Update Entry">
            <input type="button" value="Cancel Changes" onClick="history.back()">
          </center>
        </form>
      </div>
    </div>
