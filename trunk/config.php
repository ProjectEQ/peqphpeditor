<?

// Database Information:
$dbhost = 'localhost';
$dbuser = 'username';
$dbpass = 'password';
$db = 'database_name';

/*  Limit zone lists to a specified expansion
 *  (i.e. setting $expansion_limit to 2 would cause only Classic and Kunark zones
 *  to appear in zone drop-down lists)
 *    1 = EQ Classic
 *    2 = Kunark
 *    3 = Velious
 *    4 = Luclin
 *    5 = Planes of Power
 *    6 = Legacy of Ykesha
 *    7 = Lost Dungeons of Norrath
 *    8 = Gates of Discord
 */
$expansion_limit = 8;
  
// Don't want to have to type the username and password every time you start the editor?
// Set the two variables below to the values you want to be in the form when you start it up.
// (default login: admin  pw: password)
$login = 'admin';
$password = 'password';

// Log SQL queries:  1 = on, 0 = off
$logging = 0;

// $log_file = path to the file your sql logs will be saved in, if you have enabled sql logging
//    Make sure to create this directory and file before using the editor, or you will
//    get errors
$log_file = "logs/sql_log.sql";

?>