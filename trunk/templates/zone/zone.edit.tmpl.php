       <form name="zone_edit" method="post" action="index.php?editor=zone&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&action=3">
       <div class="edit_form">
         <div class="edit_form_header">
           Edit Zone: <?=$zoneidnumber?> (<?=$short_name?>)
         </div>
         <div class="edit_form_content">
         <center>
       <fieldset>
           <legend><strong><font size="4">General</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <td align="left" width="30%">Long Name: <br><input type="text" name="long_name" size="20" value="<?=$long_name?>"></td>
               <td align="left" width="23%">Safe X: <br><input type="text" name="safe_x" size="7" value="<?=$safe_x?>"></td>
               <td align="left" width="23%">Safe Y:  <br><input type="text" name="safe_y" size="7" value="<?=$safe_y?>"></td>
               <td align="left" width="24%">Safe Z: <br><input type="text" name="safe_z" size="7" value="<?=$safe_z?>"></td>
               
              </tr>
              <tr>
               <td align="left" width="30%">File Name: <br><input type="text" name="file_name" size="20" value="<?=$file_name?>"></td>
               <td align="left" width="23%">Underworld:  <br><input type="text" name="underworld" size="7" value="<?=$underworld?>"></td>
               <td align="left" width="23%">Timezone:  <br><input type="text" name="timezone" size="7" value="<?=$timezone?>"></td>
               <td align="left" width="24%">Time Type:  <br><input type="text" name="time_type" size="7" value="<?=$time_type?>"></td>
               
              </tr> 
              <tr>
               <td align="left" width="30%">Note:  <br><input type="text" name="note" size="20" value="<?=$note?>"></td>
               <td align="left" width="23%">Shutdown:  <br><input type="text" name="shutdowndelay" size="7" value="<?=$shutdowndelay?>"></td>
               <td align="left" width="23%">Graveyard: <br><input type="text" name="graveyard_id" size="7" value="<?=$graveyard_id?>"></td>
               <td align="left" width="24%">Zone Type: <br><input type="text" name="ztype" size="7" value="<?=$ztype?>"></td>
             </tr>
             <tr>
               <td align="left" width="30%">Map:  <br><input type="text" name="map_file_name" size="20" value="<?=$map_file_name?>"></td>
               <td align="left" width="23%">Ruleset:  <br><input type="text" name="ruleset" size="7" value="<?=$ruleset?>"></td>
               <td align="left" width="23%">Version: <br><input type="text" name="version" size="7" value="<?=$version?>"></td>
               <td align="left" width="25%">Exp Multiplier:  <br><input type="text" name="zone_exp_multiplier" size="7" value="<?=$zone_exp_multiplier?>"></td>
             </tr>
             <tr>
              
               <td align="left" width="25%">Walkspeed:  <br><input type="text" name="walkspeed" size="7" value="<?=$walkspeed?>"></td>
               <td align="left" width="25%">
	          Weather:  <br>
			      <select name="weather">
			      <option value="0"<?echo ($weather == 0) ? " selected" : ""?>>None</option>
			      <option value="1"<?echo ($weather == 1) ? " selected" : ""?>>Rain</option>
                           <option value="2"<?echo ($weather == 2) ? " selected" : ""?>>Snow</option>
                 </select>
                 </td>
                 <td align="left" width="25%">
                  Hotzone:  <br>
                 <select name="hotzone">
                   <option value="0"<?echo ($hotzone == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($hotzone == 1) ? " selected" : ""?>>Yes</option>
                 </select>
                </td>
               <td align="left" width="25%">
                  Global Instance:  <br>
                 <select name="global">
                   <option value="0"<?echo ($global == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($global == 1) ? " selected" : ""?>>Yes</option>
                 </select>
                </td>
                </tr>
                </tr>
                <td align="left" width="25%">
                  Suspend Buffs:  <br>
                 <select name="suspendbuffs">
                   <option value="0"<?echo ($suspendbuffs == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($suspendbuffs == 1) ? " selected" : ""?>>Yes</option>
                 </select>
                </td>
               <td align="left" width="25%">
               Type:<br>
                 <select name="type">
                 <?foreach($zonetype as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $type)? " selected" : "";?>> <?=$value?></option>
                 <?endforeach;?>
                 </select>
               </td>
               <td align="left" width="25%">
               Expansion:<br>
                 <select name="expansion">
                 <?foreach($eqexpansions as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $expansion)? " selected" : "";?>> <?=$value?></option>
                 <?endforeach;?>
                 </select>
              </td>
             </tr>
            </table>
         </fieldset><br>

         <fieldset>
           <legend><strong><font size="4">Restrictions</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <td align="left" width="25%">Level:  <br><input type="text" name="min_level" size="7" value="<?=$min_level?>"></td>
               <td align="left" width="25%">Status:  <br><input type="text" name="min_status" size="7" value="<?=$min_status?>"></td>
               <td align="left" width="25%">Max Clients:  <br><input type="text" name="maxclients" size="7" value="<?=$maxclients?>"></td>
               <td align="left" width="25%">Flag:  <br><input type="text" name="flag_needed" size="15" value="<?=$flag_needed?>"></td>
             </tr>
              <tr>
               <td align="left" width="20%">
                 Can Levitate:  <br>
                 <select name="canlevitate">
                   <option value="0"<?echo ($canlevitate == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($canlevitate == 1) ? " selected" : ""?>>Yes</option>
                 </select>
               </td>
               <td align="left" width="20%">
                 Outdoor:  <br>
                 <select name="castoutdoor">
                   <option value="0"<?echo ($castoutdoor == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($castoutdoor == 1) ? " selected" : ""?>>Yes</option>
                 </select>
               </td>
               <td align="left" width="20%">
                 Can Combat:  <br>
			      <select name="cancombat">
			      <option value="0"<?echo ($cancombat == 0) ? " selected" : ""?>>No</option>
			      <option value="1"<?echo ($cancombat == 1) ? " selected" : ""?>>Yes</option>
			     </select>
			   </td>
		 <td align="left" width="20%">
                 PEQ Zone:  <br>
			      <select name="peqzone">
			      <option value="0"<?echo ($peqzone == 0) ? " selected" : ""?>>No</option>
			      <option value="1"<?echo ($peqzone == 1) ? " selected" : ""?>>Yes</option>
			     </select>
			   </td>
	        <td align="left" width="20%">
	          Can Bind:  <br>
			      <select name="canbind">
			      <option value="0"<?echo ($canbind == 0) ? " selected" : ""?>>No</option>
			      <option value="1"<?echo ($canbind == 1) ? " selected" : ""?>>Self</option>
                           <option value="2"<?echo ($canbind == 2) ? " selected" : ""?>>Others</option>
                 </select>
                </td>
             </tr>
           </table>
         </fieldset><br>

         <fieldset>
           <legend><strong><font size="4">Sky</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <td align="left" width="14%">Sky:  <br><input type="text" name="sky" size="5" value="<?=$sky?>"></td>
               <td align="left" width="14%">Min Clip:  <br><input type="text" name="minclip" size="5" value="<?=$minclip?>"></td>
               <td align="left" width="14%">Max Clip:  <br><input type="text" name="maxclip" size="5" value="<?=$maxclip?>"></td>
               <td align="left" width="14%">Fog Minclip:  <br><input type="text" name="fog_minclip" size="5" value="<?=$fog_minclip?>"></td>
               <td align="left" width="14%">Fog Maxclip:  <br><input type="text" name="fog_maxclip" size="5" value="<?=$fog_maxclip?>"></td>
               <td align="left" width="15%">Fog Blue:  <br><input type="text" name="fog_blue" size="5" value="<?=$fog_blue?>"></td>
               <td align="left" width="15%">Fog Red:  <br><input type="text" name="fog_red" size="5" value="<?=$fog_red?>"></td>
             </tr>
             <tr>
               <td align="left" width="14%">Fog Green:  <br><input type="text" name="fog_green" size="5" value="<?=$fog_green?>"></td>
               <td align="left" width="14%">Fog Minclip1:  <br><input type="text" name="fog_minclip1" size="5" value="<?=$fog_minclip1?>"></td>
               <td align="left" width="14%">Fog Maxclip1:  <br><input type="text" name="fog_maxclip1" size="5" value="<?=$fog_maxclip1?>"></td>
               <td align="left" width="14%">Fog Blue1:  <br><input type="text" name="fog_blue1" size="5" value="<?=$fog_blue1?>"></td>
               <td align="left" width="14%">Fog Red1:  <br><input type="text" name="fog_red1" size="5" value="<?=$fog_red1?>"></td>
               <td align="left" width="15%">Fog Green1:  <br><input type="text" name="fog_green1" size="5" value="<?=$fog_green1?>"></td>
               <td align="left" width="15%">Fog Minclip2:  <br><input type="text" name="fog_minclip2" size="5" value="<?=$fog_minclip2?>"></td>
             </tr>
             <tr>
               
               <td align="left" width="14%">Fog Maxclip2:  <br><input type="text" name="fog_maxclip2" size="5" value="<?=$fog_maxclip2?>"></td>
               <td align="left" width="14%">Fog Blue2:  <br><input type="text" name="fog_blue2" size="5" value="<?=$fog_blue2?>"></td>
               <td align="left" width="14%">Fog Red2:  <br><input type="text" name="fog_red2" size="5" value="<?=$fog_red2?>"></td>
               <td align="left" width="14%">Fog Green2:  <br><input type="text" name="fog_green2" size="5" value="<?=$fog_green2?>"></td>
               <td align="left" width="14%">Fog Minclip3:  <br><input type="text" name="fog_minclip3" size="5" value="<?=$fog_minclip3?>"></td>
               <td align="left" width="15%">Fog Maxclip3:  <br><input type="text" name="fog_maxclip3" size="5" value="<?=$fog_maxclip3?>"></td>
               <td align="left" width="15%">Fog Blue3:  <br><input type="text" name="fog_blue3" size="5" value="<?=$fog_blue3?>"></td>
             </tr>
             <tr>
               
               <td align="left" width="14%">Fog Red3:  <br><input type="text" name="fog_red3" size="5" value="<?=$fog_red3?>"></td>
               <td align="left" width="14%">Fog Green3:  <br><input type="text" name="fog_green3" size="5" value="<?=$fog_green3?>"></td>
               <td align="left" width="14%">Fog Minclip4:  <br><input type="text" name="fog_minclip4" size="5" value="<?=$fog_minclip4?>"></td>
               <td align="left" width="14%">Fog Maxclip4:  <br><input type="text" name="fog_maxclip4" size="5" value="<?=$fog_maxclip4?>"></td>
               <td align="left" width="14%">Fog Blue4:  <br><input type="text" name="fog_blue4" size="5" value="<?=$fog_blue4?>"></td>
               <td align="left" width="15%">Fog Red4:  <br><input type="text" name="fog_red4" size="5" value="<?=$fog_red4?>"></td>
               <td align="left" width="15%">Fog Green4:  <br><input type="text" name="fog_green4" size="5" value="<?=$fog_green4?>"></td>
             </tr>
		 <td align="left" width="14%">Fog Density: <br><input type="text" name="fog_density" size="5" value="<?=$fog_density?>"></td>
           </table>
           </fieldset><br>
           <center>
            <input type="hidden" name="zoneidnumber" value="<?=$zoneidnumber?>">
            <input type="hidden" name="short_name" value="<?=$short_name?>">
            <input type="submit" value="Submit Changes">
         </center>
           </div>
       </div>