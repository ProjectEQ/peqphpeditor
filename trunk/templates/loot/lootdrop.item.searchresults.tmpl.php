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
<?foreach($results as $result):?>
             <li><a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$ldid?>&action=21&itemid=<?=$result['id']?>"><?=$result['name']?><br>
             &nbsp;&nbsp; (Lore: <?=$result['lore']?>)</a></li>
<?endforeach;?>
             </ul>
<?endif;?>
<?if ($results == ''):?>
            <center>
              Your search produced no results!<br><br>
              <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$ldid?>&action=20">Try again</a>
            </center>
<?endif;?>
           </td>
         </tr>
       </table>
