<meta charset="utf-8">
<?php
        session_start();
        include("mysql_connect.inc.php");
        $timeText = array("1 08:00 - 08:50", "2 09:00-09:50", "3 10:00-10:50", "4 11:00-11:50", "Z 12:00-12:50", "5 13:00-13:50", "6 14:00-14:50", "7 15:00-15:50", "8 16:00-16:50", "9 17:00-17:50", "A 18:00-18:50", "B 19:00-19:50", "C 20:00-20:50", "C 20:00-20:50");
        $us = $_SESSION['username'];
        $sql = "SELECT * FROM reserveClass where userName = '$us'";
        $result = mysqli_query($conn, $sql);
        $i=0;
         while($row[$i] = mysqli_fetch_object($result))
        {
                $i++;
                //echo $i;
        }
?>
<!DOCTYPE html>
<html>

<head>
        <title>紀錄</title>
</head>
        <body>
        <?php
        //echo $row[0]->class;
        echo "<table width='600' border='1'>";
        $i=0;
        while($row[$i])
        {

	        echo "<tr>";
	        echo "<td>".$i."</td>";
	        echo "<td>".$row[$i]->user."</td>";
	        echo "<td>". $row[$i]->phone ."</td>";
	        echo "<td>". $row[$i]->date ."</td>";
	        echo "<td>". $row[$i]->class ."</td>";
	        echo "<td>".$timeText[$row[$i]->time-1] ."</td>";
	        echo "<td>". $row[$i]->event ."</td>";
	        echo "</tr>";
	        $i++;

        }
        echo  "</table>";
        ?>
        <form action="edit.php" method="post">
			<p>欲編輯或刪除資料</p>
			<select name="data">
				
				<?php
					for($k=0; $k<$i; $k++)
					{
						$k++;
						echo "<option value=$k>$k</option>";
						$k--;
					}
				?>
			</select><br><br>
			<input type="submit" name="edit" value="編輯">
			<input type="submit" name="delete" value="刪除"><br><br>
		</form><br>
		<a href="system.php">返回</a>
        <?php $cnon->close(); ?>
    </body>
</html>
