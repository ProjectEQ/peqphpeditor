<?php

$current_revision = "8 January 2017";

require_once("config.php");
require_once("lib/logging.php");
if ($mysql_class == "mysqli")
  require_once("classes/mysqli.php");
else 
  require_once("classes/mysql.php");
require_once("classes/template.php");
require_once("classes/session.php");
require_once("lib/common.php");
require_once("lib/data.php");

$editor = (isset($_GET['editor']) ? $_GET['editor'] : '');
$action = (isset($_GET['action']) ? $_GET['action'] : 0);
$npcid = (isset($_GET['npcid']) ? $_GET['npcid'] : null);
$z = (isset($_GET['z']) ? $_GET['z'] : '');
$zoneid = (isset($_GET['zoneid']) ? $_GET['zoneid'] : '');
$fid = (isset($_GET['fid']) ? $_GET['fid'] : '');
$tskid = (isset($_GET['tskid']) ? $_GET['tskid'] : '');
$ts = (isset($_GET['ts']) ? $_GET['ts'] : '');
$rec = (isset($_GET['rec']) ? intval($_GET['rec']) : '0');
$spellset = (isset($_GET['spellset']) ? $_GET['spellset'] : '');
$playerid = (isset($_GET['playerid']) ? $_GET['playerid'] : null);
$acctid = (isset($_GET['acctid']) ? $_GET['acctid'] : null);
$guildid = (isset($_GET['guildid']) ? $_GET['guildid'] : null);
$aaid = (isset($_GET['aaid']) ? $_GET['aaid'] : null);

$searchbar = '';
$body = '';
$javascript = '';
$breadcrumbs = '';
$headbar = '';

require_once('lib/headbars.php');
require_once('lib/breadcrumbs.php');

if (isset($_GET['admin'])) {
  if (session::is_admin()) {
    require_once('lib/admin.php');
  }
}

switch ($editor) {
  case '':
    $body = new Template("templates/intro.tmpl.php");
    $body->set('current_revision', $current_revision);
    break;
  case 'loot':
    require_once('lib/loot.php');
    break;
  case 'npc':
    require_once('lib/npc.php');
    break;
  case 'spawn':
    require_once('lib/spawn.php');
    break;
  case 'merchant':
    require_once('lib/merchant.php');
    break;
  case 'faction':
    require_once('lib/faction.php');
    break;
  case 'spellset':
    require_once('lib/spellset.php');
    break;
  case 'tradeskill':
    require_once('lib/tradeskill.php');
    break;
  case 'zone':
    require_once('lib/zone.php');
    break;
  case 'misc':
    require_once('lib/misc.php');
    break;
  case 'server':
    require_once('lib/server.php');
    break;
  case 'adventures':
    require_once('lib/adventures.php');
    break;
  case 'tasks':
    require_once('lib/tasks.php');
    break;
  case 'items':
    require_once('lib/items.php');
    break;
  case 'player':
    require_once('lib/player.php');
    break;
  case 'spells':
    require_once('lib/spellenums.php');
    require_once('lib/spells.php');
    break;
  case 'spellops':
    require_once('lib/spellops.php');
    break;
  case 'account':
    require_once('lib/account.php');
    break;
  case 'guild':
    require_once('lib/guild.php');
    break;
  case 'mail':
    require_once('lib/mail.php');
    break;
  case 'aa':
    require_once('lib/spellenums.php');
    require_once('lib/aa.php');
    break;
  case 'qglobal':
    require_once('lib/qglobal.php');
    break;
  case 'util':
    require_once('lib/util.php');
    break;
  case 'altcur':
    require_once('lib/altcur.php');
    break;
  case 'quest':
    require_once('lib/quest.php');
    break;
  case 'inv':
    require_once('lib/inventory.php');
    break;
  case 'keys':
    require_once('lib/keys.php');
    break;
}

$tmpl->set('javascript', $javascript);
$tmpl->set('headbar', $headbar);
$tmpl->set('searchbar', $searchbar);
$tmpl->set('breadcrumbs', $breadcrumbs);
$tmpl->set('body', $body);

echo $tmpl->fetch('templates/index.tmpl.php');

?>
