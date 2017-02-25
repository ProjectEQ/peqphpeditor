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
    if (isset($aaid) && $aaid >= 0) {
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
  //check_authorization(); uncomment if you want only admins to search by name
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
/*check_authorization();
	$javascript = new Template("templates/iframes/js.tmpl.php");
	$body = new Template("templates/aa/aa_ranks.edit.tmpl.php");
	$body->set('editmode', 2);
	$body->set('aa_ability', $defaultvalues);
	$body->set('aa_type', $aa_type);
	$body->set('aa_category', $aa_category);
	$body->set('errors', null);
	break;*/
  case 5: //Insert AA
  case 6: //Add AA Rank
  case 7: //Insert AA Rank
  case 8: //Add AA Effect
  case 9: //Insert AA Effect
  case 10: //Add Prerequisite AA
  case 11: //Insert Prerequisite AA
  case 12: //Edit AA
  case 13: //Update AA
  case 14: //Edit AA Rank
  case 15: //Update AA Rank
  case 16: //Edit AA Effect
  case 17: //Update AA Effect
  case 18: //Edit Prerequisite AA
  case 19: //Update Prerequisite AA
  case 20: //Delete AA
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

  $query = "SELECT id FROM aa_ranks";
  $all_ranks = $mysql->query_mult_assoc($query);

  $aa_array['base'] = $aa_base;
  $aa_array['ranks'] = $aa_ranks;
  $aa_array['effects'] = $aa_effects;
  $aa_array['prereqs'] = $aa_prereqs;
  $aa_array['all_ranks'] = $all_ranks;

  if ($aa_array) {
    return $aa_array;
  }
  else {
    return null;
  }
}

function getClasses($classes) {
  if ($classes == 0) {
	return "None";
  }
  elseif ($classes == 65535) 
	return "ALL";
  else {
	$result = '';
	if ($classes & 32768) $result .= "BER ";
	if ($classes &   128) $result .= "BRD ";
	if ($classes & 16384) $result .= "BST ";
	if ($classes &     2) $result .= "CLR ";
	if ($classes &    32) $result .= "DRU ";
	if ($classes &  8192) $result .= "ENC ";
	if ($classes &  4096) $result .= "MAG ";
	if ($classes &    64) $result .= "MNK ";
	if ($classes &  1024) $result .= "NEC ";
	if ($classes &     4) $result .= "PAL ";
	if ($classes &     8) $result .= "RNG ";
	if ($classes &   256) $result .= "ROG ";
	if ($classes &    16) $result .= "SHD ";
	if ($classes &   512) $result .= "SHM ";
	if ($classes &     1) $result .= "WAR ";
	if ($classes &  2048) $result .= "WIZ ";
	$result = rtrim($result, " ");
	return $result;
  }
}

function getRaces($races) {
  if ($races == 0) {
	return "None";
  }
  elseif ($races == 65535) 
	return "ALL";
  else {
	$result = '';
	if ($races &     2) $result .= "BAR ";
	if ($races &    32) $result .= "DEF ";
	if ($races & 32768) $result .= "DRK ";
	if ($races &   128) $result .= "DWF ";
	if ($races &     8) $result .= "ELF ";
	if ($races &     4) $result .= "ERU ";
	if ($races &  4096) $result .= "FRG ";
	if ($races &  2048) $result .= "GNM ";
	if ($races &    64) $result .= "HEF ";
	if ($races &  1024) $result .= "HFL ";
	if ($races &    16) $result .= "HIE ";
	if ($races &     1) $result .= "HUM ";
	if ($races &  8192) $result .= "IKS ";
	if ($races &   512) $result .= "OGR ";
	if ($races &   256) $result .= "TRL ";
	if ($races & 16384) $result .= "VAH ";
	$result = rtrim($result, " ");
	return $result;
  }
}

function getDeities($deities) {
  if ($deities == 0) {
	return "None";
  }
  elseif ($deities == 131071) 
	return "ALL";
  else {
	$result = '';

	if ($deities & 65536) $result .= "Agnostic ";
	if ($deities &     1) $result .= "Bertoxxulous ";
	if ($deities &     2) $result .= "Brell Serilis ";
	if ($deities &    16) $result .= "Bristlebane ";
	if ($deities &     4) $result .= "Cazic-Thule ";
	if ($deities &     8) $result .= "Erollisi Marr ";
	if ($deities &    32) $result .= "Innoruuk ";
	if ($deities &    64) $result .= "Karana ";
	if ($deities &   128) $result .= "Mithaniel Marr ";
	if ($deities &   256) $result .= "Prexus ";
	if ($deities &   512) $result .= "Quellious ";
	if ($deities &  1024) $result .= "Rallos Zek ";
	if ($deities &  2048) $result .= "Rodcet Nife ";
	if ($deities &  4096) $result .= "Solusek Ro ";
	if ($deities &  8192) $result .= "The Tribunal ";
	if ($deities & 16384) $result .= "Tunare ";
	if ($deities & 32768) $result .= "Veeshan ";
	$result = rtrim($result, " ");
	return $result;
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

?>