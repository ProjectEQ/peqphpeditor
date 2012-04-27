<?php

// Database Information:
$dbhost = 'localhost';
$dbuser = 'eqemu';
$dbpass = 'eqemu';
$db = 'eqemu';

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
 *    9 = Omens of War
 *    10 = Dragons of Norrath
 *    11 = Depths of Darkhollow
 *    12 = Prophecy of Ro
 *    13 = The Serpents Spine
 *    14 = The Buried Sea
 *    15 = Secrets of Faydwer
 *    16 = Seeds of Destruction
 *    17 = Underfoot
 *    18 = House of Thule\
 *    19 = Veil of Alaris
 *    99 = Other
 */
$expansion_limit = 19;

// How NPCs are listed. 1 = by NPCID (zoneidnumber*1000), 2 = By spawn2 entry
$npc_list = 1;

// Spawngroup list limit. Limits how many spawngroups are displayed as result of a Coord/NPC search. Specific NPC lists are not effected.
$spawngroup_limit = 150;

// Dont want to have to type the username and password every time you start the editor?
// Set the two variables below to the values you want to be in the form when you start it up.
// (default login: admin  pw: password)
//$login = 'admin';
//$password = 'password';

// Log SQL queries:  1 = on, 0 = off
$logging = 1;

// $log_file = path to the file your sql logs will be saved in.
// If you want a single log file, uncomment next line and comment the two monthly log options.
//$log_file = "logs/sql_log.sql";

// Automatically create new logs monthly.
$filetime = date("m-Y");
$log_file = "logs/sql_log_$filetime.sql";

// Log all MySQL queries (If disabled only write entries are logged - recommended.)
$log_all = 0;

// Log all MySQL queries that result in an error.
$log_error = 1;

// Enable or disable user logins.
$enable_user_login = 1;

// Enable or disable read only guest mode log in.
$enable_guest_mode = 1;

// Path for quests without trailing slash.
$quest_path = "/home/administrator/run/quests"

?>