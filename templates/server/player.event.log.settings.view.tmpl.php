  <div class="table_container" style="width: 750px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Player Event Log Settings</td>
          <td align="right">
            <a href="index.php?editor=server&action=77"><img src="images/add.gif" border="0" title="Add a Setting"></a>
          </td>
        </tr>        
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if(isset($settings)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="50%"><strong>Event Name</strong></td>
        <td align="center" width="10%"><strong>Enabled</strong></td>
        <td align="center" width="15%"><strong>Retention</strong></td>
        <td align="center" width="10%"><strong>ETL</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0; foreach($settings as $setting):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$setting['id']?></td>
        <td align="center" width="50%"><?=$setting['event_name']?></td>
        <td align="center" width="10%"><?=$yesno[$setting['event_enabled']]?></td>
        <td align="center" width="15%"><?=$setting['retention_days']?></td>
        <td align="center" width="10%"><?=$yesno[$setting['etl_enabled']]?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=server&id=<?=$setting['id']?>&action=79"><img src="images/edit2.gif" border="0" title="Edit Setting"></a>          
          <a href="index.php?editor=server&id=<?=$setting['id']?>&action=81" onClick="return confirm('Really delete this setting?');"><img src="images/remove3.gif" border="0" title="Delete this setting"></a>
        </td>
      </tr>
<?$x++;endforeach;?>
<?else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Settings</td>
      </tr>
<?endif;?>
    </table>
  </div>
