        <div class="table_container" style="width: 700px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" width="33%">Learned Recipes</td>
                <td align="center" width="33%">
                  <?echo ($page > 1) ? "<a href='index.php?editor=tradeskill&action=13&page=1" . (($sort != "") ? "&sort=" . $sort : "") . "'><img src='images/first.gif' border='0' width='12' height='12' title='First'/></a>" : "<img src='images/first.gif' border='0' width='12' height='12'/>";?>
                  <?echo ($page > 1) ? "<a href='index.php?editor=tradeskill&action=13&page=" . ($page - 1) . (($sort != "") ? "&sort=" . $sort : "") . "'><img src='images/prev.gif' border='0' width='12' height='12' title='Previous'/></a>" : "<img src='images/prev.gif' border='0' width='12' height='12'/>";?>
                  <?echo $page . " of " . $pages;?>
                  <?echo ($page < $pages) ? "<a href='index.php?editor=tradeskill&action=13&page=" . ($page + 1) . (($sort != "") ? "&sort=" . $sort : "") . "'><img src='images/next.gif' border='0' width='12' height='12' title='Next'/></a>" : "<img src='images/next.gif' border='0' width='12' height='12'/>";?>
                  <?echo ($page < $pages) ? "<a href='index.php?editor=tradeskill&action=13&page=" . $pages . (($sort != "") ? "&sort=" . $sort : "") . "'><img src='images/last.gif' border='0' width='12' height='12' title='Last'/></a>" : "<img src='images/last.gif' border='0' width='12' height='12'/>";?>
                </td>
                <td align="right" width="33%">&nbsp;</td>
              </tr>
            </table>
          </div>
          <table class="table_content2" width="100%">
<?if (isset($recipes)):?>
            <tr>
              <td align="center"><strong><?echo ($sort == 1) ? "Character <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=tradeskill&action=13&sort=1'>Character <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Character'/></a>";?></strong></td>
              <td align="center"><strong><?echo ($sort == 2) ? "Recipe <img src='images/sort_red.bmp' border='0' width='8' height='8'/>" : "<a href='index.php?editor=tradeskill&action=13&sort=2'>Recipe <img src='images/sort_green.bmp' border='0' width='8' height='8' title='Sort by Recipe'/></a>";?></strong></td>
              <td align="center"><strong>Count</strong></td>
              <td width="5%">&nbsp;</td>
            </tr>
<?$x=0;
foreach($recipes as $recipe):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center"><?echo "<a href='index.php?editor=player&playerid=" . $recipe['char_id'] . "'>" . getPlayerName($recipe['char_id'])?></a> (<?=$recipe['char_id']?>)</td>
              <td align="center"><?echo "<a href='index.php?editor=tradeskill&rec=" . $recipe['recipe_id'] . "'>" . getRecipeName($recipe['recipe_id'])?></a> (<?=$recipe['recipe_id']?>)</td>
              <td align="center"><?=$recipe['madecount']?></td>
              <td align="right"><a onClick="return confirm('Really delete <?=getRecipeName($recipe['recipe_id'])?> from <?=getPlayerName($recipe['char_id'])?>?');" href="index.php?editor=tradeskill&recipe_id=<?=$recipe['recipe_id']?>&char_id=<?=$recipe['char_id']?>&action=14"><img src="images/remove3.gif" border="0" title="Delete Learned Recipe"></a></td>
            </tr>
<?$x++;
endforeach;
else:?>
            <tr>
              <td align="left" width="100" style="padding: 10px;">No Learned Recipes</td>
            </tr>
<?endif;?>
          </table>
        </div>
