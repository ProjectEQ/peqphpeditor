<?if($errors != ''):?>
<?foreach($errors as $error):?>
      <div class="error">
        <table width="100%">
          <tr>
            <td valign="middle" width="30px"><img src="images/caution.gif"></td>
            <td style="padding:0px 5px;"><?=$error?></td>
          </tr>
        </table>
      </div>
<?endforeach;?>
<?endif;?>
  <?$export_sql = export_recipe_sql();?>
  <div id="sql_block" style="display:none;">
    <center>
      <textarea id="sql_text" rows="3" cols="90"><?=$export_sql?></textarea><br/><br/>
      <button type="button" id="copy_sql" onClick="clipboardData.setData('Text', sql_text.value);">Copy SQL to Clipboard</button>&nbsp;
      <button type="button" id="hide_sql" onClick="document.getElementById('sql_block').style.display='none';document.getElementById('sql_image').style.display='inline';">Hide SQL</button>
    </center><br/>
  </div>
      <div class="table_container" style="width:350px;">
        <div class="table_header">
          <div style="float: right">
            <a onClick="document.getElementById('sql_block').style.display='block';document.getElementById('sql_image').style.display='none';"><img id="sql_image" src="images/sql.gif" border="0" title="Show SQL"></a>
            <a href="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&action=1"><img src="images/c_table.gif" border="0" title="Edit Recipe"></a>
            <a onClick="return confirm('Really Copy Recipe <?=$id?>?');" href="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&action=12"><img src="images/last.gif" border="0" title="Copy Recipe"></a>
            <a onClick="return confirm('Really Delete Recipe <?=$id?>?');" href="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&action=3"><img src="images/remove3.gif" border="0" title="Delete Recipe"></a>
          </div>
          Recipe <?=$id?>: "<?=$name?>"
        </div>
        <div class="table_content">
          <strong>Tradeskill:</strong> <?=$tradeskills[$tradeskill]?><br/>
          <strong>Min Skill:</strong> <?=$skillneeded?><br/>
          <strong>Trivial</strong>: <?=$trivial?><br/>
          <strong>No Fail:</strong> <?=$yesno[$nofail]?><br/>
          <strong>Replace Container:</strong> <?=$yesno[$replace_container]?><br/>
          <strong>Quest Controlled:</strong> <?=$yesno[$quest]?><br/>
          <strong>Learn Flag:</strong> <?echo ($must_learn) ? "Yes" : "No";?><br/>
          <strong>Enabled:</strong> <?=$yesno[$enabled]?><br/>
          <strong>Notes:</strong> <?=$notes?>
        </div>
      </div>
      <br/>
      <div class="table_container">
        <div class="table_header">
          <div style="float:right;">
            <a href="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&action=7"><img src="images/add.gif" border="0" title="Add item to recipe"></a>
          </div>
          Recipe Details
        </div>
        <div class="table_content">
        <fieldset>
          <legend><strong>Containers</strong></legend>
<?php if (!isset($containers) || $containers == ''):?>
          No combine containers specified
<?endif;?>
<?php if (isset($containers) && $containers != ''):?>
          <table width="100%" cellspacing="0" cellpadding="0">
<?php foreach ($containers as $container): extract($container);?>
            <tr>
              <td width="40%">
                <?if($item_id < 1001):?>
                <?=$name?> (<?=$item_id?>)
                <?endif;?>
                <?if($item_id > 1000):?>
                <?=$name?> (<a href="index.php?editor=items&ts=<?=$ts?>&rec=<?=$rec?>&tsid=<?=$id?>&id=<?=$item_id?>&action=2"><?=$item_id?></a>)
                <?endif;?>
              </td>
              <td width="15%">
                [<a href="http://lucy.allakhazam.com/item.html?id=<?=$item_id?>">Lucy</a>]
              </td>
              <td align="center" width="15%">
                &nbsp;
              </td>
              <td align="center" width="15%">
                &nbsp;
              </td>
              <td align="right" width="15%">
                <a href="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&id=<?=$id?>&action=5"><img src="images/edit2.gif" border="0" title="Edit this container"></a>&nbsp;
                <a href="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&id=<?=$id?>&action=4" onClick="return confirm('Really delete this container?');"><img src="images/remove.gif" border="0" title="Delete this container"></a>
              </td>
            </tr>
<?endforeach;?>
          </table>
<?endif;?>
          </fieldset><br/><br/>
        <fieldset>
          <legend><strong>Components</strong></legend>
<?php if (!isset($components) || $components == ''):?>
          No components specified
<?endif;?>
<?php if (isset($components) && $components != ''):?>
          <table width="100%" cellspacing="0" cellpadding="0">
<?php foreach ($components as $component): extract($component);?>
            <tr>
              <td width="40%">
                <?=$name?> (<a href="index.php?editor=items&ts=<?=$ts?>&rec=<?=$rec?>&tsid=<?=$id?>&id=<?=$item_id?>&action=2"><?=$item_id?></a>)
              </td>
              <td width="15%">
                [<a href="http://lucy.allakhazam.com/item.html?id=<?=$item_id?>">Lucy</a>]
              </td>
              <td align="center" width="10%">
                Qty: <?=$componentcount?>
              </td>
              <td align="center" width="10%">
                Returned: <?=$failcount?>
              </td>
              <td align="center" width="10%">
               Salvage: <?=$salvagecount?>
              </td>
              <td align="right" width="15%">
                <a href="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&id=<?=$id?>&action=5"><img src="images/edit2.gif" border="0" title="Edit this component"></a>&nbsp;
                <a href="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&id=<?=$id?>&action=4" onClick="return confirm('Really delete this component?');"><img src="images/remove.gif" border="0" title="Delete this component"></a>
              </td>
            </tr>
<?endforeach;?>
          </table>
<?endif;?>
          </fieldset><br/><br/>
        <fieldset>
          <legend><strong>Products</strong></legend>
<?php if (!isset($products) || $products == ''):?>
            No products specified
<?endif;?>
<?php if (isset($products) && $products != ''):?>
          <table width="100%" cellspacing="0" cellpadding="0">
<?php foreach ($products as $product): extract($product);?>
            <tr>
              <td width="40%">
                <?=$name?> (<a href="index.php?editor=items&ts=<?=$ts?>&rec=<?=$rec?>&tsid=<?=$id?>&id=<?=$item_id?>&action=2"><?=$item_id?></a>)
              </td>
              <td width="15%">
                [<a href="http://lucy.allakhazam.com/item.html?id=<?=$item_id?>">Lucy</a>]
              </td>
              <td align="center" width="15%">
                Qty: <?=$successcount?>
              </td>
              <td align="center" width="15%">
                &nbsp;
              </td>
              <td align="right" width="15%">
                <a href="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&id=<?=$id?>&action=5"><img src="images/edit2.gif" border="0" title="Edit this product"></a>&nbsp;
                <a href="index.php?editor=tradeskill&ts=<?=$ts?>&rec=<?=$rec?>&id=<?=$id?>&action=4" onClick="return confirm('Really delete this product?');"><img src="images/remove.gif" border="0" title="Delete this product"></a>
              </td>
            </tr>
<?endforeach;?>
          </table>
<?endif;?>
          </fieldset>
        </div>
      </div>
