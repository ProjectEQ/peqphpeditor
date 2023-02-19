  <div class="table_container" style="width: 250px;">
    <div class="table_header">
      <div style="float:right">
        <a href="index.php?editor=mercs&merc_merchant_template_id=<?=$template['merc_merchant_template_id']?>&action=88"><img src="images/edit2.gif" border="0" title="Edit Merc Merchant Template"></a>          
        <a href="index.php?editor=mercs&merc_merchant_template_id=<?=$template['merc_merchant_template_id']?>&action=90" onClick="return confirm('Really delete template and all associated entries?');"><img src="images/remove3.gif" border="0" title="Delete this template"></a>
      </div>
      Merc Merchant Template Data
    </div>
    <div class="table_content">
      <strong>ID:</strong> <?=$template['merc_merchant_template_id']?><br>
      <strong>Name:</strong> <?=$template['name']?><br>
      <strong>QGlobal:</strong> <?echo ($template['qglobal'] != "") ? $template['qglobal'] : "N/A";?>
    </div>
  </div><br><br>
  <div class="table_container" style="width: 350px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Templates</td>
          <td align="right">    
            <a href="index.php?editor=mercs&merc_merchant_template_id=<?=$template['merc_merchant_template_id']?>&action=92"><img src="images/add.gif" border="0" title="Add a template entry"></a>
          </td>
        </tr>        
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if(isset($t_entries)):?>
      <tr>
        <td align="center" width="45%"><strong>ID</strong></td>
        <td align="center" width="45%"><strong>Merc Template</strong></td>
        <td width="10%"></td>
      </tr>
<?$x=0; foreach($t_entries as $t):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="45%"><?=$t['merc_merchant_template_entry_id']?></td>
        <td align="center" width="45%"><?=$t['merc_template_id']?></td>
        <td align="right">      
          <a href="index.php?editor=mercs&merc_merchant_template_entry_id=<?=$t['merc_merchant_template_entry_id']?>&action=94"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
          <a href="index.php?editor=mercs&merc_merchant_template_entry_id=<?=$t['merc_merchant_template_entry_id']?>&merc_merchant_template_id=<?=$t['merc_merchant_template_id']?>&action=96" onClick="return confirm('Really delete this template entry?');"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
        </td>
      </tr>
<?$x++;endforeach;?>
<?else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary Template Entries</td>
      </tr>
<?endif;?>
    </table>
  </div><br><br>
  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Merchants</td>
          <td align="right">    
            <a href="index.php?editor=mercs&merc_merchant_template_id=<?=$template['merc_merchant_template_id']?>&action=97"><img src="images/add.gif" border="0" title="Add a merchant"></a>
          </td>
        </tr>        
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if(isset($m_entries)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="40%"><strong>Merchant</strong></td>
        <td width="10%"></td>
      </tr>
<?$x=0; foreach($m_entries as $m):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$m['merc_merchant_entry_id']?></td>
        <td align="center" width="10%"><?=getNPCName($m['merchant_id'])?> (<?=$m['merchant_id']?>)</td>
        <td align="right">      
          <a href="index.php?editor=mercs&merc_merchant_entry_id=<?=$m['merc_merchant_entry_id']?>&action=99"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>          
          <a href="index.php?editor=mercs&merc_merchant_entry_id=<?=$m['merc_merchant_entry_id']?>&merc_merchant_template_id=<?=$t['merc_merchant_template_id']?>&action=101" onClick="return confirm('Really delete this merchant?');"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
        </td>
      </tr>
<?$x++;endforeach;?>
<?else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Mercenary Merchants</td>
      </tr>
<?endif;?>
    </table>
  </div>