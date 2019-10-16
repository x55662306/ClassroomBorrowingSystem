<?php session_start(); ?>
<meta charset= "utf-8" >
<?php

include("mysql_connect.inc.php");
$us = $_POST['user'];
$pw = $_POST['password'];

$sql = "SELECT * FROM users where user = '$us'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


if($us != null && $pw != null && $row['user'] == $us && $row['password'] == $pw)
{
        $_SESSION['username'] = $us;
        echo "登入成功!";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=system.php>';
}
else
{
        echo "登入失敗!";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
}
$cnon->close();
?>