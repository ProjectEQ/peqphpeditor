<?php

switch ($action) {
  case 0: // Preview Parcels
    check_authorization();
    $body = new Template("templates/parcels/parcels.tmpl.php");
    $parcels = get_parcels();
    if ($parcels) {
      $body->set("parcels", $parcels);
      $containers = get_containers();
      if ($containers) {
        $body->set("containers", $containers);
      }
    }
    break;
  case 1: // Add Parcel
    check_authorization();
    $breadcrumbs .= " >> Add Parcel";
    $body = new Template("templates/parcels/parcel.add.tmpl.php");
    $body->set("suggest_id", suggest_parcel_id());
    break;
  case 2: // Insert Parcel
    check_authorization();
    insert_parcel();
    header("Location: index.php?editor=parcels");
    exit;
  case 3: // Edit Parcel
    check_authorization();
    $breadcrumbs .= " >> Edit Parcel";
    $body = new Template("templates/parcels/parcel.edit.tmpl.php");
    $parcel = get_parcel($_GET['id']);
    if ($parcel) {
      $body->set("parcel", $parcel);
    }
    break;
  case 4: // Update Parcel
    check_authorization();
    update_parcel();
    header("Location: index.php?editor=parcels");
    exit;
  case 5: // Delete Parcel
    check_authorization();
    delete_parcel($_GET['id']);
    header("Location: index.php?editor=parcels");
    exit;
  case 6: // View Container Contents
    check_authorization();
    $breadcrumbs .= " >> Container Parcels";
    $body = new Template("templates/parcels/container.tmpl.php");
    $parcels = get_container_parcels($_GET['parcels_id']);
    if ($parcels) {
      $body->set("parcels", $parcels);
    }
    break;
  case 7: // Add Container Parcel
    check_authorization();
    $breadcrumbs .= " >> Container Parcels >> Add Container Parcel";
    $body = new Template("templates/parcels/container.add.tmpl.php");
    $body->set("suggest_id", suggest_container_parcel_id());
    $body->set("parcels_id", $_GET['parcels_id']);
    break;
  case 8: // Insert Container Parcel
    check_authorization();
    $parcels_id = $_POST['parcels_id'];
    insert_container_parcel();
    header("Location: index.php?editor=parcels&parcels_id=$parcels_id&action=6");
    exit;
  case 9: // Edit Container Parcel
    check_authorization();
    $breadcrumbs .= " >> Container Parcels >> Edit Container Parcel";
    $body = new Template("templates/parcels/container.edit.tmpl.php");
    $parcel = get_container_parcel($_GET['id']);
    if ($parcel) {
      $body->set("parcel", $parcel);
    }
    break;
  case 10: // Update Container Parcel
    check_authorization();
    $parcels_id = $_POST['parcels_id'];
    update_container_parcel();
    header("Location: index.php?editor=parcels&parcels_id=$parcels_id&action=6");
    exit;
  case 11: // Delete Container Parcel
    check_authorization();
    $parcels_id = $_GET['parcels_id'];
    delete_container_parcel($_GET['id']);
    header("Location: index.php?editor=parcels&parcels_id=$parcels_id&action=6");
    exit;
}

function get_parcels() {
  global $mysql;

  $query = "SELECT * FROM character_parcels";
  $result = $mysql->query_mult_assoc($query);

  return $result;
}

function get_parcel($id) {
  global $mysql;

  $query = "SELECT * FROM character_parcels WHERE id=$id";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function insert_parcel() {
  global $mysql;

  $id = $_POST['id'];
  $char_id = $_POST['char_id'];
  $item_id = $_POST['item_id'];
  $aug_slot_1 = $_POST['aug_slot_1'];
  $aug_slot_2 = $_POST['aug_slot_2'];
  $aug_slot_3 = $_POST['aug_slot_3'];
  $aug_slot_4 = $_POST['aug_slot_4'];
  $aug_slot_5 = $_POST['aug_slot_5'];
  $aug_slot_6 = $_POST['aug_slot_6'];
  $slot_id = $_POST['slot_id'];
  $quantity = $_POST['quantity'];
  $from_name = $_POST['from_name'];
  $note = $_POST['note'];
  //$sent_date = $_POST['sent_date']; // Using now() function

  $query = "INSERT INTO character_parcels SET id=$id, char_id=$char_id, item_id=$item_id, aug_slot_1=$aug_slot_1, aug_slot_2=$aug_slot_2, aug_slot_3=$aug_slot_3, aug_slot_4=$aug_slot_4, aug_slot_5=$aug_slot_5, aug_slot_6=$aug_slot_6, slot_id=$slot_id, quantity=$quantity, from_name=\"$from_name\", note=\"$note\", sent_date=NOW()";
  $mysql->query_no_result($query);
}

function update_parcel() {
  global $mysql;

  $id = $_POST['id'];
  $char_id = $_POST['char_id'];
  $item_id = $_POST['item_id'];
  $aug_slot_1 = $_POST['aug_slot_1'];
  $aug_slot_2 = $_POST['aug_slot_2'];
  $aug_slot_3 = $_POST['aug_slot_3'];
  $aug_slot_4 = $_POST['aug_slot_4'];
  $aug_slot_5 = $_POST['aug_slot_5'];
  $aug_slot_6 = $_POST['aug_slot_6'];
  $slot_id = $_POST['slot_id'];
  $quantity = $_POST['quantity'];
  $from_name = $_POST['from_name'];
  $note = $_POST['note'];
  //$sent_date = $_POST['sent_date']; // Using now() function

  $query = "UPDATE character_parcels SET char_id=$char_id, item_id=$item_id, aug_slot_1=$aug_slot_1, aug_slot_2=$aug_slot_2, aug_slot_3=$aug_slot_3, aug_slot_4=$aug_slot_4, aug_slot_5=$aug_slot_5, aug_slot_6=$aug_slot_6, slot_id=$slot_id, quantity=$quantity, from_name=\"$from_name\", note=\"$note\", sent_date=NOW() WHERE id=$id";
  $mysql->query_no_result($query);
}

function suggest_parcel_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM character_parcels";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result['id'] + 1;
  }
  else {
    return 1;
  }
}

function delete_parcel($id) {
  global $mysql;

  $query = "DELETE FROM character_parcels WHERE id=$id";
  $mysql->query_no_result($query);
}

function get_containers() {
  global $mysql;

  $query = "SELECT DISTINCT(parcels_id) AS parcels_id FROM character_parcels_containers";
  $results = $mysql->query_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_container_parcels($parcels_id) {
  global $mysql;

  $query = "SELECT * FROM character_parcels_containers WHERE parcels_id=$parcels_id ORDER BY slot_id";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_container_parcel($id) {
  global $mysql;

  $query = "SELECT * FROM character_parcels_containers WHERE id=$id";
  $results = $mysql->query_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function insert_container_parcel() {
  global $mysql;

  $id = $_POST['id'];
  $parcels_id = $_POST['parcels_id'];
  $slot_id = $_POST['slot_id'];
  $item_id = $_POST['item_id'];
  $aug_slot_1 = $_POST['aug_slot_1'];
  $aug_slot_2 = $_POST['aug_slot_2'];
  $aug_slot_3 = $_POST['aug_slot_3'];
  $aug_slot_4 = $_POST['aug_slot_4'];
  $aug_slot_5 = $_POST['aug_slot_5'];
  $aug_slot_6 = $_POST['aug_slot_6'];
  $quantity = $_POST['quantity'];

  $query = "INSERT INTO character_parcels_containers SET id=$id, parcels_id=$parcels_id, slot_id=$slot_id, item_id=$item_id, aug_slot_1=$aug_slot_1, aug_slot_2=$aug_slot_2, aug_slot_3=$aug_slot_3, aug_slot_4=$aug_slot_4, aug_slot_5=$aug_slot_5, aug_slot_6=$aug_slot_6, quantity=$quantity";
  $mysql->query_no_result($query);
}

function update_container_parcel() {
  global $mysql;

  $id = $_POST['id'];
  $parcels_id = $_POST['parcels_id'];
  $slot_id = $_POST['slot_id'];
  $item_id = $_POST['item_id'];
  $aug_slot_1 = $_POST['aug_slot_1'];
  $aug_slot_2 = $_POST['aug_slot_2'];
  $aug_slot_3 = $_POST['aug_slot_3'];
  $aug_slot_4 = $_POST['aug_slot_4'];
  $aug_slot_5 = $_POST['aug_slot_5'];
  $aug_slot_6 = $_POST['aug_slot_6'];
  $quantity = $_POST['quantity'];

  $query = "UPDATE character_parcels_containers SET item_id=$item_id, aug_slot_1=$aug_slot_1, aug_slot_2=$aug_slot_2, aug_slot_3=$aug_slot_3, aug_slot_4=$aug_slot_4, aug_slot_5=$aug_slot_5, aug_slot_6=$aug_slot_6, quantity=$quantity WHERE id=$id";
  $mysql->query_no_result($query);
}

function suggest_container_parcel_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM character_parcels_containers";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result['id'] + 1;
  }
  else {
    return 1;
  }
}

function delete_container_parcel($id) {
  global $mysql;

  $query = "DELETE FROM character_parcels_containers WHERE id=$id";
  $mysql->query_no_result($query);
}
?>