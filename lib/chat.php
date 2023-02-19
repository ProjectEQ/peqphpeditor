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
?>