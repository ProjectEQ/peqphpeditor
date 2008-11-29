<?php

  session_start();
  
  $action = $_REQUEST['action'];

  include("config.ini");  // Load user settings
  include("peq_lib/login.php");  // Load login-related functions
  require_once("peq_lib/database.php");
  
  $database = new database();

  if ($_SESSION['logged_in']!="TRUE") {
    if (isset($_REQUEST['login_page'])) {
      $login = $_REQUEST['login'];
	  $password = md5($_REQUEST['password']);
			
	  $query = "SELECT * FROM peq_admin WHERE adm_login='$login' AND adm_pw='$password' LIMIT 1";
	  $result = mysql_query($query);
	  $count = mysql_num_rows($result);
			
	  if (!result || $count<1) {
	    $_SESSION['logged_in'] = "FALSE";
	    include('header_b.php');
		echo "<div id=\"content\">";
 		echo "<div class=\"page_title\"><span><br>Project Everquest Database Editing Interface</span></div><br><br>		
	          <center><font size=2>Sorry, that information is incorrect.<br><br>
			  <a href=\"peq_editor.php?action=30\">Back to login page</a></font></center></div>";
	    break;
	  }
	  else {
	    $_SESSION['logged_in'] = "TRUE";
	    $_SESSION['user'] = $login;
	    $_SESSION['guest'] = "FALSE";
				
		header("Location: peq_backend.php?action=2");
	  }			
    }
    else {
	  login_page();
	  break;
	}
  }

  if ($action) {
	switch ( $action ) {
	  case 1: // Login
	    login_page();
	    break;
	  case 2: // Display Admins
	    include("header_b.php");
	    if ($_SESSION['logged_in'] == "TRUE") {
          echo "<a href=\"peq_backend.php?action=3\">Add Admin</a> | <a href=\"peq_backend.php?action=2\">View Admins</a> | <a href=\"peq_backend.php?action=420\">Logout</a";
        }
	    echo "<p align=\"center\">
		        <table width=\"250\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">
			      <tr>
				    <td align=\"left\">";
	    $query = "SELECT * FROM peq_admin";
	    $result = @mysql_query($query);
	    while($row = mysql_fetch_array($result)) {
		  $id = $row['adm_id'];
		  $login = $row['adm_login'];
		  $pass = $row['adm_pw'];
		  echo "$id | $login | <a href=\"peq_backend.php?action=4&var=$id\"><img src=\"images/note.gif\" border=\"0\" title=\"Change Password\"></a> <a href=\"peq_backend.php?action=5&var=$id\"><img src=\"images/remove.gif\" border=\"0\" title=\"Delete Admin\"></a><br />";
	    }
	    echo "</td></tr></table></p>";
	    break;
	  case 3: // Add an Admin
	    include("header_b.php");
	    if (isset($_REQUEST['add_admin'])) {
	      $login = $_REQUEST['login'];
	      $password = md5($_REQUEST['password']);

		  $query = "SELECT * FROM peq_admin WHERE adm_login='$login' LIMIT 1";
		  $result = mysql_query($query);
		  $count = mysql_num_rows($result);
			
		  if ($count>=1) {
		    include('header_b.php');
		    echo "<p>We're sorry, that admin already exists.</p></div><br />";
		    exit();
		  }
		  else {
		    $query2 = "INSERT INTO peq_admin SET adm_login='$login', adm_pw='$password'";
		    $result2 = mysql_query($query2);
			
		    if (!$result2) {
		      include('header_b.php');
		      echo "<p>ERROR!</p></div><br />";
		      exit();
		    }
		    header("Location: peq_backend.php?action=2");
	      }
	    }
	    else {
	      echo "<center><br /><br /><br /><br /><br /><font size=3><b>Add an Admin:</b></font><br /><br />
		  <form action=\"peq_backend.php\" method=\"post\">
		  <input type=\"hidden\" name=\"add_admin\" value=\"add\" />
		  <input type=\"hidden\" name=\"action\" value=\"$action\" />
		  LOGIN: <br /><input type=\"text\" name=\"login\" /><br /><br />
		  PASSWORD: <br /><input type=\"password\" name=\"password\" /><br /><br />
		  <input type=\"submit\" name=\"submit\" value=\"Submit Changes\" /></center>";
	    }
	    break;
	  case 4: // Change an Admin's Password
	    $var = $_REQUEST['var'];
		
	    if (isset($_REQUEST['change_pass'])) {			
	      $password = md5($_REQUEST['password']);
	      $password2 = md5($_REQUEST['password2']);
			
	      if ($password!=$password2) {
	        include('header_b.php');
	        echo "<p>Passwords don't match</p></div><br />";
		    exit();
	      }
			
	      $query = "SELECT * FROM peq_admin WHERE adm_id='$var' LIMIT 1";
	      $result = mysql_query($query);
	      $count = mysql_num_rows($result);
		
	      if ($count<1) {
	        include('header_b.php');
	        echo "<p>We're sorry, that admin doesn't exist.</p></div><br />";
		    exit();
	      }
	      else {
		    $query2 = "UPDATE peq_admin SET adm_pw='$password' WHERE adm_id='$var'";
		    $result2 = mysql_query($query2);

		    if (!$result2) {
		      include('header_b.php');
		      echo "<p>ERROR!</p></div><br />";
		      exit();
		    }
		    header("Location: peq_backend.php?action=2");
	      }
	    }
	    else {
	      include("header_b.php");
	      echo "<center><br /><br /><br /><br /><br /><font size=3><b>Change an Admin's Password:</b></font><br /><br />
		    <form action=\"peq_backend.php\" method=\"post\">
			<input type=\"hidden\" name=\"change_pass\" value=\"add\" />
			<input type=\"hidden\" name=\"action\" value=\"$action\" />
			<input type=\"hidden\" name=\"var\" value=\"$var\" />
			PASSWORD: <br /><input type=\"password\" name=\"password\" /><br /><br />
			CONFIRM: <br /><input type=\"password\" name=\"password2\" /><br /><br />
			<input type=\"submit\" name=\"submit\" value=\"Submit Changes\" /></center>";
	    }
	    break;
	  case 5: // Delete an Admin
	    if ($_SESSION['log_in']!="TRUE") {
	      header("Location: peq_backend.php?action=2");
	    }
	    $var = $_REQUEST['var'];

	    $query = "SELECT * FROM peq_admin WHERE adm_id='$var' LIMIT 1";
	    $result = mysql_query($query);
	    $count = mysql_num_rows($result);
			
	    if ($count<1) {
	      include('header_b.php');
	      echo "<p>We're sorry, that admin doesn't exist.</p></div><br />";
	      exit();
	    }
	    else {
		  $query2 = "DELETE FROM peq_admin WHERE adm_id='$var'";
		  $result2 = mysql_query($query2);
				
		  if (!$result2) {
		    include('header_b.php');
		    echo "<p>ERROR!</p></div><br />";
		   exit();
		  } 
		  header("Location: peq_backend.php?action=2");
	    }
	    break;
	  case 420: // LOG-OUT
		$_SESSION['logged_in'] = "FALSE";
		header("Location: peq_backend.php?action=1");
	    break;
	}
	echo "<br></div></div></body></html>";
  }

function login_page() {

  global $page,$races,$classes,$zone,$var,$var2,$guest,$npc,$fid,$filter,$number,$number2,$number3,$loot,$action,$action2,$user,$logging,$log_dir,$database, $login_name, $login_pw;

  include('header2.php');

  echo "<div id=\"content\">";
  
  echo "<div class=\"page_title\"><span><br>PEQ Editor User Management</span></div><br><br>
	  <form action=\"peq_backend.php\" method=\"post\">
	  <input type=\"hidden\" name=\"login_page\" value=\"login\">
	  <input type=\"hidden\" name=\"z\" value=\"$zone\">
	  <input type=\"hidden\" name=\"action\" value=\"$action\">
	  <input type=\"hidden\" name=\"action2\" value=\"$action2\">
	  <table width=\"250\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\">
		<tr>
	 	  <td align=\"left\"><font size=\"2\">Login:</font></td>
		  <td align=\"right\"><input type=\"text\" name=\"login\"  size=\"15\" value=\"$login_name\"></td>
		</tr>
		<tr>
		  <td align=\"left\"><font size=\"2\">Password:</font></td>
		  <td align=\"right\"><input type=\"password\" name=\"password\" size=\"15\" value=\"$login_pw\"/></td>
		</tr>
		<tr>
		  <td colspan=\"2\" align=\"center\"><br><br><input type=\"submit\" name=\"submit\" value=\"Log-in\"></td>
		</tr>
	  </table>
	  </p></div></div>";
}

?>
