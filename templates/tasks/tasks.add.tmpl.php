<form name="adventure_edit" method="post" action="index.php?editor=tasks&action=5">
       <div class="edit_form">
         <div class="edit_form_header">
           Add Task
         </div>
         <div class="edit_form_content">
         <center>

       <fieldset>
           <legend><strong><font size="4">Title</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <td align="left" width="5%">ID:  <br><input type="text" name="id" size="5" value="<?=$suggestid?>"></td>
               <td align="left" width="95%">Title:  <br><input type="text" name="title" size="50" value=""></td>
                 </select>
               </td>
              </tr> 
            </table>
         </fieldset><br>
       <fieldset>
           <legend><strong><font size="4">General</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <td align="left" width="30%">Start Zone:<br>
               <select name="startzone" style="width: 180px;">
<?foreach($zoneids as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $startzone)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
               <td align="left" width="20%">Min Level: <br><input type="text" name="minlevel" size="7" value="0"></td>
               <td align="left" width="20%">Max Level:  <br><input type="text" name="maxlevel" size="7" value="0"></td>              
               <td align="left" width="20%">Duration:  <br><input type="text" name="duration" size="7" value="0"></td>
               <td align="left" width="10%">
                 Repeatable:  <br>
                 <select name="repeatable">
                   <option value="0"<?echo ($repeatable == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($repeatable == 1) ? " selected" : ""?>>Yes</option>
                 </select>
               </td>
              </tr> 
            </table>
         </fieldset><br>

         <fieldset>
           <legend><strong><font size="4">Reward</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <td align="left" width="25%">Reward ID:  <br><input type="text" name="rewardid" size="7" value="0"></td>
               <td align="left" width="25%">Reward XP:  <br><input type="text" name="xpreward" size="7" value="0"></td>
               <td align="left" width="25%">Reward Cash:  <br><input type="text" name="cashreward" size="7" value="0"></td>
               <td align="left" width="25%">Reward Method:<br>
               <select name="rewardmethod" style="width: 180px;">
<?foreach($rewardmethods as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $rewardmethod)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                 </select></td>
             </tr>
              <tr>
               <td align="left" width="33%">Reward Text:  <br><input type="text" name="reward" size="30" value=""></td> 
               <td align="left" width="33%">&nbsp;</td>
               <td align="left" width="34%">&nbsp;</td>             
                </td>
             </tr>
           </table>
         </fieldset><br>
          <fieldset>
           <legend><strong><font size="4">Description</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
             <td><textarea name="description" rows=7 cols=86>[1,]</textarea></td>
                   <td align="right">             
          </td>
           </tr>
           </table>
           </fieldset><br>
           <center>
            <input type="submit" value="Submit Changes">
         </center>
           </div>