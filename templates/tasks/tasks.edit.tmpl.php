<form name="adventure_edit" method="post" action="index.php?editor=tasks&action=2">
       <div class="edit_form">
         <div class="edit_form_header">
           Task: <?=$title?> (<?=$id?>)
         </div>
         <div class="edit_form_content">
         <center>

       <fieldset>
           <legend><strong><font size="4">Title</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <td align="left" width="100%"><input type="text" name="title" size="50" value="<?echo htmlentities($title);?>"></td>
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
               <td align="left" width="20%">Min Level: <br><input type="text" name="minlevel" size="7" value="<?=$minlevel?>"></td>
               <td align="left" width="20%">Max Level:  <br><input type="text" name="maxlevel" size="7" value="<?=$maxlevel?>"></td>              
               <td align="left" width="20%">Duration:  <br><input type="text" name="duration" size="7" value="<?=$duration?>"></td>
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
               <td align="left" width="25%">Reward ID:  <br><input type="text" name="rewardid" size="7" value="<?=$rewardid?>"></td>
               <td align="left" width="25%">Reward XP:  <br><input type="text" name="xpreward" size="7" value="<?=$xpreward?>"></td>
               <td align="left" width="25%">Reward Cash:  <br><input type="text" name="cashreward" size="7" value="<?=$cashreward?>"></td>
               <td align="left" width="25%">Reward Method:<br>
               <select name="rewardmethod" style="width: 180px;">
<?foreach($rewardmethods as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $rewardmethod)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                 </select></td>
             </tr>
              <tr>
               <td align="left" width="33%">Reward Text:  <br><input type="text" name="reward" size="30" value="<?echo htmlentities($reward);?>"></td> 
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
             <td><textarea name="description" rows=7 cols=86><?echo htmlentities($description);?></textarea></td>
                   <td align="right">             
          </td>
           </tr>
           </table>
           </fieldset><br>
           <center>
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="submit" value="Submit Changes">&nbsp;
            <input type="button" value="Cancel" onClick="history.back()">
           </center>
          </div>
