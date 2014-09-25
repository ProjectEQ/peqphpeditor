<?php

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
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Quest Editor</a>";
    break;
  case 'inv':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Player Inventory</a>";
    break;
  case 'keys':
    $breadcrumbs = "<a href='index.php?editor=" . $editor . "'>Player Keys</a>";
    break;
}

if ($z != '') $breadcrumbs .= " >> " . "<a href='index.php?editor=" . $editor . "&z=" . $z . "&zoneid=" . getZoneIDByName($z) . "'>" . getZoneLongName($z) . "</a>";
if ($npcid != '' && $npcid !='ID' && $editor != 'altcur' && $editor != 'qglobal') $breadcrumbs .= " >> " . getNPCName($npcid) . " ($npcid)";
if ($fid != '') $breadcrumbs .= " >> " . getFactionName($fid);
if ($tskid != '') $breadcrumbs .= " >> " . getTaskTitle($tskid);
if ($ts != '') $breadcrumbs .= " >> " . "<a href='index.php?editor=" . $editor . "&ts=" . $ts . "'>" . $tradeskills[$ts] . "</a>";
if ($rec != '0') $breadcrumbs .= " >> " . getRecipeName($rec);
if ($spellset != '') $breadcrumbs .= " >> " . getSpellsetName($spellset);
if (($playerid != '') && ($playerid != 'Player ID')) $breadcrumbs .= " >> <a href='index.php?editor=" . $editor . "&playerid=" . $playerid . "'>" . getPlayerName($playerid) . " ($playerid)</a>";
if ($acctid != '') $breadcrumbs .= " >> " . getAccountName($acctid) . " ($acctid)";
if ($guildid != '') $breadcrumbs .= " >> " . getGuildName($guildid) . " ($guildid)";
if ($aaid != '') $breadcrumbs .= " >> " . getAAName($aaid) . " ($aaid)";

?>
