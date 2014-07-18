#!/usr/bin/perl

# -------------------------------------------------------
# Generate Coords from web crawled/parsed Magelo Data
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
$spawngroupinsert = $ARGV[1];
chomp $spawngroupinsert;
$Limit = $ARGV[2];
chomp $Limit;
$spawnlimit = $ARGV[3];
chomp $spawnlimit;
$heading = $ARGV[4];
chomp $heading;
$respawntime = $ARGV[5];
chomp $respawntime;
$mincoord = $ARGV[6];
chomp $mincoord;
$maxcoord = $ARGV[7];
chomp $maxcoord;
$forcedz = $ARGV[8];
chomp $forcedz;

if(!defined $ARGV[0])
{
	print "Usage: perl GenerateCoordsFromMagelo.pl <NPCID> (insert) (limit) (spawnlimit) (heading) (respawntime) (min x/y) (max x/y) (forcedz)\n";
	exit;
}

if(!defined $ARGV[1])
{
	$spawngroupinsert = 0;
}

if(!defined $ARGV[2])
{
	$Limit = 1;
}

if(!defined $ARGV[3])
{
	$spawnlimit = 0;
}

if(!defined $ARGV[4])
{
	$heading = 0;
}

if(!defined $ARGV[5])
{
	$respawntime = 0;
}

if(!defined $ARGV[6])
{
	$mincoord = -20000;
}

if(!defined $ARGV[7])
{
	$maxcoord = 20000;
}

if(!defined $ARGV[8])
{
	$forcedz = 0;
}

$z_coord_x = 100;
$z_coord_y = 100;
$exist_x = 10;
$exist_y = 10;
$spawngroup_x = 25;
$spawngroup_y = 25;

$ZoneID = substr($NPCID, 0, -3);

$query_handle = $connect->prepare("SELECT `short_name` from zone WHERE zoneidnumber = $ZoneID LIMIT 1;"); $query_handle->execute();

	while (@row = $query_handle->fetchrow_array()){
		$ZoneName = $row[0];
	}

if(!defined $ZoneName)
{
	print "Error getting zone name!\n";
	exit;
}

$query_handle1 = $connect->prepare("SELECT `name` FROM `npc_types` WHERE id = $NPCID LIMIT 1;"); $query_handle1->execute();

	while (@row1 = $query_handle1->fetchrow_array()){
		$NPCName = $row1[0];
	}

$MageloName = $NPCName; $MageloName =~ s/_/ /g; 
@all_x = ();
@all_y = ();
$count = 0;
$insertcount = 0;
$totalcount = 0;
$newspawngroupid = &get_max_spawnid;

$query_handle2 = $connect->prepare("SELECT
	magelo_npc_map_coords.x,
	magelo_npc_map_coords.y,
	magelo_npc_map_coords.genid 
	FROM
	magelo_npc_map_coords
	WHERE magelo_npc_map_coords.zoneid = '". $ZoneID . "'
	AND magelo_npc_map_coords.npc_name = '". $MageloName . "'
	AND magelo_npc_map_coords.x >= $mincoord
	AND magelo_npc_map_coords.x <= $maxcoord 
	AND magelo_npc_map_coords.y >= $mincoord
	AND magelo_npc_map_coords.y <= $maxcoord
       AND magelo_npc_map_coords.done = 0
	limit $Limit"); $query_handle2->execute();

while (@row2 = $query_handle2->fetchrow_array()){

	$adjx = 0;
	$adjy = 0;

	if($row2[0] < 0)
	{
		$adjx = -($row2[0]);
	}
	if($row2[0] > 0)
	{
		$adjx = -$row2[0];
	}
	if($row2[1] < 0)
	{
		$adjy = -($row2[1]);
	}
	if($row2[1] > 0)
	{
		$adjy = -$row2[1];
	}

	push(@all_x,int($adjx));
	push(@all_y,int($adjy));
	push(@genids,$row2[2]);
}

@joinedgenids = join( ',', @genids );
$query_handle14 = $connect->prepare("UPDATE magelo_npc_map_coords SET done=3 WHERE genid in (@joinedgenids);"); $query_handle14->execute();

$sizeofall = @all_x;
if($sizeofall < 1)
{
	print "No coords found for $NPCName.\n";
	exit;
}

else
{
	$a = 0;
	while ($a < $sizeofall)
	{	
		$x = $all_x[$a]; $y = $all_y[$a]; $genid = $genids[$a];
		$totalcount++;
		if($spawngroupinsert == 1)
		{
			$spawngroupid = 0;
			$minx = $x-$spawngroup_x;
			$maxx = $x+$spawngroup_x;
			$miny = $y-$spawngroup_y;
			$maxy = $y+$spawngroup_y;
			$query_handle3 = $connect->prepare("SELECT spawngroupid FROM spawn2 where zone = '". $ZoneName . "' AND x >= $minx AND x <= $maxx AND y >= $miny AND y <= $maxy limit 1;"); $query_handle3->execute();

			while (@row3 = $query_handle3->fetchrow_array()){
				$spawngroupid = $row3[0];

 				while (@row4 = $query_handle4->fetchrow_array) {
					$spawncount = $row4[0];
 				} 
				if($spawncount > 0)
				{
					$spawngroupid = 0;
				}
			}
			if($spawngroupid > 0)
			{
				$query_handle4 = $connect->prepare("REPLACE INTO spawnentry VALUES ($spawngroupid,$NPCID,0);"); $query_handle4->execute();
				$query_handle14 = $connect->prepare("UPDATE magelo_npc_map_coords SET done=2 WHERE genid = $genid;"); $query_handle14->execute();
				&balance_spawns($spawngroupid);
				$insertcount++;
				$count++;
			}
			else
			{
				&get_z($x,$y,$a,$forcedz,$genid);
			}
		}
		else
		{
			&get_z($x,$y,$a,$forcedz,$genid);
		}
		$a++;
	}
	print "$count matches of $totalcount found for $MageloName! $insertcount of those were inserted.\n";
}

sub balance_spawns
{
	my $spawngroupid = $_[0];

	$query_handle4 = $connect->prepare("SELECT count(npcid) as count from spawnentry where spawngroupid = $spawngroupid;"); $query_handle4->execute();

 	while (@row4 = $query_handle4->fetchrow_array) {
		$spawncount = $row4[0];
 	} 							

	$remainder = 100 % $spawncount;
  	$base = int(100 / $spawncount);
  	$x = $spawncount - $remainder;

	$sql = "SELECT npcid as npid FROM spawnentry WHERE spawngroupID = $spawngroupid"; $query_handle5 = $connect->prepare($sql);
 	$results5 = $connect->selectall_hashref($sql, "npid");

	foreach my $npid (sort(keys %$results5))
	{
		$npid = $results5->{$npid}->{npid};
		if($x > 0)
		{	
			$chance = $base;
      			$x--;
		}
		else
		{
			$chance = $base + 1;
		}
		$query_handle6 = $connect->prepare("UPDATE spawnentry SET chance=$chance WHERE spawngroupID=$spawngroupid AND npcID=$npid;"); $query_handle6->execute();
	}
}

sub get_z
{
	my $x = $_[0];
	my $y = $_[1];
	my $a = $_[2];
	my $forcedz = $_[3];
	my $genid = $_[4];
	my $z = undef;

	if($forcedz == 0)
	{
		$minx = $x-$z_coord_x;
		$maxx = $x+$z_coord_x;
		$miny = $y-$z_coord_y;
		$maxy = $y+$z_coord_y;
		$good_coord = 0;

		$query_handle3 = $connect->prepare("SELECT z FROM spawn2 where zone = '". $ZoneName . "' AND x >= $minx AND x <= $maxx AND y >= $miny AND y <= $maxy limit 1;"); $query_handle3->execute();

		while (@row3 = $query_handle3->fetchrow_array()){
			$z = $row3[0];
		}
	}

	if($forcedz != 0)
	{
		$z = $forcedz;
	}

	if(defined $z)
	{
		&check_distance($x,$y,$z,$a,$genid);	
	}
}

sub check_distance
{
	my $x = $_[0];
	my $y = $_[1];
	my $z = $_[2];
	my $a = $_[3];
	my $genid = $_[4];

	$minx = $x-$exist_x;
	$maxx = $x+$exist_x;
	$miny = $y-$exist_y;
	$maxy = $y+$exist_y;

	$arraysize = @all_x;

	$b = $a+1;
	while ($b<$arraysize)
	{
		$badcount = 0;
		$query_handle5 = $connect->prepare("SELECT count(*) AS badcount FROM spawn2 where zone = '". $ZoneName . "' AND x >= $minx AND x <= $maxx AND y >= $miny AND y <= $maxy;"); $query_handle5->execute();

		while (@row5 = $query_handle5->fetchrow_array()){
			$badcount = $row5[0];
		}

		if($badcount == 0 && !($all_x[$b] >= $minx && $all_x[$b] <= $maxx && $all_y[$b] >= $miny && $all_y[$b] <= $maxy))
		{
			if($count-$insertcount == 0)
			{
				$spawnname = "$NPCID$NPCName$a";
				$query_handle4 = $connect->prepare("INSERT INTO spawngroup (id,name,spawn_limit) VALUES ($newspawngroupid,'$spawnname',$spawnlimit);"); $query_handle4->execute();
				$query_handle4 = $connect->prepare("INSERT INTO spawnentry VALUES ($newspawngroupid,$NPCID,100);"); $query_handle4->execute();
				$query_handle4 = $connect->prepare("INSERT INTO spawn2 (spawngroupid,zone,x,y,z,heading,respawntime) VALUES ($newspawngroupid,'$ZoneName',$x,$y,$z,$heading,$respawntime);"); $query_handle4->execute();
				$query_handle14 = $connect->prepare("UPDATE magelo_npc_map_coords SET done=1 WHERE genid = $genid;"); $query_handle14->execute();
				$count++;
				return;
			}
			else
			{
				$query_handle4 = $connect->prepare("INSERT INTO spawn2 (spawngroupid,zone,x,y,z,heading,respawntime) VALUES ($newspawngroupid,'$ZoneName',$x,$y,$z,$heading,$respawntime);"); $query_handle4->execute();
				$query_handle14 = $connect->prepare("UPDATE magelo_npc_map_coords SET done=1 WHERE genid = $genid;"); $query_handle14->execute();
				$count++;
				return;
			}
		}
		$b++;
	}
}

sub get_max_spawnid
{
	$query_handle4 = $connect->prepare("SELECT max(id)+1 FROM spawngroup;"); $query_handle4->execute();

 	while (@row4 = $query_handle4->fetchrow_array) {
		$spawngroupid = $row4[0];
 	} 

	if(!defined $spawngroupid)
	{
		$spawngroupid = 1;
	}
 
	return($spawngroupid);
}