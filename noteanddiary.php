<?Php
require "config.php";
session_start();

//输出笔记
$note_title = $_POST['note_title'];
if($note_title != ""){
    $query1 = "SELECT * FROM `".$_SESSION['login']."_note"."` WHERE note = '$note_title' ";
$result1 = mysqli_query($db_connect, $query1);
$row1 = mysqli_fetch_array($result1,MYSQLI_BOTH);
$result = array(
    "title"=>$row1['note'],
    "content"=>$row1['content']
);
echo json_encode($result);
}
//输出日记
$diary_title = $_POST['diary_title'];
if($diary_title != ""){
    $query2 = "SELECT * FROM `".$_SESSION['login']."_diary"."` WHERE diary = '$diary_title' ";
$result2 = mysqli_query($db_connect, $query2);
$row2 = mysqli_fetch_array($result2,MYSQLI_BOTH);
$result = array(
    "title"=>$row2['diary'],
    "content"=>$row2['content']
);
echo json_encode($result);
}
//写笔记
$write_note_title = $_POST['write_note_title'];
$write_note_content = $_POST['write_note_content'];
if(($write_note_title != "")&&($write_note_content != "")){
    $query3 = "INSERT INTO `".$_SESSION['login']."_note"."` (note,content) VALUES('$write_note_title','$write_note_content')";
    if($db_connect->query($query3) === true){
        echo ('<script type="text/javascript">
        alert("恭喜你又写了一篇笔记！");
        window.location.href = "http://localhost/dxsyyxx/me.php";
        </script>')
       ;
    }else{
        echo $db_connect->error;
    }
}
//写日记
$write_diary_title = $_POST['write_diary_title'];
$write_diary_content = $_POST['write_diary_content'];
if(($write_diary_title != "")&&($write_diary_content != "")){
    $query4 = "INSERT INTO `".$_SESSION['login']."_diary"."` (diary,content) VALUES('$write_diary_title','$write_diary_content')";
    if($db_connect->query($query4) === true){
        echo ('<script type="text/javascript">
        alert("恭喜你又写了一篇日记！");
        window.location.href = "http://localhost/dxsyyxx/me.php";
        </script>')
       ;
    }else{
        echo $db_connect->error;
    }
}
//输入xindanci
$write_w = $_POST['write_w'];
$write_t = $_POST['write_t'];
if(($write_w != "")&&($write_t != "")){
$query5 = "INSERT INTO `" . $_SESSION['login'] . "`(word,translation) VALUES('$write_w','$write_t')";
if($db_connect->query($query5) === true){
    echo ('<script type="text/javascript">
    alert("输入新单词成功！");
    window.location.href = "http://localhost/dxsyyxx/me.php";
    </script>')
   ;
}else{
    echo $db_connect->error;
}
}


?>