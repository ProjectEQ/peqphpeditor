<?php

switch ($action) {
  case 0:  // View Player Profile
    check_admin_authorization();
    if ($playerid) {
      $body = new Template("templates/player/player.tmpl.php");
      $body->set('playerid', $playerid);
      $body->set('classes', $classes);
      $body->set('genders', $genders);
      $body->set('bodytypes', $bodytypes);
      $body->set('races', $races);
      $body->set('yesno', $yesno);
      $body->set('skilltypes', $skilltypes);
      $body->set('player_name', getPlayerName($playerid));
      $body->set('deities', $deities);
      $body->set('anonymity', $anonymity);
      $vars = player_info();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
    }
    else {
      $body = new Template("templates/player/player.default.tmpl.php");
    }
    break;
  case 1: // Edit Player Profile
    check_admin_authorization();
    $body = new Template("templates/player/player.edit.tmpl.php");
    $body->set('playerid', $playerid);
    $body->set('classes', $classes);
    $body->set('genders', $genders);
    $body->set('bodytypes', $bodytypes);
    $body->set('races', $races);
    $body->set('yesno', $yesno);
    $body->set('skilltypes', $skilltypes);
    $body->set('player_name', getPlayerName($playerid));
    $vars = player_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2:  // Search Players
    check_admin_authorization();
    $body = new Template("templates/player/player.searchresults.tmpl.php");
    if (isset($_GET['playerid']) && $_GET['playerid'] != "ID") {
      $results = search_players_by_id();
    }
    else {
      $results = search_players();
    }
    $body->set("results", $results);
    break;
  case 3: // Update Player Profile
    check_admin_authorization();
    update_player();
    header("Location: index.php?editor=player&playerid=$playerid");
    exit;
}

function player_info () {
  global $mysql, $playerid;
  $player_array = array();

  //Load from character_
  $query = "SELECT id,account_id,timelaston,x,y,z,zonename,groupid,lfp,lfg FROM character_ WHERE id=$playerid";
  $player_array = $mysql->query_assoc($query);
  $query = "SELECT profile FROM character_ WHERE id=$playerid";
  $result = $mysql->query_assoc($query);
  $profile = substr(serialize($result),28);

  //Convert from unix time to real time
  $player_array['timelaston'] = get_real_time($player_array['timelaston']);

  //Load account details
  $accountid = $player_array['account_id'];
  $query = "SELECT name, lsaccount_id, status FROM account WHERE id = $accountid";
  $result = $mysql->query_assoc($query);
  $player_array['lsname'] = $result['name'];
  $player_array['lsaccount'] = $result['lsaccount_id'];
  $player_array['status'] = $result['status'];

  //Set player profile variables
  $player_array['name'] = substr($profile,4,64);
  $player_array['last_name'] = substr($profile,68,32);
  $player_array['gender'] = ord(substr($profile,100,4));
  $player_array['race'] = ord(substr($profile,104,4));
  $player_array['class'] = ord(substr($profile,108,4));
  $player_array['level'] = ord(substr($profile,116,4));
  $player_array['deity'] = ord(substr($profile,220,4));
  $player_array['guildid'] = ord(substr($profile,224,4));
  $player_array['birthday'] = ord(substr($profile,228,4)); //Time not system time. Maybe minutes from server start?
  $player_array['lastzone'] = ord(substr($profile,232,4)); //Time not system time. Maybe minutes from server start?
  $player_array['timeplayed'] = ord(substr($profile,236,4));
  $player_array['pvp'] = ord(substr($profile,240,1));
  $player_array['anon'] = ord(substr($profile,242,1));
  $player_array['gm'] = ord(substr($profile,243,1));
  $player_array['guildrank'] = ord(substr($profile,244,1));
  $player_array['guildbanker'] = ord(substr($profile,245,1));
  $player_array['drunk'] = ord(substr($profile,252,4)); //This and toxicity not right
  $player_array['haircolor'] = ord(substr($profile,296,1));
  $player_array['beardcolor'] = ord(substr($profile,297,1));
  $player_array['lefteye'] = ord(substr($profile,298,1));
  $player_array['righteye'] = ord(substr($profile,299,1));
  $player_array['hairstyle'] = ord(substr($profile,300,1));
  $player_array['beard'] = ord(substr($profile,301,1));
  $player_array['title'] = substr($profile,2384,32);
  $player_array['suffix'] = substr($profile,2416,32);
  $player_array['exp'] = ord(substr($profile,2452,4)); //0-?
  $player_array['practice'] = ord(substr($profile,2460,4));
  $player_array['mana'] = ord(substr($profile,2464,4));
  $player_array['hp'] = ord(substr($profile,2468,4)); //Something's not right with this
  $player_array['STR'] = ord(substr($profile,2476,4));
  $player_array['STA'] = ord(substr($profile,2480,4));
  $player_array['CHA'] = ord(substr($profile,2484,4));
  $player_array['DEX'] = ord(substr($profile,2488,4));
  $player_array['_INT'] = ord(substr($profile,2492,4));
  $player_array['AGI'] = ord(substr($profile,2496,4));
  $player_array['WIS'] = ord(substr($profile,2500,4));
  $player_array['face'] = ord(substr($profile,2504,1));
  //$player_array['y'] = ord(substr($profile,4700,4)); //Still need to figure out floats
  //$player_array['x'] = ord(substr($profile,4704,4)); //Still need to figure out floats
  //$player_array['z'] = ord(substr($profile,4708,4)); //Still need to figure out floats
  //$player_array['heading'] = ord(substr($profile,4712,4)); //Still need to figure out floats
  $player_array['platinum'] = ord(substr($profile,4720,4));
  $player_array['gold'] = ord(substr($profile,4724,4));
  $player_array['silver'] = ord(substr($profile,4728,4));
  $player_array['copper'] = ord(substr($profile,4732,4));
  $player_array['platinum_bank'] = ord(substr($profile,4736,4));
  $player_array['gold_bank'] = ord(substr($profile,4740,4));
  $player_array['silver_bank'] = ord(substr($profile,4744,4));
  $player_array['copper_bank'] = ord(substr($profile,4748,4));
  $player_array['platinum_hand'] = ord(substr($profile,4752,4));
  $player_array['gold_hand'] = ord(substr($profile,4756,4));
  $player_array['silver_hand'] = ord(substr($profile,4760,4));
  $player_array['copper_hand'] = ord(substr($profile,4764,4));
  $player_array['platinum_shared'] = ord(substr($profile,4768,4));
  $player_array['pvp2'] = ord(substr($profile,5380,4)); //What is this?
  $player_array['pvptype'] = ord(substr($profile,5388,4));
  $player_array['drakkin_heritage'] = ord(substr($profile,5440,4));
  $player_array['drakkin_tattoo'] = ord(substr($profile,5444,4));
  $player_array['drakkin_details'] = ord(substr($profile,5448,4));
  $player_array['toxicity'] = ord(substr($profile,5456,4)); //This and drunkness not right
  $player_array['hunger'] = ord(substr($profile,5476,4));
  $player_array['thirst'] = ord(substr($profile,5480,4));
  $player_array['zone_id'] = ord(substr($profile,5504,2));
  $player_array['instanceid'] = ord(substr($profile,5506,2));
  $player_array['entityid'] = ord(substr($profile,7048,4));
  $player_array['leader_aa_active'] = ord(substr($profile,7052,4));
  $player_array['guk_points'] = ord(substr($profile,7060,4));
  $player_array['mir_points'] = ord(substr($profile,7064,4));
  $player_array['mmc_points'] = ord(substr($profile,7068,4));
  $player_array['ruj_points'] = ord(substr($profile,7072,4));
  $player_array['tak_points'] = ord(substr($profile,7076,4));
  $player_array['avail_points'] = ord(substr($profile,7080,4));
  $player_array['guk_wins'] = ord(substr($profile,7084,4));
  $player_array['mir_wins'] = ord(substr($profile,7088,4));
  $player_array['mmc_wins'] = ord(substr($profile,7092,4));
  $player_array['ruj_wins'] = ord(substr($profile,7096,4));
  $player_array['tak_wins'] = ord(substr($profile,7100,4));
  $player_array['guk_losses'] = ord(substr($profile,7104,4));
  $player_array['mir_losses'] = ord(substr($profile,7108,4));
  $player_array['mmc_losses'] = ord(substr($profile,7112,4));
  $player_array['ruj_losses'] = ord(substr($profile,7116,4));
  $player_array['tak_losses'] = ord(substr($profile,7120,4));
  $player_array['tribute_timer'] = ord(substr($profile,7196,4)); //Milliseconds? 255 if off?
  $player_array['tribute_total'] = ord(substr($profile,7204,4));
  $player_array['tribute_points'] = ord(substr($profile,7212,4));
  $player_array['tribute_active'] = ord(substr($profile,7220,4));
  $player_array['endurance'] = ord(substr($profile,7904,4));
  $player_array['group_exp'] = ord(substr($profile,7908,4)); //0-1000?
  $player_array['raid_exp'] = ord(substr($profile,7912,4)); //0-2000?
  $player_array['group_points'] = ord(substr($profile,7916,4));
  $player_array['raid_points'] = ord(substr($profile,7920,4));
  $player_array['air'] = ord(substr($profile,8184,4));
  $player_array['pvp_kills'] = ord(substr($profile,8188,4));
  $player_array['pvp_deaths'] = ord(substr($profile,8192,4));
  $player_array['pvp_points'] = ord(substr($profile,8196,4));
  $player_array['pvp_total'] = ord(substr($profile,8200,4));
  $player_array['pvp_killstreak_max'] = ord(substr($profile,8204,4));
  $player_array['pvp_deathstreak_max'] = ord(substr($profile,8208,4));
  $player_array['pvp_killstreak_now'] = ord(substr($profile,8212,4));
  $player_array['pvp_kills_today'] = ord(substr($profile,8392,4));
  $player_array['aa_spent'] = ord(substr($profile,12796,4));
  $player_array['aa_exp'] = ord(substr($profile,12800,4));
  $player_array['aa_points'] = ord(substr($profile,12804,4));
  $player_array['radiant_crystals'] = ord(substr($profile,19540,4));
  $player_array['radiant_total'] = ord(substr($profile,19544,4));
  $player_array['ebon_crystals'] = ord(substr($profile,19548,4));
  $player_array['ebon_total'] = ord(substr($profile,19552,4));
  $player_array['group_consent'] = ord(substr($profile,19556,1));
  $player_array['raid_consent'] = ord(substr($profile,19557,1));
  $player_array['guild_consent'] = ord(substr($profile,19558,1));

  return $player_array;
}

function update_player () {
  check_authorization();
  global $mysql, $playerid;

  $oldstats = player_info();
  extract($oldstats);

  $fields = '';
//Set fields here
  $fields =  rtrim($fields, ", ");

  if ($fields != '') {
    $query = "UPDATE character_ SET $fields WHERE id=$playerid";
    $mysql->query_no_result($query);
  }
}

function delete_player() {
  check_authorization();
  global $mysql, $playerid;
//Delete globals, etc.
  $query = "DELETE FROM character_ WHERE id=$playerid";
  $mysql->query_no_result($query);
}

function get_real_time ($unix_time) {
  global $mysql;

  $query = "SELECT FROM_UNIXTIME($unix_time) AS real_time";
  $result = $mysql->query_assoc($query);

  return($result['real_time']);
}

?>