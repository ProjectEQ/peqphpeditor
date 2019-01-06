  <div id="searchbar">
    <table width="100%">
      <tr>
        <td>
          <strong>1.</strong> 
          <form action="index.php" method="GET">
            <input type="hidden" name="editor" value="auras">
            <input type="hidden" name="action" value="8">
            <select onChange="gotosite(this.options[this.selectedIndex].value)">
              <option value="">Select an Aura</option>
<?foreach ($auras as $aura):?>
              <option value="index.php?editor=auras&type=<?=$aura['type']?>&action=2"<?echo ($aura['type'] == $_GET['type']) ? " selected" : "";?>><?=$aura['type']?> - <?=$aura['name']?></option>
<?endforeach;?>
            </select>
            or <strong>2.</strong> Search by <input type="text" name="name" size="22" value="Name" onFocus="clearField(document.forms[0].name);document.forms[0].npc.value='NPC ID';document.forms[0].spell.value='Spell ID';">
            or by <input type="text" name="npc" size="8" value="NPC ID" onFocus="clearField(document.forms[0].npc);document.forms[0].name.value='Name';document.forms[0].spell.value='Spell ID';">
            or by <input type="text" name="spell" size="8" value="Spell ID" onFocus="clearField(document.forms[0].spell);document.forms[0].name.value='Name';document.forms[0].npc.value='NPC ID'">
            <input type="submit" value=" GO ">
          </form>
        </td>
      </tr>
    </table>
  </div>
