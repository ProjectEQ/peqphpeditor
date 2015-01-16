        <div class="table_container" style="width: 700px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" width="33%">Character Creation Combos</td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($charcreatecombolist)) :?>
            <tr>
              <td align="center" width="8%"><strong>Alloc. ID</strong></td>
              <td align="center" width="10%"><strong>Race</strong</td>
              <td align="center" width="15%"><strong>Class</strong></td>
              <td align="center" width="20%"><strong>Deity</strong></td>
              <td align="center" width="22%"><strong>Start Zone</strong></td>
              <td align="center" width="20%"><strong>Expansions</strong></td>
            </tr>
<?$x=0; foreach($charcreatecombolist as $combo=>$v):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center" width="8%"><?=$v['allocation_id']?></td>
              <td align="center" width="10%"><?=$races[$v['race']]?> (<?=$v['race']?>)</td>
              <td align="center" width="15%"><?=$classes[$v['class']]?> (<?=$v['class']?>)</td>
              <td align="center" width="20%"><?=$deities[$v['deity']]?> (<?=$v['deity']?>)</td>
              <td align="center" width="22%"><?=$zoneids[$v['start_zone']]?> (<?=$v['start_zone']?>)</td>
              <td align="center" width="20%"><?=$v['expansions_req']?></td>
            </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($charcreatecombolist)):?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No Character Creation Combos</td>
            </tr>
<?endif;?>
          </table>
        </div>
