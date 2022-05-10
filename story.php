<?php
session_start();
if(isset($_SESSION['login'])){

}else{
    echo ('<script type="text/javascript">
    alert("请先登录！");
    window.location.href = "http://localhost/dxsyyxx/login.php";
    </script>')
   ;
}
require "config.php";
$storyname = $_POST['story_name'];
?>
<!DOCTYPE html>
<html lang="zh-cn" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/story.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./js/jquery-1.11.1.min.js"></script>
    <title>大学生英语学习</title>
    <script>
        $(function() {
            $(".select-theme").show();
            $(".retell").hide();
            $("#start").click(function() {
                $("#story_level").text() == "";
                $("#user_story").text() == "";
                if ($("#storyname").text() == "") {
                    alert("请先选择故事！");
                } else {
                    $(".select-theme").hide();
                    $(".retell").show();

                }
            });

            $("#come_back").click(function() {
                $(".select-theme").show();
                $(".retell").hide();
            });
        });

        function compareText() {
            var story_level = document.getElementById('story_level').value;
            var user_story = document.getElementById('user_story').value;
            var str = JSON.stringify({
                "user_story": user_story,
                "story_level": story_level
            })
            var xmlhttp;
            if ((user_story == "") || (story_level=="")) { //为空
                alert("准确率和输入文本不能为空，请重新输入!");
                return;
            }
            if (story_level > 100 || story_level < 0 ) {
                alert("请输入0到100的准确率!");
                return;
            }
            if (window.XMLHttpRequest) {
                // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
                xmlhttp = new XMLHttpRequest();
            } else {
                // IE6, IE5 浏览器执行代码
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                    document.getElementById("story_result").innerText = xmlhttp.responseText;
                }
            }
            xmlhttp.open("POST", "compare.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("str=" + str);
        }
    </script>
</head>

<body>
    <?php require "top.php"; ?>
    <div class="bottom">
        <?php
        $query3 = "SELECT * FROM story WHERE storyname = '$storyname'";
        $result3 = mysqli_query($db_connect, $query3);
        $row3 = mysqli_fetch_array($result3, MYSQLI_BOTH);
        $_SESSION['original_story'] = $row3['storytext'];
        ?>
      
        <div class="select-theme">
            <span class="s1">选择故事</span><br>
            <?php
            $query1 = "SELECT count(*)as number_story FROM story";
            $result1 = mysqli_query($db_connect, $query1);
            $row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
            $number_story = $row1['number_story'];
            $query2 = "SELECT * FROM `story`";
            $result2 = mysqli_query($db_connect, $query2);
            ?>
            <form action="story.php" method="POST" name="story">
                <select name="story_name" class="story_name">
                    <?PHP
                    for ($i = 1; $i <= $number_story; $i++) {
                        $row2 = mysqli_fetch_array($result2, MYSQLI_BOTH);
                    ?>
                        <option><?php echo $row2['storyname']; ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input type="submit" value="确定" class="b1">
            </form>
            <div class="original">
            
                <span class="s1">故事原文</span><br>
                <p class="sname"><?php echo $row3['storyname']; ?></p><br>
                <p id="original_story"><?php echo $_SESSION['original_story']; ?></p>
                <span class="s1">中文翻译</span><br>
                <p id="Chinese_meaning"><?php echo  $row3['Chinese_meaning']; ?></p>
            </div><br>
            <button class="b1" id="start">开始复述</button>
        </div>
        <div class="retell">
            <button class="b1" id="come_back">返回</button><br>
            <p id="storyname"><?php echo $row3['storyname']; ?></p>
            <span class="s1">故事再现</span><br>
            <label>请输入复述准确率：</label><input id="story_level"></input><label>%(百分比制)</label><br>
            <label>请开始复述：</label>
            <label class="result">结果：<span id="story_result"></span></label>
            <textarea name="user_story" id="user_story"></textarea><br>
            <button class="b1" id="over" onclick="compareText()" ;>复述完毕</button><br>

            </form>
        </div>
    </div>
</body>

</html>