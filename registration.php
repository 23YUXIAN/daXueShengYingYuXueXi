<!DOCTYPE html>
<html lang="zh-cn" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/registration.css" rel="stylesheet" type="text/css" />
    <!-- <script type="text/javascript" src="./js/jquery-1.11.1.min.js"></script> -->
    <title>大学生英语学习</title>
    <script>
        //检测注册信息的格式
        function check123() {
            //检查邮箱
            var e = document.getElementById('email').value;
            if (e == "") {
                alert("请输入邮箱");
                return false;
            } else {
                var z = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
                /* 只允许英文字母、数字、下划线、英文句号、以及中划线组成 */
                if (z.test(e)) {} else {
                    alert("请输入正确格式的邮箱");
                    return false;
                }
            }
            //检查密码
            var p1 = document.getElementById('password').value;
            if (p1 == "") {
                alert("请输入密码");
                return false;
            } else {
                var x = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,8}$/;
                /* 密码只能包含字母和数字的，且在6到8位之间 */

                if (x.test(p1)) {} else {
                    alert("请输入正确格式的密码");
                    return false;
                }
            }
            //检查确认密码
            var p2 = document.getElementById('password1').value;
            if (p2 == "") {
                alert("请确认密码");
                return false;
            } else {
                if (p2 == p1) {

                } else {
                    alert("请确认密码输入一致");
                    return false;
                }
            }
            //检查昵称
            var n = document.getElementById('name').value;
            if (n == "") {
                alert("请输入昵称");
                return false;
            } else {
                var y = /^.(?:\w)[0-9A-Za-z]{1,20}$/;
                if (y.test(n)) {} else {
                    alert("请输入正确格式的昵称");
                    return false;
                }
            }
        }
    </script>
</head>

<body>

    <?php require "./top.php" ?>
    <div class="registration-box">
        <form method="POST" action="checkregistration.php" name="form_registration">
            <label for="email">邮箱</label>
            <input type="email" name="uemail" id="email">
            <br>
            <label for="password">密码</label>
            <input type="password" name="upassword" id="password">
            <br>
            <span class="tishi">只能包含字母和数字的，且在6到8位之间</span>
            <br>
            <label for="password1">确认密码</label>
            <input type="password" name="password1" id="password1">
            <br>
            <label for="name">昵称</label>
            <input type="text" name="uname" id="name">
            <br>
            <span class="tishi">只能包含数字、字母，且到3到20个字符之间</span>
            <br>
            
            <input type="submit" class="zhuce" value="注册" onclick="return check123()">
        </form>
        <a href="login.php">已有账号，前去登录？</a>
    </div>


</body>

</html>