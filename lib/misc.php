<?php

$traptype = array(
  0   => "Casting",
  1   => "Alarm",
  2   => "NPC S. Area",
  3   => "NPC L. Area",
  4   => "Damage"
);

$alarmtype = array(
  0   => "All aggro",
  1   => "KOS aggro"
);

switch ($action) {
  case 0:
    if ($z) {
      $body = new Template("templates/misc/misc.default.tmpl.php");
      $body->set('currzone', $z);
      $body->set('currzoneid', $zoneid);
    }
    break;
  case 1: // View fishing
    $breadcrumbs .= " >> Fishing";
    $body = new Template("templates/misc/fishing.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $fishing = get_fishing();
    if ($fishing) {
      foreach ($fishing as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2: // Edit fishing
    check_authorization();
    $breadcrumbs .= " >> Fishing";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/misc/fishing.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $fishing = fishing_info();
    if ($fishing) {
      foreach ($fishing as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 3: // Update fishing
    check_authorization();
    update_fishing();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=1");
    exit;
  case 4: // Delete fishing
    check_authorization();
    delete_fishing();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=1");
    exit;
  case 5: // Add fishing
    check_authorization();
    $breadcrumbs .= " >> Fishing";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/misc/fishing.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('zid', getZoneID($z));
    $body->set('suggestfsid', suggest_fishing_id());
    break;
  case 6: // Insert fishing
    check_authorization();
    add_fishing();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=1");
    exit;
  case 7: // View forage
    $breadcrumbs .= " >> Foraging";
    $body = new Template("templates/misc/forage.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $forage = get_forage();
    if ($forage) {
      foreach ($forage as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 8: // Edit forage
    check_authorization();
    $breadcrumbs .= " >> Foraging";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/misc/forage.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $forage = forage_info();
    if ($forage) {
      foreach ($forage as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 9: // Update forage
    check_authorization();
    update_forage();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=7");
    exit;
   case 10: // Delete forage
    check_authorization();
    delete_forage();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=7");
    exit;
   case 11: // Add forage
    check_authorization();
    $breadcrumbs .= " >> Foraging";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/misc/forage.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('zid', getZoneID($z));
    $body->set('suggestfgid', suggest_forage_id());
    break;
   case 12: // Insert forage
    check_authorization();
    add_forage();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=7");
    exit;
   case 13: // View ground spawns
    $breadcrumbs .= " >> Ground Spawns";
    $body = new Template("templates/misc/groundspawn.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $gspawn = get_gspawn();
    if ($gspawn) {
      foreach ($gspawn as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 14: // Edit ground spawns
    check_authorization();
    $breadcrumbs .= " >> Ground Spawns";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/misc/groundspawn.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $gspawn = gspawn_info();
    if ($gspawn) {
      foreach ($gspawn as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 15: // Update ground spawns
    check_authorization();
    update_gspawn();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=13");
    exit;
   case 16: // Delete ground spawns
    check_authorization();
    delete_gspawn();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=13");
    exit;
   case 17: // Add ground spawn
    check_authorization();
    $breadcrumbs .= " >> Ground Spawns";
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/misc/groundspawn.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('zid', getZoneID($z));
    $body->set('suggestgsid', suggest_gspawn_id());
    $body->set('suggestver', suggest_version());
    break;
   case 18: // Insert ground spawn
    check_authorization();
    add_gspawn();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=13");
    exit;
   case 19: // View traps
    $breadcrumbs .= " >> Traps";
    $body = new Template("templates/misc/traps.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set("traptype", $traptype);
    $body->set("alarmtype", $alarmtype);
    $traps = get_traps();
    if ($traps) {
      foreach ($traps as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 20: // Edit traps
    check_authorization();
    $breadcrumbs .= " >> Traps";
    $body = new Template("templates/misc/traps.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set("traptype", $traptype);
    $traps = traps_info();
    if ($traps) {
      foreach ($traps as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 21: // Update traps
    check_authorization();
    update_traps();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=19");
    exit;
   case 22: // Delete traps
    check_authorization();
    delete_traps();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=19");
    exit;
   case 23: // Add traps
    check_authorization();
    $breadcrumbs .= " >> Traps";
    $body = new Template("templates/misc/traps.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set("traptype", $traptype);
    $body->set("alarmtype", $alarmtype);
    $body->set('suggesttid', suggest_traps_id());
    $body->set('suggestver', suggest_version());
    break;
   case 24: // Insert traps
    check_authorization();
    add_traps();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=19");
    exit;
   case 25:  // Search functions
    $body = new Template("templates/misc/misc.searchresults.tmpl.php");
    if (isset($_GET['gspawnid']) && $_GET['gspawnid'] != "GroundSpawn"){
      $breadcrumbs .= " >> Ground Spawns";
      $gspawn = search_gspawn_by_id();
    }
    if (isset($_GET['forageid']) && $_GET['forageid'] != "Forage"){
      $breadcrumbs .= " >> Foraging";
      $forage = search_forage_by_id();
    }
    if (isset($_GET['fishid']) && $_GET['fishid'] != "Fishing"){
      $breadcrumbs .= " >> Fishing";
      $fishing = search_fishing_by_id();
    }
    $body->set("fishing", $fishing);
    $body->set("forage", $forage);
    $body->set("gspawn", $gspawn);
    break;
   case 26: // View fishing
    $breadcrumbs .= " >> Fishing";
    $body = new Template("templates/misc/fishing.view.tmpl.php");
    $fishing = fishing_info();
    if ($fishing) {
      foreach ($fishing as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 27: // View forage
    $breadcrumbs .= " >> Foraging";
    $body = new Template("templates/misc/forage.view.tmpl.php");
    $forage = forage_info();
    if ($forage) {
      foreach ($forage as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 28: // View ground spawns
    $breadcrumbs .= " >> Ground Spawns";
    $body = new Template("templates/misc/groundspawn.view.tmpl.php");
    $gspawn = gspawn_info();
    if ($gspawn) {
      foreach ($gspawn as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 29: // View horses
    $breadcrumbs .= " >> Horses";
    $body = new Template("templates/misc/horses.tmpl.php");
    $horses = get_horses();
    $body->set("races", $races);
    $body->set("genders", $genders);
    if ($horses) {
      foreach ($horses as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 30: // Edit horses
    check_authorization();
    $breadcrumbs .= " >> Horses";
    $body = new Template("templates/misc/horses.edit.tmpl.php");
    $body->set("races", $races);
    $body->set("genders", $genders);
    $horses = horses_info();
    if ($horses) {
      foreach ($horses as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 31: // Update horses
    check_authorization();
    update_horses();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=29");
    exit;
   case 32: // Delete horses
    check_authorization();
    delete_horses();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=29");
    exit;
   case 33: // Add horses
    check_authorization();
    $breadcrumbs .= " >> Horses";
    $body = new Template("templates/misc/horses.add.tmpl.php");
    $body->set("races", $races);
    $body->set("genders", $genders);
    break;
   case 34: // Insert horses
    check_authorization();
    add_horses();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=29");
    exit;
   case 35: // View doors
    $breadcrumbs .= " >> Doors";
    $body = new Template("templates/misc/doors.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $doors = get_doors();
    if ($doors) {
      foreach ($doors as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 36: // Edit doors
    check_authorization();
    $breadcrumbs .= " >> Doors";
    $body = new Template("templates/misc/doors.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $doors = doors_info();
    if ($doors) {
      foreach ($doors as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 37: // Update doors
    check_authorization();
    update_doors();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=35");
    exit;
  case 38: // Delete doors
    check_authorization();
    delete_doors();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=35");
    exit;
  case 39: // Add doors
    check_authorization();
    $breadcrumbs .= " >> Doors";
    $body = new Template("templates/misc/doors.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('zid', getZoneID($z));
    $body->set('suggestdrid', suggest_door_id());
    $body->set('suggestdoorid', suggest_doorid());
    $body->set('suggestver', suggest_version());
    break;
  case 40: // Insert doors
    check_authorization();
    add_doors();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=35");
    exit;
  case 41: // View objects
    $breadcrumbs .= " >> Objects";
    $body = new Template("templates/misc/objects.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set("world_containers", $world_containers);
    $objects = get_objects();
    if ($objects) {
      foreach ($objects as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 42: // Edit objects
    check_authorization();
    $breadcrumbs .= " >> Objects";
    $body = new Template("templates/misc/objects.edit.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set("world_containers", $world_containers);
    $objects = objects_info();
    if ($objects) {
      foreach ($objects as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 43: // Update object
    check_authorization();
    update_object();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=41");
    exit;
  case 44: // Delete object
    check_authorization();
    delete_object();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=41");
    exit;
  case 45: // Add objects
    check_authorization();
    $breadcrumbs .= " >> Objects";
    $body = new Template("templates/misc/objects.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('zid', getZoneID($z));
    $body->set("world_containers", $world_containers);
    $body->set('suggestobjid', suggest_object_id());
    $body->set('suggestver', suggest_version());
    break;
  case 46: // Insert objects
    check_authorization();
    add_objects();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=41");
    exit;
  case 47:  // Copy doors
    check_authorization();
    $breadcrumbs .= " >> Doors";
    $body = new Template("templates/misc/doors.copyver.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('doorversion', get_max_doorversion());
    break;
  case 48:  // Copy doors
    check_authorization();
    copy_doors();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=35");
    exit;
  case 49:  // Copy GSpawns
    check_authorization();
    $breadcrumbs .= " >> Ground Spawns";
    $body = new Template("templates/misc/groundspawns.copyver.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('gsversion', get_max_gsversion());
    break;
  case 50:  // Copy GSpawns
    check_authorization();
    copy_groundspawns();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=13");
    exit;
  case 51:  // Copy Traps
    check_authorization();
    $breadcrumbs .= " >> Traps";
    $body = new Template("templates/misc/traps.copyver.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('trapversion', get_max_trapversion());
    break;
  case 52:  // Copy Traps
    check_authorization();
    copy_traps();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=19");
    exit;
  case 53:  // Copy Objects
    check_authorization();
    $breadcrumbs .= " >> Objects";
    $body = new Template("templates/misc/objects.copyver.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    $body->set('objectversion', get_max_objectversion());
    break;
  case 54:  // Copy Objects
    check_authorization();
    copy_objects();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=41");
    exit;
  case 55:  // Delete doors
    check_authorization();
    $body = new Template("templates/misc/doors.delver.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    break;
  case 56:  // Delete doors
    check_authorization();
    delete_doors_ver();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=35");
    exit;
  case 57:  // Delete GSpawns
    check_authorization();
    $body = new Template("templates/misc/groundspawns.delver.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    break;
  case 58:  // Delete GSpawns
    check_authorization();
    delete_groundspawns_ver();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=13");
    exit;
  case 59:  // Delete Traps
    check_authorization();
    $body = new Template("templates/misc/traps.delver.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    break;
  case 60:  // Delete Traps
    check_authorization();
    delete_traps_ver();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=19");
    exit;
  case 61:  // Delete Objects
    check_authorization();
    $body = new Template("templates/misc/objects.delver.tmpl.php");
    $body->set('currzone', $z);
    $body->set('currzoneid', $zoneid);
    break;
  case 62:  // Delete Objects
    check_authorization();
    delete_objects_ver();
    header("Location: index.php?editor=misc&z=$z&zoneid=$zoneid&action=41");
    exit;
}

function get_fishing() {
  global $mysql, $z;
  $zid = getZoneID($z);
  $array = array();

  $query = "SELECT fishing.id,Itemid AS fiid,zoneid,skill_level,chance,npc_id,npc_chance, items.name AS name
                FROM fishing, items
                WHERE fishing.zoneid=$zid
                AND fishing.Itemid=items.id
                OR fishing.zoneid=0
                AND fishing.Itemid=items.id";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['fishing'][$result['id']] = array("fsid"=>$result['id'], "fiid"=>$result['fiid'], "zoneid"=>$result['zoneid'], "skill_level"=>$result['skill_level'], "chance"=>$result['chance'], "npc_id"=>$result['npc_id'], "npc_chance"=>$result['npc_chance'], "name"=>$result['name']);
         }
       }
  return $array;
  }

function get_forage() {
  global $mysql, $z;
  $zid = getZoneID($z);
  $array = array();

  $query = "SELECT forage.id,zoneid,Itemid AS fgiid,level,chance, items.name AS name
                FROM forage, items
                WHERE forage.zoneid=$zid
                AND forage.Itemid=items.id
                OR forage.zoneid=0
                AND forage.Itemid=items.id";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['forage'][$result['id']] = array("fgid"=>$result['id'], "fgiid"=>$result['fgiid'], "zoneid"=>$result['zoneid'], "level"=>$result['level'], "chance"=>$result['chance'], "name"=>$result['name']);
         }
       }
  return $array;
  }

function get_gspawn() {
  global $mysql, $z, $zoneid;
  $zid = getZoneID($z);
  $array = array();

  $query = "SELECT version AS zversion FROM zone where id=$zoneid";
  $result = $mysql->query_assoc($query);
  $zversion = $result['zversion'];

  if($zversion == 0){
  $query = "SELECT ground_spawns.id,zoneid,max_x,max_y,max_z,min_x,min_y,heading,max_allowed,respawn_timer,version,item AS giid, items.name AS name
                FROM ground_spawns, items
                WHERE ground_spawns.zoneid=$zid
                AND ground_spawns.item=items.id
                OR ground_spawns.zoneid=0
                AND ground_spawns.item=items.id";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['gspawn'][$result['id']] = array("gsid"=>$result['id'], "giid"=>$result['giid'], "zoneid"=>$result['zoneid'], "max_x"=>$result['max_x'], "max_y"=>$result['max_y'], "max_z"=>$result['max_z'], "min_x"=>$result['min_x'], "min_y"=>$result['min_y'], "heading"=>$result['heading'], "gname"=>$result['gname'], "max_allowed"=>$result['max_allowed'], "comment"=>$result['comment'], "respawn_timer"=>$result['respawn_timer'], "iname"=>$result['name'], "version"=>$result['version']);
         }
       }
  }
  if($zversion > 0){
  $query = "SELECT ground_spawns.id,zoneid,max_x,max_y,max_z,min_x,min_y,heading,max_allowed,respawn_timer,version,item AS giid, items.name AS name
                FROM ground_spawns, items
                WHERE ground_spawns.zoneid=$zid
                AND ground_spawns.version=$zversion
                AND ground_spawns.item=items.id
                OR ground_spawns.zoneid=0
                AND ground_spawns.item=items.id";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['gspawn'][$result['id']] = array("gsid"=>$result['id'], "giid"=>$result['giid'], "zoneid"=>$result['zoneid'], "max_x"=>$result['max_x'], "max_y"=>$result['max_y'], "max_z"=>$result['max_z'], "min_x"=>$result['min_x'], "min_y"=>$result['min_y'], "heading"=>$result['heading'], "gname"=>$result['gname'], "max_allowed"=>$result['max_allowed'], "comment"=>$result['comment'], "respawn_timer"=>$result['respawn_timer'], "iname"=>$result['name'], "version"=>$result['version']);
         }
       }
  }
  return $array;
  }

function get_traps() {
  global $mysql, $z, $zoneid;
  $array = array();

$query = "SELECT version AS zversion FROM zone where id=$zoneid";
  $result = $mysql->query_assoc($query);
  $zversion = $result['zversion'];

  if($zversion == 0){
  $query = "SELECT * FROM traps WHERE zone=\"$z\"";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['traps'][$result['id']] = array("tid"=>$result['id'], "x_coord"=>$result['x'], "y_coord"=>$result['y'], "z_coord"=>$result['z'], "chance"=>$result['chance'], "maxzdiff"=>$result['maxzdiff'], "radius"=>$result['radius'], "effect"=>$result['effect'], "effectvalue"=>$result['effectvalue'], "effectvalue2"=>$result['effectvalue2'], "message"=>$result['message'], "skill"=>$result['skill'], "level"=>$result['level'], "respawn_time"=>$result['respawn_time'], "respawn_var"=>$result['respawn_var'], "version"=>$result['version']);
         }
       }
   }

  if($zversion > 0){
  $query = "SELECT * FROM traps WHERE zone=\"$z\" AND version=$zversion";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['traps'][$result['id']] = array("tid"=>$result['id'], "x_coord"=>$result['x'], "y_coord"=>$result['y'], "z_coord"=>$result['z'], "chance"=>$result['chance'], "maxzdiff"=>$result['maxzdiff'], "radius"=>$result['radius'], "effect"=>$result['effect'], "effectvalue"=>$result['effectvalue'], "effectvalue2"=>$result['effectvalue2'], "message"=>$result['message'], "skill"=>$result['skill'], "level"=>$result['level'], "respawn_time"=>$result['respawn_time'], "respawn_var"=>$result['respawn_var'], "version"=>$result['version']);
         }
       }
   }
  return $array;
  }

function get_horses() {
  global $mysql;
  $array = array();

  $query = "SELECT * FROM horses";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['horses'][$result['filename']] = array("filename"=>$result['filename'], "race"=>$result['race'], "gender"=>$result['gender'], "texture"=>$result['texture'], "mountspeed"=>$result['mountspeed'], "notes"=>$result['notes']);
         }
       }
  return $array;
  }

function get_doors() {
  global $mysql, $z, $zoneid;

  $array = array();

  $query = "SELECT version AS zversion FROM zone where id=$zoneid";
  $result = $mysql->query_assoc($query);
  $zversion = $result['zversion'];

  if($zversion == 0){
  $query = "SELECT * FROM doors WHERE zone=\"$z\"";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['doors'][$result['id']] = array("drid"=>$result['id'], "doorid"=>$result['doorid'], "name"=>$result['name'], "pos_x"=>$result['pos_x'], "pos_y"=>$result['pos_y'], "pos_z"=>$result['pos_z'], "heading"=>$result['heading'], "opentype"=>$result['opentype'], "guild"=>$result['guild'], "lockpick"=>$result['lockpick'], "keyitem"=>$result['keyitem'], "triggerdoor"=>$result['triggerdoor'], "triggertype"=>$result['triggertype'], "doorisopen"=>$result['doorisopen'], "door_param"=>$result['door_param'], "dest_zone"=>$result['dest_zone'], "dest_x"=>$result['dest_x'], "dest_y"=>$result['dest_y'], "dest_z"=>$result['dest_z'], "dest_heading"=>$result['dest_heading'], "invert_state"=>$result['invert_state'], "incline"=>$result['incline'], "size"=>$result['size'], "version"=>$result['version'], "is_ldon_door"=>$result['is_ldon_door'], "nokeyring"=>$result['nokeyring'], "dest_instance"=>$result['dest_instance'], "client_version_mask"=>$result['client_version_mask'], "disable_timer"=>$result['disable_timer']);
         }
       }
   }
   if($zversion > 0){
  $query = "SELECT * FROM doors WHERE zone=\"$z\" AND version=$zversion";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['doors'][$result['id']] = array("drid"=>$result['id'], "doorid"=>$result['doorid'], "name"=>$result['name'], "pos_x"=>$result['pos_x'], "pos_y"=>$result['pos_y'], "pos_z"=>$result['pos_z'], "heading"=>$result['heading'], "opentype"=>$result['opentype'], "guild"=>$result['guild'], "lockpick"=>$result['lockpick'], "keyitem"=>$result['keyitem'], "triggerdoor"=>$result['triggerdoor'], "triggertype"=>$result['triggertype'], "doorisopen"=>$result['doorisopen'], "door_param"=>$result['door_param'], "dest_zone"=>$result['dest_zone'], "dest_x"=>$result['dest_x'], "dest_y"=>$result['dest_y'], "dest_z"=>$result['dest_z'], "dest_heading"=>$result['dest_heading'], "invert_state"=>$result['invert_state'], "incline"=>$result['incline'], "size"=>$result['size'], "version"=>$result['version'], "is_ldon_door"=>$result['is_ldon_door'], "nokeyring"=>$result['nokeyring'], "dest_instance"=>$result['dest_instance'], "client_version_mask"=>$result['client_version_mask'], "disable_timer"=>$result['disable_timer']);
         }
       }
   }
  return $array;
  }

function get_objects() {
  global $mysql, $z, $zoneid;

  $zid = getZoneID($z);
  $array = array();

  $query = "SELECT version AS zversion FROM zone where id=$zoneid";
  $result = $mysql->query_assoc($query);

  $zversion = $result['zversion'];

  $query = "SELECT * FROM object WHERE zoneid=\"$zid\"" . (($zversion > 0) ? " AND version=$zversion" : "");
  $result = $mysql->query_mult_assoc($query);

  if ($result) {
    foreach ($result as $result) {
      $array['objects'][$result['id']] = array("objid"=>$result['id'], "objectname"=>$result['objectname'], "xpos"=>$result['xpos'], "ypos"=>$result['ypos'], "zpos"=>$result['zpos'], "heading"=>$result['heading'], "itemid"=>$result['itemid'], "charges"=>$result['charges'], "type"=>$result['type'], "icon"=>$result['icon'], "version"=>$result['version'], "tilt_x"=>$result['tilt_x'], "tilt_y"=>$result['tilt_y'], "size"=>$result['size'], "display_name"=>$result['display_name']);
    }
  }

  return $array;
}

function fishing_info() {
  global $mysql;

  $fsid = $_GET['fsid'];

  $query = "SELECT id AS fsid,Itemid AS fiid,zoneid,skill_level,chance,npc_id,npc_chance FROM fishing WHERE id=\"$fsid\"";
  $result = $mysql->query_assoc($query);

  return $result;
}

function forage_info() {
  global $mysql;

  $fgid = $_GET['fgid'];

  $query = "SELECT id AS fgid,Itemid AS fgiid,zoneid,level,chance FROM forage WHERE id=\"$fgid\"";
  $result = $mysql->query_assoc($query);

  return $result;
}

function gspawn_info() {
  global $mysql;

  $gsid = $_GET['gsid'];

  $query = "SELECT id AS gsid,zoneid,max_x,max_y,max_z,min_x,min_y,heading,name,version,item AS giid,max_allowed,comment,respawn_timer FROM ground_spawns WHERE id=\"$gsid\"";
  $result = $mysql->query_assoc($query);

  return $result;
}

function traps_info() {
  global $mysql;

  $tid = $_GET['tid'];

  $query = "SELECT * FROM traps WHERE id=\"$tid\"";
  $result = $mysql->query_assoc($query);

  return $result;
}

function horses_info() {
  global $mysql;

  $filename = $_GET['filename'];

  $query = "SELECT * FROM horses WHERE filename=\"$filename\"";
  $result = $mysql->query_assoc($query);

  return $result;
}

function doors_info() {
  global $mysql;

  $drid = $_GET['drid'];

  $query = "SELECT * FROM doors WHERE id=\"$drid\"";
  $result = $mysql->query_assoc($query);

  return $result;
}

function objects_info() {
  global $mysql;

  $objid = $_GET['objid'];

  $query = "SELECT * FROM object WHERE id=\"$objid\"";
  $result = $mysql->query_assoc($query);

  return $result;
}

function update_fishing() {
  global $mysql;

  $fsid = $_POST['fsid'];
  $fiid = $_POST['fiid'];
  $zoneid = $_POST['zoneid'];
  $skill_level = $_POST['skill_level'];
  $chance = $_POST['chance'];
  $npc_id = $_POST['npc_id'];
  $npc_chance = $_POST['npc_chance'];

  $query = "UPDATE fishing SET Itemid=\"$fiid\", zoneid=\"$zoneid\", skill_level=\"$skill_level\", chance=\"$chance\", npc_id=\"$npc_id\", npc_chance=\"$npc_chance\" WHERE id=\"$fsid\"";
  $mysql->query_no_result($query);
}

function update_forage() {
  global $mysql;

  $fgid = $_POST['fgid'];
  $fgiid = $_POST['fgiid'];
  $zoneid = $_POST['zoneid'];
  $level = $_POST['level'];
  $chance = $_POST['chance'];

  $query = "UPDATE forage SET Itemid=\"$fgiid\", zoneid=\"$zoneid\", level=\"$level\", chance=\"$chance\" WHERE id=\"$fgid\"";
  $mysql->query_no_result($query);
}

function update_horses() {
  global $mysql;

  $filename = $_POST['filename'];
  $filenamea = $_POST['filenamea'];
  $race = $_POST['race'];
  $gender = $_POST['gender'];
  $texture = $_POST['texture'];
  $mountspeed = $_POST['mountspeed'];
  $notes = $_POST['notes'];

  $query = "UPDATE horses SET filename=\"$filenamea\", race=\"$race\", gender=\"$gender\", texture=\"$texture\", mountspeed=\"$mountspeed\", notes=\"$notes\" WHERE filename=\"$filename\"";
  $mysql->query_no_result($query);
}

function update_gspawn() {
  global $mysql;

  $gsid = $_POST['gsid'];
  $giid = $_POST['giid'];
  $zoneid = $_POST['zoneid'];
  $max_x = $_POST['max_x'];
  $max_y = $_POST['max_y'];
  $max_z = $_POST['max_z'];
  $min_x = $_POST['min_x'];
  $min_y = $_POST['min_y'];
  $heading = $_POST['heading'];
  $max_allowed = $_POST['max_allowed'];
  $respawn_timer = $_POST['respawn_timer'];
  $name = $_POST['name'];
  $comment = $_POST['comment'];
  $version = $_POST['version'];

  $query = "UPDATE ground_spawns SET item=\"$giid\", zoneid=\"$zoneid\", max_x=\"$max_x\", max_y=\"$max_y\", max_z=\"$max_z\", min_x=\"$min_x\", min_y=\"$min_y\", heading=\"$heading\", max_allowed=\"$max_allowed\", respawn_timer=\"$respawn_timer\", name=\"$name\", comment=\"$comment\", version=\"$version\" WHERE id=\"$gsid\"";
  $mysql->query_no_result($query);
}

function update_traps() {
  global $mysql;

  $tid = $_POST['tid'];
  $zone = $_POST['zone'];
  $x = $_POST['x_coord'];
  $y = $_POST['y_coord'];
  $z_coord = $_POST['z_coord'];
  $chance = $_POST['chance'];
  $maxzdiff = $_POST['maxzdiff'];
  $radius = $_POST['radius'];
  $effect = $_POST['effect'];
  $effectvalue = $_POST['effectvalue'];
  $effectvalue2 = $_POST['effectvalue2'];
  $message = $_POST['message'];
  $skill = $_POST['skill'];
  $level = $_POST['level'];
  $respawn_time = $_POST['respawn_time'];
  $respawn_var = $_POST['respawn_var'];
  $version = $_POST['version'];

  $query = "UPDATE traps SET zone=\"$zone\", x=\"$x\", y=\"$y\", z=\"$z_coord\", chance=\"$chance\", maxzdiff=\"$maxzdiff\", radius=\"$radius\", effect=\"$effect\", effectvalue=\"$effectvalue\", effectvalue2=\"$effectvalue2\", message=\"$message\", skill=\"$skill\", level=\"$level\", respawn_time=\"$respawn_time\", respawn_var=\"$respawn_var\", version=\"$version\" WHERE id=\"$tid\"";
  $mysql->query_no_result($query);
}

function update_doors() {
  global $mysql;

  $drid = $_POST['drid'];
  $doorid = $_POST['doorid'];
  $name = $_POST['name'];
  $pos_x = $_POST['pos_x'];
  $pos_y = $_POST['pos_y'];
  $pos_z = $_POST['pos_z'];
  $heading = $_POST['heading'];
  $opentype = $_POST['opentype'];
  $guild = $_POST['guild'];
  $lockpick = $_POST['lockpick'];
  $keyitem = $_POST['keyitem'];
  $triggerdoor = $_POST['triggerdoor'];
  $triggertype = $_POST['triggertype'];
  $doorisopen = $_POST['doorisopen'];
  $door_param = $_POST['door_param'];
  $dest_zone = $_POST['dest_zone'];
  $dest_x = $_POST['dest_x'];
  $dest_y = $_POST['dest_y'];
  $dest_z = $_POST['dest_z'];
  $dest_heading = $_POST['dest_heading'];
  $invert_state = $_POST['invert_state'];
  $incline = $_POST['incline'];
  $size = $_POST['size'];
  $version = $_POST['version'];
  $is_ldon_door = $_POST['is_ldon_door'];
  $nokeyring = $_POST['nokeyring'];
  $dest_instance = $_POST['dest_instance'];
  $client_version_mask = $_POST['client_version_mask'];
  $disable_timer = $_POST['disable_timer'];

  $query = "UPDATE doors SET doorid=\"$doorid\", name=\"$name\", pos_x=\"$pos_x\", pos_y=\"$pos_y\", pos_z=\"$pos_z\", heading=\"$heading\", opentype=\"$opentype\", guild=\"$guild\", lockpick=\"$lockpick\", keyitem=\"$keyitem\", triggerdoor=\"$triggerdoor\", triggertype=\"$triggertype\", doorisopen=\"$doorisopen\", door_param=\"$door_param\", dest_zone=\"$dest_zone\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_heading=\"$dest_heading\", invert_state=\"$invert_state\", incline=\"$incline\", size=\"$size\", version=\"$version\", is_ldon_door=\"$is_ldon_door\", nokeyring=\"$nokeyring\", dest_instance=\"$dest_instance\", client_version_mask=\"$client_version_mask\", disable_timer=\"$disable_timer\" WHERE id=\"$drid\"";
  $mysql->query_no_result($query);
}

function update_object() {
  global $mysql;

  $objid = $_POST['objid'];
  $objectname = $_POST['objectname'];
  $xpos = $_POST['xpos'];
  $ypos = $_POST['ypos'];
  $zpos = $_POST['zpos'];
  $heading = $_POST['heading'];
  $itemid = $_POST['itemid'];
  $charges = $_POST['charges'];
  $type = $_POST['type'];
  $icon = $_POST['icon'];
  $version = $_POST['version'];
  $tilt_x = $_POST['tilt_x'];
  $tilt_y = $_POST['tilt_y'];
  $size = $_POST['size'];
  $display_name = $_POST['display_name'];

  $query = "UPDATE object SET objectname=\"$objectname\", xpos=\"$xpos\", ypos=\"$ypos\", zpos=\"$zpos\", heading=\"$heading\", itemid=\"$itemid\", charges=\"$charges\", type=\"$type\", icon=\"$icon\", version=\"$version\", tilt_x=\"$tilt_x\", tilt_y=\"$tilt_y\", size=\"$size\", display_name=\"$display_name\" WHERE id=\"$objid\"";
  $mysql->query_no_result($query);
}

function delete_fishing() {
  global $mysql;

  $fsid = $_GET['fsid'];

  $query = "DELETE from fishing WHERE id=\"$fsid\"";
  $mysql->query_no_result($query);
}

function delete_forage() {
  global $mysql;

  $fgid = $_GET['fgid'];

  $query = "DELETE from forage WHERE id=\"$fgid\"";
  $mysql->query_no_result($query);
}

function delete_gspawn() {
  global $mysql;

  $gsid = $_GET['gsid'];

  $query = "DELETE from ground_spawns WHERE id=\"$gsid\"";
  $mysql->query_no_result($query);
}

function delete_traps() {
  global $mysql;

  $tid = $_GET['tid'];

  $query = "DELETE from traps WHERE id=\"$tid\"";
  $mysql->query_no_result($query);
}

function delete_horses() {
  global $mysql;

  $filename = $_GET['filename'];

  $query = "DELETE from horses WHERE filename=\"$filename\"";
  $mysql->query_no_result($query);
}

function delete_doors() {
  global $mysql;

  $drid = $_GET['drid'];

  $query = "DELETE from doors WHERE id=\"$drid\"";
  $mysql->query_no_result($query);
}

function delete_object() {
  global $mysql;

  $objid = $_GET['objid'];

  $query = "DELETE from object WHERE id=\"$objid\"";
  $mysql->query_no_result($query);
}

function suggest_fishing_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS fsid FROM fishing";
  $result = $mysql->query_assoc($query);

  return ($result['fsid'] + 1);
}

function suggest_forage_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS fgid FROM forage";
  $result = $mysql->query_assoc($query);

  return ($result['fgid'] + 1);
}

function suggest_gspawn_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS gsid FROM ground_spawns";
  $result = $mysql->query_assoc($query);

  return ($result['gsid'] + 1);
}


function suggest_traps_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS tid FROM traps";
  $result = $mysql->query_assoc($query);

  return ($result['tid'] + 1);
}

function suggest_door_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS drid FROM doors";
  $result = $mysql->query_assoc($query);

  return ($result['drid'] + 1);
}

function suggest_doorid() {
  global $mysql, $z;

  $query = "SELECT MAX(doorid) AS dorid FROM doors WHERE zone=\"$z\"";
  $result = $mysql->query_assoc($query);

  return ($result['dorid'] + 1);
}

function suggest_object_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS objid FROM object";
  $result = $mysql->query_assoc($query);

  return ($result['objid'] + 1);
}

function add_fishing() {
  global $mysql;

  $fsid = $_GET['fsid'];
  $fiid = $_POST['fiid'];
  $zoneid = $_POST['zoneid'];
  $skill_level = $_POST['skill_level'];
  $chance = $_POST['chance'];
  $npc_id = $_POST['npc_id'];
  $npc_chance = $_POST['npc_chance'];

  $query = "INSERT INTO fishing SET id=\"fsid\", Itemid=\"$fiid\", zoneid=\"$zoneid\", skill_level=\"$skill_level\", chance=\"$chance\", npc_id=\"$npc_id\", npc_chance=\"$npc_chance\"";
  $mysql->query_no_result($query);
}

function add_forage() {
  global $mysql;

  $fgid = $_GET['fgid'];
  $fgiid = $_POST['fgiid'];
  $zoneid = $_POST['zoneid'];
  $level = $_POST['level'];
  $chance = $_POST['chance'];

  $query = "INSERT INTO forage SET id=\"fgid\", Itemid=\"$fgiid\", zoneid=\"$zoneid\", level=\"$level\", chance=\"$chance\"";
  $mysql->query_no_result($query);
}

function add_gspawn() {
  global $mysql;

  $gsid = $_POST['gsid'];
  $giid = $_POST['giid'];
  $zoneid = $_POST['zoneid'];
  $max_x = $_POST['max_x'];
  $max_y = $_POST['max_y'];
  $max_z = $_POST['max_z'];
  $min_x = $_POST['min_x'];
  $min_y = $_POST['min_y'];
  $heading = $_POST['heading'];
  $max_allowed = $_POST['max_allowed'];
  $respawn_timer = $_POST['respawn_timer'];
  $name = $_POST['name'];
  $comment = $_POST['comment'];
  $version = $_POST['version'];

  $query = "INSERT INTO ground_spawns SET id=\"$gsid\", item=\"$giid\", zoneid=\"$zoneid\", max_x=\"$max_x\", max_y=\"$max_y\", max_z=\"$max_z\", min_x=\"$min_x\", min_y=\"$min_y\", heading=\"$heading\", max_allowed=\"$max_allowed\", respawn_timer=\"$respawn_timer\", name=\"$name\", comment=\"$comment\", version=\"$version\"";
  $mysql->query_no_result($query);
}

function add_traps() {
  global $mysql;

  $tid = $_POST['tid'];
  $zone = $_POST['zone'];
  $x = $_POST['x_coord'];
  $y = $_POST['y_coord'];
  $z_coord = $_POST['z_coord'];
  $chance = $_POST['chance'];
  $maxzdiff = $_POST['maxzdiff'];
  $radius = $_POST['radius'];
  $effect = $_POST['effect'];
  $effectvalue = $_POST['effectvalue'];
  $effectvalue2 = $_POST['effectvalue2'];
  $message = $_POST['message'];
  $skill = $_POST['skill'];
  $level = $_POST['level'];
  $respawn_time = $_POST['respawn_time'];
  $respawn_var = $_POST['respawn_var'];
  $version = $_POST['version'];

  $query = "INSERT INTO traps SET id=\"tid\", zone=\"$zone\", x=\"$x\", y=\"$y\", z=\"$z_coord\", chance=\"$chance\", maxzdiff=\"$maxzdiff\", radius=\"$radius\", effect=\"$effect\", effectvalue=\"$effectvalue\", effectvalue2=\"$effectvalue2\", message=\"$message\", skill=\"$skill\", level=\"$level\", respawn_time=\"$respawn_time\", respawn_var=\"$respawn_var\", version=\"$version\"";
  $mysql->query_no_result($query);
}

function add_horses() {
  global $mysql;

  $filename = $_POST['filename'];
  $race = $_POST['race'];
  $gender = $_POST['gender'];
  $texture = $_POST['texture'];
  $mountspeed = $_POST['mountspeed'];
  $notes = $_POST['notes'];

  $query = "INSERT INTO horses SET filename=\"$filename\", race=\"$race\", gender=\"$gender\", texture=\"$texture\", mountspeed=\"$mountspeed\", notes=\"$notes\"";
  $mysql->query_no_result($query);
}

function add_doors() {
  global $mysql, $z;

  $drid = $_POST['drid'];
  $doorid = $_POST['doorid'];
  $name = $_POST['name'];
  $pos_x = $_POST['pos_x'];
  $pos_y = $_POST['pos_y'];
  $pos_z = $_POST['pos_z'];
  $heading = $_POST['heading'];
  $opentype = $_POST['opentype'];
  $guild = $_POST['guild'];
  $lockpick = $_POST['lockpick'];
  $keyitem = $_POST['keyitem'];
  $triggerdoor = $_POST['triggerdoor'];
  $triggertype = $_POST['triggertype'];
  $doorisopen = $_POST['doorisopen'];
  $door_param = $_POST['door_param'];
  $dest_zone = $_POST['dest_zone'];
  $dest_x = $_POST['dest_x'];
  $dest_y = $_POST['dest_y'];
  $dest_z = $_POST['dest_z'];
  $dest_heading = $_POST['dest_heading'];
  $invert_state = $_POST['invert_state'];
  $incline = $_POST['incline'];
  $size = $_POST['size'];
  $version = $_POST['version'];
  $is_ldon_door = $_POST['is_ldon_door'];
  $nokeyring = $_POST['nokeyring'];
  $dest_instance = $_POST['dest_instance'];
  $client_version_mask = $_POST['client_version_mask'];
  $disable_timer = $_POST['disable_timer'];

  $query = "INSERT INTO doors SET id=\"$drid\", zone=\"$z\", doorid=\"$doorid\", name=\"$name\", pos_x=\"$pos_x\", pos_y=\"$pos_y\", pos_z=\"$pos_z\", heading=\"$heading\", opentype=\"$opentype\", guild=\"$guild\", lockpick=\"$lockpick\", keyitem=\"$keyitem\", triggerdoor=\"$triggerdoor\", triggertype=\"$triggertype\", doorisopen=\"$doorisopen\", door_param=\"$door_param\", dest_zone=\"$dest_zone\", dest_x=\"$dest_x\", dest_y=\"$dest_y\", dest_z=\"$dest_z\", dest_heading=\"$dest_heading\", invert_state=\"$invert_state\", incline=\"$incline\", size=\"$size\", buffer=0, is_ldon_door=\"$is_ldon_door\", version=\"$version\", nokeyring=\"$nokeyring\", dest_instance=\"$dest_instance\", client_version_mask=\"$client_version_mask\", disable_timer=\"$disable_timer\"";
  $mysql->query_no_result($query);
}

function add_objects() {
  global $mysql, $z;

  $zid = getZoneID($z);
  $objid = $_POST['objid'];
  $zoneid = $_POST['zoneid'];
  $objectname = $_POST['objectname'];
  $xpos = $_POST['xpos'];
  $ypos = $_POST['ypos'];
  $zpos = $_POST['zpos'];
  $heading = $_POST['heading'];
  $itemid = $_POST['itemid'];
  $charges = $_POST['charges'];
  $type = $_POST['type'];
  $icon = $_POST['icon'];
  $version = $_POST['version'];

  $query = "INSERT INTO object SET id=\"$objid\", zoneid=\"$zid\", objectname=\"$objectname\", xpos=\"$xpos\", ypos=\"$ypos\", zpos=\"$zpos\", heading=\"$heading\", itemid=\"$itemid\", charges=\"$charges\", type=\"$type\", icon=\"$icon\", version=\"$version\"";

  $mysql->query_no_result($query);
}

function search_fishing_by_id() {
   global $mysql;

   $fishid = $_GET['fishid'];

   $query = "SELECT id AS fsid, Itemid AS fiid FROM fishing WHERE Itemid=\"$fishid\"";
   $results = $mysql->query_mult_assoc($query);

   return $results;
}

function search_gspawn_by_id() {
   global $mysql;

   $gspawnid = $_GET['gspawnid'];

   $query = "SELECT id AS gsid, item AS giid FROM ground_spawns where item=\"$gspawnid\"";
   $results = $mysql->query_mult_assoc($query);

   return $results;
}

function search_forage_by_id() {
   global $mysql;

   $forageid = $_GET['forageid'];

   $query = "SELECT id AS fgid, Itemid AS fgiid FROM forage where Itemid=\"$forageid\"";
   $results = $mysql->query_mult_assoc($query);

   return $results;
}

function get_max_doorversion() {
   global $mysql, $z;

   $query = "SELECT MAX(version) AS version FROM doors WHERE zone=\"$z\"";
   $result = $mysql->query_assoc($query);

  return ($result['version'] + 1);
}

function get_max_gsversion() {
   global $mysql, $z;
   $zid=getZoneID($z);

   $query = "SELECT MAX(version) AS version FROM ground_spawns WHERE zoneid=\"$zid\"";
   $result = $mysql->query_assoc($query);

  return ($result['version'] + 1);
}

function get_max_trapversion() {
   global $mysql, $z;

   $query = "SELECT MAX(version) AS version FROM traps WHERE zone=\"$z\"";
   $result = $mysql->query_assoc($query);

  return ($result['version'] + 1);
}

function get_max_objectversion() {
   global $mysql, $z;
   $zid=getZoneID($z);

   $query = "SELECT MAX(version) AS version FROM object WHERE zoneid=\"$zid\"";
   $result = $mysql->query_assoc($query);

  return ($result['version'] + 1);
}

function copy_doors() {
  global $mysql, $z;

  $door_version = $_POST['door_version'];
  $new_version = $_POST['new_version'];

  $query = "CREATE TEMPORARY TABLE `doors_temp` (
    `id` int(11) NOT NULL,
    `doorid` smallint(4) NOT NULL auto_increment,
    `zone` varchar(16) NOT NULL default '',
    `version` smallint(5) unsigned NOT NULL default '0',
    `name` varchar(32) NOT NULL default '',
    `pos_y` float NOT NULL default '0',
    `pos_x` float NOT NULL default '0',
    `pos_z` float NOT NULL default '0',
    `heading` float NOT NULL default '0',
    `opentype` smallint(4) NOT NULL default '0',
    `guild` smallint(4) NOT NULL default '0',
    `lockpick` smallint(4) NOT NULL default '0',
    `keyitem` int(11) NOT NULL default '0',
    `nokeyring` tinyint(3) unsigned NOT NULL default '0',
    `triggerdoor` smallint(4) NOT NULL default '0',
    `triggertype` smallint(4) NOT NULL default '0',
    `doorisopen` smallint(4) NOT NULL default '0',
    `door_param` int(4) NOT NULL default '0',
    `dest_zone` varchar(16) default 'NONE',
    `dest_x` float default '0',
    `dest_y` float default '0',
    `dest_z` float default '0',
    `dest_heading` float default '0',
    `invert_state` int(11) default '0',
    `incline` int(11) default '0',
    `size` smallint(5) unsigned NOT NULL default '100',
    `buffer` float default '0',
    `is_ldon_door` smallint(6) NOT NULL default '0',
    `dest_instance` int UNSIGNED default 0 NOT NULL,
    `client_version_mask` int UNSIGNED default 4294967295 NOT NULL,
    `disable_timer` tinyint(2) NOT NULL default 0,
    PRIMARY KEY (`doorid`)
  )";
   $mysql->query_no_result($query);


   $query = "INSERT INTO doors_temp (id,doorid,zone,version,name,pos_y,pos_x,pos_z,heading,opentype,guild,lockpick,keyitem,nokeyring,triggerdoor,triggertype,doorisopen,door_param,dest_zone,dest_x,dest_y,dest_z,dest_heading,invert_state,incline,size,is_ldon_door,dest_instance,client_version_mask,disable_timer)
             SELECT id,doorid,zone,name,version,pos_y,pos_x,pos_z,heading,opentype,guild,lockpick,keyitem,nokeyring,triggerdoor,triggertype,doorisopen,door_param,dest_zone,dest_x,dest_y,dest_z,dest_heading,invert_state,incline,size,is_ldon_door,dest_instance,client_version_mask,disable_timer FROM doors WHERE zone=\"$z\"";
   $mysql->query_no_result($query);

   $query = "UPDATE doors SET version=$new_version WHERE version=$door_version AND zone=\"$z\"";
   $mysql->query_no_result($query);

   $query = "INSERT INTO doors_temp (zone,version,name,pos_y,pos_x,pos_z,heading,opentype,guild,lockpick,keyitem,nokeyring,triggerdoor,triggertype,doorisopen,door_param,dest_zone,dest_x,dest_y,dest_z,dest_heading,invert_state,incline,size,is_ldon_door,dest_instance,client_version_mask,disable_timer)
             SELECT zone,version,name,pos_y,pos_x,pos_z,heading,opentype,guild,lockpick,keyitem,nokeyring,triggerdoor,triggertype,doorisopen,door_param,dest_zone,dest_x,dest_y,dest_z,dest_heading,invert_state,incline,size,is_ldon_door,dest_instance,client_version_mask,disable_timer FROM doors WHERE zone=\"$z\" AND version=$new_version";
   $mysql->query_no_result($query);

   $query = "UPDATE doors SET version=$door_version WHERE version=$new_version AND zone=\"$z\"";
   $mysql->query_no_result($query);

   $query = "INSERT INTO doors (doorid,zone,version,name,pos_y,pos_x,pos_z,heading,opentype,guild,lockpick,keyitem,nokeyring,triggerdoor,triggertype,doorisopen,door_param,dest_zone,dest_x,dest_y,dest_z,dest_heading,invert_state,incline,size,is_ldon_door,dest_instance,client_version_mask,disable_timer)
             SELECT doorid,zone,version,name,pos_y,pos_x,pos_z,heading,opentype,guild,lockpick,keyitem,nokeyring,triggerdoor,triggertype,doorisopen,door_param,dest_zone,dest_x,dest_y,dest_z,dest_heading,invert_state,incline,size,is_ldon_door,dest_instance,client_version_mask,disable_timer FROM doors_temp WHERE version=$new_version AND zone=\"$z\"";
   $mysql->query_no_result($query);

   $query = "DROP table `doors_temp`";
   $mysql->query_no_result($query);
}

function copy_groundspawns() {
   global $mysql, $z;
   $zid = getZoneID($z);

   $gs_version = $_POST['gs_version'];
   $new_version = $_POST['new_version'];

   $query = "UPDATE ground_spawns SET version=10000 WHERE version=$gs_version AND zoneid=\"$zid\"";
   $mysql->query_no_result($query);

   $query = "UPDATE ground_spawns SET version=9999 WHERE version=0 AND zoneid=\"$zid\"";
   $mysql->query_no_result($query);

   $query = "INSERT INTO ground_spawns (zoneid,max_x,max_y,max_z,min_x,min_y,heading,name,item,max_allowed,comment,respawn_timer)
            SELECT zoneid,max_x,max_y,max_z,min_x,min_y,heading,name,item,max_allowed,comment,respawn_timer FROM ground_spawns WHERE zoneid=\"$zid\" AND version=10000";
   $mysql->query_no_result($query);

   $query = "UPDATE ground_spawns SET version=$new_version WHERE version=0 AND zoneid=\"$zid\"";
   $mysql->query_no_result($query);

   $query = "UPDATE ground_spawns SET version=$gs_version WHERE version=10000 AND zoneid=\"$zid\"";
   $mysql->query_no_result($query);

  $query = "UPDATE ground_spawns SET version=0 WHERE version=9999 AND zoneid=\"$zid\"";
   $mysql->query_no_result($query);
}

function copy_traps() {
   global $mysql, $z;

   $trap_version = $_POST['trap_version'];
   $new_version = $_POST['new_version'];

   $query = "UPDATE traps SET version=10000 WHERE version=$trap_version AND zone=\"$z\"";
   $mysql->query_no_result($query);

   $query = "UPDATE traps SET version=9999 WHERE version=0 AND zone=\"$z\"";
   $mysql->query_no_result($query);

   $query = "INSERT INTO traps (zone,x,y,z,chance,maxzdiff,radius,effect,effectvalue,effectvalue2,message,skill,level,respawn_time,respawn_var)
            SELECT zone,x,y,z,chance,maxzdiff,radius,effect,effectvalue,effectvalue2,message,skill,level,respawn_time,respawn_var FROM traps WHERE zone=\"$z\" AND version=10000";
   $mysql->query_no_result($query);

   $query = "UPDATE traps SET version=$new_version WHERE version=0 AND zone=\"$z\"";
   $mysql->query_no_result($query);

   $query = "UPDATE traps SET version=$trap_version WHERE version=10000 AND zone=\"$z\"";
   $mysql->query_no_result($query);

  $query = "UPDATE traps SET version=0 WHERE version=9999 AND zone=\"$z\"";
   $mysql->query_no_result($query);
}

function copy_objects() {
   global $mysql, $z;
   $zid = getZoneID($z);

   $object_version = $_POST['object_version'];
   $new_version = $_POST['new_version'];

   $query = "UPDATE object SET version=10000 WHERE version=$object_version AND zoneid=\"$zid\"";
   $mysql->query_no_result($query);

   $query = "UPDATE object SET version=9999 WHERE version=0 AND zoneid=\"$zid\"";
   $mysql->query_no_result($query);

   $query = "INSERT INTO object (zoneid,xpos,ypos,zpos,heading,itemid,charges,objectname,type,icon)
            SELECT zoneid,xpos,ypos,zpos,heading,itemid,charges,objectname,type,icon FROM object WHERE zoneid=\"$zid\" AND version=10000";
   $mysql->query_no_result($query);

   $query = "UPDATE object SET version=$new_version WHERE version=0 AND zoneid=\"$zid\"";
   $mysql->query_no_result($query);

   $query = "UPDATE object SET version=$object_version WHERE version=10000 AND zoneid=\"$zid\"";
   $mysql->query_no_result($query);

  $query = "UPDATE object SET version=0 WHERE version=9999 AND zoneid=\"$zid\"";
   $mysql->query_no_result($query);
}

function delete_traps_ver() {
  global $mysql, $z;

  $trap_version = $_POST['trap_version'];

  $query = "DELETE from traps WHERE version=\"$trap_version\" AND zone=\"$z\"";
  $mysql->query_no_result($query);
}

function delete_doors_ver() {
  global $mysql, $z;

  $door_version = $_POST['door_version'];

  $query = "DELETE from doors WHERE version=\"$door_version\" AND zone=\"$z\"";
  $mysql->query_no_result($query);
}

function delete_groundspawns_ver() {
  global $mysql, $z;

  $zid = getZoneID($z);
  $gs_version = $_POST['gs_version'];

  $query = "DELETE from ground_spawns WHERE version=\"$gs_version\" AND zoneid=\"$zid\"";
  $mysql->query_no_result($query);
}

function delete_objects_ver() {
  global $mysql, $z;

  $zid = getZoneID($z);
  $object_version = $_POST['object_version'];

  $query = "DELETE from object WHERE version=\"$object_version\" AND zoneid=\"$zid\"";
  $mysql->query_no_result($query);
}
?>
