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
    <link href="css/me.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./js/jquery-1.11.1.min.js"></script>
    <title>大学生英语学习</title>
    <script>
        $(function() {
            $(".personal").show();
            $(".word-book").hide();
            $(".note").hide();
            $(".diary").hide();
            $("#personal").click(function() {
                $(".personal").show();
                $(".word-book").hide();
                $(".note").hide();
                $(".diary").hide();
            });
            $("#word-book").click(function() {
                $(".personal").hide();
                $(".word-book").show();
                $(".show-book").show();
                $(".write-book").hide();
                $(".note").hide();
                $(".diary").hide();
            });
            $("#note").click(function() {
                $(".personal").hide();
                $(".word-book").hide();
                $(".note").show();
                $(".diary").hide();
                $(".note-content").hide();
                $(".note-title").show();
                $(".note-write").hide()
            });
            $("#diary").click(function() {
                $(".personal").hide();
                $(".word-book").hide();
                $(".note").hide();
                $(".diary").show();
                $(".diary-content").hide();
                $(".diary-title").show();
                $(".diary-write").hide();
            });
            $("#write-note").click(function() {
                $(".note-title").hide();
                $(".note-write").show();
            });

            $("#write-diary").click(function() {
                $(".diary-title").hide();
                $(".diary-write").show();
            });
            $("#write-book").click(function() {
                $(".show-book").hide();
                $(".write-book").show();
            });
            $("#come-back1").click(function() {
                $(".note-content").hide();
                $(".note-title").show();
            });
            $("#come-back2").click(function() {
                $(".diary-content").hide();
                $(".diary-title").show();

            });
            $("#come-back3").click(function() {
                $(".note-title").show();
                $(".note-write").hide()
            });
            $("#come-back4").click(function() {
                $(".diary-title").show();
                $(".diary-write").hide();
            });
            $("#come-back5").click(function() {
                $(".show-book").show();
                $(".write-book").hide();
            });
        });

        function shownotecontent() {
            $(".note-content").show();
            $(".note-title").hide();
            var obj = event.srcElement ? event.srcElement : event.target;
            var note_title = obj.innerText; //获取到被点击对象的话题内容
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
                    re3 = JSON.parse(xmlhttp.responseText);
                    document.getElementById("title1").innerText = re3['title'];
                    document.getElementById("content1").innerText = re3['content'];

                }
            }
            xmlhttp.open("POST", "noteanddiary.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("note_title=" + note_title);

        }

        function showdiarycontent() {
            $(".diary-content").show();
            $(".diary-title").hide();
            var obj = event.srcElement ? event.srcElement : event.target;
            var diary_title = obj.innerText; //获取到被点击对象的话题内容
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
                    re3 = JSON.parse(xmlhttp.responseText);
                    document.getElementById("title2").innerText = re3['title'];
                    document.getElementById("content2").innerText = re3['content'];

                }
            }
            xmlhttp.open("POST", "noteanddiary.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("diary_title=" + diary_title);

        }

        function check123() {
            if ((document.getElementById("t1").value == "") || (document.getElementById("tc1").value == "")) {
                alert("标题或正文不能为空");
                return false;
            }
        }

        function check456() {
            if (document.getElementById("t2").value == "") {
                alert("标题不能为空");
                return false;
            }
            if (document.getElementById("dc2").value == "") {
                alert("正文不能为空");
                return false;
            }
        }
        function check789(){
            if (document.getElementById("write_w").value == "") {
                alert("单词不能为空");
                return false;
            }
            if (document.getElementById("write_t").value == "") {
                alert("意思不能为空");
                return false;
            }
        }
    </script>

</head>

<body>
    <?php require "top.php";
    ?>
    <div class="bottom">
        <div class="left">
            <p id="personal">个人信息</p>
            <p id="word-book">单词本</p>
            <p id="note">笔记本</p>
            <p id="diary">日记本</p>
        </div>
        <div class="right">
            <div class="personal">
                <?php
                $query1 = "SELECT * FROM users WHERE uemail='" . $_SESSION['login'] . "'";
                $result1 = mysqli_query($db_connect, $query1);
                $row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
                ?>
                <p>昵称：<span><?php echo $row1['uname']; ?></span></p>
                <p>邮箱：<span><?php echo $row1['uemail']; ?></span></p>
                <p>密码：<span><?php echo $row1['upassword']; ?></span></p>
            </div>
            <div class="word-book">
                <div class="show-book">
                    <button class="button_all" id="write-book">输入新单词</button><br>
                    <p>单词本</p><!-- 表名 -->
                    <?php
                    $query2 = "SELECT count(*)as number_word FROM `" . $_SESSION['login'] . "`";
                    $result2 = mysqli_query($db_connect, $query2);
                    $row2 = mysqli_fetch_array($result2, MYSQLI_BOTH);
                    $number_word = $row2['number_word']; //提取该表单词的总数目

                    $query3 = "SELECT * FROM `" . $_SESSION['login'] . "` "; //从该单词表里提取单词
                    $result3 = mysqli_query($db_connect, $query3);
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
                        for ($i = 1; $i <=  $number_word; $i++) {
                            $row3 = mysqli_fetch_array($result3, MYSQLI_BOTH);
                        ?>
                            <tr class="word<?php echo $i; ?>">
                                <td class="a" id="a<?php echo $i; ?>"><?php echo $row3['wordid']; ?></td>
                                <td class="b" id="b<?php echo $i; ?>"><?php echo $row3['word']; ?></td>
                                <td class="c" id="c<?php echo $i; ?>"><?php echo $row3['translation']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table><br>

                </div>
                <div class="write-book">
                    <button class="button_all" id="come-back5">返回</button>
                    <form action="noteanddiary.php" method="POST">
                        <label>单词：</label>
                        <input type="text" id="write_w" name="write_w">
                        <label>意思:</label>
                        <input type="text" id="write_t" name="write_t">
                        <input type="submit" value="提交" onclick="return check789()">
                    </form>
                </div>
            </div>
            <div class="note">
                <div class="note-title">
                    <?php
                    //查询有多少篇笔记
                    $query4 = "SELECT count(*)as number_note FROM `" . $_SESSION['login'] . "_note" . "` ";
                    $result4 = mysqli_query($db_connect, $query4);
                    $row4 = mysqli_fetch_array($result4, MYSQLI_BOTH);
                    $number_note = $row4['number_note'];
                    //循环输出笔记标题
                    $query5 = "SELECT * FROM `" . $_SESSION['login'] . "_note" . "`";
                    $result5 = mysqli_query($db_connect, $query5);
                    for ($i = 1; $i <= $number_note; $i++) {
                        $row5 = mysqli_fetch_array($result5, MYSQLI_BOTH);
                    ?>
                        <p class="note-name">
                            <span id="n<?php echo $row5['noteid']; ?>" onclick="shownotecontent()"><?php echo $row5['note']; ?></span>
                        </p>
                    <?php
                    } ?>
                    <button class="button_all" id="write-note">写笔记</button>
                </div>
                <!-- 笔记内容 -->
                <div class="note-content">
                    <button class="button_all" id="come-back1">返回</button>
                    <p id="title1"></p>
                    <p id="content1"></p>
                </div>
                <div class="note-write">
                    <button class="button_all" id="come-back3">返回</button>
                    <form action="noteanddiary.php" method="POST">
                        <label>标题：</label>
                        <br>
                        <input class="t1" type="text" name="write_note_title" id="t1">
                        <br>
                        <label>正文：</label>
                        <br>
                        <textarea type="text" name="write_note_content" id="tc1"></textarea><br>
                        <input class="button3" type="submit" value="提交" onclick="return check123()">
                    </form>
                </div>
            </div>
            <div class="diary">
                <div class="diary-title">
                    <?php
                    //查询有多少篇日记
                    $query6 = "SELECT count(*)as number_diary FROM `" . $_SESSION['login'] . "_diary" . "` ";
                    $result6 = mysqli_query($db_connect, $query6);
                    $row6 = mysqli_fetch_array($result6, MYSQLI_BOTH);
                    $number_diary = $row6['number_diary'];
                    //循环输出日记标题
                    $query7 = "SELECT * FROM `" . $_SESSION['login'] . "_diary" . "`";
                    $result7 = mysqli_query($db_connect, $query7);
                    for ($i = 1; $i <= $number_diary; $i++) {
                        $row7 = mysqli_fetch_array($result7, MYSQLI_BOTH);
                    ?>
                        <p class="diary-name">
                            <span id="n<?php echo $row7['diaryid']; ?>" onclick="showdiarycontent()"><?php echo $row7['diary']; ?></span>
                        </p>
                    <?php
                    } ?>
                    <button class="button_all" id="write-diary">写日记</button>
                </div>
                <!-- 日记内容 -->
                <div class="diary-content">
                    <button class="button_all" id="come-back2">返回</button>
                    <p id="title2"></p>
                    <p id="content2"></p>
                </div>
                <!-- 写日记 -->
                <div class="diary-write">
                    <button class="button_all" id="come-back4">返回</button>
                    <form action="noteanddiary.php" method="POST">
                        <label>标题：</label>
                        <br>
                        <input class="t1" type="text" name="write_diary_title" id="t2">
                        <br>
                        <label>正文：</label>
                        <br>
                        <textarea type="text" name="write_diary_content" id="dc2"></textarea><br>
                        <input class="button4" type="submit" value="提交" onclick="return check456()">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>