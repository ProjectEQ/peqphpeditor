 <form name="bug_edit" method="post" action="index.php?editor=server&action=3">
       <div class="edit_form">
         <div class="edit_form_header">
           View Bug <?=$bid?>
         </div>
         <div class="edit_form_content">
         <center>
         <fieldset style="text-align: left;">
         <table width="100%">
         <tr>
          <td align="center" width="5%"><strong>ID</strong></td>
          <td align="center" width="19%"><strong>Zone</strong></td>
          <td align="center" width="19%"><strong>Toon</strong></td>
          <td align="center" width="19%"><strong>Type</strong></td>
          <td align="center" width="19%"><strong>Target</strong></td>
          <td align="center" width="19%"><strong>Date</strong></td>
         </tr>
         <tr>
          <td align="center" width="5%"><?=$bid?></td>
          <td align="center" width="19%"><?=$zone?></td>
          <td align="center" width="19%"><?=$name?></td>
          <td align="center" width="19%"><?=$type?></td>
          <td align="center" width="19%"><?=$target?></td>
          <td align="center" width="19%"><?=$date?></td>       
        </tr>
        <tr>
          <td align="center" width="5%">&nbsp;</td>
          <td align="center" width="19%"><strong>UI</strong></td>
          <td align="center" width="19%"><strong>X</strong></td>
          <td align="center" width="19%"><strong>Y</strong></td>
          <td align="center" width="19%"><strong>Z</strong></td>
          <td align="center" width="19%"><strong>Flag</strong></td>
         </tr>
         <tr>
          <td align="center" width="5%">&nbsp;</td>
          <td align="center" width="19%"><?=$ui?></td>
          <td align="center" width="19%"><?=$x?></td>
          <td align="center" width="19%"><?=$y?></td>
          <td align="center" width="19%"><?=$z?></td>
          <td align="center" width="19%"><?=$flags[$flag]?></td>
        </tr>
        </table>
        </fieldset><br>
         <fieldset>
         <legend><strong>Bug</strong></legend>
         <table width="100%">
         <tr>
          <td align="center" width="10%"><select name="status">
<?foreach($bugstatus as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $status)? " selected" : "";?>><?=$value?></option>
<?endforeach;?>
                 </select></td>
         <td align="center" width="90%"><?=$bug?></td>
           
        </tr>
          </table>
           </fieldset><br>
        <center>
          <input type="hidden" name="bid" value="<?=$bid?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>