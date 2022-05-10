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
session_start();
$word_theme_name = $_GET['word_theme_name'];
?>
<!DOCTYPE html>
<html lang="zh-cn" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/word.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./js/jquery-1.11.1.min.js"></script>
    <title>大学生英语学习</title>
    <script>
        $(function() {
            $(".word-table").show();
            $(".show-word").hide();
            $("#come-back").click(function() {
                $(".word-table").show();
                $(".show-word").hide();
            });
            
           
                if($("#word_theme_name").text() == ""){

            }else{
                $(".word-table").hide();
                $(".show-word").show();
            }
            });
        
        

        function previousgroup() {
            var wordid_first = document.getElementById('a1').innerText;
            var word_theme_name = document.getElementById('word_theme_name').innerText;
            if (wordid_first == 1) {
                alert("该组单词是第一组");
                resturn;
            }
            var str = {
                "wordid_first": wordid_first,
                "word_theme_name": word_theme_name
            };
            var word_previous = JSON.stringify(str);
            //获取该组第一个单词的id和单词表名并进行转换为json格式

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
                    re1 = JSON.parse(xmlhttp.responseText);
                    for (var j = 1; j <= 20; j++) {
                        document.getElementById("a" + j).innerText = re1[j - 1][0];
                        document.getElementById("b" + j).innerText = re1[j - 1][1];
                        document.getElementById("c" + j).innerText = re1[j - 1][2];
                    }
                }
            }
            xmlhttp.open("POST", "groupword.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("word_previous=" + word_previous);
        }

        function nextgroup() {
            var wordid_last = document.getElementById('a20').innerText;
            var word_theme_name = document.getElementById('word_theme_name').innerText;
            if (wordid_last == "") {
                alert("该组单词是最后一组");
                resturn;
            }
            var str = {
                "wordid_last": wordid_last,
                "word_theme_name": word_theme_name
            };
            var word_next = JSON.stringify(str);
            //获取该组最后一个单词的id和单词表名并进行转换为json格式

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
                    re = JSON.parse(xmlhttp.responseText);

                    for (var i = 1; i <= 20; i++) {
                        document.getElementById("a" + i).innerText = re[i - 1][0];
                        document.getElementById("b" + i).innerText = re[i - 1][1];
                        document.getElementById("c" + i).innerText = re[i - 1][2];
                    }
                }
            }
            xmlhttp.open("POST", "groupword.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("word_next=" + word_next);
        }
    </script>

</head>

<body>
    <?php require "top.php"; ?>
    <div class="bottom">
    
        <!-- 选择单词表 -->
        <div class="word-table">
            <span class="">选择单词表</span><br>
            <?php
            $query1 = "SELECT count(*)as number_word_theme FROM word_theme";
            $result1 = mysqli_query($db_connect, $query1);
            $row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
            $number_word_theme = $row1['number_word_theme']; //提取单词表数目
            $query2 = "SELECT * FROM `word_theme`";
            $result2 = mysqli_query($db_connect, $query2); //提取单词表主题
            ?>
            <form action="" method="GET" name="word_theme">
                <select name="word_theme_name" class="word_theme_name">
                    <?PHP
                    for ($i = 1; $i <= $number_word_theme; $i++) { //输出每一个单词表主题名
                        $row2 = mysqli_fetch_array($result2, MYSQLI_BOTH);
                    ?>
                        <option><?php echo $row2['word_theme_name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input type="submit" value="确定" class="button1">
            </form>
        </div>
        
        <!-- 展示单词 -->
        <div class="show-word">
            <button class="button1" id="come-back">返回</button>

            <p class="" id="word_theme_name"><?php echo $word_theme_name; ?></p><br><!-- 表名 -->
            <?php
            $query3 = "SELECT count(*)as number_word FROM `$word_theme_name`";
            $result3 = mysqli_query($db_connect, $query3);
            $row3 = mysqli_fetch_array($result3, MYSQLI_BOTH);
            $number_word = $row3['number_word']; //提取该表单词的总数目

            $query4 = "SELECT * FROM `$word_theme_name` "; //从该单词表里提取单词
            $result4 = mysqli_query($db_connect, $query4);
            ?>
            <!--表格展示单词-->
            <table border="1">
                <tr>
                    <th>number</th>
                    <th>word</th>
                    <th>translation</th>
                </tr>
                <!-- 循环输出-->
                <?php
                for ($i = 1; $i <= 20; $i++) {
                    $row4 = mysqli_fetch_array($result4, MYSQLI_BOTH);
                ?>
                    <tr class="word<?php echo $i; ?>">
                        <td class="a" id="a<?php echo $i; ?>"><?php echo $row4['wordid']; ?></td>
                        <td class="b" id="b<?php echo $i; ?>"><?php echo $row4['word']; ?></td>
                        <td class="c" id="c<?php echo $i; ?>"><?php echo $row4['translation']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </table><br>
            <button class="button2" onclick="previousgroup()">上一组</button>
            <button class="button3" onclick="nextgroup()">下一组</button>
        </div>
    </div>
</body>

</html>