

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
	<title>註冊</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<p>帳號: </p>
        <input type="text" name="user" value="user"><br>
        <p>密碼: </p>
        <input type="password" name="password" value="password"><br>
        <p>再次輸入密碼: </p>
        <input type="password" name="password_again" value="password"><br>
    	<p>身分: </p>
        <select name="Identity">
		　<option value="S">學生</option>
		　<option value="A">行政人員</option>
		　<option value="R">管理員(不建議)</option>
		</select>
		<input type="submit" value="register"><br><br>
    </form>
<?php
include("mysql_connect.inc.php");
$us = $_POST['user'];
$pw = $_POST['password'];
$pw2 = $_POST['password_again'];
$auth = $_POST['Identity'];

$sql = "SELECT * FROM users WHERE user = '$us'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if($us == $row['user'])
{
	echo "帳號已存在";
}
elseif(strlen($pw)<=8)
{
	echo "密碼長度需大於8";
	echo '<meta http-equiv=REFRESH CONTENT=1;url=rigister.php>';	
}
elseif($us != null && $pw != null && $row['user'] == $us && $row['password'] == $pw && $pw == $pw2)
{
	$sql = "INSERT INTO users(user, password, identity) VALUES ('$us', '$pw', '$auth')";
	if(mysqli_query($conn, $sql))
	{
	        echo "註冊成功";
	        echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
	}
	else
	{
	        echo "新增失敗";
	        echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
	}
}
else
{
	echo "註冊失敗";
	echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
}
$cnon->close();

?>
</body>
</html>