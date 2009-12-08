       <center>
       <table style="border: 1px solid black; background-color: #CCC;">
         <tr><td colspan=2><b>Legend:</b></td></tr>
         <tr><td align=center>&nbsp;Text1: NPC Name/Item Name/Area or Zone&nbsp;</td></tr>
         <tr><td align=center>Text2: Item Name (Deliver, Loot)</td></tr>
         <tr><td align=center>Text3: Overwrites both</td></tr>
       </table><br><br>
       </center>

<form name="activity_add" method="post" action="index.php?editor=tasks&action=10">
       <div class="edit_form">
         <div class="edit_form_header">
           Add Activity to Task <?=$tskid?>
         </div>
         <div class="edit_form_content">
         <center>

       <fieldset>
           <legend><strong><font size="4">General</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <?if($suggeststep > 1):?>
               <td align="left" width="20%">ID: <br><input type="text" name="activityid" size="5" value="<?=$suggestid?>"></td>
               <?endif;?> 
               <?if($suggestid == 1 && $suggeststep == 1):?>
               <td align="left" width="20%">ID: <br><input type="text" name="activityid" size="5" value="0"></td>
               <?endif;?> 
               <td align="left" width="20%">Step: <br><input type="text" name="step" size="5" value="<?=$suggeststep?>"></td>
               </select></td>
               <td align="left" width="20%">
                 Optional:  <br>
                 <select name="optional">
                   <option value="0"<?echo ($optional == 0) ? " selected" : ""?>>No</option>
                   <option value="1"<?echo ($optional == 1) ? " selected" : ""?>>Yes</option>
                 </select>
               </td>
               <td align="left" width="40%">Type:<br>
               <select name="activitytype" style="width: 180px;">
<?foreach($activitytypes as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $activitytype)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?></td>
   
              </tr> 
            </table>
         </fieldset><br>

              <fieldset>
           <legend><strong><font size="4">Text</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <td align="left" width="33%">Text 1:  <br><input type="text" name="text1" size="30" value=""></td>
               <td align="left" width="33%">Text 2:  <br><input type="text" name="text2" size="30" value=""></td>
               <td align="left" width="34%">Text 3:  <br><input type="text" name="text3" size="30" value=""></td>           
                </td>
             </tr>
           </table>
         </fieldset><br>

         <fieldset>
           <legend><strong><font size="4">Goal</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <td align="left" width="20%">Goal ID:  <br><input type="text" name="goalid" size="7" value="0"></td>
                <td align="left" width="20%">Goal Method:<br>
               <select name="goalmethod" style="width: 100px;">
<?foreach($rewardmethods as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $goalmethod)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                 </select></td>
               <td align="left" width="20%">Goal Count:  <br><input type="text" name="goalcount" size="7" value="0"></td>
               <td align="left" width="20%">Deliver to NPC:  <br><input type="text" name="delivertonpc" size="7" value="0"></td>
               <td align="left" width="40%">Zone:<br>
               <select name="zoneid" style="width: 180px;">
<?foreach($zoneids as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $zoneid)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?></td>
             </tr>
           </table><br>
           <center>
            <input type="hidden" name="taskid" value="<?=$tskid?>">
            <input type="submit" value="Submit Changes">
         </center>
           </div>