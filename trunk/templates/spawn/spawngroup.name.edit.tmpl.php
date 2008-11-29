       <div class="edit_form" style="width:275px">
         <div class="edit_form_header">
             <center>
           Spawngroup <?=$sid?>
         </div>
         <div class="edit_form_content">
           <form method="post" action="index.php?editor=spawn&z=<?=$currzone?>&npcid=<?=$npcid?>&sid=<?=$sid?>&action=5">
             <center>
             <strong>Spawngroup Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;spawn_limit:</strong><br>
             <input type="text" name="name" size="15" value="<?=$name?>">
             &nbsp;&nbsp;<input type="text" name="spawn_limit" size="6" value="<?=$spawn_limit?>"><br><br>

             <strong>dist:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; max_x:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; min_x:</strong><br>
             <input type="text" name="dist" size="5" value="<?=$dist?>">
             &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="max_x" size="5" value="<?=$max_x?>">
             &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="min_x" size="5" value="<?=$min_x?>"><br><br>

             <strong>delay:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; max_y:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; min_y:</strong><br>
             <input type="text" name="delay" size="5" value="<?=$delay?>">
             &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="max_y" size="5" value="<?=$max_y?>">
             &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="min_y" size="5" value="<?=$min_y?>"><br><br>

              <center>
               <input type="submit" name="submit" value="Submit Changes">
             </center>
           </form>
         </div>
       </div>
