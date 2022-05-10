<?php 
header('Content-type:text/html;chaeset=utf-8');
error_reporting(0);
//设置数据库的主机、用户、密码、数据库
$db_host = "localhost";
$db_user = "root";
$db_password = "123456";
$db_name = "dxsyyxx";
//连接数据库 插入SQL语句以设置编码格式,防止乱码
$db_connect = mysqli_connect($db_host,$db_user,$db_password,$db_name) or die("数据库平台连接错误：" . mysqli_error($db_connect));
mysqli_query($db_connect,'SET NAMES UTF8') or die ('编码格式/字符集错误，错误类型是：' . mysqli_error($db_connect));
?>