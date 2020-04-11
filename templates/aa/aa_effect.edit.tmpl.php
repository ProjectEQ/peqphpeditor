  <div class="edit_form" style="width:300px;">
    <div class="edit_form_header">
<?
  if ($editmode == 1)
    echo "Edit AA Effect";
  else
    echo "Add New AA Effect";
?>
      <br>
    </div>
    <div class="edit_form_content">
      <form name="aa_effect" method="post" action="index.php?editor=aa&aaid=<?=($aaid-$rank+1)?>&rank=<?=$rank?>&action=<?if ($editmode == 1) echo "13"; else echo "17";?>">
        <fieldset>
          <legend><b>Effect</b></legend>
          <table width="100%">
            <tr>
              <td>
                Slot:<br>
                <input type="text" name="slot" size="5" value="<?=$slot?>"><br><br>
              </td>
              <td>
                Effect:<br>
                <input type="text" name="effectid" size="5" value="<?=$effectid?>"><br><br>
              </td>
              <td>
                Base 1:<br>
                <input type="text" name="base1" size="5" value="<?=$base1?>"><br><br>
              </td>
              <td>
                Base 2:<br>
                <input type="text" name="base2" size="5" value="<?=$base2?>"><br><br>
              </td>
            </tr>
          </table>
        </fieldset>
        <fieldset>
          <legend><b>Attached to</b></legend>
          <table width="100%">
            <tr>
              <td>
                Rank:<br>
                <select name="ranksel">
<? for ($i=1 ; $i<=$rank_max; $i++) { ?>
                  <option value="<?=$i?>"<?if($i==$rank) echo " selected";?>>Rank<?=$i?></option>
<? } ?>
                  <option value="useraw">Use Raw</option>
                </select>
              </td>
              <td>
                Raw AAID:<br>
                <input type="text" name="raw_aaid" size="5" value="<?=$aaid?>"><br>
              </td>
              <td align="right">
                Key ID:<br>
                <input type="text" name="id" size="5" value="<?=$id?>"><br>
              </td>
            </tr>
          </table>
        </fieldset><br>
        <center><input type="submit" value="Sumbit Changes"></center>
        <input type="hidden" name="oldid" value="<?=$oldid?>">
      </form>
    </div>
  </div>
  <center>
    <br>
    Known Effect Codes:<br>
    <select id="splist" onchange="document.aa_effect.effectid.value=this.value;">
<? foreach($sp_effects as $key => $value):?>
      <option value="<?=$key?>"<?if($key == $effectid) echo " selected";?>><? echo "$key: $value";?></option>
<? endforeach; ?>
    </select>
  </center>
