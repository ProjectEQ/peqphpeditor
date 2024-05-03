<?php

switch ($action) {
  case 0: // Preview Parcels
    check_authorization();
    $body = new Template("templates/parcels/parcels.tmpl.php");
    $parcels = get_parcels();
    if ($parcels) {
      $body->set("parcels", $parcels);
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
?>