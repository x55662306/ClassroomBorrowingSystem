<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
	<title>編輯中</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<p>使用者姓名: </p>
        <input type="text" name="user" value="<?php echo $_SESSION['user'] ?>" ><br>
        <p>連絡電話: </p>
        <input type="text" name="phone" value= "<?php echo $_SESSION['phone'] ?>" ><br>
        <p>借用教室:  </p>
        <select name="class" value= "<?php echo $_SESSION['class'] ?>" >
			<option value="A203">A203</option>
			<option value="A204">A204</option>
			<option value="A205">A205</option>
			<option value="A206">A206 (AR)</option>
			<option value="A207">A207 (AR)</option>
			<option value="A208">A208 (AR)</option>
			<option value="A209">A209</option>
			<option value="A210">A210</option>
			<option value="A211">A211</option>
			<option value="A212">A212</option>
			<option value="A303">A303</option>
			<option value="A306">A306</option>
			<option value="B217">B217 (AR)</option>
		</select><br>
    	<p>借用日期: </p>
    	<input type="date" name="date" value= "<?php echo $_SESSION['date'] ?>"><br>
    	<p>借用時段: </p>
        <select name="time" value= "<?php echo $_SESSION['time'] ?>">
			<option value="1">1 08:00 - 08:50 AM</option>
			<option value="2">2 09:00 - 09:50 AM</option>
			<option value="3">3 10:00 - 10:50 AM</option>
			<option value="4">4 11:00 - 11:50 AM</option>
			<option value="5">Z 12:00 - 12:50 PM</option>
			<option value="6">5 13:00 - 13:50 PM</option>
			<option value="7">6 14:00 - 14:50 PM</option>
			<option value="8">7 15:00 - 15:50 PM</option>
			<option value="9">8 16:00 - 16:50 PM</option>
			<option value="10">9 17:00 - 17:50 PM (AR)</option>
			<option value="11">A 18:00 - 18:50 PM (AR)</option>
			<option value="12">B 19:00 - 19:50 PM (AR)</option>
			<option value="13">C 20:00 - 20:50 PM (AR)</option>
			<option value="14">D 21:00 - 21:50 PM (AR)</option>
		</select><br>
		<p>借用事由:  </p>
        <input type="text" name="event" value= "<?php echo $_SESSION['event'] ?>" ><br><br>
		<input type="submit" value="編輯完成"><br><br>
    </form>
    <a href="reserveRecord.php">返回</a><br>
	<?php
		include("mysql_connect.inc.php");
		session_start();
		$timelist = array('08:50:00', '09:50:00', '10:50:00', '11:50:00', '12:50:00', '13:50:00', '14:50:00', '15:50:00', '16:50:00', '17:50:00', '18:50:00', '19:50:00', '20:50:00', '21:50:00');
		$us = $_POST['user'];
		$ph = $_POST['phone'];
		$cl = $_POST['class'];
		$da = $_POST['date'];
		$t  = $_POST['time'];
		$ev  = $_POST['event'];
		$usname = $_SESSION['username'];
		$oldUs = $_SESSION['user'];
		$oldPh = $_SESSION['phone'];
		$oldCl = $_SESSION['class'];
		$oldDa = $_SESSION['date'];
		$oldT = $_SESSION['time'];
		$oldEv = $_SESSION['event'];
		$timeNow = mktime();
		$reserveTime = strtotime($da.' '.$timelist[$t]);
		$sql = "SELECT * FROM users where user = '$usname'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);

		
		if($us==null || $ph==null || $ev==null)
			echo "欄位不得有空值";
		elseif($timeNow - $reserveTime > 0)
			echo "超過時間囉";
		elseif( ($cl=="A206" || $cl=="A207" || $cl=="A208" || $cl=="B217") && row['identity']=='S')
			echo "無權限借用此教室";
		elseif( (date('w', $reserveTime)==0 || date('w', $reserveTime)==6 || $t=="10" || $t=="11" || $t=="12" || $t=="13" || $t=="14") && row['identity']=='S')
			echo "無此權限選用此時間";
		else
		{
			$sql = "SELECT * FROM reserveClass where class = '$cl' && date = '$da' && time = '$t'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			if($row['user']==null)
			{
				$sql = "UPDATE reserveClass SET user='$us', phone='$ph', date='$da', time='$t',event='$ev', class='$cl', userName='$usname' WHERE user='$oldUs' && phone='$oldPh' && date='$oldDa' && time='$oldT' && event='$oldEv' && class='$oldCl' && userName='$usname'";
				if(mysqli_query($conn, $sql))
				{
					echo "更改成功";
					echo '<meta http-equiv=REFRESH CONTENT=1;url=system.php>';
				}
				else
					echo "更改失敗";
			}
			else
				echo "此時間已有人預訂";
		}
		$cnon->close();

	?>
	</body>
</html>