  <table class="edit_form">
    <tr>
      <td class="edit_form_header">Options</td>
    </tr>
    <tr>
      <td class="edit_form_content">
        <center><a href="index.php?editor=items&action=8">Create an Item</a></center>
        <center><a href="index.php?editor=items&action=10">Starting Items</a></center>
        <center><a href="index.php?editor=items&action=19">Evolving Items</a></center>
        <center><a href="index.php?editor=items&action=16">View Books</a></center>
        <center><a href="index.php?editor=items&action=17">Review Imported Items</a></center>
      </td>
    </tr>
  </table>

<?php
if (isset($latest_items) && !empty($latest_items)) {
?>
<div class="table_container" style="margin-top: 20px;">
  <div class="table_header">
    Latest Items
  </div>
    <table class="table_content2" width="100%" cellspacing="0" cellpadding="5">
      <?php foreach ($latest_items as $x => $item) { ?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td><a href="index.php?editor=items&id=<?php echo $item['id']; ?>&action=2"><?php echo $item['id']; ?></a></td>
        <td><?php echo $item['name']; ?></td>
        <td>
          <?php 
          if (isset($itemtypes[$item['itemtype']])) {
            echo $itemtypes[$item['itemtype']];
          } else {
            echo 'UNKNOWN';
          }
          ?>
        </td>
        <td><?php echo $item['updated']; ?></td>
        <td align="right">
          <a href="index.php?editor=items&id=<?php echo $item['id']; ?>&action=2"><img src="images/edit2.gif" width="13" height="13" border="0" title="View Item"></a>
          <a href="index.php?editor=items&id=<?php echo $item['id']; ?>&action=7" onClick="return confirm('Really Copy Item <?php echo $item['id']; ?>?');"><img src="images/last.gif" border="0" title="Copy this Item"></a>
          <a href="index.php?editor=items&id=<?php echo $item['id']; ?>&action=5" onClick="return confirm('Really Delete Item <?php echo $item['id']; ?>?');"><img src="images/table.gif" border="0" title="Delete this Item"></a>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>
</div>
<?php
}
?>
