  <form method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=77">
    <div class="edit_form" style="width: 510px;">
      <div class="edit_form_header">
        Add emote to set <?=$emoteid?> Current NPC is: <?=$npcid?>
      </div>
      <div class="edit_form_content">
        <center>
          <strong>EmoteID</strong><br>
          <input class="indented" id="id" type="text" name="emoteid" size="7" value="<?=$emoteid?>"><br><br>
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
          <input class="indented" id="id" type="text" name="text" size="75" value=""><br><br>
          <input type="hidden" name="emoteid" value="<?=$emoteid?>">
          <input type="submit" value="Submit Changes">
        </center>
      </div>
    </div>
  </form>
