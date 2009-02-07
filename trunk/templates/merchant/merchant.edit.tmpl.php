      <div class="edit_form" style="width: 400px">
      <div class="edit_form_header">
        Edit Merchant List: <?=$id?>
      </div>

      <div class="edit_form_content">
        <form name="merchantlist" method="post" action="index.php?editor=merchant&z=<?=$currzone?>&npcid=<?=$npcid?>&action=2">
        <table width="100%">
          <tr>
            <th>Slot</th>
            <th></th>
            <th>Item</th>
            <th>Item Name</th>
          </tr>
<?$x=1; foreach ($slots as $slot => $v):?>
          <tr>
            <td><?=$slot?></td>
            <td><input type="text" size="3" name="newslot<?=$x?>" value="<?=$slot?>"></td>
            <td><input type="text" size="7" name="item<?=$x?>" value="<?=$v['item']?>"></td>
            <td><?=$v['item_name']?></td>
            <input type="hidden" name="slot<?=$x?>" value="<?=$slot?>">
            
          </tr>
<?$x++; endforeach?>
        </table><br><br>

        <center>
          
          <input type="hidden" name="mid" value="<?=$id?>">
          <input type="hidden" name="count" value="<?=($x - 1)?>">
          <input type="submit" value="Submit Changes">
        </center>
      </form>
      </div>
      </div>
