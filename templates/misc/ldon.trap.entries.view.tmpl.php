  <div class="table_container" style="width: 200px;">
    <div class="table_header">
      <table style="width:100%; padding:0px; border-spacing:0px;">
        <tr>
          <td align="right"><a href="index.php?editor=misc&action=71"><img src="images/add.gif" title="Add Trap Entry"></a></td>
        </tr>
      </table>
    </div>
    <table class="table_content2" style="width:100%;">
<?if (isset($entries)):?>
      <tr>
        <td align="center" width="10%"><strong>ID</strong></td>
        <td align="center" width="20%"><strong>Trap ID</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($entries as $entry):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="10%"><?=$entry['id']?></td>
        <td align="center" width="20%"><?=$entry['trap_id']?></td>
        <td align="right" width="10%">
          <a href="index.php?editor=misc&id=<?=$entry['id']?>&trap_id=<?=$entry['trap_id']?>&action=73" onClick="return confirm('Really delete trap entry?');"><img src="images/remove.gif" width="13" height="13" border="0" title="Delete Trap Entry"></a>
        </td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No Trap Entries</td>
      </tr>
<?endif;?>
    </table>
  </div>
