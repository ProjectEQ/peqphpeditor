       <center>
       <table style="border: 1px solid black; background-color: #CCC;">
         <tr><td colspan=2><b>Legend:</b></td></tr>
         <tr><td align=center>&nbsp;Text1: NPC Name/Item Name/Area or Zone&nbsp;</td></tr>
         <tr><td align=center>Text2: Item Name (Deliver, Loot)</td></tr>
         <tr><td align=center>Text3: Overwrites both</td></tr>
       </table><br><br>
       </center>

<form name="activity_edit" method="post" action="index.php?editor=tasks&action=7">
       <div class="edit_form">
         <div class="edit_form_header">
           Activity for Task: <?=$taskid?>
         </div>
         <div class="edit_form_content">
         <center>

       <fieldset>
           <legend><strong><font size="4">General</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <td align="left" width="20%">ID: <br><input type="text" name="newactivityid" size="5" value="<?=$activityid?>"></td>
               <td align="left" width="20%">Step: <br><input type="text" name="step" size="5" value="<?=$step?>"></td>
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
               <td align="left" width="33%">Text 1:<br><input type="text" name="text1" size="30" value="<?echo htmlentities($text1);?>"></td>
               <td align="left" width="33%">Text 2:<br><input type="text" name="text2" size="30" value="<?echo htmlentities($text2);?>"></td>
               <td align="left" width="34%">Text 3:<br><input type="text" name="text3" size="30" value="<?echo htmlentities($text3);?>"></td>
                </td>
             </tr>
           </table>
         </fieldset><br>

         <fieldset>
           <legend><strong><font size="4">Goal</font></strong></legend>
           <table width="100%" border="0" cellpadding="3" cellspacing="0">
             <tr>
               <td align="left" width="20%">Goal ID:  <br><input type="text" name="goalid" size="7" value="<?=$goalid?>"></td>
                <td align="left" width="20%">Goal Method:<br>
               <select name="goalmethod" style="width: 100px;">
<?foreach($rewardmethods as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $goalmethod)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                 </select></td>
               <td align="left" width="20%">Goal Count:  <br><input type="text" name="goalcount" size="7" value="<?=$goalcount?>"></td>
               <td align="left" width="20%">Deliver to NPC:  <br><input type="text" name="delivertonpc" size="7" value="<?=$delivertonpc?>"></td>
               <td align="left" width="40%">Zone:<br>
               <select name="zoneid" style="width: 180px;">
<?foreach($zoneids as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $zoneid)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?></td>
             </tr>
           </table><br>
           <center>
            <input type="hidden" name="taskid" value="<?=$taskid?>">
            <input type="hidden" name="activityid" value="<?=$activityid?>">
            <input type="submit" value="Submit Changes">
            <input type="button" value="Cancel" onClick="history.back()">
           </center>
         </div>