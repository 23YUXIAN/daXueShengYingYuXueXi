<!DOCTYPE html>
<html lang="zh-cn" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login.css" rel="stylesheet" type="text/css" />
    <!-- <script type="text/javascript" src="./js/jquery-1.11.1.min.js"></script> -->
    <title>大学生英语学习</title>
</head>

<body>
    
        <?php require "./top.php" ?>
        <div class="login-box">
            <form  method="POST" action="check.php">
                <label for="email">邮箱</label>
                <input type="email" name="uemail" id="email">
                <br>
                <label for="password">密码</label>
                <input type="password" name="upassword" id="password">
                <br>
                <input  class="denglu" type="submit" value="登录" >
            </form>
            <a href="registration.php">还没有账号，前去注册？</a>
        </div>
</body>

</html>