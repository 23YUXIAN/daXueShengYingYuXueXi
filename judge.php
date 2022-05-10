<?Php //该文件用于接收情景对话，在分析之后，得出相似度，也就是正确率，返回text1是下一句对白还是保持不变
require "config.php";
session_start();

$user_text2 = $_POST['user_text2'];
//获取text2原文
$query8 = "SELECT * FROM `".$_SESSION['sceneid']."` WHERE chatid ='".$_SESSION['chatid']."' "; 
$result8 = mysqli_query($db_connect, $query8);
$row8 = mysqli_fetch_array($result8,MYSQLI_BOTH);
$text2 = $row8['chat2'];
//对比，获取相似度
/* $_SESSION['ss']=0; */
similar_text($text2, $user_text2, $similarity);
$next=intval($similarity);
$query10 = "SELECT count(*)as number_chat FROM `".$_SESSION['sceneid']."` "; //mysql,纯数字为表名的，需要加上``，否则出错
$result10 = mysqli_query($db_connect, $query10);
$row10 = mysqli_fetch_array($result10, MYSQLI_BOTH);
$numberChat = $row10['number_chat']; //对话数量

$chat_result;
if($next>60){//大于
$_SESSION['chatid']++;
if($_SESSION['chatid'] > $numberChat ){
    $chat_result="恭喜通过，成功对话！继续挑战其他情景吧！";
}else{
    $chat_result="没错，继续对话吧";
}
$query9 = "SELECT * FROM `".$_SESSION['sceneid']."` WHERE chatid ='".$_SESSION['chatid']."' "; 
$result9 = mysqli_query($db_connect, $query9);
$row9 = mysqli_fetch_array($result9,MYSQLI_BOTH);
$text1 = $row9['chat'];
$resultN=array('chat_result'=>$chat_result,'text1'=>$text1);
echo json_encode($resultN);
}else{//小于
    $chat_result="不对哦，请再回复！";
    $text1=$row8['chat'];
    $resultN=array('chat_result'=>$chat_result,'text1'=>$text1);
    echo json_encode($resultN);
}
?>