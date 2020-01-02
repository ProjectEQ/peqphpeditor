<?
$aa_category = array (
 -1 => "None",
  1 => "Passive",
  2 => "Progression",
  3 => "Shroud Passive",
  4 => "Shroud Active",
  5 => "Veteran Reward",
  6 => "Tradeskill",
  7 => "Expendable",
  8 => "Racial Innate",
  9 => "Everquest"
);

$aa_type = array (
  0  =>  "Not Applicable",
  1  =>  "General",
  2  =>  "Archetype",
  3  =>  "Class",
  4  =>  "PoP Advanced",
  5  =>  "PoP Abilities",
  6  =>  "Gates of Discord",
  7  =>  "Omens of War",
  8  =>  "Veteran",
  9  =>  "Dragons of Norrath",
 10  =>  "Depths of Darkhollow"
);

switch ($action) {
  case 0: //View AA
    if (isset($_GET['aaid']) && $_GET['aaid'] >= 0) {
      $body = new Template("templates/aa/aa.tmpl.php");
      $javascript = new Template("templates/aa/js.tmpl.php");
      $aa_info = aa_info();
      $body->set('yesno', $yesno);
      $body->set('eqexpansions', $eqexpansions);
      $body->set('sp_effects', $sp_effects);
      $body->set('sp_spelltypes', $sp_spelltypes); //This is still wrong
      $body->set('aa_type', $aa_type);
      $body->set('aa_category', $aa_category);
      $body->set('aas', $aas);
      if ($aa_info) {
        foreach ($aa_info as $key => $value) {
          $body->set($key, $value);
        }
      }
    }
    else {
      $body = new Template("templates/aa/aa.default.tmpl.php");
    }
    break;
  case 1: //Search AAs by ID or NameAAs
    $body = new Template("templates/aa/aa.searchresults.tmpl.php");
    if (isset($_GET['aaid']) && $_GET['aaid'] != "AA ID") {
      $results = search_aas_by_id();
      $body->set("results", $results);
    }
    elseif (isset($_GET['search']) && $_GET['search'] != "AA Name"){
      $results = search_aas_by_name();
      $body->set("results", $results);
    }
    break;
  case 2: //Search AAs by SPA
    if (isset($_GET['spa']) && ($_GET['spa'] > 0)) {
      $body = new Template("templates/aa/aa.searchresults.tmpl.php");
      $results = getAAsBySPA($_GET['spa']);
      if ($results) {
        $body->set('results', $results);
        $body->set('spa_id', $_GET['spa']);
        $body->set('spa_name', $sp_effects[$_GET['spa']]);
      }
    }
    else {
      header("Location: index.php?editor=aa");
      exit;
    }
    break;
  case 3: //Search AAs by Expansion and Class
  case 4: //Add AA
    check_authorization();
    $body = new Template("templates/aa/aa.add.tmpl.php");
    $javascript = new Template("templates/aa/js.tmpl.php");
    $breadcrumbs .= " >> Create AA";
    $body->set('yesno', $yesno);
    $body->set('eqexpansions', $eqexpansions);
    $body->set('sp_effects', $sp_effects);
    $body->set('sp_spelltypes', $sp_spelltypes); //This is still wrong
    $body->set('aa_type', $aa_type);
    $body->set('aa_category', $aa_category);
    $body->set('aas', $aas);
    $body->set('new_id', suggest_id());
    $body->set('all_ranks', get_aa_ranks());
    break;
  case 5: //Insert AA
    check_authorization();
    insertAA();
    $id = $_POST['id'];
    header("Location: index.php?editor=aa&aaid=$id");
    exit;
  case 6: //Add AA Rank
  case 7: //Insert AA Rank
  case 8: //Add AA Effect
  case 9: //Insert AA Effect
  case 10: //Add Prerequisite AA
  case 11: //Insert Prerequisite AA
  case 12: //Update AA
    check_authorization();
    $id = $_POST['id'];
    updateAA();
    header("Location: index.php?editor=aa&aaid=$id");
    exit;
  case 13:
  case 14: //Edit AA Rank
  case 15: //Update AA Rank
  case 16: //Edit AA Effect
  case 17: //Update AA Effect
  case 18: //Edit Prerequisite AA
  case 19: //Update Prerequisite AA
  case 20: //Delete AA
    check_authorization();
    deleteAA();
    header("Location: index.php?editor=aa");
    exit;
  case 21: //Delete AA Rank
  case 22: //Delete AA Effect
  case 23: //Delete Prerequiste AA
    header("Location: index.php?editor=aa");
    exit;
}

function aa_info() {
  global $mysql, $aaid;
  $aa_array = array();
  $aa_base = array();
  $aa_ranks = array();
  $all_ranks = array();
  $aa_effects = array();
  $aa_prereqs = array();
  $first = 0;
  $rank = 0;

  //Get AA info from aa_ability
  $query = "SELECT * from aa_ability WHERE id=$aaid";
  $base_results = $mysql->query_assoc($query);

  if ($base_results) {
    $aa_base = $base_results;
    $first = $aa_base['first_rank_id'];
    $query = "SELECT * FROM aa_ranks WHERE id=$first";
    $first_rank_result = $mysql->query_assoc($query);

    if ($first_rank_result) {
      $aa_ranks[$rank] = $first_rank_result;
      $effect_id = $first_rank_result['id'];
      $next_id = $first_rank_result['next_id'];

      $query = "SELECT * FROM aa_rank_effects WHERE rank_id=$effect_id";
      $first_effect_results = $mysql->query_mult_assoc($query);
      if ($first_effect_results) {
        $aa_effects[$rank] = $first_effect_results;
      }

      $query = "SELECT * FROM aa_rank_prereqs WHERE rank_id=$effect_id";
      $prereq_result = $mysql->query_assoc($query);
      if ($prereq_result) {
        $aa_prereqs[$rank] = $prereq_result;
      }


      while ($next_id > 0) {
        $query = "SELECT * FROM aa_ranks WHERE id=$next_id";
        $result_detail = $mysql->query_assoc($query);
        if ($result_detail) {
          $rank++;
          $aa_ranks[$rank] = $result_detail;
          $next_id = $result_detail['next_id'];
          $effect_id = $result_detail['id'];
          $query = "SELECT * FROM aa_rank_effects WHERE rank_id=$effect_id";
          $effect_detail = $mysql->query_mult_assoc($query);
          if ($effect_detail) {
            $aa_effects[$rank] = $effect_detail;
          }
          $query = "SELECT * FROM aa_rank_prereqs WHERE rank_id=$effect_id";
          $prereq_result = $mysql->query_assoc($query);
          if ($prereq_result) {
            $aa_prereqs[$rank] = $prereq_result;
          }
        }
        else {
          $next_id = 0;
        }
      }
    }
  }

  $aa_array['base'] = $aa_base;
  $aa_array['ranks'] = $aa_ranks;
  $aa_array['effects'] = $aa_effects;
  $aa_array['prereqs'] = $aa_prereqs;
  $aa_array['all_ranks'] = get_aa_ranks();

  if ($aa_array) {
    return $aa_array;
  }
  else {
    return null;
  }
}

function getAAsBySPA($spa) {
  global $mysql;
  $results = array();

  $query = "SELECT id FROM spells_new WHERE $spa IN (effectid1, effectid2, effectid3, effectid4, effectid5, effectid6, effectid7, effectid8, effectid9, effectid10, effectid11, effectid12)";
  $spells = $mysql->query_mult_assoc($query);

  if ($spells) {
    foreach ($spells as $spell) {
      $spell_id = $spell['id'];

      $query = "SELECT id FROM aa_ranks WHERE spell=$spell_id";
      $ranks = $mysql->query_mult_assoc($query);

      if ($ranks) {
        foreach ($ranks as $rank) {
          $rank_id = $rank['id'];


          $query = "SELECT id FROM aa_ability WHERE first_rank_id = $rank_id";
          $abilities = $mysql->query_mult_assoc($query);

          if ($abilities) {
            foreach ($abilities as $ability) {
              array_push($results, $ability['id']);
            }
          }
        }
      }
    }
  }

  asort($results);
  return $results;    
}

function insertAA() {
  global $mysql;

  $id = $_POST['id'];
  $name = $_POST['name'];
  $category = $_POST['category'];
  $type = $_POST['type'];
  $classes = $_POST['classes'];
  $races = $_POST['races'];
  $deities = $_POST['deities'];
  $enabled = $_POST['enabled'];
  $first_rank_id = $_POST['first_rank_id'];
  $grant_only = $_POST['grant_only'];
  $status = $_POST['status'];
  $charges = $_POST['charges'];
  $drakkin_heritage = $_POST['drakkin_heritage'];

  $classes_value = 0;
  foreach ($classes as $v) {
    $classes_value = $classes_value ^ $v;
  }

  $races_value = 0;
  foreach ($races as $v) {
    $races_value = $races_value ^ $v;
  }

  $deities_value = 0;
  foreach ($deities as $v) {
    $deities_value = $deities_value ^ $v;
  }

  $query = "INSERT INTO aa_ability SET id=$id, name=\"$name\", category=$category, type=$type, classes=$classes_value, races=$races_value, deities=$deities_value, enabled=$enabled, first_rank_id=$first_rank_id, grant_only=$grant_only, status=$status, charges=$charges, drakkin_heritage=$drakkin_heritage";
  $mysql->query_no_result($query);

  return;
}

function updateAA() {
  global $mysql;

  $id = $_POST['id'];
  $name = $_POST['name'];
  $category = $_POST['category'];
  $type = $_POST['type'];
  $classes = $_POST['classes'];
  $races = $_POST['races'];
  $deities = $_POST['deities'];
  $enabled = $_POST['enabled'];
  $first_rank_id = $_POST['first_rank_id'];
  $grant_only = $_POST['grant_only'];
  $status = $_POST['status'];
  $charges = $_POST['charges'];
  $drakkin_heritage = $_POST['drakkin_heritage'];

  $classes_value = 0;
  foreach ($classes as $v) {
    $classes_value = $classes_value ^ $v;
  }

  $races_value = 0;
  foreach ($races as $v) {
    $races_value = $races_value ^ $v;
  }

  $deities_value = 0;
  foreach ($deities as $v) {
    $deities_value = $deities_value ^ $v;
  }

  $query = "UPDATE aa_ability SET name=\"$name\", category=$category, type=$type, classes=$classes_value, races=$races_value, deities=$deities_value, enabled=$enabled, first_rank_id=$first_rank_id, grant_only=$grant_only, status=$status, charges=$charges, drakkin_heritage=$drakkin_heritage WHERE id=$id";
  $mysql->query_no_result($query);

  return;
}

function deleteAA() {
  global $mysql;

  $id = $_GET['aaid'];

  $query = "DELETE FROM aa_ability WHERE id=$id";
  $mysql->query_no_result($query);

  return;
}

function get_aa_ranks() {
  global $mysql;

  $query = "SELECT id FROM aa_ranks";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function suggest_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM aa_ability";
  $result = $mysql->query_assoc($query);

  return $result['id'] + 1;
}

?>
