  <div class="table_container" style="width:400px;">
    <div class="table_header">Character Auras (Limit: 500)</div>
    <div class="table_content">
<?if($char_auras != ''):?>
      <table cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <th>Character</th>
          <th>Slot</th>
          <th>Spell</th>
          <th>&nbsp;</th>
        </tr>
<?foreach($char_auras as $char_aura): extract($char_aura);?>
        <tr>
          <td align="center"><a href="index.php?editor=player&playerid=<?=$char_aura['id']?>"><?=getPlayerName($char_aura['id'])?> (<?=$char_aura['id']?>)</a></td>
          <td align="center"><?=$char_aura['slot']?></td>
          <td align="center"><a href="index.php?editor=spells&id=<?=$char_aura['spell_id']?>&action=2"><?=getSpellName($char_aura['spell_id'])?> (<?=$char_aura['spell_id']?>)</a></td>
          <td align="right" width="10%"><a onClick="return confirm('Really delete aura (<?=$char_aura['spell_id']?>) from this character (<?=$char_aura['id']?>)?');" href="index.php?editor=auras&id=<?=$char_aura['id']?>&slot=<?=$char_aura['slot']?>&action=14"><img src="images/remove3.gif" border="0" title="Delete Character Aura"></a></td>
        </tr>
<?endforeach;?>
      </table>
<?endif;?>
<?if($char_auras == ''):?>
      No character auras
<?endif;?>
    </div>
  </div>
