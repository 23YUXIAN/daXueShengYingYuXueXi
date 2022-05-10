<?php
require "config.php";
session_start();
$search_key = $_GET['search_key'];
?>
<!DOCTYPE html>
<html lang="zh-cn" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/index.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="./js/jquery-1.11.1.min.js"></script>
    <title>大学生英语学习</title>
    <script>
       $(function(){   
    $(".introduction").show();
    $(".search").hide();
if($("#dd").text() == ""){
    $(".introduction").show();
    $(".search").hide();
}else{
    $(".introduction").hide();
    $(".search").show();
}
          /*  $("#show-start").click(function(){
               $(".introduction").hide();
               $(".search").show();
           }) */
       });
    </script>
</head>

<body>
    <!-- 导航条模块开始 -->
    <div class="top">
        <?php require "top.php"; ?>
    </div>
    <!-- 导航条模块结束 -->
    <!-- 网页内容模块开始 -->
    <div class="introduction" >
        <p>欢迎来到大学生英语学习，在本网站，你可以进行情景对话、故事再现增强使用英语对话的能力，还可以建立个人的单词基地，提高单词量，如果学累了，那就去分享和欣赏英语学习心得吧！加油，我们一起讲英语！</p>
    </div>
    <div class="search">
        <?php
        $row1;
        if ($search_key != "") {
            $query1 = "SELECT * FROM all_word WHERE word='$search_key'";
            $result1 = mysqli_query($db_connect, $query1);
            if ($result1 == false) {
                echo "目前单词库没有该单词信息！";
            }
            $row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
        }
        ?>
        <P>
            <span id="dd"><?php echo $row1['word']; ?></span><br>
            <p id="nn"><?php echo $row1['translation']; ?></p>
        </P>
<?php 
$search_key="";
?>
    </div>

    <!-- 网页内容模块结束 -->
    <!-- <div style="height: 40px; background:#a1bbeb;"></div>
    <div style="height: 40px; background:rgba(144, 163, 185, 0.5);"></div>
    <div style="height: 40px; background:#6092EE;"></div>
    <div style="height: 40px; background:#5486e2;"></div>
    <div style="height: 40px; background:#4193a9"></div> -->
</body>

</html>