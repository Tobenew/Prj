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
      <div class="alert alert-danger">
        <!-- <strong>错误！</strong> -->
         <span id="msg"></span>
      </div>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" type="email" class="form-control" placeholder="邮箱" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" type="password" class="form-control" placeholder="密码">
      </div>
      <span type="submit" class="btn btn-primary btn-block" href="#" id="btn-login">登 录</span>
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
            console.log(email);
            console.log(password);

            
            //3.校验完毕,ajax发送数据给后台校验
            $.ajax({
                type:"POST",
                data:{
                  email:email,
                  password:password
                },
                dataType:'json',
                url:"../api/_userLogin.php",
                success:function(){
                    
                }
            });
        });
    });
</script>
</html>
