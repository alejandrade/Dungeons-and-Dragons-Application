<?php
$server = '127.0.0.1:3306';
$user = 'root';
$pass = '';
$dbname = 'DungeonsAndDragonDB';
$con = mysqli_connect($server, $user, $pass, $dbname) or die("Can't connect");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
$sth = mysqli_query($con,"SELECT player_name, id FROM DungeonsAndDragonDB.players;");
$itemList = array();
while($r = mysqli_fetch_assoc($sth)) {
	$itemList[] = $r;
}
echo json_encode($itemList);
mysqli_close($con);
?>