  <div id="searchbar">
    <table width="100%">
      <tr>
        <td>
          <strong>1.</strong>
          <form action="index.php" method="GET">
            <input type="hidden" name="editor" value="items">
            <input type="hidden" name="action" value="1">
            <input type="text" name="id" size="7" value="ID" onFocus="clearField(document.forms[0].id);document.forms[0].search.value='Enter an Item';"> or <input type="text" name="search" size="22" value="Enter an Item" onFocus="clearField(document.forms[0].search);document.forms[0].id.value='ID';">
<?php if (!empty($item_kinbound_available)): ?>
            <label for="kinbound_filter">Kinbound:</label>
            <select name="kinbound" id="kinbound_filter">
              <option value="">Any policy</option>
<?php foreach (item_kinbound_options() as $value => $label): ?>
              <option value="<?=$value?>"<?=isset($kinbound_filter) && $kinbound_filter === (string) $value ? ' selected' : ''?>><?=$label?></option>
<?php endforeach; ?>
            </select>
<?php endif; ?>
            <input type="submit" value=" GO ">
          </form>
        </td>
      </tr>
    </table>
  </div>
