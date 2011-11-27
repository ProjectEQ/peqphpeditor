       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Search Results
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
<?if ($results != ''):?>
             <ul>
<?foreach($results as $result): extract($result);?>
             <li><a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&minx=<?=$minx?>&miny=<?=$miny?>&maxx=<?=$maxx?>&maxy=<?=$maxy?>&limit=<?=$limit?>&npcname=<?=$npcname?>&npc=<?=$id?>&action=69"><?=$name?> (<?=$id?>) (<?=get_zone_by_npcid($id)?>) - Level <?=$level?></a></li>
<?endforeach;?>
             </ul>
<?endif;?>
<?if ($results == ''):?>
            <center>
              Your search produced no results!<br><br>
              <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&minx=<?=$minx?>&miny=<?=$miny?>&maxx=<?=$maxx?>&maxy=<?=$maxy?>&limit=<?=$limit?>&npcname=<?=$npcname?>&action=69">Try again</a>
            </center>
<?endif;?>
           </td>
         </tr>
       </table>
