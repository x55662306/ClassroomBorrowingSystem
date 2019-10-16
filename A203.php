<meta charset="utf-8">

<?php
session_start();
include("mysql_connect.inc.php");
$class = $_SESSION['class'];
$dateNow=date('Y-m-d');
$first=0;
$w=date('w',strtotime($dateNow));
$dateStart=date('Y-m-d',strtotime("$date -".($w ? $w - $first : 6).' days'));
if(isset($_POST["lastWeek"]))
$_SESSION['week']-=7;

if(isset($_POST["nextWeek"]))
$_SESSION['week']+=7;

$dateStart = date('Y-m-d',strtotime("$dateStart +".$_SESSION['week']. "days"));


for($k=0; $k<7; $k++)
{
        $d[$k] = date('Y-m-d',strtotime("$dateStart +".$k. "days"));
        $d_md[$k] = date('m-d',strtotime("$dateStart +".$k. "days"));
}
for($k=0; $k<7; $k++)
{
        for($j=0; $j<14; $j++)
        {
                $time = $j+1;
                $sql = "SELECT * FROM reserveClass where date = '$d[$k]' && time = '$time' && class = '$class'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $info[$k][$j] = $row['event'] . "<br>" . $row['user'];
        }
}
?>
<!DOCTYPE html>
<html>

<head>
<title>A203</title>
<style>
tr
{
        text-align: center;
}
tr.odd
{
        background-color: #AFEEEE;
}
table
{
        border-collapse: collapse;

width: 60%;
}
.right
{
position: relative;
left:410px;
}
.left
{
position: relative;
left:390px;
}
p
{
position: relative;
left:440px;
     font-size: 30px;
}
a
{
position: relative;
left:450px;
     font-size: 18px;
}



</style>
</head>
<body>
<p><?php session_start(); echo $_SESSION['class']; ?></p><br>
<?php
$timeText = array("1 08:00-08:50", "2 09:00-09:50", "3 10:00-10:50", "4 11:00-11:50", "Z 12:00-12:50", "5 13:00-13:50", "6 14:00-14:50", "7 15:00-15:50", "8 16:00-16:50", "9 17:00-17:50", "A 18:00-18:50", "B 19:00-19:50", "C 20:00-20:50", "C 20:00-20:50");
$day = array ("(日)", "(一)", "(二)", "(三)", "(四)", "(五)", "(六)");

echo "<table>
<tr>
<th>
</th>";

for($k=0; $k<7; $k++)
{
        echo "<th>";
        echo $d_md[$k].$day[$k];
        echo "</th>";
}
echo "</tr>";
for($k=0; $k<14; $k++)
{
        if($k%2==0)
                echo "<tr class='odd'>";
        else
                echo "<tr class='even'>";
        echo "<th>";
        echo $timeText[$k];
        echo "</th>";
        for($j=0; $j<7; $j++)
        {
                echo "<td>";
                echo $info[$j][$k];
                echo "</td>";
        }
        echo "</tr>";
}
echo  "</table><br>";
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="submit" name="lastWeek" value="lastWeek" class='left'>
<input type="submit" name="nextWeek" value="nextWeek" class='right'><br>
</form>
<a href="system.php">返回</a>
<?php $cnon->close(); ?>
</body>
</html>
