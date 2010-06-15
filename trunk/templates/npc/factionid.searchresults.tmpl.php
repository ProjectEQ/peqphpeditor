       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Search Results
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
<?if ($results != ''):?>
             <ul style="padding-left: 20px;">
<?foreach($results as $result):?>
             <li><a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&npc_faction_id=<?=$result['id']?>&action=5"><?=$result['name']?></a></li>
<?endforeach;?>
             </ul>
<?endif;?>
<?if ($results == ''):?>
            <center>
              Your search produced no results!<br><br>
              <a href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=6">Try again</a>
            </center>
<?endif;?>
           </td>
         </tr>
       </table>
