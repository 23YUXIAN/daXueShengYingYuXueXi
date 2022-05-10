<?php
require "config.php";
session_start();
if (isset($_SESSION['login'])) {
} else {
    echo ('<script type="text/javascript">
    alert("请先登录！");
    window.location.href = "http://localhost/dxsyyxx/login.php";
    </script>');
}
?>
<!DOCTYPE html>
<html lang="zh-cn" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/shareandadmire.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./js/jquery-1.11.1.min.js"></script>
    <title>大学生英语学习</title>
    <script>
        $(function() {
            $("#share").show();
            $("#admire").show();
            $(".share").hide();
            $(".admire").hide();
            $("#share").click(function() {
                $(".share").show();
                $("#share").hide();
                $(".admire").hide();
                $("#admire").hide();
            });
            $("#admire").click(function() {
                $(".share").hide();
                $("#share").hide();
                $(".admire").show();
                $(".admire-main").hide();
                $("#admire").hide();
            });
            $("#come-back1").click(function() {
                $(".share").hide();
                $("#share").show();
                $(".admire").hide();
                $("#admire").show();
            });
            $("#come-back2").click(function() {
                $(".share").hide();
                $("#share").show();
                $(".admire").hide();
                $("#admire").show();
            });
            $("#come-back3").click(function() {
                $(".admire-topic").show();
            $(".admire-main").hide();
            });
        });

        function showmain() {
            $(".admire-topic").hide();
            $(".admire-main").show();
            var obj = event.srcElement ? event.srcElement : event.target;
            var topic = obj.innerText; //获取到被点击对象的话题内容
            var xmlhttp;
            if (window.XMLHttpRequest) {
                // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
                xmlhttp = new XMLHttpRequest();
            } else {
                // IE6, IE5 浏览器执行代码
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    re2 = JSON.parse(xmlhttp.responseText);
                    document.getElementById("result-uname").innerText = re2['publisher'];
                    document.getElementById("result-good").innerText = re2['good'];
                    document.getElementById("result-topic").innerText = re2['topic'];
                    document.getElementById("result-main").innerText = re2['main'];
                }
            }
            xmlhttp.open("POST", "admire.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("topic=" + topic);

        }

        function check() {
            if (document.getElementById("topic").value == "") {
                alert("话题不能为空");
                return false;
            }
            if (document.getElementById("main").value == "") {
                alert("正文不能为空");
                return false;
            }
        }
    </script>
</head>

<body>
    <?php require "top.php"; ?>
    <div class="bottom">
        <div class="bb">
            <button class="button" id="share">分享</button>
            <button class="button" id="admire">欣赏</button>
        </div>
        <div class="share">
            <button class="button1" id="come-back1">返回</button>
            <form action="share.php" method="POST">
                <label>话题：</label>
                <br>
                <input class="t1" type="text" name="topic" id="topic">
                <br>
                <label>正文：</label>
                <br>
                <textarea type="text" name="main" id="main"></textarea><br>
                <input class="button3" type="submit" value="提交" onclick="return check()">
            </form>
        </div>
        <div class="admire">
            
            <div class="admire-topic">
            <button class="button2" id="come-back2">返回</button>
                <?php
                //查询有多少个话题
                $query1 = "SELECT count(*)as number_topic FROM discussion ";
                $result1 = mysqli_query($db_connect, $query1);
                $row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
                $number_topic = $row1['number_topic'];
                //循环输出话题
                $query2 = "SELECT * FROM discussion ORDER BY good DESC";
                $result2 = mysqli_query($db_connect, $query2);
                for ($i = 1; $i <= $number_topic; $i++) {
                    $row2 = mysqli_fetch_array($result2, MYSQLI_BOTH);
                ?>
                    <p class="topic-name" >
                    <span class="tn" id="t<?php echo $row2['topicid']; ?>" onclick="showmain()"><?php echo $row2['topic']; ?></span>
                    <span class="good"><?php echo $row2['good']?></span>
                    <img src="images/click.png"></p>
                   
                <?php
                } ?>
            </div>
            <div class="admire-main">
            <button class="button2" id="come-back3">返回</button>
                <p id="result-topic"></p>
                <p class="p2"><span class="s1">发布者：<span id="result-uname"></span></span><span class="s2">点击率<span id="result-good"></span></span></p>
                
                <p class="p3"><span id="result-main"></span></p>
            </div>
        </div>
    </div>
</body>

</html>