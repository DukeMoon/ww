<?php
################################################################################
# 版本：v3.2
# 功能：注册页配置文件
# 作者：Cici
# 修改者：小得得
# 添加功能：登陆器下载，论坛，修改密码，找回密码，gmlevel
# 更新：201901 添加自适应代码，修改数据库连接方式为mysqli
#                        请编辑以下配置参数
################################################################################
$expansion = 0; // 默认游戏版本 (0 = 经典版, 1 = TBC, 2 = WLK, 3 =CTM, 4 = MOP)
$minpasslenght = 6; // 最短密码长度限制
$dbhost = 'localhost'; // 数据库地址   = localhost (127.0.0.1)
$dbuser = 'mangos'; // 数据库用户名 = root
$dbpass = 'mangos'; // 数据库密码
$dbname = 'classicrealmd'; // 帐号数据库
$servername = '地球时代'; // 服务器名称
$ip = "127.0.0.1"; // 服务器地址
$oneaccpermail = false; // 'true'只允许电子邮件注册,'false' 取消检测
$dlq = "/dlq.zip"; // 登录器
$homepage = "index.php"; // 网站首页
$bbs = "/bbs"; // 网站论坛
$hipass = 666666;
################################################################################
#                           请不要修改以下数据                                 #
################################################################################
if ($expansion < 0) {
    $expansion = 0;
}

//屏蔽错误提示
//error_reporting(0);
//建立数据库连接
$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
$page = $parts[count($parts) - 1];

foreach ($_POST as $Index => $Item) {
    $_POST[$Index] = addslashes($Item);
}

foreach ($_GET as $Index => $Item) {
    $_GET[$Index] = addslashes($Item);
}

function GetExpansionName($expansion)
{
    switch ($expansion) {
        case 0:
            return "经典版";
        case 1:
            return "TBC";
        case 2:
            return "WLK";
        case 3:
            return "CTM";
        case 4:
            return "MOP";
        default:
            return "未知版本";
    }
}

function IsValidEmail($email)
{
    $pattern = "/\w+@(\w|\d)+\.\w{2,3}/i";
    preg_match($pattern, $email, $matches);
    return $matches;
}
