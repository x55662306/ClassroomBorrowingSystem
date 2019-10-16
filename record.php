<?php 
	session_start(); 
	include("mysql_connect.inc.php");
	$us = $_SESSION['username'];
	$sql = "SELECT * FROM reserveClass where user = '$us'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	echo $row;
	
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
	<title>教室借用系統</title>
</head>
	<body>
	
    </body>
</html>