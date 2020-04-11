  <script>
    function showSearch() {
      document.getElementById("searchframe").style.display = "block";
      document.getElementById("button").style.display = "block";
    }

    function hideSearch() {
      document.getElementById("searchframe").style.display = "none";
      document.getElementById("button").style.display = "none";
    }

    function updateRawTarget(val) {
      if (val == "useraw") {
        document.aa_action.raw_target.disabled = false;
      }
      else {
        document.aa_action.raw_target.value = val;
        document.aa_action.raw_target.disabled = true;
      }
    }
  </script>
  <center>
    <iframe id="searchframe" src="templates/iframes/spellsearch.php"></iframe>
    <input id="button" type="button" value="Hide AA Search" onclick="hideSearch();" style="display:none; margin-bottom:20px;">
  </center>
  <div class="edit_form" style="width:400px;">
    <div class="edit_form_header">
<?
  if ($editmode == 1)
    echo "Edit AA Action";
  else
    echo "Add New AA Action";
?>
    <br>
    </div>
    <div class="edit_form_content">
      <form name="aa_action" method="post" action="index.php?editor=aa&aaid=<?=($aaid)?>&rank=<?=$rank?>&action=<?if ($editmode == 1) echo "14"; else echo "18";?>">
        <fieldset>
          <legend><b>Spell</b></legend>
          <table width="100%">
            <tr>
              <td style="width:80px;">
                <a href="javascript:showSearch();" title="Click to show spell search">Spell ID:</a><br>
                <input id="id" type="text" name="spell_id" size="5" value="<?=$spell_id?>"><br>
              </td>
              <td>
                Target Override:<br>
                <select name="target" onchange="updateRawTarget(this.value)">
<? foreach ($aa_action_target as $k => $v) :?>
                  <option value="<?=$k?>"<?if($k == $target) echo "selected=\"selected\"";?>><?=$v?></option>
<? endforeach;?>
                  <option value="useraw">Use Raw</option>
                </select>
                <input type="text" name="raw_target" size="5" value="<?=$target?>"<?if(isset($aa_action_target[$target])) echo "disabled";?>><br>
              </td>
              <td>
                Reuse Time:<br>
                <input type="text" name="reuse_time" size="7" value="<?=$reuse_time?>"><br>
              </td>
            </tr>
          </table>
        </fieldset>
        <fieldset>
          <legend><b>Non-spell</b></legend>
          <table width="100%">
            <tr>
              <td>
                Action:<br>
                <input type="text" name="nonspell_action" size="5" value="<?=$nonspell_action?>"><br>
              </td>
              <td>
                Mana:<br>
                <input type="text" name="nonspell_mana" size="5" value="<?=$nonspell_mana?>"><br>
              </td>
              <td>
                Duration:<br>
                <input type="text" name="nonspell_duration" size="5" value="<?=$nonspell_duration?>"><br>
              </td>
            </tr>
          </table>
        </fieldset>
        <fieldset>
          <legend><b>Reuse Reduction</b></legend>
          <table width="100%">
            <tr>
              <td>
                Redux AA:<br>
                <input type="text" name="redux_aa" size="5" value="<?=$redux_aa?>"><br>
              </td>
              <td>
                Redux Rate:<br>
                <input type="text" name="redux_rate" size="5" value="<?=$redux_rate?>"><br>
              </td>
              <td>
                Redux AA 2:<br>
                <input type="text" name="redux_aa2" size="5" value="<?=$redux_aa2?>"><br>
              </td>
              <td>
                Redux Rate 2:<br>
                <input type="text" name="redux_rate2" size="5" value="<?=$redux_rate2?>"><br>
              </td>
            </tr>
          </table>
        </fieldset><br>
        <center><input type="submit" value="Sumbit Changes"></center>
      </form>
    </div>
  </div>
