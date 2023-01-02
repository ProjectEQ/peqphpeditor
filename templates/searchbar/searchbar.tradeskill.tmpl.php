  <div id="searchbar">
    <table width="100%">
      <tr>
        <td>
          <strong>1.</strong>
          <select OnChange="gotosite(this.options[this.selectedIndex].value)">
            <option value="">Select a Tradeskill</option>
<?
if (isset($tradeskills) && is_array($tradeskills)):
  foreach ($tradeskills as $k => $v):
?>
            <option value="index.php?editor=tradeskill&ts=<?=$k?>"<?echo ($currts == $k) ? " selected" : "";?>><?=$v?></option>
<?
  endforeach;
endif;
?>
          </select>
          &nbsp; and &nbsp;
          <select OnChange="gotosite(this.options[this.selectedIndex].value)">
            <option value="">Select a Recipe</option>
<?
if (isset($recipes) && is_array($recipes)):
  foreach ($recipes as $k => $v):
?>
            <option value="index.php?editor=tradeskill&ts=<?=$currts?>&rec=<?=$v['id']?>"<?echo ($currrec == $v['id']) ? " selected" : "";?>><?=$v['name']?></option>
<?
  endforeach;
endif;
?>
          </select>
        </td>
        <td align="right"> or <strong>&nbsp;2.</strong> Search by 
          <form action="index.php" method="GET">
            <input type="hidden" name="editor" value="tradeskill">
            <input type="hidden" name="action" value="9">
            <input type="text" name="itemid" size="5" value="Item ID" onFocus="clearField(document.forms[0].itemid);document.forms[0].search.value='Recipe Name';"> or <input type="text" name="search" size="12" value="Recipe Name" onFocus="clearField(document.forms[0].search);document.forms[0].itemid.value='Item ID';">
            <input type="submit" value=" GO ">
          </form>
        </td>
      </tr>
    </table>
  </div>
