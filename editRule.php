<?php session_start(); ?>
<?php
    include("mysql_connect.inc.php");
    $sql = "SELECT * FROM rule WHERE no=1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $ruleText = str_replace(,"<br />", chr(13).chr(10), $row['rule']);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>編輯中</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <textarea cols="400" rows="20" name="rule" ><?php echo $ruleText; ?></textarea>
        <input type="submit" value="編輯完成">

        <input type="submit" value="編輯完成">
    </form>
    <?php
        $rule=nl2br($_POST['rule']);
        $sql = "UPDATE rule SET rule='$rule' WHERE no=1";
            if($rule!=NULL)
            {
                if(mysqli_query($conn, $sql) && $rule!=NULL)
                {
                    echo "更改成功";
                    echo '<meta http-equiv=REFRESH CONTENT=1;url=system.php>';
                }
                else
                    echo "更改失敗";
            }
        $cnon->close();
    ?>

    
    </body>
</html>