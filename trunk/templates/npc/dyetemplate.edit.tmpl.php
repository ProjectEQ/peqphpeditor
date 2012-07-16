      <div class="edit_form" style="width: 300px">
      <div class="edit_form_header">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
        <td>Edit Armor tint ID <?=$id?></td>
        <td align="right"> 
        <a onClick="return confirm('Really Delete Tint <?=$id?>?');" href="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&tint_id=<?=$id?>&action=37"><img src="images/remove3.gif" border="0" title="Delete this entry"></a>
        </td>
        </tr>
         </table>
       </div>

      <div class="edit_form_content">
        <form name="Armor tint" method="post" action=index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=34">
        <table width="100%">
           <tr>
            <td align="left" width="33%">&nbsp;</td>
            <td align="left" width="33%">&nbsp;</td>
            <td align="left" width="34%">&nbsp;</td>
           </tr>
           <tr>
            <th>Red Helm</th>
            <th>Green Helm</th>
            <th>Blue Helm</th>
          </tr>
          <tr>
            <td><input type="text" size="5" name="red1h" value="<?=$red1h?>"></td>
            <td><input type="text" size="5" name="grn1h" value="<?=$grn1h?>"></td>
            <td><input type="text" size="5" name="blu1h" value="<?=$blu1h?>"></td>
           </tr>
           <tr>
            <th>Red Chest</th>
            <th>Green Chest</th>
            <th>Blue Chest</th>                
          </tr>
          <tr>          
            <td><input type="text" size="5" name="red2c" value="<?=$red2c?>"></td>
            <td><input type="text" size="5" name="grn2c" value="<?=$grn2c?>"></td>
            <td><input type="text" size="5" name="blu2c" value="<?=$blu2c?>"></td> 
          </tr>
           <tr> 
            <th>Red Arms</th>
            <th>Green Arms</th>
            <th>Blue Arms</th>
           </tr>
           <tr>
            <td><input type="text" size="5" name="red3a" value="<?=$red3a?>"></td>
            <td><input type="text" size="5" name="grn3a" value="<?=$grn3a?>"></td>
            <td><input type="text" size="5" name="blu3a" value="<?=$blu3a?>"></td>
            </tr>
            <tr>
            <th>Red Bracers</th>
            <th>Green Bracers</th>
            <th>Blue Bracers</th>  
          </tr>
            <tr>
            <td><input type="text" size="5" name="red4b" value="<?=$red4b?>"></td>
            <td><input type="text" size="5" name="grn4b" value="<?=$grn4b?>"></td>
            <td><input type="text" size="5" name="blu4b" value="<?=$blu4b?>"></td>
           </tr> 
        <tr> 
            <th>Red Gloves</th>
            <th>Green Gloves</th>
            <th>Blue Gloves</th>
           </tr>
            <tr>
            <td><input type="text" size="5" name="red5g" value="<?=$red5g?>"></td>
            <td><input type="text" size="5" name="grn5g" value="<?=$grn5g?>"></td>
            <td><input type="text" size="5" name="blu5g" value="<?=$blu5g?>"></td>
            </tr>
            <tr>
            <th>Red Legs</th>
            <th>Green Legs</th>
            <th>Blue Legs</th>  
          </tr>
            <tr>
            
            <td><input type="text" size="5" name="red6l" value="<?=$red6l?>"></td>
            <td><input type="text" size="5" name="grn6l" value="<?=$grn6l?>"></td>
            <td><input type="text" size="5" name="blu6l" value="<?=$blu6l?>"></td>
           </tr>    
           <tr> 
            <th>Red Face</th>
            <th>Green Face</th>
            <th>Blue Face</th>
            </tr>
            <tr>
            <td><input type="text" size="5" name="red7f" value="<?=$red7f?>"></td>
            <td><input type="text" size="5" name="grn7f" value="<?=$grn7f?>"></td>
            <td><input type="text" size="5" name="blu7f" value="<?=$blu7f?>"></td>
            </tr>   
	     <th>Red Pri</th>
            <th>Green Pri</th>
            <th>Blue Pri</th>
            </tr>
            <tr>
            <td><input type="text" size="5" name="red8x" value="<?=$red8x?>"></td>
            <td><input type="text" size="5" name="grn8x" value="<?=$grn8x?>"></td>
            <td><input type="text" size="5" name="blu8x" value="<?=$blu8x?>"></td>
            </tr> 
	     <th>Red Sec</th>
            <th>Green Sec</th>
            <th>Blue Sec</th>
            </tr>
            <tr>
            <td><input type="text" size="5" name="red9x" value="<?=$red9x?>"></td>
            <td><input type="text" size="5" name="grn9x" value="<?=$grn9x?>"></td>
            <td><input type="text" size="5" name="blu9x" value="<?=$blu9x?>"></td>
            </tr>      
              </table><br><br>
        <center>
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="hidden" name="npcid" value="<?=$npcid?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>
