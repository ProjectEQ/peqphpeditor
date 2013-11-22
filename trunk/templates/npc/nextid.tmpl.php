  <div class="edit_form" style="width:200px;">
    <div class="edit_form_header">
      Find next available NPCID in
    </div>
    <div class="edit_form_content">
      <form name="npc_id" method="post" action="index.php?editor=npc&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$npcid?>&action=41">
        <table width="100%">
          <tr>
            <td align="left" width="30%"> Zone:<br/>
              <select name="npczoneid" style="width:180px;">
<?foreach($zoneids as $key=>$value):?>
                <option value="<?=$key?>"<?echo ($key == $zoneid)? " selected" : "";?>><?=$key?>: <?=$value?></option>
<?endforeach;?>
              </select>
            </td>
          </tr>          
        </table><br/><br/>
        <center><input type="submit" value="GO"></center>
      </form>
    </div>
  </div>
