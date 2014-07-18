#!/usr/bin/perl

# -------------------------------------------------------
# Generate Loot from web crawled/parsed Magelo Data origionally by Akkadius and altered by cavedude
# -------------------------------------------------------
use DBI;
use DBD::mysql;

$host = 'localhost';
$user = 'user';
$pass = 'pass';
$db = 'eqemu';

# PERL DBI CONNECT
$dsn = "dbi:mysql:$db:$host:3306";
if(!$connect){ $connect = DBI->connect($dsn, $user, $pass); }

################################################################
# SCRIPT OPTIONS
################################################################

$NPCID = $ARGV[0];
chomp $NPCID;
$mincash = 1;
$maxcash = 100;
$cashbylevel = 1;
$minactual = 1;

if(!defined $ARGV[0])
{
	print "Usage: perl Loot.pl <NPCID>\n";
	exit;
}

$zoneid = substr($NPCID, 0, -3);

$query_handle = $connect->prepare("SELECT `short_name` from zone WHERE zoneidnumber = $zoneid LIMIT 1;"); $query_handle->execute();

	while (@row = $query_handle->fetchrow_array()){
		$ZoneName = $row[0];
	}

if(!defined $ZoneName)
{
	print "Error getting zone name!\n";
	exit;
}

$query_handle1 = $connect->prepare("SELECT `name`, `bodytype`, `level` FROM `npc_types` WHERE id = $NPCID LIMIT 1;"); $query_handle1->execute();

while (@row1 = $query_handle1->fetchrow_array()){
	$NPCName = $row1[0];
	$bodytype = $row1[1];
	$level = $row1[2];
}

$MageloName = $NPCName; $MageloName =~ s/_/ /g; $MageloName =~ s/#//g;

### This will define when a new Lootdrop boundary or group is defined...
### The script will iterate through all the loot an NPC has and start a new lootdrop ID at each percentage
%LootDropRanges = (
	1 => [1],
	2 => [34],
	3 => [99],
	4 => [100],
);
$LootDropNum = 1;

$query_handle2 = $connect->prepare("SELECT `loottable_id` FROM `npc_types` WHERE id = $NPCID LIMIT 1;"); $query_handle2->execute();
while (@row2 = $query_handle2->fetchrow_array()){
	$loottable_id = $row2[0];
}

if(!defined $loottable_id)
{
	print "No Loottable!\n";
	exit;
}

@banneditems = ();
$query_handle10 = $connect->prepare("select id from items where name like '%defiant%' and reqlevel > 26 and reclevel > 40;"); $query_handle10->execute();
while (@row10 = $query_handle10->fetchrow_array()){
	push(@banneditems,$row10[0]);
}

if($loottable_id != 0)
{	
	@lootdrops = ();
	$query_handle3 = $connect->prepare("SELECT `lootdrop_id` from loottable_entries where loottable_id = $loottable_id;"); $query_handle3->execute();
	while (@row3 = $query_handle3->fetchrow_array()){
		push(@lootdrops,$row3[0]);
	}
	@joinedlootdrops = join( ',', @lootdrops );

	@useditems = ();
	$query_handle4 = $connect->prepare("SELECT `item_id` from lootdrop_entries where lootdrop_id in (@joinedlootdrops);"); $query_handle4->execute();
	while (@row4 = $query_handle4->fetchrow_array()){
		push(@useditems,$row4[0]);
	}
	@joineduseditems = join( ',', @useditems );

	$query_handle5 = $connect->prepare("SELECT MAX(id) + 1 FROM `lootdrop`"); $query_handle5->execute();
	while (@row5 = $query_handle5->fetchrow_array()){
		$lootdropid = $row5[0]
	}
	$startlootdropid = $lootdropid;
				
	### Create the actual Lootdrop Entry
	$query_handle6 = $connect->prepare("INSERT INTO `lootdrop` (id, name) VALUES (?, ?);");
	$query_handle6->execute($lootdropid, $lootdropid . _ . $NPCName . "_MAGELO-GEN");
		
	### loottable_entries generation
	$query_handle7 = $connect->prepare("INSERT INTO `loottable_entries` (loottable_id, lootdrop_id, multiplier, probability, mindrop, droplimit) VALUES (?, ?, ?, ?, ?, ?);");
	$query_handle7->execute($loottable_id, $lootdropid, 1, 100, 0, 0);
		
	$query_handle = $connect->prepare("SELECT
	magelo_npc_loot_parse.itemid,
	magelo_npc_loot_parse.Type,
	magelo_npc_loot_parse.drop_actual,
	magelo_npc_loot_parse.drop_max,
	magelo_npc_loot_parse.drop_rate
	FROM
	magelo_npc_loot_parse
	WHERE magelo_npc_loot_parse.zoneid = '". $zoneid . "'
	AND magelo_npc_loot_parse.npc_name = '". $MageloName . "'
	AND magelo_npc_loot_parse.itemid NOT in (@joineduseditems)
	ORDER by magelo_npc_loot_parse.drop_rate;"); $query_handle->execute();

	$Drops = 0;
	while (@row = $query_handle->fetchrow_array()){
		$stacksize = 1;
		$equip = 0;
		$disabled_rate = 0;
		($itemid, $Type, $drop_actual, $drop_max) = ($row[0], $row[1], $row[2], $row[3]);
		$droprate = ($drop_actual/$drop_max)*100;
		$drop_rate = sprintf("%.3f", $droprate);
	
		$query_handle4 = $connect->prepare("SELECT count(*) AS count from items where id = $itemid AND stacksize > 1 AND price < 20000;"); $query_handle4->execute();
		while (@row4 = $query_handle4->fetchrow_array()){
			$stackcount = $row4[0];
		}
		if($stackcount == 1)
		{
			$stacksize = 2;
		}

		$query_handle5 = $connect->prepare("SELECT slots, augtype FROM items WHERE id=$itemid;"); $query_handle5->execute();
 		while (@row5 = $query_handle5->fetchrow_array()){

  			$slots = $row5[0];
  			$augment = $row5[1];
		}

  		if ($slots > 0 && $augment == 0) 
		{
    			$equip = 1;
  		}

		$bannedsize = @banneditems;
		$banned = 0;
		while ($banned<$bannedsize)
		{
			if($itemid == $banneditems[$banned])
			{
				$disabled_rate = $drop_rate;
				$drop_rate = 0;
				break;
			}
			$banned++;
		}
	
		if($drop_rate > $LootDropRanges{$LootDropNum}[0])
		{
			### Lootdrop Generation - Incremenet based on Lootdrop groups from hash
			$lootdropid++;
				
			$query_handle3 = $connect->prepare("INSERT INTO `loottable_entries` (loottable_id, lootdrop_id, multiplier, probability, mindrop, droplimit) VALUES (?, ?, ?, ?, ?, ?);");
			$query_handle3->execute($loottable_id, $lootdropid, 1, 100, 0, 0);

			$query_handle3 = $connect->prepare("INSERT INTO `lootdrop` (id, name) VALUES (?, ?);");
			$query_handle3->execute($lootdropid, $lootdropid . _ . $NPCName . "_MAGELO-GEN");
			$LootDropNum++;
		}
		if($drop_actual => $minactual)
		{
			### lootdrop_entries generation
			$query_handle3 = $connect->prepare("INSERT INTO `lootdrop_entries` (lootdrop_id, item_id, item_charges, equip_item, chance, disabled_chance, minlevel, maxlevel, multiplier) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
			$query_handle3->execute($lootdropid, $itemid, 1, $equip, $drop_rate, $disabled_rate, 0, 127, $stacksize);
			$Drops++;
		}
	}
	$cleanup = 0;
	while ($cleanup<4)
	{
		$query_handle3 = $connect->prepare("SELECT count(*) from lootdrop_entries where lootdrop_id = $startlootdropid"); $query_handle3->execute(); 
		while (my @row = $query_handle3->fetchrow_array())  {
			$count = $row[0];
		}
		if($count == 0)
		{
			$query_handle4 = $connect->prepare("DELETE FROM `loottable_entries` WHERE loottable_id = $loottable_id AND lootdrop_id = $startlootdropid"); $query_handle4->execute(); 
		}
		$startlootdropid++;
		$cleanup++;
	}
	print "$Drops item drops added to $NPCName!\n";
}
else
{	
	$loottable_id = 0;
	$query_handle12 = $connect->prepare("SELECT count(*) FROM magelo_npc_loot_parse WHERE magelo_npc_loot_parse.zoneid = $zoneid AND magelo_npc_loot_parse.npc_name = '". $MageloName . "';"); $query_handle12->execute();
	while (@row = $query_handle12->fetchrow_array()){
		$lootcount = $row[0]
	}

	if($lootcount > 0)
	{
		$query_handle4 = $connect->prepare("SELECT MAX(id) + 1 FROM `loottable`"); $query_handle4->execute();
		while (@row4 = $query_handle4->fetchrow_array()){
			$loottable_id = $row4[0]
		}

		$query_handle5 = $connect->prepare("SELECT MAX(id) + 1 FROM `lootdrop`"); $query_handle5->execute();
		while (@row5 = $query_handle5->fetchrow_array()){
			$lootdropid = $row5[0]
		}
		$startlootdropid = $lootdropid;

		if($bodytype < 35 && $bodytype != 0 && $bodytype != 10 && $bodytype != 11 && $bodytype != 17 && $bodytype != 18 && $bodytype != 21 && $bodytype != 22 && $bodytype != 23 && $bodytype != 25)
		{
			$nmincash = $mincash;
			$nmincash = $mincash;
			if($cashbylevel)
			{
				$nmincash = $mincash*$level;
				$nmaxcash = $maxcash*$level;
			}
			$query_handle3 = $connect->prepare("INSERT INTO `loottable` (id, name, mincash, maxcash) VALUES (?, ?, ?, ?);");
			$query_handle3->execute($loottable_id, $loottable_id . _ . $NPCName . "_MAGELO-GEN", $nmincash, $nmaxcash);
		}
		else
		{
			$query_handle3 = $connect->prepare("INSERT INTO `loottable` (id, name) VALUES (?, ?);");
			$query_handle3->execute($loottable_id, $loottable_id . _ . $NPCName . "_MAGELO-GEN");
		}

		### Create the actual Lootdrop Entry
		$query_handle6 = $connect->prepare("INSERT INTO `lootdrop` (id, name) VALUES (?, ?);");
		$query_handle6->execute($lootdropid, $lootdropid . _ . $NPCName . "_MAGELO-GEN");
		
		### loottable_entries generation
		$query_handle7 = $connect->prepare("INSERT INTO `loottable_entries` (loottable_id, lootdrop_id, multiplier, probability, mindrop, droplimit) VALUES (?, ?, ?, ?, ?, ?);");
		$query_handle7->execute($loottable_id, $lootdropid, 1, 100, 0, 0);

		$query_handle = $connect->prepare("SELECT
		magelo_npc_loot_parse.itemid,
		magelo_npc_loot_parse.Type,
		magelo_npc_loot_parse.drop_actual,
		magelo_npc_loot_parse.drop_max,
		magelo_npc_loot_parse.drop_rate
		FROM
		magelo_npc_loot_parse
		WHERE magelo_npc_loot_parse.zoneid = '". $zoneid . "'
		AND magelo_npc_loot_parse.npc_name = '". $MageloName . "'
		ORDER by magelo_npc_loot_parse.drop_rate;"); $query_handle->execute();

		$Drops = 0;
		while (@row = $query_handle->fetchrow_array()){
			$stacksize = 1;
			$equip = 0;
			$disabled_rate = 0;
			($itemid, $Type, $drop_actual, $drop_max) = ($row[0], $row[1], $row[2], $row[3]);
			$droprate = ($drop_actual/$drop_max)*100;
			$drop_rate = sprintf("%.3f", $droprate);
	
			$query_handle4 = $connect->prepare("SELECT count(*) AS count from items where id = $itemid AND stacksize > 1 AND price < 20000;"); $query_handle4->execute();
			while (@row4 = $query_handle4->fetchrow_array()){
				$stackcount = $row4[0];
			}
			if($stackcount == 1)
			{
				$stacksize = 2;
			}

			$query_handle5 = $connect->prepare("SELECT slots, augtype FROM items WHERE id=$itemid;"); $query_handle5->execute();
 			while (@row5 = $query_handle5->fetchrow_array()){

  				$slots = $row5[0];
  				$augment = $row5[1];
			}

  			if ($slots > 0 && $augment == 0) 
			{
    				$equip = 1;
  			}

			$bannedsize = @banneditems;
			$banned = 0;
			while ($banned<$bannedsize)
			{
				if($itemid == $banneditems[$banned])
				{
					$disabled_rate = $drop_rate;
					$drop_rate = 0;
					break;
				}
				$banned++;
			}
	
			if($drop_rate > $LootDropRanges{$LootDropNum}[0])
			{
				### Lootdrop Generation - Incremenet based on Lootdrop groups from hash
				$lootdropid++;
				
				$query_handle3 = $connect->prepare("INSERT INTO `loottable_entries` (loottable_id, lootdrop_id, multiplier, probability, mindrop, droplimit) VALUES (?, ?, ?, ?, ?, ?);");
				$query_handle3->execute($loottable_id, $lootdropid, 1, 100, 0, 0);

				$query_handle3 = $connect->prepare("INSERT INTO `lootdrop` (id, name) VALUES (?, ?);");
				$query_handle3->execute($lootdropid, $lootdropid . _ . $NPCName . "_MAGELO-GEN");
				$LootDropNum++;
			}
			if($drop_actual => $minactual)
			{
				### lootdrop_entries generation
				$query_handle3 = $connect->prepare("INSERT INTO `lootdrop_entries` (lootdrop_id, item_id, item_charges, equip_item, chance, disabled_chance, minlevel, maxlevel, multiplier) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
				$query_handle3->execute($lootdropid, $itemid, 1, $equip, $drop_rate, $disabled_rate, 0, 127, $stacksize);
				$Drops++;
			}
		}
		$query_handle11 = $connect->prepare("UPDATE `npc_types` SET `loottable_id` = $loottable_id WHERE `name` = '$NPCName' AND `id`  >= ($zoneid * 1000) AND `id` <= (($zoneid * 1000) + 999) AND `loottable_id` = '0'"); $query_handle11->execute();

		$cleanup = 0;
		while ($cleanup<4)
		{
			$query_handle3 = $connect->prepare("SELECT count(*) from lootdrop_entries where lootdrop_id = $startlootdropid"); $query_handle3->execute(); 
			while (my @row = $query_handle3->fetchrow_array())  {
				$count = $row[0];
			}
			if($count == 0)
			{
				$query_handle4 = $connect->prepare("DELETE FROM `loottable_entries` WHERE loottable_id = $loottable_id AND lootdrop_id = $startlootdropid"); $query_handle4->execute(); 
			}
			$startlootdropid++;
			$cleanup++;
		}
		print "$Drops item drops added $NPCName!\n";
	}
	else
	{
		print "No item drops to add to $NPCName!\n";
	}
}



