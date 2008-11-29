      <center>
        <iframe id='searchframe' src='templates/iframes/itemsearch.php'></iframe>
        <input id="button" type="button" value='Hide Item Search' onclick='hideSearch("searchframe");' style='display:none; margin-bottom: 20px;'>
      </center>

       <form name="addloot" method="post" action="index.php?editor=loot&z=<?=$currzone?>&npcid=<?=$npcid?>&ldid=<?=$ldid?>&action=21">
         <div class="edit_form" style="width: 200px">
           <div class="edit_form_header">
             Add an Item to LootDrop <?=$ldid?>
           </div>
           <div class="edit_form_content">
             <strong>Enter an Item ID:</strong> (<a href="javascript:showSearch('searchframe');">search</a>)<br>
             <input class="indented" id="id" type="text" name="itemid"><br><br>
             <center>
               <input type="hidden" name="mid" value="<?=$mid?>">
               <input type="submit" name="submit" value=" Submit ">
             </center>
           </div>
         </div>
       </form>
