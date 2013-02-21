      <center>
        <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
        <input id="button" type="button" value='Hide Item Search' onclick='hideSearch("searchframe");' style='display:none; margin-bottom: 20px;'>
      </center>

       <form name="addloot" method="post" action="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&ldid=<?=$ldid?>&action=21">
         <div class="edit_form" style="width: 200px">
           <div class="edit_form_header">
             Add an Item to LootDrop <?=$ldid?>
           </div>
           <div class="edit_form_content">
             <strong>Enter an Item ID:</strong> (<a href="javascript:showSearch('searchframe');">search</a>)<br>
             <input class="indented" id="id" type="text" size="5" name="itemid"><br><br>
	      <strong>Charges:</strong><br>
	      <input class="indented" type="text" size="5" name="item_charges" value=1><br><br>
	      <strong>Chance:</strong><br>
	      <input class="indented" type="text" size="5" name="chance">%<br><br>
	      <strong>Multiplier:</strong><br>
	      <input class="indented" type="text" size="5" name="multiplier" value=1><br><br>
             <center>
               <input type="hidden" name="mid" value="<?=$mid?>">
               <input type="submit" name="submit" value=" Submit ">
             </center>
           </div>
         </div>
       </form>
