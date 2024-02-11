  <div class="table_container" style="width: 700px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" width="33%">Character Base Data</td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($charbasedata)) :?>
      <tr>
        <td align="center"><strong>Level</strong></td>
        <td align="center"><strong>Class</strong></td>
        <td align="center"><strong>HP</strong></td>
        <td align="center"><strong>Mana</strong></td>
        <td align="center"><strong>End</strong></td>
        <td align="center"><strong>HP<br>Regen</strong></td>
        <td align="center"><strong>End<br>Regen</strong></td>
        <td align="center"><strong>HP<br>Factor</strong></td>
        <td align="center"><strong>Mana<br>Factor</strong></td>
        <td align="center"><strong>End<br>Factor</strong></td>
      </tr>
<?$x=0; foreach($charbasedata as $k=>$v):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center"><?=$v['level']?></td>
        <td align="center"><?=$classes[$v['class']]?> (<?=$v['class']?>)</td>
        <td align="center"><?=$v['hp']?></td>
        <td align="center"><?=$v['mana']?></td>
        <td align="center"><?=$v['end']?></td>
        <td align="center"><?=$v['hp_regen']?></td>
        <td align="center"><?=$v['end_regen']?></td>
        <td align="center"><?=$v['hp_fac']?></td>
        <td align="center"><?=$v['mana_fac']?></td>
        <td align="center"><?=$v['end_fac']?></td>
      </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($charbasedata)):?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No Character Base Data</td>
      </tr>
<?endif;?>
    </table>
  </div>
