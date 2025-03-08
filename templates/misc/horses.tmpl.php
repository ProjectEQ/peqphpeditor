  <div class="table_container" style="width: 800px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Horses</td>
          <td align="right">
            <a href="index.php?editor=misc&z=<?echo (isset($currzone)) ? $currzone : "";?>&zoneid=<?echo (isset($currzoneid)) ? $currzoneid : "";?>&action=33"><img src="images/add.gif" border="0" title="Add an entry"></a>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<? if (isset($horses)):?>
      <tr>
        <td align="center" width="20%"><strong>Filename</strong></td>
        <td align="center" width="10%"><strong>Race</strong></td>
        <td align="center" width="10%"><strong>Gender</strong></td>
        <td align="center" width="10%"><strong>Texture</strong></td>
        <td align="center" width="10%"><strong>Helm</strong></td>
        <td align="center" width="10%"><strong>Speed</strong></td>
        <td align="center" width="25%"><strong>Notes</strong></td>
        <td width="5%"></td>
      </tr>
<?$x=0; foreach($horses as $horse):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="20%"><?=$horse['filename']?></td>
        <td align="center" width="10%"><?=$races[$horse['race']]?></td>
        <td align="center" width="10%"><?=$genders[$horse['gender']]?></td>
        <td align="center" width="10%"><?=$horse['texture']?></td>
        <td align="center" width="10%"><?=$horse['helmtexture']?></td>
        <td align="center" width="10%"><?=$horse['mountspeed']?></td>
        <td align="center" width="25%"><?=$horse['notes']?></td>
        <td align="right">
          <a href="index.php?editor=misc&z=<?echo (isset($currzone)) ? $currzone : "";?>&zoneid=<?echo (isset($currzoneid)) ? $currzoneid : "";?>&filename=<?=$horse['filename']?>&action=30"><img src="images/edit2.gif" border="0" title="Edit Entry"></a>
          <a onClick="return confirm('Really Delete Horse <?=$horse['filename']?>?');" href="index.php?editor=misc&z=<?echo (isset($currzone)) ? $currzone : "";?>&zoneid=<?echo (isset($currzoneid)) ? $currzoneid : "";?>&filename=<?=$horse['filename']?>&action=32"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
        </td>
      </tr>
<?$x++; endforeach;?>
<?endif;?>
<? if (!isset($horses)):?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No horse data</td>
      </tr>
<?endif;?>
    </table>
  </div>
