     <center>
       <table style="border: 1px solid black; background-color: #CCC;">
        <tr><td colspan=2><b>Reminder:</b></td></tr>

         <tr><td align=right>If you wish to use the WHERE options you must select Custom for NPC to Change.</td></tr>

       </table><br><br>
       </center>

<div class="edit_form" style="width: 750px">
      <div class="edit_form_header">
        Change NPC Stats (AC and Resists)
               </div>
        <div class="edit_form_content">
        <form method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=53">
              <table width="100%">
           <tr>
               <td valign="top">
NPC Type:<br>
<select name="npctype_selected">
<?foreach($npctype as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $npctype_selected)? " selected" : "";?>><?=$value?></option>
<?endforeach;?>
                 </select><br><br>  
</td> 
<td valign="top">   
NPC Tier:<br>       
<select name="npctier_selected">
<?foreach($npctier as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $npctier_selected)? " selected" : "";?>> <?=$value?></option>
<?endforeach;?>
                 </select>               
            </td>
</td> 
<td valign="top">   
NPC Class:<br>       
<select name="npcclass_selected">
<?foreach($npcclass as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $npcclass_selected)? " selected" : "";?>> <?=$value?></option>
<?endforeach;?>
                 </select>               
            </td>
<td valign="top">   
NPC to Change:<br>       
<select name="npcchange_selected">
<?foreach($npcchange as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $npcchange_selected)? " selected" : "";?>> <?=$value?></option>
<?endforeach;?>
                 </select>               
            </td>
<td valign="top">   
Stat to Change:<br>       
<select name="npcstatchange_selected">
<?foreach($npcstatchange as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $npcstatchange_selected)? " selected" : "";?>> <?=$value?></option>
<?endforeach;?>
                 </select>               
            </td>

             </tr>
                 </table>
<center><B>WHERE:<B><br></center>
<table width="100%">
           <tr>
<td valign="top">
Name:<br>
<input type="text" size="25" name="npcname" value=""></td> 
<td valign="top">
Level:<br>
<input type="text" size="5" name="npclevel" value=""></td> 
<td valign="top">   
Race:<br>       
<select name="race_selected">
<?foreach($races as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $race_selected)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                 </select>               
            </td>
<td valign="top">   
Class:<br>       
<select name="class_selected">
<?foreach($classes as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $class_selected)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
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
  