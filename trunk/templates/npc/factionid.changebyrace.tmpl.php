<div class="edit_form" style="width: 350px">
      <div class="edit_form_header">
        Change Faction
               </div>
        <div class="edit_form_content">
        <form method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&npcfid=<?=$npcfid?>&action=51">
              <table width="100%">
          <tr>
              <th>npc race</th>
              <th>update all</th>
           </tr>
           <tr>
               <td><select name="npcrace" style="width: 265px;">
<?foreach($races as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $race)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                 </select></td>
               <td>
               <select name="updateall">
                   <option value="0"<?echo ($updateall == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($updateall == 1) ? " selected" : ""?>>Yes</option>
                 </select>
               </td>
             </tr>
                 </table><br><br>
               <center>
                 <input type="submit">
               </center>
             </form>
         </div>
      </div>
  