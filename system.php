<meta charset="utf-8">
<?php
        session_start();
        include("mysql_connect.inc.php");
        $usname=$_SESSION['username'];
        $_SESSION['week']=0;
        if(isset($_POST["class"]))
        {
                $_SESSION['class']=$_POST['class'];
                echo '<meta http-equiv=REFRESH CONTENT=1;url=A203.php>';
        }
        $sql = "SELECT * FROM rule";
		$result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $sql = "SELECT * FROM users where user = '$usname'";
        $result = mysqli_query($conn, $sql);
        $userInfo = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>

<head>
        <title>教室借用系統</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="systemStyle.css">
        <style>
        body
        {
                 background-color: #CFD7FF;
        }
        .rule
        {
                 background-color: #ffffff;
        }
        </style>
</head>
<body>
        <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()"> &times;</button>
        <a href="reserve.php" class="w3-bar-item w3-button">借用教室</a>
        <a href="reserveRecord.php" class="w3-bar-item w3-button">借用紀錄</a>
        <a href="logout.php" class="w3-bar-item w3-button">登出</a>
</div>

<div id="main">

<div class="w3-teal">
        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
</div>

        <h>目前使用者:<?php echo $_SESSION['username']; ?></h><br><br>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <p>教室列表</p>
        <select name="class">
                <option value="A203">A203</option>
                <option value="A204">A204</option>
                <option value="A205">A205</option>
                <option value="A206">A206(AR)</option>
                <option value="A207">A207(AR)</option>
                <option value="A208">A208(AR)</option>
                <option value="A209">A209</option>
                <option value="A210">A210</option>
                <option value="A211">A211</option>
                <option value="A212">A212</option>
                <option value="A303">A303</option>
                <option value="A306">A306</option>
                <option value="B217">B217(AR)</option>
        </select>
        <input type="submit" value="gogo"><br><br>
        </form>
        <div class="rule">
        <p> <?php echo $row['rule']; ?> </p><br>
        </div>
        <?php
                if($userInfo['identity']!='S')
                        echo "<a href='editRule.php'>編輯</a><br>"
        ?>
        <script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "25%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>
    </body>
</html>
