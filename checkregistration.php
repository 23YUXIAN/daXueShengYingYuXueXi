<?php
session_start();//传值
require './config.php';//导入配置文件

//接收邮箱、密码、昵称
$uemail = $_POST['uemail'];
$upassword = $_POST['upassword'];
$upassword1 = $_POST['password1'];
$uname =$_POST['uname'];
//先判断邮箱、密码、昵称是否为空
if($uemail == null || $upassword == null || $uname == null){
    //为空，则结束，发出错误提示，返回上一页
    echo('
    <script type="text/javascript">
    alert("邮箱、密码、昵称都不能为空！");
    window.location.href = "http://localhost/dxsyyxx/registration.php";
    </script>
    ');
}else{
    //不为空，则根据邮箱在users表里查找该邮箱的用户信息
    $query = "SELECT * FROM users WHERE uemail = '$uemail'";
    $result = mysqli_query($db_connect,$query);
    $row = mysqli_fetch_array($result);
    if(!empty($row['uemail'])){
    //查询结果为有该邮箱的用户信息，并提示换一个邮箱注册,返回上一页
    echo('
    <script type="text/javascript">
    alert("该邮箱已注册，请换一个邮箱！");
    window.location.href = "http://localhost/dxsyyxx/registration.php";
    </script>
    ');    
    }else{
        //查询结果为没有该邮箱的用户信息，则将接收到的邮箱、密码、昵称作为新用户信息插入users表
        $query2 = "INSERT INTO `users`(`uemail`,`upassword`,`uname`)VALUES('$uemail','$upassword','$uname')";
        $result2 = mysqli_query($db_connect,$query2);
        if($result2){
        //数据插入成功
        //创建该用户的单词本
        $query3 = "CREATE TABLE IF NOT EXISTS `".$uemail."` (
            `wordid` int(11) NOT NULL AUTO_INCREMENT,
            `word` varchar(250) CHARACTER SET utf8 NOT NULL,
            `translation` varchar(1000) CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`wordid`)
          ) ENGINE=InnoDB  AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
    $result3 = mysqli_query($db_connect,$query3);
     //创建该用户的笔记本
    $query4 = "CREATE TABLE IF NOT EXISTS `".$uemail."_note"."` (
        `noteid` int(11) NOT NULL AUTO_INCREMENT,
        `note` varchar(250) CHARACTER SET utf8 NOT NULL,
        `content` varchar(1000) CHARACTER SET utf8 NOT NULL,
        PRIMARY KEY (`noteid`)
      ) ENGINE=InnoDB  AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
$result4 = mysqli_query($db_connect,$query4);
 //创建该用户的日记本
 $query5 = "CREATE TABLE IF NOT EXISTS `".$uemail."_diary"."` (
    `diaryid` int(11) NOT NULL AUTO_INCREMENT,
    `diary` varchar(250) CHARACTER SET utf8 NOT NULL,
    `content` varchar(1000) CHARACTER SET utf8 NOT NULL,
    PRIMARY KEY (`diaryid`)
  ) ENGINE=InnoDB  AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
$result5 = mysqli_query($db_connect,$query5);
        echo('
        <script type="text/javascript">
    alert ("注册成功，返回登录");
    window.location.href = "http://localhost/dxsyyxx/login.php";
    </script> 
        ');
    }else{//数据插入失败
        echo "注册失败，请重新注册";
    
}
    }}
?>