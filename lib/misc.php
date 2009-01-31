<?

$traptype = array(
  0   => "Casting",
  1   => "Alarm",
  2   => "NPC S. Area",
  3   => "NPC L. Area",
  4   => "Damage",
);

$alarmtype = array(
  0   => "All aggro",
  1   => "KOS aggro",
);

switch ($action) {
  case 0:
    if (!$z) {
    }
    else {
        $body = new Template("templates/misc/misc.default.tmpl.php");
        $body->set('currzone', $z);
    }
    break;
  case 1: // View fishing
    $body = new Template("templates/misc/fishing.tmpl.php");
    $body->set('currzone', $z);
    $fishing = get_fishing();
    if ($fishing) {
      foreach ($fishing as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2: // Edit fishing
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/misc/fishing.edit.tmpl.php");
    $body->set('currzone', $z);
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
    header("Location: index.php?editor=misc&z=$z&action=1");
    exit;
  case 4: // Delete fishing
    check_authorization();
    delete_fishing();
    header("Location: index.php?editor=misc&z=$z&action=1");
    exit;
  case 5: // Get fishing ID
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/misc/fishing.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('zid', getZoneID($z));
    $body->set('suggestfsid', suggest_fishing_id());
    break;
  case 6: // Add fishing
    check_authorization();
    add_fishing();
    header("Location: index.php?editor=misc&z=$z&action=1");
    exit;
  case 7: // View forage
    $body = new Template("templates/misc/forage.tmpl.php");
    $body->set('currzone', $z);
    $forage = get_forage();
    if ($forage) {
      foreach ($forage as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 8: // Edit forage
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/misc/forage.edit.tmpl.php");
    $body->set('currzone', $z);
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
    header("Location: index.php?editor=misc&z=$z&action=7");
    exit;
   case 10: // Delete forage
    check_authorization();
    delete_forage();
    header("Location: index.php?editor=misc&z=$z&action=7");
    exit;
   case 11: // Get forage ID
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/misc/forage.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('zid', getZoneID($z));
    $body->set('suggestfgid', suggest_forage_id());
    break;
   case 12: // Add forage
    check_authorization();
    add_forage();
    header("Location: index.php?editor=misc&z=$z&action=7");
    exit;
   case 13: // View ground spawns
    check_authorization();
    $body = new Template("templates/misc/groundspawn.tmpl.php");
    $body->set('currzone', $z);
    $gspawn = get_gspawn();
    if ($gspawn) {
      foreach ($gspawn as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 14: // Edit ground spawns
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/misc/groundspawn.edit.tmpl.php");
    $body->set('currzone', $z);
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
    header("Location: index.php?editor=misc&z=$z&action=13");
    exit;
   case 16: // Delete ground spawns
    check_authorization();
    delete_gspawn();
    header("Location: index.php?editor=misc&z=$z&action=13");
    exit;
   case 17: // Get ground spawn ID
    check_authorization();
    $javascript = new Template("templates/iframes/js.tmpl.php");
    $body = new Template("templates/misc/groundspawn.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set('zid', getZoneID($z));
    $body->set('suggestgsid', suggest_gspawn_id());
    break;
   case 18: // Add ground spawn
    check_authorization();
    add_gspawn();
    header("Location: index.php?editor=misc&z=$z&action=13");
    exit;
   case 19: // View traps
    check_authorization();
    $body = new Template("templates/misc/traps.tmpl.php");
    $body->set('currzone', $z);
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
    $body = new Template("templates/misc/traps.edit.tmpl.php");
    $body->set('currzone', $z);
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
    header("Location: index.php?editor=misc&z=$z&action=19");
    exit;
   case 22: // Delete traps
    check_authorization();
    delete_traps();
    header("Location: index.php?editor=misc&z=$z&action=19");
    exit;
   case 23: // Get traps ID
    check_authorization();
    $body = new Template("templates/misc/traps.add.tmpl.php");
    $body->set('currzone', $z);
    $body->set("traptype", $traptype);
    $body->set("alarmtype", $alarmtype);
    $body->set('suggesttid', suggest_traps_id());
    break;
   case 24: // Add traps
    check_authorization();
    add_traps();
    header("Location: index.php?editor=misc&z=$z&action=19");
    exit; 
   case 25:  // Search functions
    //check_authorization();
    $body = new Template("templates/misc/misc.searchresults.tmpl.php");
    if (isset($_GET['gspawnid']) && $_GET['gspawnid'] != "GroundSpawn"){
       $gspawn = search_gspawn_by_id();
    }
    if (isset($_GET['forageid']) && $_GET['forageid'] != "Forage"){
       $forage = search_forage_by_id();
    }
    if (isset($_GET['fishid']) && $_GET['fishid'] != "Fishing"){
       $fishing = search_fishing_by_id();
    }
    $body->set("fishing", $fishing);
    $body->set("forage", $forage);
    $body->set("gspawn", $gspawn);
    break;
   case 26: // View fishing
    $body = new Template("templates/misc/fishing.view.tmpl.php");
    $fishing = fishing_info();
    if ($fishing) {
      foreach ($fishing as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 27: // View forage
    $body = new Template("templates/misc/forage.view.tmpl.php");
    $forage = forage_info();
    if ($forage) {
      foreach ($forage as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 28: // View ground spawns
    check_authorization();
    $body = new Template("templates/misc/groundspawn.view.tmpl.php");
    $gspawn = gspawn_info();
    if ($gspawn) {
      foreach ($gspawn as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
   case 29: // View horses
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
    header("Location: index.php?editor=misc&z=$z&action=29");
    exit;
   case 32: // Delete horses
    check_authorization();
    delete_horses();
    header("Location: index.php?editor=misc&z=$z&action=29");
    exit;
   case 33: // Add horses
    check_authorization();
    $body = new Template("templates/misc/horses.add.tmpl.php");
    $body->set("races", $races);
    $body->set("genders", $genders);
    break;
   case 34: // Add horses
    check_authorization();
    add_horses();
    header("Location: index.php?editor=misc&z=$z&action=29");
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
  global $mysql, $z;
  $zid = getZoneID($z);
  $array = array();
  
  $query = "SELECT ground_spawns.id,zoneid,max_x,max_y,max_z,min_x,min_y,heading,max_allowed,respawn_timer,item AS giid, items.name AS name
                FROM ground_spawns, items
                WHERE ground_spawns.zoneid=$zid 
                AND ground_spawns.item=items.id
                OR ground_spawns.zoneid=0
                AND ground_spawns.item=items.id";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['gspawn'][$result['id']] = array("gsid"=>$result['id'], "giid"=>$result['giid'], "zoneid"=>$result['zoneid'], "max_x"=>$result['max_x'], "max_y"=>$result['max_y'], "max_z"=>$result['max_z'], "min_x"=>$result['min_x'], "min_y"=>$result['min_y'], "heading"=>$result['heading'], "gname"=>$result['gname'], "max_allowed"=>$result['max_allowed'], "comment"=>$result['comment'], "respawn_timer"=>$result['respawn_timer'], "iname"=>$result['name']);
         }
       }
  return $array;
  }

function get_traps() {
  global $mysql, $z;
  $array = array();
  
  $query = "SELECT * FROM traps WHERE zone=\"$z\"";
  $result = $mysql->query_mult_assoc($query);
  if ($result) {
    foreach ($result as $result) {
     $array['traps'][$result['id']] = array("tid"=>$result['id'], "x_coord"=>$result['x'], "y_coord"=>$result['y'], "z_coord"=>$result['z'], "chance"=>$result['chance'], "maxzdiff"=>$result['maxzdiff'], "radius"=>$result['radius'], "effect"=>$result['effect'], "effectvalue"=>$result['effectvalue'], "effectvalue2"=>$result['effectvalue2'], "message"=>$result['message'], "skill"=>$result['skill'], "level"=>$result['level'], "respawn_time"=>$result['respawn_time'], "respawn_var"=>$result['respawn_var']);
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

  $query = "SELECT id AS gsid,zoneid,max_x,max_y,max_z,min_x,min_y,heading,name,item AS giid,max_allowed,comment,respawn_timer FROM ground_spawns WHERE id=\"$gsid\"";
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

  $query = "UPDATE ground_spawns SET item=\"$giid\", zoneid=\"$zoneid\", max_x=\"$max_x\", max_y=\"$max_y\", max_z=\"$max_z\", min_x=\"$min_x\", min_y=\"$min_y\", heading=\"$heading\", max_allowed=\"$max_allowed\", respawn_timer=\"$respawn_timer\", name=\"$name\", comment=\"$comment\" WHERE id=\"$gsid\"";
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

  $query = "UPDATE traps SET zone=\"$zone\", x=\"$x\", y=\"$y\", z=\"$z_coord\", chance=\"$chance\", maxzdiff=\"$maxzdiff\", radius=\"$radius\", effect=\"$effect\", effectvalue=\"$effectvalue\", effectvalue2=\"$effectvalue2\", message=\"$message\", skill=\"$skill\", level=\"$level\", respawn_time=\"$respawn_time\", respawn_var=\"$respawn_var\" WHERE id=\"$tid\"";
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

  $query = "INSERT INTO ground_spawns SET id=\"gsid\", item=\"$giid\", zoneid=\"$zoneid\", max_x=\"$max_x\", max_y=\"$max_y\", max_z=\"$max_z\", min_x=\"$min_x\", min_y=\"$min_y\", heading=\"$heading\", max_allowed=\"$max_allowed\", respawn_timer=\"$respawn_timer\", name=\"$name\", comment=\"$comment\"";
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

  $query = "INSERT INTO traps SET id=\"tid\", zone=\"$zone\", x=\"$x\", y=\"$y\", z=\"$z_coord\", chance=\"$chance\", maxzdiff=\"$maxzdiff\", radius=\"$radius\", effect=\"$effect\", effectvalue=\"$effectvalue\", effectvalue2=\"$effectvalue2\", message=\"$message\", skill=\"$skill\", level=\"$level\", respawn_time=\"$respawn_time\", respawn_var=\"$respawn_var\"";
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

?>