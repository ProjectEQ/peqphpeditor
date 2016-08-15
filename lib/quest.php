<?
switch ($action) {
  case 0:
    check_authorization();
    if($npcid) {
      $body = new Template("templates/quest/quest.tmpl.php");
      $body->set('currzone', $z);
      $body->set('currzoneid', $zoneid);
      $body->set('npcid', $npcid);
      $body->set('filename', find_quest_script());
    }
    else {
      $body = new Template("templates/quest/quest.default.tmpl.php");
    }
    break;
   case 1:
    check_authorization();
    MarkQuestNPC();
    header("Location: index.php?editor=npc");
    exit;
}

function find_quest_script() {
  global $npcid, $quest_path;

  $name = getNPCName($npcid);
  $npcname = str_replace("`","-",$name);

  $zone = ($npcid >= 1000) ? get_zone_by_npcid($npcid) : "";
  $zonepath = "$quest_path/$zone";
  $temppath = "$quest_path/templates";

  $LuafullpathID = "$zonepath/$npcid.lua";
  $LuafullpathName = "$zonepath/$npcname.lua";
  $LuafulltempID = "$temppath/$npcid.lua";
  $LuafulltempName = "$temppath/$npcname.lua";
  $Luafullzonedefault = "$zonepath/default.lua";
  $Luafulldefault = "$quest_path/default.lua";

  $fullpathID = "$zonepath/$npcid.pl";
  $fullpathName = "$zonepath/$npcname.pl";
  $fulltempID = "$temppath/$npcid.pl";
  $fulltempName = "$temppath/$npcname.pl";
  $fullzonedefault = "$zonepath/default.pl";
  $fulldefault = "$quest_path/default.pl";

  if(file_exists($LuafullpathID))
    $path = $LuafullpathID;
  else if(file_exists($LuafullpathName))
    $path = $LuafullpathName;
  else if(file_exists($LuafulltempID))
    $path = $LuafulltempID;
  else if(file_exists($LuafulltempName))
    $path = $LuafulltempName;
  else if(file_exists($fullzonedefault))
    $path = $fullzonedefault;
  else if(file_exists($Luafulldefault))
    $path = $Luafulldefault;
  else if(file_exists($fullpathID))
    $path = $fullpathID;
  else if(file_exists($fullpathName))
    $path = $fullpathName;
  else if(file_exists($fulltempID))
    $path = $fulltempID;
  else if(file_exists($fulltempName))
    $path = $fulltempName;
  else if(file_exists($fullzonedefault))
    $path = $fullzonedefault;
  else if(file_exists($fulldefault))
    $path = $fulldefault;
  else {
    if($zone == '')
        $path = $LuafulltempName;
    else
        $path = $LuafullpathName;
  }

  return $path;
}

function MarkQuestNPC() {
  global $mysql, $quest_path;

  $query = "UPDATE npc_types SET isquest = 0";
  $mysql->query_no_result($query);

  $query = "SELECT id FROM npc_types";
  $results = $mysql->query_mult_assoc($query);

  foreach ($results as $r) {

    $npcid = $r['id'];
    $name = getNPCName($npcid);
    $npcname = str_replace("`","-",$name);

    $zone = ($npcid >= 1000) ? get_zone_by_npcid($npcid) : "";
    $zonepath = "$quest_path/$zone";
    $temppath = "$quest_path/templates";

    $LuafullpathID = "$zonepath/$npcid.lua";
    $LuafullpathName = "$zonepath/$npcname.lua";
    $LuafulltempID = "$temppath/$npcid.lua";
    $LuafulltempName = "$temppath/$npcname.lua";

    $fullpathID = "$zonepath/$npcid.pl";
    $fullpathName = "$zonepath/$npcname.pl";
    $fulltempID = "$temppath/$npcid.pl";
    $fulltempName = "$temppath/$npcname.pl";

    if(file_exists($LuafullpathID) || file_exists($LuafullpathName) || file_exists($LuafulltempID) || file_exists($LuafulltempName) || file_exists($fullpathID) || file_exists($fullpathName) || file_exists($fulltempID) || file_exists($fulltempName)) {
      $query = "UPDATE npc_types SET isquest=1 WHERE id=$npcid";
      $mysql->query_no_result($query);
    }

  }
}
?>
