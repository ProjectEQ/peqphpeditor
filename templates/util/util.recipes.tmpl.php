  <div class="table_container" style="width: 500px;">
    <div class="table_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td align="left" width="100%">Recipe Activity - Recipes made more than <?=$count?> times</td>
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
          <td align="center" width="25%"><?=getPlayerName($v['char_id'])?></td>
          <td align="center" width="50%"><?=getRecipeName($v['recipe_id'])?></td>
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
