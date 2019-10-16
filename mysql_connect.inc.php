<meta charset="utf-8">
<?php
//資料庫設定
//資料庫位置
$db_server = "localhost";
//資料庫名稱
$db_name = "snmg";
//資料庫管理者帳號
$db_user = "root";
//資料庫管理者密碼
$db_passwd = "x55662306";

//對資料庫連線
$conn = new mysqli($db_server, $db_user, $db_passwd, $db_name);

if($conn->connect_error)
{

	die("Connection failed: " . $conn->connect_error);
}
?> 