  <center>
    <div class="page_title"><span><br>Project Everquest Online Editing Interface</span></div>
    <img src="images/dontpanic.jpg" alt="Don't Panic">
    <div class="page_title"><span>PEQ Official Revision<br><a href="https://github.com/ProjectEQ/peqphpeditor" target="_blank"><?=$current_revision?></a></span></div>
  </center>
<?
$php_version = explode(".", phpversion());
if ($php_version[0] < 7):
?>
  <div class="error">
    <table width="100%">
      <tr>
        <td valign="middle" width="30px"><img src="images/caution.gif"></td>
        <td style="padding:0px 5px; font-size:10px;">Support for PHP <?echo phpversion();?> is no longer provided and all references will be removed in future updates. It is recommended you upgrade to PHP 7.</td>
      </tr>
    </table>
  </div>
<? endif; ?>

<?
if (isset($current_db_version) && $current_db_version > 0) {
  global $mysql;

  $query = "SELECT version FROM db_version LIMIT 1";
  $result = $mysql->query_assoc($query);

  if ($result) {
    $local_db_version = $result['version'];
    if ($local_db_version != $current_db_version):
?>
  <div class="error">
    <table width="100%">
      <tr>
        <td valign="middle" width="30px"><img src="images/caution.gif"></td>
        <td style="padding:0px 5px; font-size:10px;">Your database schema (<?=$local_db_version?>) does not match the current binary database version (<?=$current_db_version?>) which this editor supports.<br>Proceed with caution as you may experience errors or inaccurate data if you continue.</td>
      </tr>
    </table>
  </div>

<?
    endif;
  }
}
?>
