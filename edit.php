<meta charset="utf-8">
<?php
	session_start();
	include("mysql_connect.inc.php");
	$us=$_SESSION['username'];
	$sql = "SELECT * FROM reserveClass where userName = '$us'";
    $result = mysqli_query($conn, $sql);
    $i=$_POST['data'];
	for($k=0; $k<$i; $k++)
	{
		$row = mysqli_fetch_object($result);
	}

	$da=$row->date;
	$timelist = array('08:50:00', '09:50:00', '10:50:00', '11:50:00', '12:50:00', '13:50:00', '14:50:00', '15:50:00', '16:50:00', '17:50:00', '18:50:00', '19:50:00', '20:50:00', '21:50:00');
	$timeNow = mktime();
	$editTime = strtotime($da.' '.$timelist[$row->time-1]);
    
    if($timeNow - $editTime > 0)
	{
		echo "超過時間囉";
		echo '<meta http-equiv=REFRESH CONTENT=1;url=reserveRecord.php>';
	}
    elseif(isset($_POST["edit"]))
    {
        $edit=1;
        $_SESSION['user']=$row->user;
        $_SESSION['time']=$row->time;
        $_SESSION['date']=$row->date;
        $_SESSION['phone']=$row->phone;
        $_SESSION['event']=$row->event;
        $_SESSION['class']=$row->class;
        echo '<meta http-equiv=REFRESH CONTENT=1;url=editPage.php>';
    }
    elseif(isset($_POST["delete"]))
    {
    	$sql = "DELETE FROM `reserveClass` WHERE userName= '$us' && date= '$row->date' && time= '$row->time' && class= '$row->class' ";
    	if(mysqli_query($conn, $sql))
    	{
    		echo "刪除成功";
    	}
        echo '<meta http-equiv=REFRESH CONTENT=1;url=reserveRecord.php>';
    }
    $cnon->close();

?>