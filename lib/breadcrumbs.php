<?

switch ($editor) {
  case '':
    break;
  case 'npc':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>NPC Editor</a>";
    break;
  case 'loot':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Loot Editor</a>";
    break;
  case 'spawn':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Spawn Editor</a>";
    break;
  case 'merchant':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Merchant Editor</a>";
    break;
  case 'spellops':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Spell Options</a>";
    break;
  case 'spells':
    $breadcrumbs = "<a href='index.php?editor=spellops'>Spell Options</a>" . " >> " . "<a href='index.php?editor=" . $editor . "'>Spell Editor</a>";
    break;
  case 'spellset':
    $breadcrumbs = "<a href='index.php?editor=spellops'>Spell Options</a>" . " >> " . "<a href='index.php?editor=" . $editor . "'>Spellset Editor</a>";
    break;
  case 'faction':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Faction Editor</a>";
    break;
  case 'tradeskill':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Tradeskill Editor</a>";
    break;
  case 'zone':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Zone Editor</a>";
    break;
  case 'misc':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Miscellaneous Editor</a>";
    break;
  case 'server':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Server Config</a>";
    break;
  case 'adventures':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Adventures Editor</a>";
    break;
  case 'tasks':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Task Editor</a>";
    break;
  case 'items':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Item Editor</a>";
    break;
  case 'player':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Players</a>";
    break;
  case 'account':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Accounts</a>";
    break;
  case 'guild':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Guilds</a>";
    break;
  case 'mail':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Mail</a>";
    break;
  case 'aa':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>AAs</a>";
    break;
  case 'qglobal':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Quest Globals</a>";
    break;
  case 'util':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Utilities</a>";
    break;
  case 'altcur':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Alternate Currency</a>";
    break;
  case 'quest':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Quest Viewer</a>";
    break;
  case 'inv':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Player Inventory</a>";
    break;
  case 'keys':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Player Keys</a>";
    break;
  case 'titles':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Title Editor</a>";
    break;
  case 'auras':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Auras Editor</a>";
    break;
  case 'pvp':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>PVP Editor</a>";
    break;
  case 'databuckets':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Data Buckets</a>";
    break;
  case 'content':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Content Flags</a>";
    break;
  case 'expeditions':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Expeditions</a>";
    break;
  case 'sharedtasks':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Shared Tasks</a>";
    break;
  case 'mercs':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Mercenaries</a>";
    break;
  case 'chat':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Chat Channels</a>";
    break;
}

if (isset($z) && $z != '') $breadcrumbs .= " >> " . "<a href='index.php?editor=" . $editor . "&z=" . $z . "&zoneid=" . $zoneid . "'>" . getZoneLongName($z, getZoneVersion($zoneid)) . "</a>";
if (isset($npcid) && intval($npcid) > 0 && $editor != 'altcur' && $editor != 'qglobal') $breadcrumbs .= " >> " . getNPCName($npcid) . " ($npcid)";
if (isset($fid) && intval($fid) > 0) $breadcrumbs .= " >> " . getFactionName($fid);
if (isset($tskid) && intval($tskid) > 0) $breadcrumbs .= " >> " . getTaskTitle($tskid);
if (isset($ts) && intval($ts) > 0) $breadcrumbs .= " >> " . "<a href='index.php?editor=" . $editor . "&ts=" . $ts . "'>" . $tradeskills[$ts] . "</a>";
if (isset($rec) && intval($rec) > 0) $breadcrumbs .= " >> " . getRecipeName($rec);
if (isset($spellset) && intval($spellset) > 0) $breadcrumbs .= " >> " . getSpellsetName($spellset);
if (isset($playerid) && intval($playerid) > 0) $breadcrumbs .= " >> <a href='index.php?editor=" . $editor . "&playerid=" . $playerid . "'>" . getPlayerName($playerid) . " ($playerid)</a>";
if (isset($acctid) && intval($acctid) > 0) $breadcrumbs .= " >> " . getAccountName($acctid) . " ($acctid)";
if (isset($guildid) && intval($guildid) > 0) $breadcrumbs .= " >> <a href='index.php?editor=" . $editor . "&guildid=" . $guildid . "'>" . getGuildName($guildid) . " ($guildid)</a>";
if (isset($aaid) && intval($aaid) > 0) $breadcrumbs .= " >> " . getAAName($aaid) . " ($aaid)";
if (isset($nseid) && intval($nseid) > 0) $breadcrumbs .= " >> <a href='index.php?editor=" . $editor . "&action=11'>NPC Spells Effects</a>";

?>
