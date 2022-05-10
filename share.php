<?php
session_start();
require "config.php";
$topic = $_POST['topic'];
$main = $_POST['main'];
$query1 = "INSERT INTO discussion (topic,main,good,publisher) VALUES('$topic','$main',null,'".$_SESSION['uname']."')";
/* $result1 = mysqli_query($db_connect,$query1);
echo $result1; */
if($db_connect->query($query1) === true){
    echo ('<script type="text/javascript">
    alert("分享成功！");
    window.location.href = "http://localhost/dxsyyxx/shareandadmire.php";
    </script>')
   ;
}else{
    echo $db_connect->error;
}

?>