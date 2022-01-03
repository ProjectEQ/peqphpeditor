<script language="javascript">
  function expand_races() {
    document.getElementById("races_show").style.display = "none";
    document.getElementById("races_hide").style.display = "block";
    document.getElementById("races").style.display = "block";
  }
  function collapse_races() {
    document.getElementById("races_show").style.display = "block";
    document.getElementById("races_hide").style.display = "none";
    document.getElementById("races").style.display = "none";
  }
  function expand_classes() {
    document.getElementById("classes_show").style.display = "none";
    document.getElementById("classes_hide").style.display = "block";
    document.getElementById("classes").style.display = "block";
  }
  function collapse_classes() {
    document.getElementById("classes_show").style.display = "block";
    document.getElementById("classes_hide").style.display = "none";
    document.getElementById("classes").style.display = "none";
  }
  function expand_bodytypes() {
    document.getElementById("bodytypes_show").style.display = "none";
    document.getElementById("bodytypes_hide").style.display = "block";
    document.getElementById("bodytypes").style.display = "block";
  }
  function collapse_bodytypes() {
    document.getElementById("bodytypes_show").style.display = "block";
    document.getElementById("bodytypes_hide").style.display = "none";
    document.getElementById("bodytypes").style.display = "none";
  }
  function expand_zones() {
    document.getElementById("zones_show").style.display = "none";
    document.getElementById("zones_hide").style.display = "block";
    document.getElementById("zones").style.display = "block";
  }
  function collapse_zones() {
    document.getElementById("zones_show").style.display = "block";
    document.getElementById("zones_hide").style.display = "none";
    document.getElementById("zones").style.display = "none";
  }
</script>
    
  <form name="global_loot_add" method="post" action="index.php?editor=loot&id=<?=$id?>&action=51">
    <div class="edit_form">
      <div class="edit_form_header">Add Global Loot</div>
      <div class="edit_form_content">
        <table width="100%" cellpadding="3" cellspacing="0" border="0">
          <tr>
            <td>
              <strong>ID:</strong><br>
              <input type="text" size="15" name="id" value="<?=$new_id?>">
            </td>
            <td>&nbsp;</td>
            <td colspan="2">
              <strong>Description:</strong><br>
              <input type="text" size="50" name="description" value="">
            </td>
            <td>
              <strong>Enabled:</strong><br>
              <select name="enabled" style="width: 80px;">
                <option value="0">No</option>
                <option value="1" selected>Yes</option>
              </select>
            </td>
            <td>
              <strong>Hot Zone:</strong><br>
              <select name="hot_zone" style="width: 80px;">
                <option value="-1" selected>Not Used</option>
                <option value="0">Must Not Be</option>
                <option value="1">Must Be</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <strong>Loottable ID:</strong><br>
              <input type="text" size="15" name="loottable_id" value="<?=$new_table_id?>">
            </td>
            <td>&nbsp;</td>
            <td>
              <strong>Rare:</strong><br>
              <select name="rare" style="width: 120px;">
                <option value="">Unused</option>
                <option value="0">Must Not Be</option>
                <option value="1">Must Be</option>
              </select>
            </td>
            <td>
              <strong>Raid:</strong><br>
              <select name="raid" style="width: 120px;">
                <option value="">Unused</option>
                <option value="0">Must Not Be</option>
                <option value="1">Must Be</option>
              </select>
            </td>
            <td>
              <strong>Min Level:</strong><br>
              <input type="text" size="7" name="min_level" value="0">
            </td>
            <td>
              <strong>Max Level:</strong><br>
              <input type="text" size="7" name="max_level" value="0">
            </td>
          </tr>
          <tr>
            <td>
              <strong>Min Expansion</strong><br>
              <input type="text" size="15" name="min_expansion" value="-1">
            </td>
            <td>&nbsp;</td>
            <td>
              <strong>Max Expansion</strong><br>
              <input type="text" size="15" name="max_expansion" value="-1">
            </td>
            <td>
              <strong>Content Flags</strong><br>
              <input type="text" size="25" name="content_flags" value="">
            </td>
            <td colspan="2">
              <strong>Content Flags Disabled</strong><br>
              <input type="text" size="25" name="content_flags_disabled" value="">
            </td>
          </tr>
          <tr>
            <td colspan="6">
              <fieldset>
                <legend><strong>Races</strong></legend>
                <table width="100%">
                  <tr>
                    <td align="left">
                      (| = Delimiter)(blank = ALL)
                    </td>
                    <td align="right">
                      <div id="races_show">
                        <a href="#" title="Show Race Codes" onClick="expand_races();">[+]</a> Show Race Codes
                      </div>
                      <div id="races_hide" style="display: none;">
                        <a href="#" title="Hide Race Codes" onClick="collapse_races();">[-]</a> Hide Race Codes
                      </div>
                    </td>
                  </tr>
                </table>
                <br>
                <div id="races" style="display: none;">
<?
  $x = 0;
  echo "<table width='100%' cellpadding='0' cellspacing='0'>";
  echo "  <tr>";
  foreach ($races as $k=>$v) {
    echo "    <td width='25%'>$k - $v</td>";
    $x++;
    if ($x % 4 == 0) {
      echo "  </tr>";
      echo "  <tr>";
    }
  }
  echo "  </tr>";
  echo "</table><br>";
?>
                </div>
                <input type="text" size="117" name="race" value="">
              </fieldset><br>
            </td>
          </tr>
          <tr>
            <td colspan="6">
              <fieldset>
                <legend><strong>Classes</strong></legend>
                <table width="100%">
                  <tr>
                    <td align="left">
                      (| = Delimiter)(blank = ALL)
                    </td>
                    <td align="right">
                      <div id="classes_show">
                        <a href="#" title="Show Class Codes" onClick="expand_classes();">[+]</a> Show Class Codes
                      </div>
                      <div id="classes_hide" style="display: none;">
                        <a href="#" title="Hide Class Codes" onClick="collapse_classes();">[-]</a> Hide Class Codes
                      </div>
                    </td>
                  </tr>
                </table>
                <br>
                <div id="classes" style="display: none;">
<?
  $x = 0;
  echo "<table width='100%' cellpadding='0' cellspacing='0'>";
  echo "  <tr>";
  foreach ($classes as $k=>$v) {
    echo "    <td width='25%'>$k - $v</td>";
    $x++;
    if ($x % 4 == 0) {
      echo "  </tr>";
      echo "  <tr>";
    }
  }
  echo "  </tr>";
  echo "</table><br>";
?>
                </div>
                <input type="text" size="117" name="class" value="">
              </fieldset><br>
            </td>
          </tr>
          <tr>
            <td colspan="6">
              <fieldset>
                <legend><strong>Bodytypes</strong></legend>
                <table width="100%">
                  <tr>
                    <td align="left">
                      (| = Delimiter)(blank = ALL)
                    </td>
                    <td align="right">
                      <div id="bodytypes_show">
                        <a href="#" title="Show Bodytype Codes" onClick="expand_bodytypes();">[+]</a> Show Bodytype Codes
                      </div>
                      <div id="bodytypes_hide" style="display: none;">
                        <a href="#" title="Hide Bodytype Codes" onClick="collapse_bodytypes();">[-]</a> Hide Bodytype Codes
                      </div>
                    </td>
                  </tr>
                </table>
                <br>
                <div id="bodytypes" style="display: none;">
<?
  $x = 0;
  echo "<table width='100%' cellpadding='0' cellspacing='0'>";
  echo "  <tr>";
  foreach ($bodytypes as $k=>$v) {
    echo "    <td width='25%'>$k - $v</td>";
    $x++;
    if ($x % 4 == 0) {
      echo "  </tr>";
      echo "  <tr>";
    }
  }
  echo "  </tr>";
  echo "</table><br>";
?>
                </div>
                <input type="text" size="117" name="bodytype" value="">
              </fieldset><br>
            </td>
          </tr>
          <tr>
            <td colspan="6">
              <fieldset>
                <legend><strong>Zones</strong></legend>
                <table width="100%">
                  <tr>
                    <td align="left">
                      (| = Delimiter)(blank = ALL)
                    </td>
                    <td align="right">
                      <div id="zones_show">
                        <a href="#" title="Show Zone Codes" onClick="expand_zones();">[+]</a> Show Zone Codes
                      </div>
                      <div id="zones_hide" style="display: none;">
                        <a href="#" title="Hide Zone Codes" onClick="collapse_zones();">[-]</a> Hide Zone Codes
                      </div>
                    </td>
                  </tr>
                </table>
                <br>
                <div id="zones" style="display: none;">
<?
  $x = 0;
  echo "<table width='100%' cellpadding='0' cellspacing='0'>";
  echo "  <tr>";
  foreach ($zoneids as $k=>$v) {
    echo "    <td width='25%'>$k - $v</td>";
    $x++;
    if ($x % 4 == 0) {
      echo "  </tr>";
      echo "  <tr>";
    }
  }
  echo "  </tr>";
  echo "</table><br>";
?>
                </div>
                <input type="text" size="117" name="zone" value="">
              </fieldset><br>
            </td>
          </tr>
        </table>
        <center>
          <input type="submit" value="Add Global Loot">&nbsp;&nbsp;
          <input type="button" value="Cancel" onClick="history.back();">
        </center>
      </div>
    </div>
  </form>
