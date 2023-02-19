  <div class="table_container" style="width: 600px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td align="right"><a href="index.php?editor=mercs&action=86"><img src="images/add.gif" title="Add Mercenary Merchant Template"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($templates)):?>
      <tr>
        <td align="center" width="20%"><strong>ID</strong></td>
        <td align="center" width="50%"><strong>Name</strong></td>
        <td align="center" width="20%"><strong>QGlobal</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($templates as $template):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="20%"><?=$template['merc_merchant_template_id']?></td>
        <td align="center" width="50%"><?=$template['name']?></td>
        <td align="center" width="20%"><?echo ($template['qglobal'] != "") ? $template['qglobal'] : "N/A";?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=mercs&merc_merchant_template_id=<?=$template['merc_merchant_template_id']?>&action=91"><img src="images/view_all.gif" width="13" height="13" border="0"></a>&nbsp;
          <a href="index.php?editor=mercs&merc_merchant_template_id=<?=$template['merc_merchant_template_id']?>&action=90" onClick="return confirm('Really delete template and associated entries?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Mercenary Merchant Template"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary Merchant Templates</td>
      </tr>
<?endif;?>
    </table>
  </div>
