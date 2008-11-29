      <center>
        <iframe id='searchframe' src='templates/iframes/spellsetsearch.php'></iframe>
        <input id="button" type="button" value='Hide Spellset Search' onclick='hideSearch();' style='display:none; margin-bottom: 20px;'>
      </center>

       <div class="edit_form" style="width:150px">
         <div class="edit_form_header">
           Change Spellset
         </div>
         <div class="edit_form_content">
           <form method="post" action="index.php?editor=spellset&z=<?=$currzone?>&npcid=<?=$npcid?>&action=13">
             <strong>Spellset ID:</strong> (<a href="javascript:showSearch();">search</a>)<br>
             <input class="indented" id="id" type="text" size="10" name="id"><br><br>
             <center>
               <input type="submit" value="Submit">
             </center>
           </form>
         </div>
       </div>