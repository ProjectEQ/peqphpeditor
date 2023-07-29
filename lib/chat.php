<?
switch ($action) {
  case 0: // View Chat Channels
    check_authorization();
    $body = new Template("templates/chat/chats.view.tmpl.php");
    $chats = get_chat_channels();
    if ($chats) {
      $body->set('chats', $chats);
    }
    break;
  case 1: // Add Chat Channel
    check_authorization();
    $breadcrumbs .= " >> Add Channel";
    $body = new Template("templates/chat/chat.add.tmpl.php");
    break;
  case 2: // Insert Chat Channel
    check_authorization();
    insert_chat_channel();
    header("Location: index.php?editor=chat");
    exit;
  case 3: // Edit Chat Channel
    check_authorization();
    $breadcrumbs .= " >> Edit Channel";
    $body = new Template("templates/chat/chat.edit.tmpl.php");
    $chat = get_chat_channel($_GET['name']);
    if ($chat) {
      $body->set('chat', $chat);
    }
    break;
  case 4: // Update Chat Channel
    check_authorization();
    update_chat_channel();
    header("Location: index.php?editor=chat");
    exit;
  case 5: // Delete Chat Channel
    check_authorization();
    delete_chat_channel($_GET['name']);
    header("Location: index.php?editor=chat");
    exit;
  case 6: // View Reserved Names
    check_authorization();
    $breadcrumbs .= " >> Reserved Names";
    $body = new Template("templates/chat/reserved.names.view.tmpl.php");
    $reserved_names = get_reserved_names();
    if ($reserved_names) {
      $body->set('reserved_names', $reserved_names);
    }
    break;
  case 7: // Add Reserved Name
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=chat&action=6'>Reserved Names</a> >> Add Reserved Name";
    $body = new Template("templates/chat/reserved.name.add.tmpl.php");
    $body->set('suggest_id', suggest_reserved_name_id());
    break;
  case 8: // Insert Reserved Name
    check_authorization();
    insert_reserved_name();
    header("Location: index.php?editor=chat&action=6");
    exit;
  case 9: // Edit Reserved Name
    check_authorization();
    $breadcrumbs .= " >> <a href='index.php?editor=chat&action=6'>Reserved Names</a> >> Edit Reserved Name";
    $body = new Template("templates/chat/reserved.name.edit.tmpl.php");
    $reserved_name = get_reserved_name($_GET['id']);
    if ($reserved_name) {
      $body->set('reserved_name', $reserved_name);
    }
    break;
  case 10: // Update Reserved Name
    check_authorization();
    update_reserved_name();
    header("Location: index.php?editor=chat&action=6");
    exit;
  case 11: // Delete Reserved Name
    check_authorization();
    delete_reserved_name($_GET['id']);
    header("Location: index.php?editor=chat&action=6");
    exit;
}

function get_chat_channels() {
  global $mysql;

  $query = "SELECT * FROM chatchannels";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_chat_channel($name) {
  global $mysql;

  $query = "SELECT * FROM chatchannels WHERE `name`=\"$name\"";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_chat_channel() {
  global $mysql;

  $name = $_POST['name'];
  $owner = $_POST['owner'];
  $password = $_POST['password'];
  $minstatus = $_POST['minstatus'];

  $query = "REPLACE INTO chatchannels SET `name`=\"$name\", owner=\"$owner\", password=\"$password\", minstatus=$minstatus";
  $mysql->query_no_result($query);
}

function update_chat_channel() {
  global $mysql;

  $old_name = $_POST['old_name'];
  $new_name = $_POST['new_name'];
  $owner = $_POST['owner'];
  $password = $_POST['password'];
  $minstatus = $_POST['minstatus'];

  $query = "UPDATE chatchannels SET `name`=\"$new_name\", owner=\"$owner\", password=\"$password\", minstatus=$minstatus WHERE `name`=\"$old_name\"";
  $mysql->query_no_result($query);
}

function delete_chat_channel($name) {
  global $mysql;

  $query = "DELETE FROM chatchannels WHERE `name`=\"$name\"";
  $mysql->query_no_result($query);
}

function get_reserved_names() {
  global $mysql;

  $query = "SELECT * FROM chatchannel_reserved_names";
  $results = $mysql->query_mult_assoc($query);

  if ($results) {
    return $results;
  }
  else {
    return null;
  }
}

function get_reserved_name($id) {
  global $mysql;

  $query = "SELECT * FROM chatchannel_reserved_names WHERE id=$id";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result;
  }
  else {
    return null;
  }
}

function insert_reserved_name() {
  global $mysql;

  $id = $_POST['id'];
  $name = $_POST['name'];

  $query = "INSERT INTO chatchannel_reserved_names SET id=$id, `name`=\"$name\"";
  $mysql->query_no_result($query);
}

function update_reserved_name() {
  global $mysql;

  $id = $_POST['id'];
  $name = $_POST['name'];

  $query = "UPDATE chatchannel_reserved_names SET `name`=\"$name\" WHERE id=$id";
  logSQL($query);
  $mysql->query_no_result($query);
}

function delete_reserved_name($id) {
  global $mysql;

  $query = "DELETE FROM chatchannel_reserved_names WHERE id=$id";
  $mysql->query_no_result($query);
}

function suggest_reserved_name_id() {
  global $mysql;

  $query = "SELECT MAX(id) AS id FROM chatchannel_reserved_names";
  $result = $mysql->query_assoc($query);

  if ($result) {
    return $result['id'] + 1;
  }
  else {
    return 1;
  }  
}
?>