<?php //该文件用于接收故事复述，在分析之后，得出相似度，也就是正确率，返回结果
require "config.php";
session_start();

$str = json_decode($_POST['str'],true);
$user_story = $str['user_story'];
$story_level = $str['story_level'];
$original_story =$str['original_story'];

similar_text($_SESSION['original_story'], $user_story, $similarity);
$SS=intval($similarity);
if( $SS >= $story_level ){
$story_result="恭喜，复述成功！";                                     
echo $story_result."当前准确率为".$SS."%";
    
}else{
    $story_result="加油！还差一点！";
    echo $story_result."当前准确率为".$SS."%";
}
?>