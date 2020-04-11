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
      <form name="Armor tint" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=34">
        <table width="100%">
          <tr>
            <td align="left" width="33%">&nbsp;</td>
            <td align="left" width="33%">&nbsp;</td>
            <td align="left" width="34%">&nbsp;</td>
          </tr>
          <tr>
            <td><strong>Red Helm</strong></td>
            <td><strong>Green Helm</strong></td>
            <td><strong>Blue Helm</strong></td>
          </tr>
          <tr>
            <td><input type="text" size="5" name="red1h" value="<?=$red1h?>"></td>
            <td><input type="text" size="5" name="grn1h" value="<?=$grn1h?>"></td>
            <td><input type="text" size="5" name="blu1h" value="<?=$blu1h?>"></td>
          </tr>
          <tr>
            <td><strong>Red Chest</strong></td>
            <td><strong>Green Chest</strong></td>
            <td><strong>Blue Chest</strong></td>                
          </tr>
          <tr>          
            <td><input type="text" size="5" name="red2c" value="<?=$red2c?>"></td>
            <td><input type="text" size="5" name="grn2c" value="<?=$grn2c?>"></td>
            <td><input type="text" size="5" name="blu2c" value="<?=$blu2c?>"></td> 
          </tr>
          <tr> 
            <td><strong>Red Arms</strong></td>
            <td><strong>Green Arms</strong></td>
            <td><strong>Blue Arms</strong></td>
          </tr>
          <tr>
            <td><input type="text" size="5" name="red3a" value="<?=$red3a?>"></td>
            <td><input type="text" size="5" name="grn3a" value="<?=$grn3a?>"></td>
            <td><input type="text" size="5" name="blu3a" value="<?=$blu3a?>"></td>
          </tr>
          <tr>
            <td><strong>Red Bracers</strong></td>
            <td><strong>Green Bracers</strong></td>
            <td><strong>Blue Bracers</strong></td>  
          </tr>
          <tr>
            <td><input type="text" size="5" name="red4b" value="<?=$red4b?>"></td>
            <td><input type="text" size="5" name="grn4b" value="<?=$grn4b?>"></td>
            <td><input type="text" size="5" name="blu4b" value="<?=$blu4b?>"></td>
          </tr> 
          <tr> 
            <td><strong>Red Gloves</strong></td>
            <td><strong>Green Gloves</strong></td>
            <td><strong>Blue Gloves</strong></td>
          </tr>
          <tr>
            <td><input type="text" size="5" name="red5g" value="<?=$red5g?>"></td>
            <td><input type="text" size="5" name="grn5g" value="<?=$grn5g?>"></td>
            <td><input type="text" size="5" name="blu5g" value="<?=$blu5g?>"></td>
          </tr>
          <tr>
            <td><strong>Red Legs</strong></td>
            <td><strong>Green Legs</strong></td>
            <td><strong>Blue Legs</strong></td>  
          </tr>
          <tr>
            <td><input type="text" size="5" name="red6l" value="<?=$red6l?>"></td>
            <td><input type="text" size="5" name="grn6l" value="<?=$grn6l?>"></td>
            <td><input type="text" size="5" name="blu6l" value="<?=$blu6l?>"></td>
          </tr>    
          <tr> 
            <td><strong>Red Face</strong></td>
            <td><strong>Green Face</strong></td>
            <td><strong>Blue Face</strong></td>
          </tr>
          <tr>
            <td><input type="text" size="5" name="red7f" value="<?=$red7f?>"></td>
            <td><input type="text" size="5" name="grn7f" value="<?=$grn7f?>"></td>
            <td><input type="text" size="5" name="blu7f" value="<?=$blu7f?>"></td>
          </tr>   
          <tr>
	        <td><strong>Red Pri</strong></td>
            <td><strong>Green Pri</strong></td>
            <td><strong>Blue Pri</strong></td>
          </tr>
          <tr>
            <td><input type="text" size="5" name="red8x" value="<?=$red8x?>"></td>
            <td><input type="text" size="5" name="grn8x" value="<?=$grn8x?>"></td>
            <td><input type="text" size="5" name="blu8x" value="<?=$blu8x?>"></td>
          </tr>
          <tr>
	        <td><strong>Red Sec</strong></td>
            <td><strong>Green Sec</strong></td>
            <td><strong>Blue Sec</strong></td>
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
