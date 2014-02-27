       <div class="edit_form" style="width:200px">
         <div class="edit_form_header">
             <center>
           Spawngroup <?=$sid?>
         </div>
         <div class="edit_form_content">
           <form method="post" action="index.php?editor=spawn&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&sid=<?=$sid?>&action=5">
             <center>
             	Spawngroup Name:<br>  
		<input type="text" name="name" size="15" value="<?=$name?>"><br><br>
	    	spawn_limit:<br>
             	<input type="text" name="spawn_limit" size="6" value="<?=$spawn_limit?>"><br><br>
		dist:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
              <input type="text" name="dist" size="5" value="<?=$dist?>"><br><br>
		mindelay:&nbsp;
              delay:<br>
		<input type="text" name="mindelay" size="5" value="<?=$mindelay?>">
		<input type="text" name="delay" size="5" value="<?=$delay?>"><br><br>
		max_x:&nbsp;&nbsp; 
		min_x:<br>
		<input type="text" name="max_x" size="5" value="<?=$max_x?>">
             	<input type="text" name="min_x" size="5" value="<?=$min_x?>"><br><br>
		max_y:&nbsp;&nbsp;
		min_y:<br> 
		<input type="text" name="max_y" size="5" value="<?=$max_y?>">
             	<input type="text" name="min_y" size="5" value="<?=$min_y?>"><br><br>
		despawn:<br>
		<select name="despawn" style="width: 160px;">
		<?foreach($despawntype as $key=>$value):?>
              <option value="<?=$key?>"<?echo ($key == $despawn)? " selected" : "";?>><?=$key?>: <?=$value?></option>
		<?endforeach;?></select><br><br>
		despawn timer:<br>
		<input type="text" name="despawn_timer" size="5" value="<?=$despawn_timer?>"><br><br>
              <input type="submit" name="submit" value="Submit Changes">
             </center>
           </form>
         </div>
       </div>
