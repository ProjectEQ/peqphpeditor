  <center>
    <table width="150" border="1" cellpadding="3" cellspacing="0" id="CustomCount" style="display:none;">
      <tr>
        <td align="center">
          New Count: <input type="text" id="new_count" size="5" value="<?=$count?>"/><br/><br/>
          <input type="button" value="Submit" onClick="javascript:verifyCount();"/>&nbsp;<input type="button" value="Cancel" onClick="javascript:toggleCount();"/>
        </td>
      </tr>
    </table>
  </center><br/>
  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" width="100%">Recipe Activity - Recipes made <a href="javascript:toggleCount();"><?=$count?></a> or more times</td>
        </tr>
        </table>
      </div>
      <table class="table_content2" width="100%">
<?if (isset($recipes)):?>
        <tr>
          <td align="center" width="25%"><strong>Character</strong></td>
          <td align="center" width="50%"><strong>Recipe</strong></td>
          <td align="center" width="20%"><strong>Count</strong></td>
        </tr>
<?$x=0; foreach($recipes as $recipe=>$v):?>
        <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
          <td align="center" width="25%"><a href="index.php?editor=player&playerid=<?=$v['char_id']?>"><?echo getPlayerName($v['char_id'])?></a></td>
          <td align="center" width="50%"><?echo getRecipeName($v['recipe_id'])?></td>
          <td align="center" width="20%"><?=$v['madecount']?></td>
        </tr>
<?$x++; endforeach;?>
<?endif;?>
<?if (!isset($recipes)):?>
        <tr>
          <td align="left" width="100" style="padding: 10px;">No entries</td>
        </tr>
<?endif;?>
      </table>
    </div><br/>
