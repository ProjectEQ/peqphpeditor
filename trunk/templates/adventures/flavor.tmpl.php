     <div class="table_container" style="width: 605px;">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Adventure Flavor Text for ID <?=$aid?></td>
            </tr>        
         </table>
      </div>

       <div class="edit_form_content">
        <form name="flavor" method="post" action=index.php?editor=adventures&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=6">
        <table width="100%">
          <td><textarea name="text" rows=6 cols=70><?=$text?></textarea></td>
                   <td align="right">             
          </td>
        </table><br>
        <center>
          <input type="hidden" name="id" value="<?=$aid?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>
