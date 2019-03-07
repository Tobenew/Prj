<?php
// 1.完成的是登陆的功能
// 2.收集用户的数据,发送到服务端
// 3.把用户数据和数据库数据对比
// 4.把登录结果发给前台

// 前端  
//   登录按钮注册点击事件
//     收集用户的数据,ajax发送给服务端
//     判断返回的数据是否登陆成功
//       成功就跳转到后台页面,否则提示错误
// 后端
//   得到用户的邮箱和密码
//   根据邮箱h和密码到数据库中查找有没有对应的数据
//   最终通知前台是否登录成功
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../static/assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap">
      <img class="avatar" src="../static/assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger" style="display:none">
        <strong>错误！</strong> <span id="msg"></span>
      </div>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" type="email" class="form-control" placeholder="邮箱" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" type="password" class="form-control" placeholder="密码">
      </div>
      <span class="btn btn-primary btn-block" href="#" id="btn-login" style="submit">登 录</span>
    </form>
  </div>
</body>
<script src="../static/assets/vendors/jquery/jquery.js"></script>
<script>
    $(function(){
        //给登录按钮添加点击事件
        $('#btn-login').on('click',function(){
            // 1.收集用户的账号密码 
            var email = $('#email').val();
            var password = $('#password').val();
            // 2.做简单的正则校验
            var reg = /\w+[@]\w+[.]\w+/;
            //如果账号校验不对
            if(!reg.test(email)){
                $('#msg').text('您输入的邮箱格式有误!');
                $('.alert').show();
                return;
            };
            //3.校验完毕,ajax发送数据给后台校验
            $.ajax({
              type: "post",
              url: "../api/_userLogin.php",
              data: {email:email,
                    password:password },
              dataType: "json",
              success: function (response) {
                if (response.code == 1) {
                    $("#msg").text("登录进去了");
                    console.log(121312);
                    
                    // $(".alert").hide();
                  location.href="./index.php"; 
                }else{
                    $("#msg").text("用户名或者密码错误");
                    $(".alert").show();
                }
              }
            });
        });
    });
</script>
</html>
