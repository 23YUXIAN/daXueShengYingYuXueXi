<?php
session_start(); //传值
require 'config.php'; //导入配置文件
if(isset($_GET['delete'])){//如果点击了退出则清空登录状态，回到首页
    unset($_SESSION['login']);/*清空*/
    header("location:http://localhost/dxsyyxx/index.php");
}
?>
<!DOCTYPE html>
<html lang="zh-cn" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/top.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./js/jquery-1.11.1.min.js"></script>
    <title>大学生英语学习</title>
   
</head>

<body>
    <div class="top-bg" onscroll="a()">
        <div class="navigation">
            <!-- logo模块开始 -->
            <div class="logo">
                <a href="index.php"><img src="./images/logo.jpg"></a>
            </div>
            <!-- logo模块结束 -->
            <!-- 导航链接模块开始 -->
            <nav>
                <ul>
                    <li><a href="index.php">网站介绍</a></li>
                    <li><a href="conversation.php">情景对话</a></li>
                    <li><a href="story.php">故事再现</a></li>
                    <li><a href="word.php">单词基地</a></li>
                    <li><a href="shareandadmire.php">分享与欣赏</a></li>
                </ul>
            </nav>
            <!-- 导航链接模块结束 -->
            <!--搜索框模块开始 -->
            <!-- 通过单击搜索图标出发表单的submit()函数，将用户输入的内容提交到某某页面 还未写 暂定 -->
            <div class="search-box">
                <form action="index.php" name="search_table">
                    <input type="text" name="search_key" id="search_key">
                    <span id="searching" onclick="document.search_table.submit()">
                        <img id="search-start" src="./images/search.png">
                    </span>
                    <!--应该使用.submit()函数，如果使用按钮之类的是错误的方式-->
                </form>
            </div>
            <!-- 搜索框模块结束-->
            <!-- top-right模块开始-->
            <div class="top-right">
            <?php
            /* $query1 = "SELECT * FROM users WHERE uemail='" . $_SESSION['login'] . "'";
            $result1 = mysqli_query($db_connect, $query1);
            $row1 = mysqli_fetch_array($result1, MYSQLI_BOTH); */
            /* 判断有无登录，有则显示我的 退出，没有则显示登录注册*/
            if (isset($_SESSION['login'])) {
            ?>
                    <div class="me">
                        <a href="me.php">我的</a>
                        <a href="http://localhost/dxsyyxx/login.php?delete=1">退出</a>
                    </div>
                <?php } else { ?>
                    <div class="login-registration">
                        <a href="login.php" class="login">登录</a>
                        <span>|</span>
                        <a href="registration.php" class="registration">注册</a>
                    </div>
                <?php } ?>
                </div>
                <!-- top-right模块结束-->
        </div>
    </div>
    <!-- 导航条置顶的脚本：如果屏幕有滚动就将导航条置顶-->
    <script>
        $(document).ready(function() {
            $(document).scroll(function() {
                if ($(window).scrollTop() > 20) {
                    $(".top-bg").addClass('fixed');
                } else {
                    $(".top-bg").removeClass('fixed');
                }
            });
        });
    </script>
</body>

</html>