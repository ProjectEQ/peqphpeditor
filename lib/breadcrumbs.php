<?php

switch ($editor) {
  case '':
    break;
  case 'loot':
    $breadcrumbs = "Loot Editor";
    break;
  case 'npc':
    $breadcrumbs = "NPC Editor";
    break;
  case 'spawn':
    $breadcrumbs = "Spawn Editor";
    break;
  case 'merchant':
    $breadcrumbs = "Merchant Editor";
    break;
  case 'faction':
    $breadcrumbs = "Faction Editor";
    break;
  case 'spellops':
    $breadcrumbs = "Spell Options";
    break;
  case 'spells':
    $breadcrumbs = "Spell Editor";
    break;
  case 'spellset':
    $breadcrumbs = "Spellset Editor";
    break;
  case 'tradeskill':
    $breadcrumbs = "Tradeskill Editor";
    break;
  case 'zone':
    $breadcrumbs = "Zone Editor";
    break;
  case 'misc':
    $breadcrumbs = "Miscellaneous Editor";
    break;
  case 'server':
    $breadcrumbs = "Server Config";
    break;
  case 'adventures':
    $breadcrumbs = "Adventures Editor";
    break;
  case 'tasks':
    $breadcrumbs = "Task Editor";
    break;
  case 'items':
    $breadcrumbs = "Item Editor";
    break;
  case 'player':
    $breadcrumbs = "Players";
    break;
}

if ($z != '') $breadcrumbs .= " >> " . getZoneLongName($z);
if ($npcid != '') $breadcrumbs .= " >> " . getNPCName($npcid) . " ($npcid)";
if ($fid != '') $breadcrumbs .= " >> " . getFactionName($fid);
if ($tskid != '') $breadcrumbs .= " >> " . getTaskTitle($tskid);
if ($ts != '') $breadcrumbs .= " >> " . $tradeskills[$ts];
if ($rec != '0') $breadcrumbs .= " >> " . getRecipeName($rec);
if ($spellset != '') $breadcrumbs .= " >> " . getSpellsetName($spellset);
if ($playerid != '') $breadcrumbs .= " >> " . getPlayerName($playerid) . " ($playerid)";

?>
