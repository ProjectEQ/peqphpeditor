<?php

$list_limit = 500;

$slots = array(
    0 => "Charm",
    1 => "Left Ear",
    2 => "Head",
    3 => "Face",
    4 => "Right Ear",
    5 => "Neck",
    6 => "Shoulders",
    7 => "Arms",
    8 => "Back",
    9 => "Left Wrist",
   10 => "Right Wrist",
   11 => "Range",
   12 => "Hands",
   13 => "Primary",
   14 => "Secondary",
   15 => "Left Finger",
   16 => "Right Finger",
   17 => "Chest",
   18 => "Legs",
   19 => "Feet",
   20 => "Waist",
   21 => "Power Source",
   22 => "Ammo",
   23 => "Main01",
   24 => "Main02",
   25 => "Main03",
   26 => "Main04",
   27 => "Main05",
   28 => "Main06",
   29 => "Main07",
   30 => "Main08",
   31 => "Main09",
   32 => "Main10",
   33 => "CursorFront",
  251 => "Main01-01",
  252 => "Main01-02",
  253 => "Main01-03",
  254 => "Main01-04",
  255 => "Main01-05",
  256 => "Main01-06",
  257 => "Main01-07",
  258 => "Main01-08",
  259 => "Main01-09",
  260 => "Main01-10",
  261 => "Main02-01",
  262 => "Main02-02",
  263 => "Main02-03",
  264 => "Main02-04",
  265 => "Main02-05",
  266 => "Main02-06",
  267 => "Main02-07",
  268 => "Main02-08",
  269 => "Main02-09",
  270 => "Main02-10",
  271 => "Main03-01",
  272 => "Main03-02",
  273 => "Main03-03",
  274 => "Main03-04",
  275 => "Main03-05",
  276 => "Main03-06",
  277 => "Main03-07",
  278 => "Main03-08",
  279 => "Main03-09",
  280 => "Main03-10",
  281 => "Main04-01",
  282 => "Main04-02",
  283 => "Main04-03",
  284 => "Main04-04",
  285 => "Main04-05",
  286 => "Main04-06",
  287 => "Main04-07",
  288 => "Main04-08",
  289 => "Main04-09",
  290 => "Main04-10",
  291 => "Main05-01",
  292 => "Main05-02",
  293 => "Main05-03",
  294 => "Main05-04",
  295 => "Main05-05",
  296 => "Main05-06",
  297 => "Main05-07",
  298 => "Main05-08",
  299 => "Main05-09",
  300 => "Main05-10",
  301 => "Main06-01",
  302 => "Main06-02",
  303 => "Main06-03",
  304 => "Main06-04",
  305 => "Main06-05",
  306 => "Main06-06",
  307 => "Main06-07",
  308 => "Main06-08",
  309 => "Main06-09",
  310 => "Main06-10",
  311 => "Main07-01",
  312 => "Main07-02",
  313 => "Main07-03",
  314 => "Main07-04",
  315 => "Main07-05",
  316 => "Main07-06",
  317 => "Main07-07",
  318 => "Main07-08",
  319 => "Main07-09",
  320 => "Main07-10",
  321 => "Main08-01",
  322 => "Main08-02",
  323 => "Main08-03",
  324 => "Main08-04",
  325 => "Main08-05",
  326 => "Main08-06",
  327 => "Main08-07",
  328 => "Main08-08",
  329 => "Main08-09",
  330 => "Main08-10",
  331 => "Main09-01",
  332 => "Main09-02",
  333 => "Main09-03",
  334 => "Main09-04",
  335 => "Main09-05",
  336 => "Main09-06",
  337 => "Main09-07",
  338 => "Main09-08",
  339 => "Main09-09",
  340 => "Main09-10",
  341 => "Main10-01",
  342 => "Main10-02",
  343 => "Main10-03",
  344 => "Main10-04",
  345 => "Main10-05",
  346 => "Main10-06",
  347 => "Main10-07",
  348 => "Main10-08",
  349 => "Main10-09",
  350 => "Main10-10",
  351 => "CursorFront-01",
  352 => "CursorFront-02",
  353 => "CursorFront-03",
  354 => "CursorFront-04",
  355 => "CursorFront-05",
  356 => "CursorFront-06",
  357 => "CursorFront-07",
  358 => "CursorFront-08",
  359 => "CursorFront-09",
  360 => "CursorFront-10",
 2000 => "Bank01",
 2001 => "Bank02",
 2002 => "Bank03",
 2003 => "Bank04",
 2004 => "Bank05",
 2005 => "Bank06",
 2006 => "Bank07",
 2007 => "Bank08",
 2008 => "Bank09",
 2009 => "Bank10",
 2010 => "Bank11",
 2011 => "Bank12",
 2012 => "Bank13",
 2013 => "Bank14",
 2014 => "Bank15",
 2015 => "Bank16",
 2016 => "Bank17",
 2017 => "Bank18",
 2018 => "Bank19",
 2019 => "Bank20",
 2020 => "Bank21",
 2021 => "Bank22",
 2022 => "Bank23",
 2023 => "Bank24",
 2031 => "Bank01-01",
 2032 => "Bank01-02",
 2033 => "Bank01-03",
 2034 => "Bank01-04",
 2035 => "Bank01-05",
 2036 => "Bank01-06",
 2037 => "Bank01-07",
 2038 => "Bank01-08",
 2039 => "Bank01-09",
 2040 => "Bank01-10",
 2041 => "Bank02-01",
 2042 => "Bank02-02",
 2043 => "Bank02-03",
 2044 => "Bank02-04",
 2045 => "Bank02-05",
 2046 => "Bank02-06",
 2047 => "Bank02-07",
 2048 => "Bank02-08",
 2049 => "Bank02-09",
 2050 => "Bank02-10",
 2051 => "Bank03-01",
 2052 => "Bank03-02",
 2053 => "Bank03-03",
 2054 => "Bank03-04",
 2055 => "Bank03-05",
 2056 => "Bank03-06",
 2057 => "Bank03-07",
 2058 => "Bank03-08",
 2059 => "Bank03-09",
 2060 => "Bank03-10",
 2061 => "Bank04-01",
 2062 => "Bank04-02",
 2063 => "Bank04-03",
 2064 => "Bank04-04",
 2065 => "Bank04-05",
 2066 => "Bank04-06",
 2067 => "Bank04-07",
 2068 => "Bank04-08",
 2069 => "Bank04-09",
 2070 => "Bank04-10",
 2071 => "Bank05-01",
 2072 => "Bank05-02",
 2073 => "Bank05-03",
 2074 => "Bank05-04",
 2075 => "Bank05-05",
 2076 => "Bank05-06",
 2077 => "Bank05-07",
 2078 => "Bank05-08",
 2079 => "Bank05-09",
 2080 => "Bank05-10",
 2081 => "Bank06-01",
 2082 => "Bank06-02",
 2083 => "Bank06-03",
 2084 => "Bank06-04",
 2085 => "Bank06-05",
 2086 => "Bank06-06",
 2087 => "Bank06-07",
 2088 => "Bank06-08",
 2089 => "Bank06-09",
 2090 => "Bank06-10",
 2091 => "Bank07-01",
 2092 => "Bank07-02",
 2093 => "Bank07-03",
 2094 => "Bank07-04",
 2095 => "Bank07-05",
 2096 => "Bank07-06",
 2097 => "Bank07-07",
 2098 => "Bank07-08",
 2099 => "Bank07-09",
 2100 => "Bank07-10",
 2101 => "Bank08-01",
 2102 => "Bank08-02",
 2103 => "Bank08-03",
 2104 => "Bank08-04",
 2105 => "Bank08-05",
 2106 => "Bank08-06",
 2107 => "Bank08-07",
 2108 => "Bank08-08",
 2109 => "Bank08-09",
 2110 => "Bank08-10",
 2111 => "Bank09-01",
 2112 => "Bank09-02",
 2113 => "Bank09-03",
 2114 => "Bank09-04",
 2115 => "Bank09-05",
 2116 => "Bank09-06",
 2117 => "Bank09-07",
 2118 => "Bank09-08",
 2119 => "Bank09-09",
 2120 => "Bank09-10",
 2121 => "Bank10-01",
 2122 => "Bank10-02",
 2123 => "Bank10-03",
 2124 => "Bank10-04",
 2125 => "Bank10-05",
 2126 => "Bank10-06",
 2127 => "Bank10-07",
 2128 => "Bank10-08",
 2129 => "Bank10-09",
 2130 => "Bank10-10",
 2131 => "Bank11-01",
 2132 => "Bank11-02",
 2133 => "Bank11-03",
 2134 => "Bank11-04",
 2135 => "Bank11-05",
 2136 => "Bank11-06",
 2137 => "Bank11-07",
 2138 => "Bank11-08",
 2139 => "Bank11-09",
 2140 => "Bank11-10",
 2141 => "Bank12-01",
 2142 => "Bank12-02",
 2143 => "Bank12-03",
 2144 => "Bank12-04",
 2145 => "Bank12-05",
 2146 => "Bank12-06",
 2147 => "Bank12-07",
 2148 => "Bank12-08",
 2149 => "Bank12-09",
 2150 => "Bank12-10",
 2151 => "Bank13-01",
 2152 => "Bank13-02",
 2153 => "Bank13-03",
 2154 => "Bank13-04",
 2155 => "Bank13-05",
 2156 => "Bank13-06",
 2157 => "Bank13-07",
 2158 => "Bank13-08",
 2159 => "Bank13-09",
 2160 => "Bank13-10",
 2161 => "Bank14-01",
 2162 => "Bank14-02",
 2163 => "Bank14-03",
 2164 => "Bank14-04",
 2165 => "Bank14-05",
 2166 => "Bank14-06",
 2167 => "Bank14-07",
 2168 => "Bank14-08",
 2169 => "Bank14-09",
 2170 => "Bank14-10",
 2171 => "Bank15-01",
 2172 => "Bank15-02",
 2173 => "Bank15-03",
 2174 => "Bank15-04",
 2175 => "Bank15-05",
 2176 => "Bank15-06",
 2177 => "Bank15-07",
 2178 => "Bank15-08",
 2179 => "Bank15-09",
 2180 => "Bank15-10",
 2181 => "Bank16-01",
 2182 => "Bank16-02",
 2183 => "Bank16-03",
 2184 => "Bank16-04",
 2185 => "Bank16-05",
 2186 => "Bank16-06",
 2187 => "Bank16-07",
 2188 => "Bank16-08",
 2189 => "Bank16-09",
 2190 => "Bank16-10",
 2191 => "Bank17-01",
 2192 => "Bank17-02",
 2193 => "Bank17-03",
 2194 => "Bank17-04",
 2195 => "Bank17-05",
 2196 => "Bank17-06",
 2197 => "Bank17-07",
 2198 => "Bank17-08",
 2199 => "Bank17-09",
 2200 => "Bank17-10",
 2201 => "Bank18-01",
 2202 => "Bank18-02",
 2203 => "Bank18-03",
 2204 => "Bank18-04",
 2205 => "Bank18-05",
 2206 => "Bank18-06",
 2207 => "Bank18-07",
 2208 => "Bank18-08",
 2209 => "Bank18-09",
 2210 => "Bank18-10",
 2211 => "Bank19-01",
 2212 => "Bank19-02",
 2213 => "Bank19-03",
 2214 => "Bank19-04",
 2215 => "Bank19-05",
 2216 => "Bank19-06",
 2217 => "Bank19-07",
 2218 => "Bank19-08",
 2219 => "Bank19-09",
 2220 => "Bank19-10",
 2221 => "Bank20-01",
 2222 => "Bank20-02",
 2223 => "Bank20-03",
 2224 => "Bank20-04",
 2225 => "Bank20-05",
 2226 => "Bank20-06",
 2227 => "Bank20-07",
 2228 => "Bank20-08",
 2229 => "Bank20-09",
 2230 => "Bank20-10",
 2231 => "Bank21-01",
 2232 => "Bank21-02",
 2233 => "Bank21-03",
 2234 => "Bank21-04",
 2235 => "Bank21-05",
 2236 => "Bank21-06",
 2237 => "Bank21-07",
 2238 => "Bank21-08",
 2239 => "Bank21-09",
 2240 => "Bank21-10",
 2241 => "Bank22-01",
 2242 => "Bank22-02",
 2243 => "Bank22-03",
 2244 => "Bank22-04",
 2245 => "Bank22-05",
 2246 => "Bank22-06",
 2247 => "Bank22-07",
 2248 => "Bank22-08",
 2249 => "Bank22-09",
 2250 => "Bank22-10",
 2251 => "Bank23-01",
 2252 => "Bank23-02",
 2253 => "Bank23-03",
 2254 => "Bank23-04",
 2255 => "Bank23-05",
 2256 => "Bank23-06",
 2257 => "Bank23-07",
 2258 => "Bank23-08",
 2259 => "Bank23-09",
 2260 => "Bank23-10",
 2261 => "Bank24-01",
 2262 => "Bank24-02",
 2263 => "Bank24-03",
 2264 => "Bank24-04",
 2265 => "Bank24-05",
 2266 => "Bank24-06",
 2267 => "Bank24-07",
 2268 => "Bank24-08",
 2269 => "Bank24-09",
 2270 => "Bank24-10",
 2500 => "SharedBank01",
 2501 => "SharedBank02",
 2531 => "SharedBank01-01",
 2532 => "SharedBank01-02",
 2533 => "SharedBank01-03",
 2534 => "SharedBank01-04",
 2535 => "SharedBank01-05",
 2536 => "SharedBank01-06",
 2537 => "SharedBank01-07",
 2538 => "SharedBank01-08",
 2539 => "SharedBank01-09",
 2540 => "SharedBank01-10",
 2541 => "SharedBank02-01",
 2542 => "SharedBank02-02",
 2543 => "SharedBank02-03",
 2544 => "SharedBank02-04",
 2545 => "SharedBank02-05",
 2546 => "SharedBank02-06",
 2547 => "SharedBank02-07",
 2548 => "SharedBank02-08",
 2549 => "SharedBank02-09",
 2550 => "SharedBank02-10",
 8001 => "CursorStack01",
 8002 => "CursorStack02",
 8003 => "CursorStack03",
 8004 => "CursorStack04",
 8005 => "CursorStack05",
 8006 => "CursorStack06",
 8007 => "CursorStack07",
 8008 => "CursorStack08",
 8009 => "CursorStack09",
 8010 => "CursorStack10",
 8011 => "CursorStack11",
 8012 => "CursorStack12",
 8013 => "CursorStack13",
 8014 => "CursorStack14",
 8015 => "CursorStack15",
 8016 => "CursorStack16",
 8017 => "CursorStack17",
 8018 => "CursorStack18",
 8019 => "CursorStack19",
 8020 => "CursorStack20",
 8021 => "CursorStack21",
 8022 => "CursorStack22",
 8023 => "CursorStack23",
 8024 => "CursorStack24",
 8025 => "CursorStack25",
 8026 => "CursorStack26",
 8027 => "CursorStack27",
 8028 => "CursorStack28",
 8029 => "CursorStack29",
 8030 => "CursorStack30",
 8031 => "CursorStack31",
 8032 => "CursorStack32",
 8033 => "CursorStack33",
 8034 => "CursorStack34",
 8035 => "CursorStack35",
 8036 => "CursorStack36"
);
//NOTE: Client buffer limits CursorStack to 36, but database can (and will) go
//      much higher. Client will desync/disconnect after bagging cursored items
//      if database shows higher amount than buffer max.

switch ($action) {
  case 0:
    check_admin_authorization();
    if (isset($_GET['playerid']) && ($_GET['playerid'] > 0)) {
      $playerid = $_GET['playerid'];
      header("Location: index.php?editor=inv&playerid=$playerid&action=1");
      exit;
    }
    else {
      $body = new Template("templates/inventory/inventory.default.tmpl.php");
    }
    break;
  case 1:  //View Player Inventory
    check_admin_authorization();
    if (isset($_GET['playerid']) && ($_GET['playerid'] > 0)) {
      $inventory = player_inventory($_GET['playerid']);
      $shared_inventory = shared_inventory($_GET['playerid']);
    }
    $body = new Template("templates/inventory/inventory.player.tmpl.php");
    $body->set("playerid", $_GET['playerid']);
    $body->set("slots", $slots);
    if ($inventory)
      $body->set("inventory", $inventory);
    if ($shared_inventory)
      $body->set("shared_inventory", $shared_inventory);
    break;
  case 2: //Search by Player ID or Player Name
    check_admin_authorization();
    $search_results = "";
    if (isset($_GET['playerid']) && ($_GET['playerid'] != "") && ($_GET['playerid'] != "Player ID")) {
      $search_results = search_by_playerid($_GET['playerid']);
    }
    elseif (isset($_GET['player_name']) && ($_GET['player_name'] != "") && ($_GET['player_name'] != "Player Name")) {
      $search_results = search_by_playername($_GET['player_name'], $list_limit);
    }
    $body = new Template("templates/inventory/inventory.searchresults.tmpl.php");
    $body->set('search_results', $search_results);
    $body->set("list_limit", $list_limit);
    break;
  case 3: //Search by Item ID
    check_admin_authorization();
    $search_results = "";
    if (isset($_GET['item_id']) && ($_GET['item_id'] != "") && ($_GET['item_id'] != "Item ID")) {
      $search_results = search_by_itemid($_GET['item_id'], $list_limit);
    }
    $body = new Template("templates/inventory/inventory.searchresults.tmpl.php");
    $body->set("search_results", $search_results);
    $body->set("item_id", $_GET['item_id']);
    $body->set("list_limit", $list_limit);
    break;
  case 4: //Add item to inventory
    check_admin_authorization();
    $playerid = $_GET['playerid'];
    $body = new Template("templates/inventory/inventory.add.tmpl.php");
    $body->set("playerid", $playerid);
    break;
  case 5: //Insert item into inventory
    check_admin_authorization();
    $playerid = $_POST['charid'];
    insert_inv_item();
    header("Location: index.php?editor=inv&playerid=$playerid&action=1");
    exit;
  case 6: //Edit item in inventory
    check_admin_authorization();
    $inv_item = inv_slot_details($_GET['playerid'], $_GET['slotid']);
    $body = new Template("templates/inventory/inventory.edit.tmpl.php");
    $body->set("inv_item", $inv_item);
    $body->set("slots", $slots);
    break;
  case 7: //Update item in inventory
    check_admin_authorization();
    $playerid = $_POST['charid'];
    update_inv_item();
    header("Location: index.php?editor=inv&playerid=$playerid&action=1");
    exit;
  case 8: //Delete item from inventory
    check_admin_authorization();
    $playerid = $_GET['playerid'];
    delete_inv_item($playerid, $_GET['slotid']);
    header("Location: index.php?editor=inv&playerid=$playerid&action=1");
    exit;
}

function player_inventory($player_id) {
  global $mysql;

  $query = "SELECT charid, slotid, itemid FROM inventory WHERE charid=$player_id ORDER BY slotid";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function shared_inventory($player_id) {
  global $mysql;

  $query = "SELECT account_id FROM character_data WHERE id=$player_id";
  $result = $mysql->query_assoc($query);
  $acctid = $result['account_id'];

  $query = "SELECT acctid, slotid, itemid FROM sharedbank WHERE acctid=$acctid ORDER BY slotid";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function inv_slot_details($player_id, $slot_id) {
  global $mysql;

  $query = "SELECT * FROM inventory WHERE charid=$player_id AND slotid=$slot_id";
  $results = $mysql->query_assoc($query);

  return $results;
}

function search_by_playerid($player_id) {
  global $mysql;

  $query = "SELECT DISTINCT(charid) AS charid FROM inventory WHERE charid=$player_id";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function search_by_playername($player_name, $list_limit) {
  global $mysql;

  $query = "SELECT id AS charid FROM character_data WHERE `name` RLIKE \"$player_name\" LIMIT $list_limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function search_by_itemid($item_id, $list_limit) {
  global $mysql;

  $query = "SELECT DISTINCT(charid) AS charid FROM inventory WHERE itemid=$item_id LIMIT $list_limit";
  $results = $mysql->query_mult_assoc($query);

  return $results;
}

function delete_inv_item($player_id, $slot_id) {
  global $mysql;

  $query = "DELETE FROM inventory WHERE charid=$player_id AND slotid=$slot_id";
  $mysql->query_no_result($query);
}

function update_inv_item() {
  global $mysql;

  $charid = $_POST['charid'];
  $slotid = $_POST['slotid'];
  $itemid = $_POST['itemid'];
  $charges = $_POST['charges'];
  $color = $_POST['color'];
  $augslot1 = $_POST['augslot1'];
  $augslot2 = $_POST['augslot2'];
  $augslot3 = $_POST['augslot3'];
  $augslot4 = $_POST['augslot4'];
  $augslot5 = $_POST['augslot5'];
  $instnodrop = ($_POST['instnodrop'] == 'on') ? 1 : 0;
  $custom_data = $_POST['custom_data'];

  $query = "UPDATE inventory SET itemid=$itemid, charges=$charges, color=$color, augslot1=$augslot1, augslot2=$augslot2, augslot3=$augslot3, augslot4=$augslot4, augslot5=$augslot5, instnodrop=$instnodrop, custom_data=\"$custom_data\" WHERE charid=$charid AND slotid=$slotid";
  $mysql->query_no_result($query);
}

function insert_inv_item() {
  global $mysql;

  $charid = $_POST['charid'];
  $slotid = $_POST['slotid'];
  $itemid = $_POST['itemid'];
  $charges = $_POST['charges'];
  $color = $_POST['color'];
  $augslot1 = $_POST['augslot1'];
  $augslot2 = $_POST['augslot2'];
  $augslot3 = $_POST['augslot3'];
  $augslot4 = $_POST['augslot4'];
  $augslot5 = $_POST['augslot5'];
  $instnodrop = ($_POST['instnodrop'] == 'on') ? 1 : 0;
  $custom_data = $_POST['custom_data'];

  $query = "INSERT INTO inventory SET charid=$charid, slotid=$slotid, itemid=$itemid, charges=$charges, color=$color, augslot1=$augslot1, augslot2=$augslot2, augslot3=$augslot3, augslot4=$augslot4, augslot5=$augslot5, instnodrop=$instnodrop, custom_data=\"$custom_data\"";
  $mysql->query_no_result($query);
}
?>