<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
include "conf.php";
?>
<html>

<head>
  <link rel="shortcut icon" href="images/mangosd.ico" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.8, minimum-scale=0.8, maximum-scale=0.8, user-scalable=yes" />
  <meta name="大芒果" content="我的游戏世界">
  <title>
    <?php echo $servername; ?>- 修改服务器列表
  </title>
  <link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body text="black" vlink="white" link="black" alink="white">
  <center>
    <div id="wrap">
      <div id="welc">
        <li id="welc">
          <style="color:#222222">修改服务器列表</a>
        </li>
      </div>
      <div id="innerwrap">
        <?php
if (!isset($_POST['sent'])) {
    ?>
        <form method="post" action="">
          <input type="hidden" name="sent" value="true">
          <div class="heading">服务器列表ID</div>
          <div class="inputwrap">
            <input type="text" name="mdid" value="1" size="39">
          </div>
          <div class="heading">请输入服务器名称</div>
          <div class="inputwrap">
            <input type="text" name="mdname" value="地球时代" size="39">
          </div>
          <div class="heading">请输入新服务器IP</div>
          <div class="inputwrap">
            <input type="text" name="mdip" value="192.168.31.2" size="39">
          </div>
          <div class="heading">请输入新服务器端口</div>
          <div class="inputwrap">
            <input type="text" name="mdport" value="8085" size="39">
          </div>
          <div class="heading">请输入高级操作密码</div>
          <div class="inputwrap">
            <input type="text" name="hipass" size="39">
          </div>
          <br><br>
          <div class="heading">
            <center>
              <input type="submit" value="确定设置" name="send" id="submit">
            </center>

            <center>
              <li id="repass"><a href="index.php" style="color:#222222">返回首页 </a></l>
            </center>
          </div>
        </form>
        <?php
} else {
    echo "<h2>设置结果</h2>";
    if (mysqli_connect_errno()) {
        echo "<div class=\"error\">不能连接数据库，服务器离线。</div>";
        echo "
        <div class=\"failed\"><b>修改失败.</b></div>
         <center>
         <button class=\"homepage\" onclick=\"window.location.href='$page';\">返回主页</button>
		     </center>                                                                                         ";
        die('数据库连接错误误：' . mysqli_connect_errno());
    } else {
        $mdid = $_POST['mdid'];
        $mdname = $_POST['mdname'];
        $mdip = $_POST['mdip'];
        $mdport = $_POST['mdport'];
        $passed = true;
        if (empty($_POST['mdid']) || empty($_POST['mdname']) || empty($_POST['mdip']) || empty($_POST['mdport']) || empty($_POST['hipass'])) {
            echo "<div class=\"error\">你必须填写所有字段</div>";
            echo "
		        <center>
            <button class=\"homepage\" onclick=\"window.location.href='$page';\">重新填写</button>
            </center>
		        ";
            $passed = false;
        } else {
            $sql = "select * from realmlist where id = '$mdid' ";
            $getid = mysqli_query($db, $sql);
            $olevel = mysqli_fetch_assoc($getid);
            if (!$olevel) {
                echo "<div class=\"error\">你输入的列表不存在</div>";
                $passed = false;
            } else
            if ($_POST['hipass'] != $hipass) {
                echo "<div class=\"error\">你输入的高级操作密码有误</div>";
                $passed = false;

            }

            if ($passed) {
                $sql_md = "UPDATE realmlist SET name='" . $mdname . "',address='" . $mdip . "',port='" . $mdport . "' WHERE id = '" . $mdid . "'";
                mysqli_query($db, $sql_md);
                mysqli_close($db);
                echo "<div class=\"done\">你已经成功设置服务器列表.<br><br><br><br></div>";
                echo "
                  <div class=\"finished\"><b>成功设置服务器列表.</b></div>
                  <center>
                    <button class=\"homepage\" onclick=\"window.location.href='$homepage';\">返回主页</button>
                  </center>
                   <center>
                    <button class=\"homepage\" onclick=\"window.location.href='$page';\">继续设置</button>
                  </center>
                  ";
            } else {
                echo "
                  <div class=\"failed\"><b>设置失败.</b></div>
                  <center>
                    <button class=\"homepage\" onclick=\"window.location.href='$page';\">重新设置</button>
                  </center>
                  ";
            }
        }
    }
}
?>
      </div>
    </div>
  </center>
</body>

</html>