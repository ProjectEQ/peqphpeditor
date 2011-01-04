<?php

switch ($action) {
  case 0:  // View AA
    check_authorization();
    if ($aaid) {
      $body = new Template("templates/aa/aa.tmpl.php");
      $body->set('aaid', $aaid);
      $body->set('yesno', $yesno);
      $body->set('eqexpansions', $eqexpansions);
      $vars = aa_info();
      if ($vars) {
        foreach ($vars as $key=>$value) {
          $body->set($key, $value);
        }
      }
    }
    else {
      $body = new Template("templates/aa/aa.default.tmpl.php");
    }
    break;
  case 1:  // Search AAs
    check_authorization();
    $body = new Template("templates/aa/aa.searchresults.tmpl.php");
    if (isset($_GET['aaid']) && $_GET['aaid'] != "ID") {
      $results = search_aas_by_id();
    }
    else {
      $results = search_aas_by_name();
    }
    $body->set("results", $results);
    break;
}

function aa_info () {
  global $mysql, $aaid;
  $aa_array = array();
  $aa_vars_array = array();
  $aa_actions_array = array();
  $aa_effects_array = array();
  $aa_cost_array = array();

  //Load from altadv_vars
  $query = "SELECT * FROM altadv_vars WHERE skill_id=$aaid";
  $aa_vars_array = $mysql->query_assoc($query);
  $aa_array['aa_vars'] = $aa_vars_array;

  //Load from aa_actions
  $query = "SELECT * FROM aa_actions WHERE aaid=$aaid";
  $aa_actions_array = $mysql->query_mult_assoc($query);
  if ($aa_actions_array) {
    $aa_array['aa_actions'] = $aa_actions_array;
  }

  //Load from aa_effects
  $query = "SELECT * FROM aa_effects WHERE aaid=$aaid";
  $aa_effects_array = $mysql->query_mult_assoc($query);
  if ($aa_effects_array) {
    $aa_array['aa_effects'] = $aa_effects_array;
  }

  //Load from aa_required_level_cost
  $query = "SELECT * FROM aa_required_level_cost WHERE skill_id=$aaid";
  $aa_cost_array = $mysql->query_assoc($query);
  if ($aa_cost_array) {
    $aa_array['aa_cost'] = $aa_cost_array;
  }

  return $aa_array;
}

?>