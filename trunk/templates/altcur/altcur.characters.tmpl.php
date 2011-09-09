  <div class="table_container" style="width: 450px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Character Totals</td>
          <td>
            <div style="float:right">
              <a href="index.php?editor=altcur&action=14"><img src="images/add.gif" border="0" title="Create a new entry" /></a>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($altcur_characters)):?>
      <tr>
        <td align="center" width="35%"><strong>Character</strong></td>
        <td align="center" width="35%"><strong>Currency</strong></td>
        <td align="center" width="20%"><strong>Amount</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($altcur_characters as $character):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="35%"><?=getPlayerName($character['char_id'])?> (<?=$character['char_id']?>)</td>
        <td align="center" width="35%"><?=get_currency_name($character['currency_id'])?> (<?=$character['currency_id']?>)</td>
        <td align="center" width="20%"><?=$character['amount']?></td>
        <td align="right" width="10%"><a href="index.php?editor=altcur&charid=<?=$character['char_id']?>&currencyid=<?=$character['currency_id']?>&action=16"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Entry"></a>&nbsp;<a onClick="return confirm('Really delete this entry?');" href="index.php?editor=altcur&charid=<?=$character['char_id']?>&currencyid=<?=$character['currency_id']?>&action=18"><img src="images/remove3.gif" border="0" title="Delete Entry"></a></td>
      </tr>
<?$x++;
endforeach;
else:?>
      <tr>
        <td align="left" width="100" style="padding: 10px;">No entries</td>
      </tr>
<?endif;?>
    </table>
  </div>
