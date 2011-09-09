  <div class="table_container" style="width: 450px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td>Alternate Currency NPCs</td>
          <td>
            <div style="float:right">
              <a href="index.php?editor=altcur&action=8"><img src="images/add.gif" border="0" title="Create a new entry" /></a>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <table class="table_content2" width="100%">
<?if (isset($altcur_npcs)):?>
      <tr>
        <td align="center" width="45%"><strong>NPC</strong></td>
        <td align="center" width="45%"><strong>Currency</strong></td>
        <td width="10%">&nbsp;</td>
      </tr>
<?$x=0;
foreach($altcur_npcs as $npc):?>
      <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
        <td align="center" width="45%"><a href="index.php?editor=npc&npcid=<?=$npc['id']?>"><?=getNPCName($npc['id'])?> (<?=$npc['id']?>)</a></td>
        <td align="center" width="45%"><?=get_currency_name($npc['alt_currency_id'])?> (<?=$npc['alt_currency_id']?>)</td>
        <td align="right" width="10%"><a href="index.php?editor=altcur&npcid=<?=$npc['id']?>&action=10"><img src="images/edit2.gif" width="13" height="13" border="0" title="Edit Entry"></a>&nbsp;<a onClick="return confirm('Really delete this entry?');" href="index.php?editor=altcur&npcid=<?=$npc['id']?>&action=12"><img src="images/remove3.gif" border="0" title="Delete Entry"></a></td>
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
