       <table class="edit_form">
         <tr>
           <td class="edit_form_header">
             Search Results
           </td>
         </tr>
         <tr>
           <td class="edit_form_content">
<?if ($results != ''):?>
<?foreach($results as $result):?>
             <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&sid=<?=$result['id']?>&action=58"><?=$result['name']?></a><br>
<?endforeach;?>
<?endif;?>
<?if ($results == ''):?>
            <center>
              Your search produced no results!<br><br>
              <a href="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=55">Try again</a>
            </center>
<?endif;?>
           </td>
         </tr>
       </table>
