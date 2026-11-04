  <center>
    <div class="page_title"><span><br>Project Everquest Online Editing Interface</span></div>
    <img src="images/dontpanic.jpg" alt="Don't Panic">
    <div class="page_title"><span>PEQ Official Revision<br><a href="https://github.com/ProjectEQ/peqphpeditor" target="_blank"><?=$current_revision?></a></span></div>
  </center>
<?
$php_version = phpversion();
if (!php_version_meets_security_baseline($php_version)):
?>
  <div class="error">
    <table width="100%">
      <tr>
        <td valign="middle" width="30px"><img src="images/caution.gif"></td>
        <td style="padding:0px 5px; font-size:10px;">PHP <?=htmlspecialchars($php_version, ENT_QUOTES, 'UTF-8');?> does not match a known patched upstream release for CVE-2026-109618 and CVE-2026-109619. Update the web server's PHP runtime to the latest security release in a supported branch: at least 8.2.35, 8.3.36, 8.4.27, or 8.5.12 in the corresponding branch. If your vendor backports fixes or you use an unlisted version, verify both fixes with your provider. This warning cannot verify vendor patches and does not protect an unpatched runtime. See the <a href="https://www.php.net/archive/2026.php#2026-10-21-5" target="_blank" rel="noopener noreferrer">PHP security advisory</a>.</td>
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
