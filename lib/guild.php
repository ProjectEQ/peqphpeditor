<?
switch ($action) {
  case 0: // View Guild Info
    check_admin_authorization();
    if ($guildid) {
      $body = new Template("templates/guild/guild.tmpl.php");
      $javascript = new Template("templates/guild/js.tmpl.php");
      $body->set('guildid', $guildid);
      $body->set('yesno', $yesno);
      $body->set('guildname', getGuildName($guildid));
      $body->set('permissions', $permissions);
      $vars = guild_info();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
    }
    else {
      $body = new Template("templates/guild/guild.default.tmpl.php");
    }
    break;
  case 1: // Edit Guild Info
    check_admin_authorization();
    $body = new Template("templates/guild/guild.edit.tmpl.php");
      $body->set('guildid', $guildid);
      $body->set('yesno', $yesno);
      $body->set('guildname', getGuildName($guildid));
      $vars = guild_info();
    if ($vars) {
      foreach ($vars as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 2: // Search Guilds
    check_admin_authorization();
    $body = new Template("templates/guild/guild.searchresults.byguild.tmpl.php");
    if (isset($_GET['guild_id']) && $_GET['guild_id'] != "Guild ID") {
      $results = search_guilds_by_id();
    }
    elseif (isset($_GET['search']) && $_GET['search'] != "Guild Name" && $_GET['search'] != '') {
      $results = search_guilds();
    }
    else {
      $results = '';
    }
    $body->set("results", $results);
    break;
  case 3: //Search Guilds by Character
    check_admin_authorization();
    $body = new Template("templates/guild/guild.searchresults.bychar.tmpl.php");
    if (isset($_GET['charid']) && $_GET['charid'] != "Char ID") {
      $results = search_guilds_by_charid();
    }
    elseif (isset($_GET['charname']) && $_GET['charname'] != "Character Name" && $_GET['charname'] != '') {
      $results = search_guilds_by_charname();
    }
    else {
      $results = '';
    }
    $body->set("results", $results);
    break;
  case 4: // Update Guild Info
    check_admin_authorization();
    update_guild();
    header("Location: index.php?editor=guild&guildid=$guildid");
    exit;
  case 5: // Delete Guild
    check_admin_authorization();
    delete_guild();
    header("Location: index.php?editor=guild");
    exit;
  case 6: // Select New Guild Member
    check_admin_authorization();
    $body = new Template("templates/guild/guild.add.member.tmpl.php");
    $javascript = new Template("templates/guild/js.tmpl.php");
    $breadcrumbs .= " >> Assign Guild Member";
    $body->set('guildid', $guildid);
    break;
  case 7: // Assign New Guild Member
    check_admin_authorization();
    assign_guild_member($_POST['player']);
    header("Location: index.php?editor=guild&guildid=$guildid");
    exit;
  case 8: // Remove Guild Member
    check_admin_authorization();
    remove_guild_member($_GET['char_id']);
    header("Location: index.php?editor=guild&guildid=$guildid");
    exit;
  case 9: // Set Member Rank
    check_admin_authorization();
    set_member_rank();
    header("Location: index.php?editor=guild&guildid=$guildid");
    exit;
}

function guild_info() {
  global $mysql, $guildid;
  $guild_array = array();
  $guild_ranks_array = array();
  $guild_members_array = array();
  $guild_bank_array = array();
  $guild_relations_array = array();

  //Load Guild Info
  $query = "SELECT * FROM guilds WHERE id = $guildid";
  $guild_array = $mysql->query_assoc($query);

  //Load Guild Ranks
  $query = "SELECT * FROM guild_ranks WHERE guild_id = $guildid";
  $guild_ranks_array = $mysql->query_mult_assoc($query);
  $guild_array['guild_ranks'] = $guild_ranks_array;

  //Load Guild Members
  $query = "SELECT * FROM guild_members WHERE guild_id = $guildid ORDER BY rank DESC";
  $guild_members_array = $mysql->query_mult_assoc($query);
  $guild_array['guild_members'] = $guild_members_array;

  //Load Guild Bank
  $query = "SELECT area, slot, itemid, qty, donator, permissions, whofor FROM guild_bank WHERE guildid=$guildid ORDER BY area, slot";
  $guild_bank_array = $mysql->query_mult_assoc($query);
  $guild_array['guild_items'] = $guild_bank_array;

  //Load Guild Relations
  $query = "SELECT * FROM guild_relations WHERE guild1 = $guildid OR guild2 = $guildid";
  $guild_relations_array = $mysql->query_mult_assoc($query);
  $guild_array['guild_relations'] = $guild_relations_array;

  return $guild_array;
}

function update_guild() {
  global $mysql, $playerid;
  //Update guild info here
}

function delete_guild() {
  global $mysql, $playerid;
  //Delete guild info here
}

function assign_guild_member($char_id) {
  global $mysql, $guildid;

  $query = "REPLACE INTO guild_members SET char_id=$char_id, guild_id=$guildid, rank=0, public_note=''";
  $mysql->query_no_result($query);
}

function remove_guild_member($char_id) {
  global $mysql, $guildid;

  if ($_GET['leader'] == 1) {
    $query = "UPDATE guilds SET leader=0 WHERE id=$guildid";
    $mysql->query_no_result($query);
  }

  $query = "DELETE FROM guild_members WHERE guild_id=$guildid AND char_id=$char_id";
  $mysql->query_no_result($query);
}

function set_member_rank() {
  global $mysql, $guildid;

  $char_id = $_POST['char_id'];
  $rank = $_POST['rank'];
  $previous_rank = $_POST['previous_rank'];

  if ($rank == 2) { // Change guild leadership
    $query = "UPDATE guild_members SET rank=0 WHERE guild_id=$guildid AND rank=2";
    $mysql->query_no_result($query);

    $query = "UPDATE guilds SET leader=$char_id WHERE id=$guildid";
    $mysql->query_no_result($query);
  }

  if ($previous_rank == 2) { // Drop guild leadership
    $query = "UPDATE guilds SET leader=0 WHERE id=$guildid";
    $mysql->query_no_result($query);
  }

  $query = "UPDATE guild_members SET rank=$rank WHERE guild_id=$guildid AND char_id=$char_id";
  $mysql->query_no_result($query);
}
?>