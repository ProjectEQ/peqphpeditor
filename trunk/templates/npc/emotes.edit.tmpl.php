        <form name="emotes" method="post" action=index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=75">
         <div class="edit_form" style="width: 510px;">
        <div class="edit_form_header">
          Edit Emote <?=$id?>
        </div>
         <div class="edit_form_content">
            <center>
            <strong>Event</strong><br>
            <select name="event_" style="width: 150px;">
<?foreach($eventtype as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $event_)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                 </select><br><br>
            <strong>Type</strong><br>
            <select name="type" style="width: 100px;">
<?foreach($emotetype as $key=>$value):?>
                   <option value="<?=$key?>"<?echo ($key == $type)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
                 </select><br><br>
            <strong>Emote</strong><br>
            </center>
            <input class="indented" id="id" type="text" name="text" size="75" value="<?=$text?>"><br><br>
        <center>
          <input type="hidden" name="id" value="<?=$id?>">
          <input type="hidden" name="emoteid" value="<?=$emoteid?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>