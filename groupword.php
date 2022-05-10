<?Php //该文件用于接收"下一组"/"上一组"按钮发送的数据
require "config.php";


//接收数据(最后一个单词id,表名)，展示上一组，
if(isset($_POST['word_previous'])){
$word_previous = json_decode($_POST['word_previous'], true);
$wordid_first = $word_previous['wordid_first'];
$word_theme_name = $word_previous['word_theme_name'];
//上一组
$f = $wordid_first - 21;
$query1 = "SELECT * FROM `$word_theme_name` WHERE wordid > '$f'";
$result1 = mysqli_query($db_connect, $query1);
//开始循环输出
$result_previous = array();
for ($j = 1; $j <= 20; $j++) {
    $row1 = mysqli_fetch_array($result1, MYSQLI_BOTH);
    $result_previous[$j - 1] = array(
        $row1['wordid'], $row1['word'], $row1['translation']
    );
}
echo  json_encode($result_previous);
}


//接收数据(最后一个单词id,表名)，展示下一组，
if(isset($_POST['word_next'])){
$word_next = json_decode($_POST['word_next'], true);
$wordid_last = $word_next['wordid_last'];
$word_theme_name = $word_next['word_theme_name'];
//下一组
$query2 = "SELECT * FROM `$word_theme_name` WHERE wordid > '$wordid_last' "; //从该单词表里提取单词
$result2 = mysqli_query($db_connect, $query2);
//开始循环输出
$result_next = array();
for ($i = 1; $i <= 20; $i++) {
    $row2 = mysqli_fetch_array($result2, MYSQLI_BOTH);
    $result_next[$i - 1] = array(
        $row2['wordid'], $row2['word'], $row2['translation']
    );
}
echo  json_encode($result_next);
}
?>
