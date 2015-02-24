<?php

$wandertype = array(
  0 => "Circular",
  1 => "Random 10",
  2 => "Random",
  3 => "Patrol",
  4 => "One Way Respawn",
  5 => "Random 5 LoS",
  6 => "One Way"
);

$pausetype = array(
  0 => "Random Half",
  1 => "Full",
  2 => "Random"
);

$ochangetype = array(
  0 => "Nothing",
  1 => "Depop",
  2 => "Repop",
  3 => "RepopIfReady"
);

$actiontype = array(
  0 => "Set",
  1 => "Add",
  2 => "Subtract",
  3 => "Multiply",
  4 => "Divide"
);

$animations = array(
  0 => "Standing",
  1 => "Sitting",
  2 => "Crouching",
  3 => "Lying",
  4 => "Kneeling"
);

$despawntype = array(
  0 => "None",
  1 => "Repop",
  2 => "Repop using Timer",
  3 => "Depop",
  4 => "Depop using Timer"
);

switch ($action) {
  case 0:  // View Spawngroups
    if ($npcid) {
      $body = new Template("templates/spawn/spawn.tmpl.php");
      $body->set('currzone', $z);
      $body->set('currzoneid', $zoneid);
      $body->set('npcid', $npcid);
      $spawngroups = get_spawngroups('');
      $body->set('spawngroups', $spawngroups);
      $body->set('despawntype', $despawntype);
    }
    else {
      if ($z) {
        $body = new Template("templates/spawn/spawn.default.tmpl.php");
        $body->set('currzone', $z);
        $body->set('currzoneid', $zoneid);
      }
    }
    break;
  case 1: // Edit Spawngroup Member
    check_authorization();
    $body = new Template("templates/spawn/spawn.member.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('sgnpcid', $_GET['sgnpcid']);
    $body->set('npcname', getNPCName($_GET['sgnpcid']));
    $vars = get_spawngroup_member_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2:  // Update Spawngroup member
    check_authorization();
    update_spawngroup_member();
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 3:  // Balance spawngroup spawns
    check_authorization();
    balance_spawns('');
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 4: // Edit Spawngroup name
    check_authorization();
    $body = new Template("templates/spawn/spawngroup.name.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('sid', $_GET['sid']);
    $body->set('despawntype', $despawntype);
    $vars = get_spawngroup_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 5:  // Update spawngroup name
    check_authorization();
    update_spawngroup_name();
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 6:  // Delete spawngroup
    check_authorization();
    delete_spawngroup();
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 7:  // Delete spawngroup member
    check_authorization();
    delete_spawngroup_member('');
    $npcid = valid_npc();
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 8: // Add spawngroup member
    check_authorization();
    $body = new Template("templates/spawn/spawngroup.member.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('sid', $_GET['sid']);
    $vars = get_spawngroup_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 9: // Process add npc form
    check_authorization();
    if (isset($_POST['search']) && ($_POST['search'] != '')) {
      $body = new Template("templates/spawn/spawngroup.member.searchresults.tmpl.php");
      $body->set('currzone', $z);
      $body->set('currzoneid', $zoneid);
      $body->set('npcid', $npcid);
      $body->set('sid', $_GET['sid']);
      $results = search_npc_types($_POST['search']);
      $body->set('results', $results);
    }
    else {
      add_spawngroup_member($_REQUEST['npc']);
      header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid");
      exit;
    }
    break;
  case 10:  // View Spawnpoints
    check_authorization();
    if ($npcid) {
      $body = new Template("templates/spawn/spawnpoint.tmpl.php");
      $body->set('currzone', $z);
      $body->set('currzoneid', $zoneid);
      $body->set('npcid', $npcid);
      $sid = $_GET['sid'];
      $body->set('sid', $sid);
      $spawnpoints = get_spawnpoints();
      $body->set('spawnpoints', $spawnpoints);
      $body->set('animations', $animations);
    }
    else {
      header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&action=31");
      exit;
    }
    break;
  case 11:  // Edit Spawnpoint
    check_authorization();
    $body = new Template("templates/spawn/spawnpoint.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('animations', $animations);
    $spawnpoint = spawnpoint_info();
    if ($spawnpoint) {
      foreach ($spawnpoint as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 12:  // Update spawnpoint
    check_authorization();
    update_spawnpoint();
    $sid = $_POST['spawngroupID'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&sid=$sid&action=10");
    exit;
  case 13: // Delete spawnpoint
    check_authorization();
    delete_spawnpoint();
    $sid = $_GET['sid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&sid=$sid&action=10");
    exit;
  case 14: // Add spawnpoint
    check_authorization();
    $body = new Template("templates/spawn/spawnpoint.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('zone', $z);
    $body->set('npcid', $npcid);
    $sid = $_GET['sid'];
    $body->set('spawngroupID', $sid);
    $body->set('suggestedid', suggest_spawnpoint_id());
    $body->set('animations', $animations);
    break;
  case 15:  // Add Spawnpoint
    check_authorization();
    add_spawnpoint();
    $sid = $_POST['spawngroupID'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&sid=$sid&action=10");
    exit;
  case 16: // Add Spawngroup Choice
    check_authorization();
    $body = new Template("templates/spawn/spawngroup.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    break;
  case 17:  // Add Spawngroup
    check_authorization();
    add_spawngroup();
    $npcid = $_POST['npcID'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 18: // Add Grid
    check_authorization();
    $body = new Template("templates/spawn/grid.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('zid', getZoneID($z));
    $body->set('wandertype', $wandertype);
    $body->set('pausetype', $pausetype);
    $body->set('spid', $_GET['spid']);
    $sid = $_GET['sid'];
    $body->set('sid', $sid);
    $npcid = $_GET['npcid'];
    $body->set('npcid', $npcid);
    $body->set('suggestedid', suggest_grid_id());
    break;
  case 19:  // Add grid
    check_authorization();
    add_grid();
    $npcid = $_POST['npcid'];
    $sid = $_POST['sid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&sid=$sid&action=10");
    exit;
  case 20: // View grid
    check_authorization();
    $body = new Template("templates/spawn/grid.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('wandertype', $wandertype);
    $body->set('pausetype', $pausetype);
    $body->set('npcid', $npcid);
    $body->set('pathgrid', $_GET['pathgrid']);
    $body->set('spid', $_GET['spid']);
    $vars = gridentry_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    $grid = grid_info();
    if ($grid) {
      foreach ($grid as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 21: // Edit grid
    check_authorization();
    $body = new Template("templates/spawn/grid.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('wandertype', $wandertype);
    $body->set('pausetype', $pausetype);
    $body->set('npcid', $npcid);
    $body->set('spid', $_GET['spid']);
    $body->set('pathgrid', $_GET['pathgrid']);
    $grid = grid_info();
    if ($grid) {
      foreach ($grid as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 22: // Update grid
    check_authorization();
    update_grid();
    $npcid = $_GET['npcid'];
    $spid = $_GET['spid'];
    $pathgrid = $_POST['pathgrid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&spid=$spid&pathgrid=$pathgrid&action=20");
    exit;
  case 23:  // Delete Grid Entry
    check_authorization();
    delete_gridentry();
    $npcid = $_GET['npcid'];
    $pathgrid = $_GET['pathgrid'];
    $spid = $_GET['spid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&spid=$spid&pathgrid=$pathgrid&action=20");
    exit;
  case 24: // Edit Grid Entry
    check_authorization();
    $body = new Template("templates/spawn/gridentry.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('pathgrid', $_GET['pathgrid']);
    $body->set('spid', $_GET['spid']);
    $vars = gridpoint_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 25: // Update Grid Entry
    check_authorization();
    update_gridentry();
    $npcid = $_GET['npcid'];
    $pathgrid = $_POST['pathgrid'];
    $spid = $_GET['spid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&spid=$spid&pathgrid=$pathgrid&action=20");
    exit;
  case 26:  // Delete Grid Entries
    check_authorization();
    delete_gridentries();
    $npcid = $_GET['npcid'];
    $pathgrid = $_GET['pathgrid'];
    $spid = $_GET['spid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&spid=$spid&pathgrid=$pathgrid&action=20");
    exit;
  case 27: // Add Grid Entry
    check_authorization();
    $body = new Template("templates/spawn/gridentry.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('zid', getZoneID($z));
    $body->set('npcid', $npcid);
    $body->set('pathgrid', $_GET['pathgrid']);
    $body->set('spid', $_GET['spid']);
    $body->set('suggestednum', suggest_grid_number());
    break;
  case 28:  // Add Grid Entry
    check_authorization();
    add_gridentry();
    $npcid = $_GET['npcid'];
    $pathgrid = $_POST['pathgrid'];
    $spid = $_GET['spid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&spid=$spid&pathgrid=$pathgrid&action=20");
    exit;
  case 29:  // Delete Grid
    check_authorization();
    delete_grid();
    $sid = spawnpoint_fromgrid();
    $npcid = $_GET['npcid'];
    $pathgrid = $_GET['pathgrid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&sid=$sid&action=10");
    exit;
  case 30: // Reset respawn timer
    check_authorization();
    force_spawn();
    $sid = $_GET['sid'];
    $npcid = $_GET['npcid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&sid=$sid&action=10");
    break;
  case 31: // View zone grids
    check_authorization();
    $body = new Template("templates/spawn/grid.zone.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('wandertype', $wandertype);
    $body->set('pausetype', $pausetype);
    $body->set('npcid', $npcid);
    $grid = grid_info_zone();
    if ($grid) {
      foreach ($grid as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 32:  // Delete Grid without a spawnpoint
    check_authorization();
    delete_grid_ns();
    $pathgrid = $_GET['pathgrid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&action=31");
    exit;
  case 33: // Add Grid from zone page
    check_authorization();
    $body = new Template("templates/spawn/grid.zone.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('zid', getZoneID($z));
    $body->set('wandertype', $wandertype);
    $body->set('pausetype', $pausetype);
    $body->set('suggestedid', suggest_grid_id());
    break;
  case 34:  // Add grid from zone page
    check_authorization();
    add_grid();
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&action=31");
    exit;
  case 35: // View spawn time
    check_authorization();
    $body = new Template("templates/spawn/spawntimer.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $_GET['npcid']);
    $body->set('sid', $_GET['sid']);
    $body->set('spid', $_GET['spid']);
    $spawned = is_spawned();
    if ($spawned) {
      foreach ($spawned as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 36: // View spawn_conditions and events
    check_authorization();
    $body = new Template("templates/spawn/spawncondition.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $_GET['npcid']);
    $body->set('spid', $_GET['spid']);
    $body->set('ochangetype', $ochangetype);
    $body->set('actiontype', $actiontype);
    $body->set('yesno', $yesno);
    $spawnc = get_spawn_condition();
    if ($spawnc) {
      foreach ($spawnc as $key=>$value) {
        $body->set($key, $value);
      }
    }
    $spawne = get_spawn_event();
    if ($spawne) {
      foreach ($spawne as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 37: // Edit spawnevent
    check_authorization();
    $body = new Template("templates/spawn/spawnevent.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('spid', $_GET['spid']);
    $vars = spawnevent_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 38: // Update spawnevent
    check_authorization();
    update_spawnevent();
    $npcid = $_GET['npcid'];
    $spid = $_GET['spid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&spid=$spid&action=36");
    exit;
  case 39:  // Delete spawnevent
    check_authorization();
    delete_spawnevent();
    $npcid = $_GET['npcid'];
    $spid = $_GET['spid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&spid=$spid&action=36");
    exit;
  case 40: // Add spawnevent
    check_authorization();
    $body = new Template("templates/spawn/spawnevent.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('spid', $_GET['spid']);
    $body->set('suggestedseid', suggest_spawnevent_id());
    break;
  case 41:  // Add spawnevent
    check_authorization();
    add_spawnevent();
    $npcid = $_GET['npcid'];
    $spid = $_GET['spid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&spid=$spid&action=36");
    exit;
  case 42: // Edit spawncondition
    check_authorization();
    $body = new Template("templates/spawn/spawncondition.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('spid', $_GET['spid']);
    $vars = spawncondition_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 43: // Update spawncondition
    check_authorization();
    update_spawncondition();
    $npcid = $_GET['npcid'];
    $spid = $_GET['spid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&spid=$spid&action=36");
    exit;
  case 44:  // Delete spawncondition
    check_authorization();
    delete_spawncondition();
    $npcid = $_GET['npcid'];
    $spid = $_GET['spid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&spid=$spid&action=36");
    exit;
  case 45: // Add spawncondition
    check_authorization();
    $body = new Template("templates/spawn/spawncondition.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('spid', $_GET['spid']);
    $body->set('suggestedscid', suggest_spawncondition_id());
    $body->set('suggestedval', suggest_spawncondition_value());
    break;
  case 46:  // Add spawncondition
    check_authorization();
    add_spawncondition();
    $npcid = $_GET['npcid'];
    $spid = $_GET['spid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&spid=$spid&action=36");
    exit;
  case 47: // // View respawn time
    check_authorization();
    $body = new Template("templates/spawn/spawntimer.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $_GET['npcid']);
    $body->set('spid', $_GET['spid']);
    $body->set('sid', $_GET['sid']);
    $spawned = view_respawn();
    if ($spawned) {
      foreach ($spawned as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 48: // Update respawn time
    check_authorization();
    update_spawntimer();
    $npcid = $_GET['npcid'];
    $spid = $_GET['spid'];
    $sid = $_GET['sid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&sid=$sid&action=10");
    exit;
  case 49:  // Search npcs
    $body = new Template("templates/spawn/spawn.searchresults.tmpl.php");
    if (isset($_GET['npcid']) && $_GET['npcid'] != "ID") {
      $results = search_npc_by_id();
    }
    else {
      $results = search_npcs();
    }
    $body->set("results", $results);
    break;
  case 50:  // Copy Spawnpoint
    check_authorization();
    $body = new Template("templates/spawn/spawnpoint.copy.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $spawnpoint = spawnpoint_info();
    if ($spawnpoint) {
      foreach ($spawnpoint as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 51: // Copy spawnpoint
    check_authorization();
    copy_spawnpoint();
    $sid = $_POST['sgid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&sid=$sid&action=10");
    exit;
  case 52:  // Copy Spawnpoint
    check_authorization();
    $body = new Template("templates/spawn/spawnpoint.move.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $spawnpoint = spawnpoint_info();
    if ($spawnpoint) {
      foreach ($spawnpoint as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 53: // Move spawnpoint
    check_authorization();
    move_spawnpoint();
    $sid = $_POST['sgid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&sid=$sid&action=10");
    exit;
  case 54: // New spawngroup
    check_authorization();
    $body = new Template("templates/spawn/spawngroup.new.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('suggestedid', suggest_spawngroup_id());
    $body->set('npcid', $npcid);
    $body->set('despawntype', $despawntype);
    break;
  case 55: // Search spawngroup by name
    check_authorization();
    $body = new Template("templates/spawn/spawngroup.search.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('sid', $_GET['sid']);
    break;
  case 56: // Add spawngroup by id
    check_authorization();
    $body = new Template("templates/spawn/spawngroup.addbyid.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    break;
  case 57: // Search spawngroups by name
    check_authorization();
    $body = new Template("templates/spawn/spawngroup.searchresults.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('sid', $_GET['sid']);
    $vars = search_spawngroups($_POST['search']);
    $body->set('results', $vars);
    break;
  case 58: // Add spawngroup by name
    check_authorization();
    $body = new Template("templates/spawn/spawngroup.addbysearch.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    if($_POST['new_sid'] > 0){
      $body->set('sid', $_POST['new_sid']);
    }
    else {
      $body->set('sid', $_GET['sid']);
    }
    $vars = get_spawngroup_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 59: // List spawngroups for a zone
    check_authorization();
    $res = get_spawngroups_by_zone($z);
    $body = new Template("templates/spawn/spawngroup.showgroups.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('results', $res);
    break;
  case 60: // View spawn_condition values
    check_authorization();
    $body = new Template("templates/spawn/spawnconditionvalue.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $_GET['npcid']);
    $body->set('spid', $_GET['spid']);
    $body->set('scid', $_GET['scid']);
    $spawncv = get_spawn_condition_value();
    if ($spawncv) {
      foreach ($spawncv as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 61:  // Add spawncondition value
    check_authorization();
    add_spawnconditionvalue();
    $npcid = $_GET['npcid'];
    $spid = $_GET['spid'];
    $scid = $_GET['scid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&spid=$spid&scid=$scid&action=60");
    exit;
  case 62:  // Delete spawncondition value
    check_authorization();
    delete_spawnconditionvalue();
    $npcid = $_GET['npcid'];
    $spid = $_GET['spid'];
    $scid = $_GET['scid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&spid=$spid&scid=$scid&action=60");
    exit;
  case 63: // Copy Grid Entry
    check_authorization();
    $body = new Template("templates/spawn/gridentry.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('zid', getZoneID($z));
    $body->set('npcid', $npcid);
    $body->set('pathgrid', $_GET['pathgrid']);
    $body->set('spid', $_GET['spid']);
    $body->set('suggestednum', suggest_grid_number());
    $body->set('x_coord', $_GET['x_coord']);
    $body->set('y_coord', $_GET['y_coord']);
    $body->set('z_coord', $_GET['z_coord']);
    $body->set('heading', $_GET['h_coord']);
    $body->set('pause', $_GET['pause']);
    break;
  case 64: // Sort Grid Numbers
    check_authorization();
    sort_grid();
    $npcid = $_GET['npcid'];
    $pathgrid = $_GET['pathgrid'];
    $spid = $_GET['spid'];
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid&spid=$spid&pathgrid=$pathgrid&action=20");
    exit;
  case 65: // Copy Entire Grid
    check_authorization();
    copy_grid();
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&action=31");
    exit;
  case 66: // View NPCs on Grid
    check_authorization();
    $body = new Template("templates/spawn/grid.npcs.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $grid_npcs = get_npcs_by_grid();
    $body->set('grid_npcs', $grid_npcs);
    break;
  case 67: // Search for spawngroups
    check_authorization();
    $body = new Template("templates/spawn/spawngroup.showoptions.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    break;
  case 68: // List spawngroups by NPC
    check_authorization();
    $body = new Template("templates/spawn/spawn_.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('spawngroup_limit', $spawngroup_limit);
    $spawngroups = get_spawngroups($z);
    $body->set('spawngroups', $spawngroups);
    $body->set('minx', $_POST['minx']);
    $body->set('maxx', $_POST['maxx']);
    $body->set('miny', $_POST['miny']);
    $body->set('maxy', $_POST['maxy']);
    $body->set('limit', $_POST['limit']);
    $body->set('npcname', $_POST['npcname']);
    break;
  case 69:
    check_authorization();
    $body = new Template("templates/spawn/spawngroups.member.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('minx', $_GET['minx']);
    $body->set('maxx', $_GET['maxx']);
    $body->set('miny', $_GET['miny']);
    $body->set('maxy', $_GET['maxy']);
    $body->set('limit', $_GET['limit']);
    $body->set('npcname', $_GET['npcname']);
    break;
  case 70: // Process add npc form
    check_authorization();
    if (isset($_POST['search']) && ($_POST['search'] != '')) {
      $body = new Template("templates/spawn/spawngroups.member.searchresults.tmpl.php");
      $body->set('currzone', $z);
      $body->set('currzoneid', $zoneid);
      $body->set('npcid', $npcid);
      $body->set('sid', $_GET['sid']);
      $results = search_npc_types($_POST['search']);
      $body->set('results', $results);
      $body->set('minx', $_GET['minx']);
      $body->set('maxx', $_GET['maxx']);
      $body->set('miny', $_GET['miny']);
      $body->set('maxy', $_GET['maxy']);
      $body->set('limit', $_GET['limit']);
      $body->set('npcname', $_GET['npcname']);
    }
    else {
      add_multiple_spawngroup_member($_REQUEST['npc']);
      $npcid = $_REQUEST['npc'];
      header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid");
      exit;
    }
    break;
  case 71:  // Delete spawngroup member and balance group
    check_authorization();
    delete_spawngroup_member(1);
    $npcid = valid_npc();
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
  case 72: // Add spawngroup member
    check_authorization();
    $body = new Template("templates/spawn/spawngroup.member.add_.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    $body->set('sid', $_GET['sid']);
    $vars = get_spawngroup_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 73: // Process add npc form
    check_authorization();
    if (isset($_POST['search']) && ($_POST['search'] != '')) {
      $body = new Template("templates/spawn/spawngroup.member.searchresults.tmpl.php");
      $body->set('currzone', $z);
      $body->set('currzoneid', $zoneid);
      $body->set('npcid', $npcid);
      $body->set('sid', $_GET['sid']);
      $results = search_npc_types($_POST['search']);
      $body->set('results', $results);
    }
    else {
      add_spawngroup_member($_REQUEST['npc']);
      $npcid = $_REQUEST['npc'];
      header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid");
      exit;
    }
    break;
  case 80: // Magelo import
    check_authorization();
    $body = new Template("templates/spawn/magelo.new.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('npcid', $npcid);
    break;
  case 81:  // Magelo import
    check_authorization();
    magelo_import();
    header("Location: index.php?editor=spawn&z=$z&zoneid=$zoneid&npcid=$npcid");
    exit;
}

function get_spawngroups($search) {
  global $mysql, $npcid, $spawngroup_limit;

  if ($search != '') {
    $minx = $_POST['minx'];
    $maxx = $_POST['maxx'];
    $miny = $_POST['miny'];
    $maxy = $_POST['maxy'];
    $limit = $_POST['limit'];
    $npcname = $_POST['npcname'];

    if ($spawngroup_limit != '' && ($limit < 1 || $limit > $spawngroup_limit)) {
      $limit = $spawngroup_limit;
    }

    if ($spawngroup_limit == '' && ($limit < 1 || $limit > 150)) {
      $limit = 150;
    }

    if ($npcname != '') {
      $query = "SELECT spawngroupID FROM spawn2 LEFT JOIN spawnentry USING (spawngroupID) LEFT JOIN spawngroup ON (spawn2.spawngroupID = spawngroup.id) LEFT JOIN npc_types ON (spawnentry.npcID = npc_types.id) WHERE spawn2.zone = '$search' AND spawn2.x >= $minx AND spawn2.x <= $maxx AND spawn2.y >= $miny AND spawn2.y <= $maxy AND npc_types.name rlike \"$npcname\" group by spawngroupID limit $limit";
    }
    else {
      $query = "SELECT spawngroupID FROM spawn2 LEFT JOIN spawnentry USING (spawngroupID) LEFT JOIN spawngroup ON (spawn2.spawngroupID = spawngroup.id) WHERE spawn2.zone = '$search' AND spawn2.x >= $minx AND spawn2.x <= $maxx AND spawn2.y >= $miny AND spawn2.y <= $maxy group by spawngroupID limit $limit";
    }
  }
  else {
    $query = "SELECT * FROM spawnentry WHERE npcID=$npcid ORDER BY spawngroupID";
  }

  $results = $mysql->query_mult_assoc($query);

  if (!$results)
    return;

  for ($x=0; $x<count($results); $x++) {
    $id = $results[$x]['spawngroupID'];

    $query = "SELECT name, spawn_limit, dist, max_x, min_x, max_y, min_y, delay, mindelay, despawn, despawn_timer FROM spawngroup WHERE id=$id";
    $result = $mysql->query_assoc($query);
    $results[$x]['name'] = $result['name'];
    $results[$x]['spawn_limit'] = $result['spawn_limit'];
    $results[$x]['dist'] = $result['dist'];
    $results[$x]['max_x'] = $result['max_x'];
    $results[$x]['min_x'] = $result['min_x'];
    $results[$x]['max_y'] = $result['max_y'];
    $results[$x]['min_y'] = $result['min_y'];
    $results[$x]['delay'] = $result['delay'];
    $results[$x]['mindelay'] = $result['mindelay'];
    $results[$x]['despawn'] = $result['despawn'];
    $results[$x]['despawn_timer'] = $result['despawn_timer'];

    $query = "SELECT count(*) AS count FROM spawn2 WHERE spawngroupID=$id";
    $result = $mysql->query_assoc($query);
    $results[$x]['count'] = $result['count'];

    $query = "SELECT * FROM spawnentry WHERE spawngroupID=$id";
    $results2 = $mysql->query_mult_assoc($query);

    foreach ($results2 as $r2) {
      $r2['name'] = getNPCName($r2['npcID']);
      $results[$x]['npcs'][] = $r2;
    }

    if ($search != '') {
      $query = "SELECT npcID FROM spawnentry WHERE spawngroupID=$id limit 1";
      $result = $mysql->query_assoc($query);
      $results[$x]['npcid'] = $result['npcID'];
    }
  }
  return $results;
}

function get_spawngroup_member_info() {
  global $mysql;

  $sid = $_GET['sid'];
  $npc = $_GET['sgnpcid'];

  $query = "SELECT * FROM spawnentry WHERE spawngroupID=$sid AND npcID=$npc";
  $result = $mysql->query_assoc($query);

  return $result;
}

function add_spawngroup_member() {
  check_authorization();
  global $mysql;

  $sid = $_REQUEST['sid'];
  $npc = $_REQUEST['npc'];
  $balance = $_REQUEST['balance'];
  $chance = ($balance == "on") ? 0 : $_REQUEST['chance'];

  $query = "SELECT max(chance) AS chance FROM spawnentry where spawngroupID=$sid limit 1";
  $result = $mysql->query_assoc($query);
  $maxchance = $result['chance'];

  $query = "SELECT npcID AS maxnpcid FROM spawnentry where spawngroupID=$sid AND chance=$maxchance";
  $result = $mysql->query_assoc($query);
  $maxnpcid = $result['maxnpcid'];

  $newchance = ($maxchance - $chance);

  if ($newchance > 1) {
    $query = "UPDATE spawnentry SET chance = $newchance WHERE npcID = $maxnpcid AND spawngroupID=$sid";
    $mysql->query_no_result($query);
  }

  $query = "INSERT INTO spawnentry SET spawngroupID=$sid, npcID=$npc, chance=$chance";
  $mysql->query_no_result($query);

  if ($balance == "on") {
    balance_spawns('');
  }
}

function add_multiple_spawngroup_member() {
  check_authorization();
  global $mysql, $z, $spawngroup_limit;

  $minx = $_GET['minx'];
  $maxx = $_GET['maxx'];
  $miny = $_GET['miny'];
  $maxy = $_GET['maxy'];
  $limit = $_GET['limit'];
  $npcname = $_GET['npcname'];
  $npc = $_REQUEST['npc'];
  $balance = $_REQUEST['balance'];
  $chance = ($balance == "on") ? 0 : $_REQUEST['chance'];

  if ($spawngroup_limit != '' && ($limit < 1 || $limit > $spawngroup_limit)) {
    $limit = $spawngroup_limit;
  }

  if ($spawngroup_limit == '' && ($limit < 1 || $limit > 150)) {
    $limit = 150;
  }

  if($npcname != ''){
    $query = "SELECT spawngroupID FROM spawn2 LEFT JOIN spawnentry USING (spawngroupID) LEFT JOIN spawngroup ON (spawn2.spawngroupID = spawngroup.id) LEFT JOIN npc_types ON (spawnentry.npcID = npc_types.id) WHERE spawn2.zone = '$z' AND spawn2.x >= $minx AND spawn2.x <= $maxx AND spawn2.y >= $miny AND spawn2.y <= $maxy AND npc_types.name rlike \"$npcname\" group by spawngroupID limit $limit";
  }
  else {
    $query = "SELECT spawngroupID FROM spawn2 LEFT JOIN spawnentry USING (spawngroupID) LEFT JOIN spawngroup ON (spawn2.spawngroupID = spawngroup.id) WHERE spawn2.zone = '$z' AND spawn2.x >= $minx AND spawn2.x <= $maxx AND spawn2.y >= $miny AND spawn2.y <= $maxy group by spawngroupID limit $limit";
  }

  $results = $mysql->query_mult_assoc($query);

  for($x=0; $x<count($results); $x++) {
    $sid = $results[$x]['spawngroupID'];

    $query = "SELECT max(chance) AS chance, npcID AS maxnpcid FROM spawnentry where spawngroupID=$sid";
    $result = $mysql->query_assoc($query);
    $maxchance = $result['chance'];
    $maxnpcid = $result['maxnpcid'];

    $newchance = ($maxchance - $chance);

    if ($newchance > 1) {
      $query = "UPDATE spawnentry SET chance = $newchance WHERE npcID = $maxnpcid AND spawngroupID=$sid";
      $mysql->query_no_result($query);
    }

    $query = "REPLACE INTO spawnentry SET spawngroupID=$sid, npcID=$npc, chance=$chance";
    $mysql->query_no_result($query);

    if ($balance == "on") {
      balance_spawns($sid);
    }
  }
}

function update_spawngroup_member() {
  check_authorization();
  global $mysql;

  $spawngroupID = $_POST['spawngroupID'];
  $chance = $_POST['chance'];
  $npc = $_POST['sgnpcid'];

  $query = "UPDATE spawnentry SET chance=$chance WHERE spawngroupID=$spawngroupID AND npcID=$npc";
  $mysql->query_no_result($query);
}

function delete_spawngroup_member($balance) {
  check_authorization();
  global $mysql, $npcid;
  $sid = $_GET['sid'];
  $npc = $_GET['sgnpcid'];

  $query = "SELECT chance FROM spawnentry WHERE spawngroupID=$sid AND npcID=$npc";
  $result = $mysql->query_assoc($query);

  $del_chance = $result['chance'];

  $query = "DELETE FROM spawnentry WHERE spawngroupID=$sid AND npcID=$npc";
  $mysql->query_no_result($query);

  $query = "SELECT max(chance) AS chance_ FROM spawnentry WHERE spawngroupID=$sid";
  $result = $mysql->query_assoc($query);

  $chance = $result['chance_'];

  if ($chance != '') {
    $query = "SELECT npcID FROM spawnentry WHERE spawngroupID=$sid AND chance=$chance limit 1";
    $result = $mysql->query_assoc($query);
    $npcid_ = $result['npcID'];
  }

  if ($chance == '') {
    $query = "DELETE FROM spawngroup WHERE id=$sid";
    $mysql->query_no_result($query);

    $query = "DELETE FROM spawn2 WHERE spawngroupID=$sid";
    $mysql->query_no_result($query);
  }

  if ($npcid_ != '') {
    $query = "UPDATE spawnentry SET chance = $chance+$del_chance WHERE spawngroupID=$sid AND npcID=$npcid_";
    $mysql->query_no_result($query);
  }

  if ($balance == 1) {
    balance_spawns('');
  }
}

function valid_npc() {
  check_authorization();
  global $mysql, $npcid;
  $sid = $_GET['sid'];
  $npc = $_GET['sgnpcid'];

  if ($npcid == '' || $npcid == $npc) {
    $query = "SELECT npcID FROM spawnentry WHERE spawngroupID=$sid limit 1";
    $result = $mysql->query_assoc($query);
    return $result['npcID'];
  }

  if ($npcid != '' && $npcid != $npc) {
    return $npcid;
  }
}

function balance_spawns ($sid) {
  check_authorization();
  global $mysql;

  if ($_GET['sid'] != '') {
    $sid = $_GET['sid'];
  }

  $query = "SELECT count(npcID) AS count FROM spawnentry WHERE spawngroupID=$sid";
  $result = $mysql->query_assoc($query);

  $count = $result['count'];

  $remainder = 100 % $count;
  $base = floor(100 / $count);
  $x = $count - $remainder;

  $query = "SELECT * FROM spawnentry WHERE spawngroupID=$sid";
  $results = $mysql->query_mult_assoc($query);

  foreach ($results as $result) {
    $npc = $result['npcID'];
    if ($x > 0) {
      $chance = $base;
      $x--;
    }
    else
      $chance = $base + 1;

    $query = "UPDATE spawnentry SET chance=$chance WHERE spawngroupID=$sid AND npcID=$npc";
    $mysql->query_no_result($query);
  }
}

function get_spawngroup_info() {
  global $mysql;
  $sid = $_GET['sid'];
  $new_sid = $_POST['new_sid'];

  if ($new_sid > 0) {
    $query = "SELECT name, spawn_limit, dist, max_x, min_x, max_y, min_y, delay, mindelay, despawn, despawn_timer FROM spawngroup WHERE id=$new_sid";
  }
  else {
    $query = "SELECT name, spawn_limit, dist, max_x, min_x, max_y, min_y, delay, mindelay, despawn, despawn_timer FROM spawngroup WHERE id=$sid";
  }
  $result = $mysql->query_assoc($query);

  return $result;
}

function update_spawngroup_name() {
  check_authorization();
  global $mysql;
  $sid = $_GET['sid'];
  $name = $_POST['name'];
  $spawn_limit = $_POST['spawn_limit'];
  $dist = $_POST['dist'];
  $max_x = $_POST['max_x'];
  $min_x = $_POST['min_x'];
  $max_y = $_POST['max_y'];
  $min_y = $_POST['min_y'];
  $delay = $_POST['delay'];
  $mindelay = $_POST['mindelay'];
  $despawn = $_POST['despawn'];
  $despawn_timer = $_POST['despawn_timer'];

  $query = "UPDATE spawngroup SET name=\"$name\", spawn_limit=\"$spawn_limit\", dist=\"$dist\", max_x=\"$max_x\", min_x=\"$min_x\", max_y=\"$max_y\", min_y=\"$min_y\", delay=\"$delay\", mindelay=\"$mindelay\",despawn=\"$despawn\", despawn_timer=\"$despawn_timer\" WHERE id=$sid";
  $mysql->query_no_result($query);
}

function delete_spawngroup() {
  check_authorization();
  global $mysql;
  $sid = $_GET['sid'];

  $query = "DELETE FROM spawngroup WHERE id=$sid";
  $mysql->query_no_result($query);

  $query = "DELETE FROM spawnentry WHERE spawngroupID=$sid";
  $mysql->query_no_result($query);

  $query = "DELETE FROM spawn2 WHERE spawngroupID=$sid";
  $mysql->query_no_result($query);
}

function search_npc_types ($search) {
  global $mysql;

  $query = "SELECT id, name, level FROM npc_types WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function get_spawnpoints () {
  global $mysql;
  $sid = $_GET['sid'];

  $query = "SELECT * FROM spawn2 WHERE spawngroupID=$sid ORDER BY id";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function grid_info () {
  global $mysql, $z;
  $zid = getZoneID($z);
  $pathgrid = intval($_GET['pathgrid']);

  $query = "SELECT * FROM grid WHERE id=\"$pathgrid\" AND zoneid=$zid";
  $result = $mysql->query_assoc($query);

  return $result;
}

function spawnpoint_fromgrid () {
  global $mysql, $z;
  $zid = getZoneID($z);
  $spid = intval($_GET['spid']);

  $query = "SELECT spawngroupid AS sid FROM spawn2 WHERE id=\"$spid\" limit 1";
  $result = $mysql->query_assoc($query);

  return ($result['sid']);
}

function gridentry_info () {
  global $mysql, $z;
  $zid = getZoneID($z);
  $pathgrid = intval($_GET['pathgrid']);
  $array = array();

  $array['id'] = $pathgrid;
  $query = "SELECT number, x, y, z, heading, pause FROM grid_entries WHERE gridid=\"$pathgrid\" AND zoneid=$zid";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
      $array['grids'][$result['number']] = array("x_coord"=>$result['x'], "y_coord"=>$result['y'], "z_coord"=>$result['z'], "heading"=>$result['heading'], "pause"=>$result['pause']);
    }
  }

  return $array;
}

function gridpoint_info () {
  global $mysql, $z;
  $zid = getZoneID($z);
  $pathgrid = intval($_GET['pathgrid']);
  $number = intval($_GET['number']);

  $query = "SELECT number, x, y, z, heading, pause FROM grid_entries WHERE number=$number AND zoneid=$zid AND gridid=$pathgrid";
  $result = $mysql->query_assoc($query);

  return $result;
}

function spawnevent_info () {
  global $mysql, $z;

  $seid = $_GET['seid'];

  $query = "SELECT * FROM spawn_events WHERE id=\"$seid\"";
  $result = $mysql->query_assoc($query);

  return $result;
}

function spawncondition_info () {
  global $mysql, $z;

  $scid = $_GET['scid'];

  $query = "SELECT * FROM spawn_conditions WHERE id=\"$scid\" AND zone=\"$z\"";
  $result = $mysql->query_assoc($query);

  return $result;
}

function delete_gridentry () {
  global $mysql, $z;
  $zid = getZoneID($z);
  $pathgrid = intval($_GET['pathgrid']);
  $number = intval($_GET['number']);

  $query = "DELETE FROM grid_entries WHERE number=$number AND zoneid=$zid AND gridid=$pathgrid";
  $mysql->query_no_result($query);
}

function delete_gridentries () {
  global $mysql, $z;
  $zid = getZoneID($z);
  $pathgrid = intval($_GET['pathgrid']);

  $query = "DELETE FROM grid_entries WHERE zoneid=$zid AND gridid=$pathgrid";
  $mysql->query_no_result($query);
}

function delete_grid () {
  global $mysql, $z;
  $zid = getZoneID($z);
  $pathgrid = intval($_GET['pathgrid']);
  $spid = intval($_GET['spid']);

  $query = "DELETE FROM grid WHERE zoneid=$zid AND id=$pathgrid";
  $mysql->query_no_result($query);

  $query = "DELETE FROM grid_entries WHERE zoneid=$zid AND gridid=$pathgrid";
  $mysql->query_no_result($query);

  $query = "UPDATE spawn2 SET pathgrid = 0 WHERE id=$spid";
  $mysql->query_no_result($query);
}

function delete_grid_ns () {
  global $mysql, $z;
  $zid = getZoneID($z);
  $pathgrid = intval($_GET['pathgrid']);

  $query = "DELETE FROM grid WHERE zoneid=$zid AND id=$pathgrid";
  $mysql->query_no_result($query);

  $query = "DELETE FROM grid_entries WHERE zoneid=$zid AND gridid=$pathgrid";
  $mysql->query_no_result($query);
}

function delete_spawnevent() {
  check_authorization();
  global $mysql;
  $seid = $_GET['seid'];

  $query = "DELETE FROM spawn_events WHERE id=$seid";
  $mysql->query_no_result($query);
}

function delete_spawncondition() {
  check_authorization();
  global $mysql, $z;
  $scid = $_GET['scid'];

  $query = "DELETE FROM spawn_conditions WHERE id=$scid AND zone=\"$z\"";
  $mysql->query_no_result($query);

  $query = "DELETE FROM spawn_condition_values WHERE id=$scid AND zone=\"$z\"";
  $mysql->query_no_result($query);
}

function delete_spawnconditionvalue() {
  check_authorization();
  global $mysql, $z;
  $scid = $_GET['scid'];
  $instance_id = $_GET['instance_id'];

  $query = "DELETE FROM spawn_condition_values WHERE id=$scid AND zone=\"$z\" AND instance_id = $instance_id";
  $mysql->query_no_result($query);
}

function spawnpoint_info () {
  global $mysql;
  $id = $_REQUEST['id'];

  $query = "SELECT * FROM spawn2 WHERE id=$id";
  $result = $mysql->query_assoc($query);
  return $result;
}

function update_spawnpoint() {
  check_authorization();
  global $mysql;
  $id = $_POST['id'];

  $old = spawnpoint_info();

  $fields = '';
  foreach ($old as $k => $v) {
    if ($v != $_POST["$k"]) {
      $fields .= "$k=\"" . $_POST["$k"] . "\", ";
    }
  }

  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE spawn2 SET $fields WHERE id=$id";
    $mysql->query_no_result($query);
  }
}

function delete_spawnpoint() {
  check_authorization();
  global $mysql;
  $id = $_GET['id'];

  $query = "DELETE FROM spawn2 WHERE id=$id";
  $mysql->query_no_result($query);
}

function suggest_spawngroup_id() {
  global $mysql, $z;

  $zid = getZoneID($z) . "___";

  $query = "SELECT max(id) AS id FROM spawngroup";
  $result = $mysql->query_assoc($query);
  $id1 = $result['id'];

  $query = "SELECT MAX(spawngroupID) AS id FROM spawnentry WHERE spawngroupID LIKE \"$zid\"";
  $result = $mysql->query_assoc($query);
  $id2 = $result['id'];

  $query = "SELECT MAX(spawngroupID) AS id FROM spawn2 WHERE spawngroupID LIKE \"$zid\"";
  $result = $mysql->query_assoc($query);
  $id3 = $result['id'];

  $id = max($id1, $id2, $id3);

  return ($id + 1);
}

function suggest_spawnpoint_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM spawn2";
  $result = $mysql->query_assoc($query);

  return ($result['id'] + 1);
}

function suggest_grid_id() {
  global $mysql, $z;

  $zid = getZoneID($z);

  $query = "SELECT MAX(id) AS id FROM grid where zoneid=$zid";
  $result = $mysql->query_assoc($query);

  return ($result['id'] + 1);
}

function suggest_grid_number() {
  global $mysql, $z;

  $zid = getZoneID($z);
  $pathgrid = intval($_GET['pathgrid']);

  $query = "SELECT MAX(number) AS num FROM grid_entries where zoneid=$zid and gridid=$pathgrid";
  $result = $mysql->query_assoc($query);

  return ($result['num'] + 1);
}

function suggest_spawnevent_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS seid FROM spawn_events";
  $result = $mysql->query_assoc($query);

  return ($result['seid'] + 1);
}

function suggest_spawncondition_id() {
  global $mysql, $z;

  $query = "SELECT MAX(id) AS scid FROM spawn_conditions WHERE zone=\"$z\"";
  $result = $mysql->query_assoc($query);

  return ($result['scid'] + 1);
}

function suggest_spawncondition_value() {
  global $mysql, $z;

  $query = "SELECT MAX(value) AS scval FROM spawn_conditions WHERE zone=\"$z\"";
  $result = $mysql->query_assoc($query);

  return ($result['scval'] + 1);
}

function add_spawnpoint() {
  check_authorization();
  global $mysql;
  $id = $_POST['id'];
  $spawngroupID = $_POST['spawngroupID'];
  $zone = $_POST['zone'];
  $x = $_POST['x'];
  $y = $_POST['y'];
  $z = $_POST['z'];
  $heading = $_POST['heading'];
  $respawntime = $_POST['respawntime'];
  $variance = $_POST['variance'];
  $pathgrid = $_POST['pathgrid'];
  $condition = $_POST['_condition'];
  $cond_value = $_POST['cond_value'];
  $version = $_POST['version'];
  $enabled = $_POST['enabled'];
  $animation = $_POST['animation'];

  $query = "INSERT INTO spawn2 SET id=$id, spawngroupID=$spawngroupID, zone=\"$zone\", x=$x, y=$y, z=$z, heading=$heading, respawntime=$respawntime, variance=$variance, pathgrid=$pathgrid, _condition=$condition, cond_value=$cond_value, version=$version, enabled=$enabled, animation=$animation";
  $mysql->query_no_result($query);
}

function add_spawngroup() {
  check_authorization();
  global $mysql;

  $id = $_POST['id'];
  $name = $_POST['name'];
  $npcID = $_POST['npcID'];
  $chance = ($_POST['chance'] >= 0 && $_POST['chance'] <= 100) ? $_POST['chance'] : 100;
  $spawn_limit = intval($_POST['spawn_limit']);
  $dist = intval($_POST['dist']);
  $max_x = $_POST['max_x'];
  $min_x = $_POST['min_x'];
  $max_y = $_POST['max_y'];
  $min_y = $_POST['min_y'];
  $delay = intval($_POST['delay']);
  $mindelay = intval($_POST['mindelay']);
  $despawn = $_POST['despawn'];
  $despawn_timer = $_POST['despawn_timer'];
  $query = "INSERT INTO spawngroup VALUES($id, \"$name\", \"$spawn_limit\", \"$dist\", \"$max_x\", \"$min_x\", \"$max_y\", \"$min_y\", \"$delay\", \"$mindelay\", \"$despawn\", \"$despawn_timer\")";
  $mysql->query_no_result($query);

  $query = "INSERT INTO spawnentry SET spawngroupID=$id, npcID=$npcID, chance=$chance";
  $mysql->query_no_result($query);
}

function add_grid() {
  check_authorization();
  global $mysql, $z;

  $zid = getZoneID($z);
  $id = $_POST['id'];
  $type = intval($_POST['type']);
  $type2 = intval($_POST['type2']);
  $spid = intval($_POST['spid']);
  $query = "INSERT INTO grid VALUES($id, $zid, \"$type\", \"$type2\")";
  $mysql->query_no_result($query);

  $query = "UPDATE spawn2 SET pathgrid=$id where id=\"$spid\"";
  $mysql->query_no_result($query);
}

function add_gridentry() {
  check_authorization();
  global $mysql;

  $pathgrid = intval($_POST['pathgrid']);
  $zoneid = intval($_POST['zoneid']);
  $number = intval($_POST['number']);
  $x_coord = $_POST['x_coord'];
  $y_coord = $_POST['y_coord'];
  $z_coord = $_POST['z_coord'];
  $heading = $_POST['heading'];
  $pause = intval($_POST['pause']);
  $query = "INSERT INTO grid_entries VALUES(\"$pathgrid\", \"$zoneid\", \"$number\", \"$x_coord\", \"$y_coord\", \"$z_coord\", \"$heading\", \"$pause\")";
  $mysql->query_no_result($query);
}

function update_grid() {
  check_authorization();
  global $mysql, $z;

  $zid = getZoneID($z);
  $pathgrid = intval($_POST['pathgrid']);
  $type = intval($_POST['type']);
  $type2 = intval($_POST['type2']);

  $query = "UPDATE grid SET type=\"$type\", type2=\"$type2\" WHERE id=\"$pathgrid\" AND zoneid=$zid";
  $mysql->query_no_result($query);
}

function update_gridentry() {
  check_authorization();
  global $mysql, $z;

  $zid = getZoneID($z);
  $pathgrid = intval($_POST['pathgrid']);
  $number2 = intval($_POST['number2']);
  $number = intval($_POST['number']);
  $x_coord = $_POST['x_coord'];
  $y_coord = $_POST['y_coord'];
  $z_coord = $_POST['z_coord'];
  $heading = $_POST['heading'];
  $pause = intval($_POST['pause']);

  $query = "UPDATE grid_entries SET number=\"$number2\", x=\"$x_coord\", y=\"$y_coord\", z=\"$z_coord\", pause=\"$pause\", heading=\"$heading\" WHERE gridid=\"$pathgrid\" AND number=$number AND zoneid=$zid";
  $mysql->query_no_result($query);
}

function is_spawned() {
  global $mysql;
  $spid = intval($_GET['spid']);

  $array['id'] = $spid;
  $query = "SELECT * FROM respawn_times where id=$spid and instance_id = 0";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
      $array['spawned'][$result['id']] = array("start"=>$result['start'], "duration"=>$result['duration'], "instance_id"=>$result['instance_id']);
    }
  }

  return $array;
}

function view_respawn() {
  global $mysql;
  $spid = intval($_GET['spid']);

  $query = "SELECT * FROM respawn_times where id=$spid and instance_id = 0";
  $result = $mysql->query_assoc($query);

  return $result;
}

function force_spawn() {
  global $mysql;
  $spid = intval($_GET['spid']);
  $instance_id = intval($_GET['instance_id']);

  $query = "DELETE FROM respawn_times where id=$spid and instance_id=$instance_id";
  $mysql->query_no_result($query);
}

function grid_info_zone () {
  global $mysql, $z;
  $zid = getZoneID($z);
  $array = array();

  $array['id'] = $zid;
  $query = "SELECT id,type,type2 FROM grid WHERE zoneid=$zid";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
      $array['grids'][$result['id']] = array("pathgrid"=>$result['id'], "type"=>$result['type'], "type2"=>$result['type2']);
    }
  }

  return $array;
}

function get_spawn_condition () {
  global $mysql, $z;
  $array = array();

  $query = "SELECT id AS scid, zone, value, onchange, name FROM spawn_conditions WHERE zone=\"$z\"";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
      $array['spawnc'][$result['scid']] = array("scid"=>$result['scid'], "zone"=>$result['zone'], "value"=>$result['value'], "onchange"=>$result['onchange'], "name"=>$result['name']);
    }
  }

  return $array;
}

function get_spawn_condition_value() {
  global $mysql, $z;
  $array = array();

  $scid = $_GET['scid'];

  $query = "SELECT id AS scvid, zone, value, instance_id FROM spawn_condition_values WHERE zone=\"$z\" AND id=$scid";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
      $array['spawncv'][$result['instance_id']] = array("zone"=>$result['zone'], "value"=>$result['value'], "instance_id"=>$result['instance_id']);
    }
  }

  return $array;
}

function get_spawn_event () {
  global $mysql, $z;
  $array = array();

  $query = "SELECT id AS seid,zone AS sezone,cond_id,name AS sename,period,next_minute,next_hour,next_day,next_month,next_year,enabled,action,argument,strict FROM spawn_events WHERE zone=\"$z\" order by id";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
      $array['spawne'][$result['seid']] = array("seid"=>$result['seid'], "sezone"=>$result['sezone'], "cond_id"=>$result['cond_id'], "sename"=>$result['sename'], "period"=>$result['period'], "next_minute"=>$result['next_minute'], "next_hour"=>$result['next_hour'], "next_day"=>$result['next_day'], "next_month"=>$result['next_month'], "next_year"=>$result['next_year'], "enabled"=>$result['enabled'], "action"=>$result['action'], "argument"=>$result['argument'], "strict"=>$result['strict']);
    }
  }

  return $array;
}

function update_spawnevent() {
  check_authorization();
  global $mysql, $z;

  $seid = $_POST['seid'];
  $cond_id = $_POST['cond_id'];
  $sename = $_POST['sename'];
  $period = $_POST['period'];
  $next_minute = $_POST['next_minute'];
  $next_hour = $_POST['next_hour'];
  $next_day = $_POST['next_day'];
  $next_month = $_POST['next_month'];
  $next_year = $_POST['next_year'];
  $enabled = $_POST['enabled'];
  $action = $_POST['action'];
  $argument = $_POST['argument'];
  $strict = $_POST['strict'];

  $query = "UPDATE spawn_events SET cond_id=\"$cond_id\", name=\"$sename\", period=\"$period\", next_minute=\"$next_minute\", next_hour=\"$next_hour\", next_day=\"$next_day\", next_month=\"$next_month\", next_year=\"$next_year\", enabled=\"$enabled\", action=\"$action\", argument=\"$argument\", strict=\"$strict\" WHERE id=\"$seid\" AND zone=\"$z\"";
  $mysql->query_no_result($query);
}

function update_spawncondition() {
  check_authorization();
  global $mysql, $z;

  $scid = $_POST['scid'];
  $value = $_POST['value'];
  $onchange = $_POST['onchange'];
  $name = $_POST['name'];

  $query = "UPDATE spawn_conditions SET value=\"$value\", onchange=\"$onchange\", name=\"$name\" WHERE id=\"$scid\" AND zone=\"$z\"";
  $mysql->query_no_result($query);
}

function update_spawntimer() {
  check_authorization();
  global $mysql;

  $rid = $_POST['rid'];
  $start = $_POST['start'];
  $duration = $_POST['duration'];

  $query = "UPDATE respawn_times SET start=\"$start\", duration=\"$duration\" WHERE id=\"$rid\"";
  $mysql->query_no_result($query);
}

function add_spawnevent() {
  check_authorization();
  global $mysql, $z;

  $cond_id = $_POST['cond_id'];
  $sename = $_POST['sename'];
  $period = $_POST['period'];
  $next_minute = $_POST['next_minute'];
  $next_hour = $_POST['next_hour'];
  $next_day = $_POST['next_day'];
  $next_month = $_POST['next_month'];
  $next_year = $_POST['next_year'];
  $enabled = $_POST['enabled'];
  $action = $_POST['action'];
  $argument = $_POST['argument'];

  $query = "INSERT INTO spawn_events SET zone=\"$z\", cond_id=\"$cond_id\", name=\"$sename\", period=\"$period\", next_minute=\"$next_minute\", next_hour=\"$next_hour\", next_day=\"$next_day\", next_month=\"$next_month\", next_year=\"$next_year\", enabled=\"$enabled\", action=\"$action\", argument=\"$argument\"";
  $mysql->query_no_result($query);
}

function add_spawncondition() {
  check_authorization();
  global $mysql, $z;

  $scid = $_POST['scid'];
  $value = $_POST['value'];
  $onchange = $_POST['onchange'];
  $name = $_POST['name'];

  $query = "INSERT INTO spawn_conditions SET id=\"$scid\", zone=\"$z\", value=\"$value\", onchange=\"$onchange\", name=\"$name\"";
  $mysql->query_no_result($query);

  $query = "INSERT INTO spawn_condition_values SET id=\"$scid\", zone=\"$z\", value=\"$value\", instance_id=0";
  $mysql->query_no_result($query);
}

function add_spawnconditionvalue() {
  check_authorization();
  global $mysql, $z;

  $scid = $_GET['scid'];

  $query = "SELECT MAX(instance_id) AS scvinst FROM spawn_condition_values WHERE zone=\"$z\" AND id=$scid";
  $result = $mysql->query_assoc($query);

  $instance_id = ($result['scvinst'] + 1);

  $query = "INSERT INTO spawn_condition_values SET id=\"$scid\", zone=\"$z\", value=0, instance_id=\"$instance_id\"";
  $mysql->query_no_result($query);
}

function copy_spawnpoint() {
  check_authorization();
  global $mysql;
  $zone = $_POST['zone'];
  $x = $_POST['x'];
  $y = $_POST['y'];
  $z = $_POST['z'];
  $heading = $_POST['heading'];
  $respawntime = $_POST['respawntime'];
  $variance = $_POST['variance'];
  $pathgrid = $_POST['pathgrid'];
  $condition = $_POST['condition'];
  $cond_value = $_POST['cond_value'];
  $version = $_POST['version'];
  $enabled = $_POST['enabled'];
  $animation = $_POST['animation'];
  $sgid = $_POST['sgid'];

  $query = "INSERT INTO spawn2 SET spawngroupID=\"$sgid\", zone=\"$zone\", x=$x, y=$y, z=$z, heading=$heading, respawntime=$respawntime, variance=$variance, pathgrid=$pathgrid, _condition=$condition, cond_value=$cond_value, version=$version, enabled=$enabled, animation=$animation";
  $mysql->query_no_result($query);
}

function move_spawnpoint() {
  check_authorization();
  global $mysql;
  $id = $_POST['id'];
  $sgid = $_POST['sgid'];

  $query = "UPDATE spawn2 set spawngroupID=\"$sgid\" where id=$id";
  $mysql->query_no_result($query);
}

function search_spawngroups($search) {
  global $mysql;
  $query = "SELECT * FROM spawngroup WHERE name rlike \"$search\"";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function get_spawngroups_by_zone($search) {
  global $mysql;
  $query = "SELECT spawn2.spawngroupID, spawngroup.name, spawnentry.npcID FROM spawn2 LEFT JOIN spawnentry USING (spawngroupID) LEFT JOIN spawngroup ON (spawn2.spawngroupID = spawngroup.id) WHERE spawn2.zone = '$search'";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function export_grid_sql() {
  global $mysql;
  $gridid = $_GET['pathgrid'];
  $zoneid = getZoneID($_GET['z']);
  $table_string = "";
  $value_string = "";
  $export_string = "";

  // Get Grid Properties
  $export_string .= "DELETE FROM grid WHERE id = $gridid AND zoneid = $zoneid;\n";

  $query = "SELECT * FROM grid WHERE id = $gridid AND zoneid = $zoneid";
  $results = $mysql->query_assoc($query);
  foreach ($results as $key=>$value) {
    if ($table_string) {
      $table_string .= ", " . $key;
      $value_string .= ", '" . $value . "'";
    }
    else {
      $table_string = $key;
      $value_string = "'" . $value . "'";
    }
  }
  $export_string .= "INSERT INTO grid ($table_string) VALUES ($value_string);\n";
  $table_string = "";
  $value_string = "";

  // Get Grid Entries
  $export_string .= "DELETE FROM grid_entries WHERE gridid = $gridid AND zoneid = $zoneid;\n";

  $query = "SELECT * FROM grid_entries WHERE gridid = $gridid AND zoneid = $zoneid";
  $results = $mysql->query_mult_assoc($query);
  if ($results) {
    foreach ($results as $result) {
      foreach ($result as $key=>$value) {
        if ($table_string) {
          $table_string .= ", " . $key;
          $value_string .= ", '" . $value . "'";
        }
        else {
          $table_string = $key;
          $value_string = "'" . $value . "'";
        }
      }
      $export_string .= "INSERT INTO grid_entries ($table_string) VALUES ($value_string);\n";
      $table_string = "";
      $value_string = "";
    }
  }

  return $export_string;
}

function sort_grid() {
  global $mysql;
  $gridid = $_GET['pathgrid'];
  $zoneid = getZoneID($_GET['z']);
  $old_number = array();

  $query = "SELECT number FROM grid_entries WHERE gridid = $gridid AND zoneid = $zoneid";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    foreach ($results as $result) {
      $old_number[] = $result['number'];
    }

    $total = count($old_number);

    for ($i=0; $i<$total; $i++) {
      if ($old_number[$i] != $i) {
        $query = "UPDATE grid_entries SET number=$i WHERE gridid = $gridid AND zoneid = $zoneid AND number = $old_number[$i]";
        $mysql->query_no_result($query);
      }
    }
  }
}

function copy_grid() {
  global $mysql;
  $gridid = $_GET['pathgrid'];
  $zoneid = getZoneID($_GET['z']);
  $newid = suggest_grid_id();
  $grid_entries = array();

  $query = "SELECT type, type2 FROM grid WHERE id = $gridid AND zoneid = $zoneid";
  $results = $mysql->query_assoc($query);

  $grid_type = $results['type'];
  $grid_type2 = $results['type2'];

  $query = "INSERT INTO grid (id, zoneid, type, type2) VALUES ($newid, $zoneid, $grid_type, $grid_type2)";
  $mysql->query_no_result($query);

  $query = "SELECT * FROM grid_entries WHERE gridid = $gridid AND zoneid = $zoneid";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    foreach ($results as $result) {
      $number = $result['number'];
      $x = $result['x'];
      $y = $result['y'];
      $z = $result['z'];
      $heading = $result['heading'];
      $pause = $result['pause'];

      $query = "INSERT INTO grid_entries (gridid, zoneid, number, x, y, z, heading, pause) VALUES ($newid, $zoneid, $number, $x, $y, $z, $heading, $pause)";
      $mysql->query_no_result($query);
    }
  }
}

function get_npcs_by_grid() {
  global $mysql;
  $pathgrid = $_GET['pathgrid'];
  $zone = getZoneName(getZoneID($_GET['z']));

  $query = "SELECT sg.name AS name, sp.spawngroupid AS spawngroupid, sp.zone AS zone, se.npcid AS npcid FROM spawngroup sg, spawn2 sp, spawnentry se WHERE sg.id = sp.spawngroupid AND sp.spawngroupid = se.spawngroupid AND pathgrid = $pathgrid AND zone = \"$zone\"";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function magelo_import() {
  check_authorization();
  global $mysql, $npcid, $perl_path;

  $insert = $_POST['spawngroupinsert'];
  $limit = $_POST['limit'];
  $heading = $_POST['heading'];
  $respawntime = $_POST['respawntime'];
  $spawnlimit = $_POST['spawnlimit'];
  $mincoord = $_POST['mincoord'];
  $maxcoord = $_POST['maxcoord'];
  $forcedz = $_POST['forcedz'];

  $output = array();
  $output = exec("perl $perl_path/Coords.pl $npcid $insert $limit $spawnlimit $heading $respawntime $mincoord $maxcoord $forcedz 2>&1");
  logPerl($output);
}
?>
