<?php

$msg_status = array(
  0 => "Deleted",
  1 => "Unread",
  3 => "Read",
  4 => "Trashed"
);

switch ($action) {
  case 0: // Preview Mail
    check_admin_authorization();
    $body = new Template("templates/mail/mail.tmpl.php");
    $mail = get_mail_headers();
    if ($mail) {
      $body->set("mail", $mail);
      foreach ($mail as $key=>$value) {
        $body->set($key, $value);
      }
    }
    break;
  case 1: // View Message
    check_admin_authorization();
    $breadcrumbs .= " >> View Message";
    $message = view_message();
    $body = new Template("templates/mail/mail.view.tmpl.php");
    $body->set("msg_status", $msg_status);
    $body->set("message", $message);
    break;
  case 2: // Modify Message
    check_admin_authorization();
    $breadcrumbs .= " >> Edit Message";
    $message = view_message();
    $javascript = new Template("templates/mail/js.tmpl.php");
    $body = new Template("templates/mail/mail.edit.tmpl.php");
    $body->set("msg_status", $msg_status);
    $body->set("message", $message);
    break;
  case 3: // Create Message
    check_admin_authorization();
    $breadcrumbs .= " >> Create Message";
    $javascript = new Template("templates/mail/js.tmpl.php");
    $body = new Template("templates/mail/mail.create.tmpl.php");
    break;
  case 4: // Delete Message
    check_admin_authorization();
    delete_message();
    header("Location: index.php?editor=mail");
    exit;
  case 5: // Send Message
    check_admin_authorization();
    send_message();
    header("Location: index.php?editor=mail");
    exit;
  case 6: // Update Message
    check_admin_authorization();
    update_message();
    $msg_id = $_POST['msg_id'];
    header("Location: index.php?editor=mail&msg_id=$msg_id&action=1");
    exit;
}

function get_mail_headers() {
  global $mysql;

  $query = "SELECT msgid, charid, timestamp, `from`, subject FROM mail ORDER BY msgid";
  $result = $mysql->query_mult_assoc($query);

  return $result;
}

function view_message() {
  global $mysql;

  $msg_id = $_GET['msg_id'];

  $query = "SELECT msgid, charid, timestamp, `from`, subject, body, status FROM mail where msgid = \"$msg_id\"";
  $result = $mysql->query_assoc($query);
  
  return $result;
}

function update_message() {
  global $mysql;

  $msg_id = $_POST['msg_id'];
  $subject = $_POST['subject'];
  $body = $_POST['body'];
  $charid = getPlayerID($_POST['to_text']);
  $status = $_POST['status'];
  $to = $_POST['to_text'];
  $from = $_POST['from_text'];

  $query = "UPDATE mail SET subject=\"$subject\",body=\"$body\",charid=$charid,`to`=\"$to\",`from`=\"$from\",status=$status WHERE msgid=\"$msg_id\"";
  $mysql->query_no_result($query);
}

function send_message() {
  global $mysql;

  $subject = $_POST['subject'];
  $body = $_POST['body'];
  $charid = getPlayerID($_POST['to_text']);
  $to = $_POST['to_text'];
  $from = $_POST['from_text'];


  $query = "INSERT INTO mail (`charid`,`timestamp`,`from`,`subject`,`body`,`to`,`status`) VALUES ($charid,UNIX_TIMESTAMP(NOW()),\"$from\",\"$subject\",\"$body\",\"$to\",1)";
  $mysql->query_no_result($query);
}

function delete_message() {
  global $mysql;

  $msg_id = $_GET['msg_id'];

  $query = "DELETE FROM mail WHERE msgid=\"$msg_id\"";
  $mysql->query_no_result($query);
}
?>