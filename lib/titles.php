<?php

switch ($action) {
  case 0: // Preview Titles
    $body = new Template("templates/titles/titles.tmpl.php");
    $titles = get_titles();
    if ($titles) {
      $body->set("titles", $titles);
    }
    break;
  case 1: // View Title
    $breadcrumbs .= " >> View Title";
    $title = view_title();
    $body = new Template("templates/titles/title.view.tmpl.php");
    if ($title) {
      $body->set("title", $title);
      $body->set("genders", $genders);
      $body->set("classes", $classes);
      $body->set("skilltypes", $skilltypes);
    }
    break;
  case 2: // Add Title
    check_authorization();
    $breadcrumbs .= " >> Add Title";
    $javascript = new Template("templates/titles/js.tmpl.php");
    $body = new Template("templates/titles/title.add.tmpl.php");
    $next_id = suggest_title_id();
    $body->set('next_id', $next_id);
    $body->set("genders", $genders);
    $body->set("classes", $classes);
    $body->set("skilltypes", $skilltypes);
    break;
  case 3: // Insert Title
    check_authorization();
    insert_title();
    header("Location: index.php?editor=titles");
    exit;
  case 4: // Edit Title
    check_authorization();
    $breadcrumbs .= " >> Edit Title";
    $javascript = new Template("templates/titles/js.tmpl.php");
    $title = view_title();
    $body = new Template("templates/titles/title.edit.tmpl.php");
    if ($title) {
      $body->set("title", $title);
      $body->set("genders", $genders);
      $body->set("classes", $classes);
      $body->set("skilltypes", $skilltypes);
    }
    break;
  case 5: // Update Title
    check_authorization();
    update_title();
    $title_id = $_POST['id'];
    header("Location: index.php?editor=titles&title_id=$title_id&action=1");
    exit;
  case 6: // Delete Title
    check_authorization();
    delete_title();
    header("Location: index.php?editor=titles");
    exit;
}

function get_titles() {
  global $mysql;

  $query = "SELECT id, prefix, suffix FROM titles ORDER BY id";
  $result = $mysql->query_mult_assoc($query);

  return $result;
}

function view_title() {
  global $mysql;
  $title_id = $_GET['title_id'];

  $query = "SELECT * FROM titles WHERE id=$title_id";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function insert_title() {
  global $mysql;

  $id = $_POST['id'];
  $skill_id = $_POST['skill_id'];
  $min_skill_value = $_POST['min_skill_value'];
  $max_skill_value = $_POST['max_skill_value'];
  $min_aa_points = $_POST['min_aa_points'];
  $max_aa_points = $_POST['max_aa_points'];
  $class = $_POST['class'];
  $gender = $_POST['gender'];
  $char_id = $_POST['char_id'];
  $status = $_POST['status'];
  $item_id = $_POST['item_id'];
  $prefix = $_POST['prefix'];
  $suffix = $_POST['suffix'];
  $title_set = $_POST['title_set'];

  $query = "INSERT INTO titles (id, skill_id, min_skill_value, max_skill_value, min_aa_points, max_aa_points, `class`, gender, char_id, status, item_id, prefix, suffix, title_set) VALUES ($id, $skill_id, $min_skill_value, $max_skill_value, $min_aa_points, $max_aa_points, $class, $gender, $char_id, $status, $item_id, \"$prefix\", \"$suffix\", $title_set)";
  $mysql->query_no_result($query);
}

function update_title() {
  global $mysql;

  $id = $_POST['id'];
  $skill_id = $_POST['skill_id'];
  $min_skill_value = $_POST['min_skill_value'];
  $max_skill_value = $_POST['max_skill_value'];
  $min_aa_points = $_POST['min_aa_points'];
  $max_aa_points = $_POST['max_aa_points'];
  $class = $_POST['class'];
  $gender = $_POST['gender'];
  $char_id = $_POST['char_id'];
  $status = $_POST['status'];
  $item_id = $_POST['item_id'];
  $prefix = $_POST['prefix'];
  $suffix = $_POST['suffix'];
  $title_set = $_POST['title_set'];
  $old_id = $_POST['old_id'];

  $query = "UPDATE titles SET id=$id, skill_id=$skill_id, min_skill_value=$min_skill_value, max_skill_value=$max_skill_value, min_aa_points=$min_aa_points, max_aa_points=$max_aa_points, `class`=$class, gender=$gender, char_id=$char_id, status=$status, item_id=$item_id, prefix=\"$prefix\", suffix=\"$suffix\", title_set=$title_set WHERE id=$old_id";
  $mysql->query_no_result($query);
}

function delete_title() {
  global $mysql;
  $title_id = $_GET['title_id'];

  $query = "DELETE FROM titles WHERE id=$title_id";
  $mysql->query_no_result($query);
}

function suggest_title_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS last_id FROM titles";
  $result = $mysql->query_assoc($query);

  return $result['last_id'] + 1;
}
?>