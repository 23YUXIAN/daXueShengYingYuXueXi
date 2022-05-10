<?php
session_start();//传值
require 'config.php';//导入配置文件

//接收邮箱和密码
$uemail = $_POST['uemail'];
$upassword = $_POST['upassword'];
//先判断邮箱或密码是否为空
if($uemail == null || $upassword == null){
    //为空，则结束，发出错误提示
    echo('
    <script type="text/javascript">
    alert("邮箱和密码都不能为空！");
    window.location.href = "http://localhost/dxsyyxx/login.php";
    </script>
    ');
    
}else{
    //不为空，则根据邮箱和密码在users表李查找用户信息
    $query = "SELECT * FROM users WHERE uemail = '$uemail' AND upassword = '$upassword'";
    $result = mysqli_query($db_connect,$query);
    $row = mysqli_fetch_array($result,MYSQLI_BOTH);
    if( $row['uemail'] != ""){
    //查询结果为有该用户信息，则提取该用户信息
    
    //提取信息成功，用session数组记录邮箱和昵称，用于之后判断是否登录
        $_SESSION['login'] = $row['uemail'];
        $_SESSION['uname'] = $row['uname'];
    //返回首页
    echo('
    <script type="text/javascript">
    window.location.href = "http://localhost/dxsyyxx/index.php";
    </script>
    ');
    }else{
        //查询结果为没有该用户信息，则提示错误
        echo('
        <script type="text/javascript">
        alert("密码或账号错误，登陆失败");
        window.location.href = "http://localhost/dxsyyxx/login.php";
        </script>
        ');
    }
}

?>