<?php
$server = '127.0.0.1:3306';
$user = 'root';
$pass = '';
$dbname = 'DungeonsAndDragonDB';
$con = mysqli_connect($server, $user, $pass, $dbname) or die("Can't connect");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
$useName  = "";
if(isset($_POST["userName"])){
	$useName = addslashes($_POST["userName"]);
}else{
	$useName = "Error";
}
$sth = mysqli_query($con,"SELECT item_name, description FROM item  join players p on p.id = item.players_id and p.player_name = '$useName';");
$itemList = array();
while($r = mysqli_fetch_assoc($sth)) {
	$itemList[] = $r;
}
echo json_encode($itemList);
mysqli_close($con);
?>
