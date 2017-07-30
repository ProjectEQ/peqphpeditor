  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Auras</td>
          <td>
            <div style="float:right">
              <a href="index.php?editor=auras&action=3"><img src="images/add.gif" border="0" title="Create a new aura"></a>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($auras)):?>
      <tr>
        <td align="center" width="15%"><strong>Type</strong></td>
        <td align="center" width="25%"><strong>NPC ID</strong></td>
        <td align="center" width="50%"><strong>Name</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($auras as $aura):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="15%"><?=$aura['type']?></td>
        <td align="center" width="25%"><?=$aura['npc_type']?></td>
        <td align="center" width="50%"><?=$aura['name']?></td>
        <td align="right" width="10%"><a href="index.php?editor=auras&type=<?=$aura['type']?>&action=2"><img src="images/view_tbl.png" width="13" height="13" border="0" title="View Aura"></a>&nbsp;<a onClick="return confirm('Really delete aura <?=$aura['type']?>?');" href="index.php?editor=auras&type=<?=$aura['type']?>&action=7"><img src="images/remove3.gif" border="0" title="Delete Aura"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100%" style="padding: 10px;">No auras</td>
      </tr>
<?endif;?>
    </table>
  </div>
