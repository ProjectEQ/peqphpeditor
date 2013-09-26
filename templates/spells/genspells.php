<?php

$spellfile = "spells_us.txt";

$spellquery = "SELECT * FROM spells_new ORDER BY id";
$res = mysql_query($spellquery);

$fh = fopen($spellfile, 'w');
if(!$fh) { die("Error opening $spellfile for writing.  Make sure the path is writable."); }

$cnt = 0;
$lastid = 0;

//Based on export_spells.pl bundled with eqemu, the spells_us.txt file is just a ^ delemited copy of the spell table.
while($row = mysql_fetch_assoc($res))
{
 $cnt++;
 if($row[id] > $lastid) { $lastid = $row[id]; }
 fwrite($fh, implode("^", $row) . "\n");
}

fclose($fh);

?>
  <table class="edit_form">
    <tr>
      <td class="edit_form_header">Generate Spell File</td>
    </tr>
    <tr>
      <td class="edit_form_content">
        <center>
<?echo $cnt; ?> spells written.<br><?echo $lastid; ?> is the highest ID<br><b><a href="spells_us.txt">Right click and choose 'Save Link As' or 'Save Target As' to download spell file</a></b>
        </center>
      </td>
    </tr>
  </table>
