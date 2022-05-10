<?php
require "config.php";
$topic = $_POST['topic'];
//将点击数加一
$query1 = "SELECT good FROM discussion  WHERE topic = '$topic' ";
$result1 = mysqli_query($db_connect,$query1);
$row1 = mysqli_fetch_array($result1,MYSQLI_BOTH);
$good_before = $row1['good'];
$good_after = $good_before + 1;
$query2 = "UPDATE discussion SET good='$good_after' WHERE topic = '$topic' ";
$db_connect->query($query2);
$query3 = "SELECT * FROM discussion WHERE topic = '$topic' ";
$result3 = mysqli_query($db_connect,$query3);
$row3 = mysqli_fetch_array($result3,MYSQLI_BOTH);
$result = array(
    "publisher"=>$row3['publisher'],
    "good"=>$row3['good'],
    "topic"=>$row3['topic'],
    "main"=>$row3['main']);
echo json_encode($result);
?>