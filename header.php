<?php 
$server = '127.0.0.1:3306';
$user = 'root';
$pass = '';
$dbname = 'DungeonsAndDragonDB';
$con = mysqli_connect($server, $user, $pass, $dbname) or die("Can't connect");
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
?>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<style>
	.bannerClass{
		margin-bottom: 30px;
	}
	</style>
</head>
<body class="container" style="margin-bottom: 300px;">
	<div class="bannerClass">
		<a href="index.php">Home Page</a> | 
		<a href="CreateCharacter.php">Create Character</a> | 
		<a href="addItems.php";> Add Items</a> | 
		<a href="notes.php";> Notes</a> 
	</div>