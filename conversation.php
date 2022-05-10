<?php
require "config.php";
session_start();
if(isset($_SESSION['login'])){
}else{
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
    <link href="css/conversation.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./js/jquery-1.11.1.min.js"></script>
    <title>大学生英语学习</title>
    <script>
        $(function() {
            $(".start_select").show();
            $(".chat").hide();
            $(".chat-box").hide();
            $(".click").hide();
            $("#come_back_select").click(function() {
                $(".start_select").show();
                $(".chat").hide();
            });
            
            $("#come_back_text").click(function() {
                $(".original-text").show();
                $(".chat-box").hide();
            });

            $(".start_chat_button").click(function() {
                $(".start_select").hide();
                $(".chat").show();
                $(".original-text").show();
                $(".chat-box").hide();

                if ($("#scenename").text() == "") {
                    alert("请先选择情景");
                    $(".start_select").show();
                    $(".chat").hide();
                }
            });
            $("#start_chat_box").click(function() {
                $(".original-text").hide();
                $(".chat-box").show();
            });
            if($("#convinece").text() != ""){
                $("#click"+$("#convinece").text()).show();
            }
        });
        function showResult(user_text2) {
            var user_text2 = document.getElementById('user_text2').value;
            var xmlhttp;
            if (user_text2 == "") { //为空
                alert("输入文本不能为空，请重新输入!");
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
                    var re = JSON.parse(xmlhttp.responseText);
                    document.getElementById("chat_text1").innerText = re['text1'];
                    document.getElementById("chat_result").innerText = re['chat_result'];
                }
            }
            xmlhttp.open("POST", "judge.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("user_text2=" + user_text2);
            //获取返回值结束，置空用户输入，判断是否是最后一次对话脚本
            document.getElementById("user_text2").value = "";

        }
    </script>
</head>

<body>
    <?php require "top.php"; ?>
    <!-- 有三大模块，一、选择主题；二、选择情景；三、开始情景对话(1、输出原文模块；2、开始对话模块；)；-->
    <div class="bottom">
        <!-- “一、选择主题；”模块开始 -->
        <div class="start_select">
            <!-- “一、选择主题；”模块开始 -->
            <span class="select_icon">选择主题</span><br>
            <div class="theme">
                <?php
                //查询有多少个主题
                $query1 = "SELECT count(*)as number_theme FROM theme";
                $result1 = mysqli_query($db_connect, $query1);
                $row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
                $numberTheme = $row1['number_theme']; //主题数量
                //查询并输出每一个主题
                $query2 = "SELECT * FROM theme";
                $result2 = mysqli_query($db_connect, $query2);
                /* 开始循环输出 */
                for ($i = 1; $i <= $numberTheme; $i++) {
                    $row2 = mysqli_fetch_array($result2, MYSQLI_BOTH);
                    /* mysqli_fetch_array();从结果集中获取一行数据并将其作为数组返回。对该函数的每次后续调用都将返回结果集中的下一行，或者null如果没有更多行。*/
                ?>
                    <!--  输出每一个主题名 -->
                    <a href="conversation.php?themeid=<?php echo $row2['themeid'] ?>">主题<?php echo $i; ?>：<?php echo $row2['themename'] ?></a><br>
                <?php
                }
                ?>
            </div>
            <!-- “一、选择主题；”模块结束 -->
            <!-- “二、选择情景；”模块开始 -->
            <span class="select_icon">选择情景</span><br>
            <div class="scene" id="scene">
                <?php
                $themeid = $_GET['themeid'];
                if (!empty($themeid)) { //是否选择了主题
                    /* $_SESSION['theme_id'] = $_GET['theme_id']; */
                    //是，在总情景表里查询该主题下有多少个情景
                    $query3 = "SELECT count(*)as number_scene FROM scene WHERE themeid='$themeid'";
                    $result3 = mysqli_query($db_connect, $query3);
                    $row3 = mysqli_fetch_array($result3, MYSQLI_BOTH);
                    $numberScene = $row3['number_scene']; //情景数量
                    //通过主题id从总情景表里查询该主题下的每一个情景名并输出
                    $query4 = "SELECT * FROM scene WHERE themeid='$themeid'";
                    $result4 = mysqli_query($db_connect, $query4);
                    /* 开始循环输出 */
                    for ($i = 1; $i <= $numberScene; $i++) {
                        $row4 = mysqli_fetch_array($result4, MYSQLI_BOTH);
                ?>
                        <a class="<?php echo $row4['sceneid']; ?>" href="conversation.php?themeid=<?php echo $themeid; ?>&sceneid=<?php echo $row4['sceneid']; ?>">情景
                            <span id="<?php echo $row4['sceneid']; ?>"></span><?php echo $row4['scenename']; ?></a>
                            <span class="click" id="click<?php echo $row4['sceneid']; ?>">√</span>
                            <br>
                <?php
                    }
                    /* 结束循环输出 */
                } //没有选择主题
                ?>

            </div>
            <!-- “二、选择情景；”模块结束 -->
            <button class="start_chat_button">开始对话</button>
        </div>
        <!-- “二、选择情景；”模块结束 -->
        <!-- “三、开始情景对话；”模块开始 -->
        <div class="chat" id="chat">
            <button class="come_back" id="come_back_select">返回</button>
            <p style="display: none;" id="convinece"><?php echo $_GET['sceneid'];?></p>
            <?php
            /*  if (isset($_GET['scene_id'])) { */ //是否选择了情景
            $_SESSION['sceneid'] = $_GET['sceneid'];
            //是，查询对话数量
            $query5 = "SELECT count(*)as number_chat FROM `" . $_SESSION['sceneid'] . "` "; //mysql,纯数字为表名的，需要加上``，否则出错
            $result5 = mysqli_query($db_connect, $query5);
            $row5 = mysqli_fetch_array($result5, MYSQLI_BOTH);
            $numberChat = $row5['number_chat']; //对话数量
            ?>
            <?php
            $query11 = "SELECT * FROM scene WHERE sceneid='" . $_SESSION['sceneid'] . "'";
            $result11 = mysqli_query($db_connect, $query11);
            $row11 = mysqli_fetch_array($result11, MYSQLI_BOTH);
            ?>
            <h2 id="scenename"><?php echo $row11['scenename']; ?></h2><br><!-- 情景名字 -->
            <!-- “1、输出原文模块；”模块开始 -->
            
            <div class="original-text">
            <button id="start_chat_box">开始复述</button>
                <?php
                //通过情景id找记录该情景原文的数据表，接着获取原文
                $query6 = "SELECT * FROM `" . $_SESSION['sceneid'] . "` "; //mysql,纯数字为表名的，需要加上``，否则出错
                $result6 = mysqli_query($db_connect, $query6);
                /* 原文循环输出开始 */
                for ($i = 1; $i <= $numberChat; $i++) {
                    $row6 = mysqli_fetch_array($result6, MYSQLI_BOTH);
                ?>
                    <P><span class="character-name"><?php echo $row6['character']; ?>&nbsp</span><?php echo $row6['chat']; ?></P>
                    <P><span class="character-name"><?php echo $row6['character2']; ?>&nbsp</span><?php echo $row6['chat2']; ?></P>
                <?php
                }
                /* 原文循环输出结束 */
                ?>
                
            </div>
            <!-- “1、输出原文模块；”模块结束 -->
            <!-- “2、开始对话模块；”模块开始 -->
            <div class="chat-box">
            <button class="come_back" id="come_back_text">查看原文</button><br>
                <script></script><!-- 待实现脚本：开始人机对话按钮 -->
                <?php
                //获取第一组对话
                $_SESSION['chatid'] = 1;
                $query7 = "SELECT * FROM `" . $_SESSION['sceneid'] . "` WHERE chatid ='" . $_SESSION['chatid'] . "' ";
                $result7 = mysqli_query($db_connect, $query7);
                $row7 = mysqli_fetch_array($result7, MYSQLI_BOTH);
                //为角色1、2赋值名字和角色1赋值文本
                $name1 = $row7['character'];
                $name2 = $row7['character2'];
                $text1 = $row7['chat'];
                ?>
                <!-- “标记用于存放对话的界面；”模块开始 -->
                <span id="character1" class="character-box-name>">角色:<span><?php echo $name1; ?></span></span>
                <p id="chat_text1"><?php echo $text1; ?></p>
                <br>
                <form action="" name="chat">
                    <span id="character2" class="character-box-name>">角色:<span><?php echo $name2; ?></span></span><br>
                    <input type="text" id="user_text2" name="user_text2">
                    <span id="answer_button" onclick="showResult(user_text2)">回复</span>
                </form>
                <span class="result">结果：<span id="chat_result"></span></span><br>
                <!-- “标记用于存放对话的界面；”模块结束 -->
            </div>
            <!-- “2、开始对话模块；”模块结束 -->
            <?php
            /* }  */ //没有选择情景 
            ?>
        </div>
        <!-- “三、开始情景对话；”模块结束 -->

    </div>

    </div>
</body>

</html>