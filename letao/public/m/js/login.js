$(function () {  
    $(".loginBtn").on("tap", function () {
        var userName = $.trim($('[name="userName"]').val());
        var password = $.trim($('[name="password"]').val());
        if(!userName){
            mui.toast("请输入用户名");
            return;
        }
        if(!password){
            mui.toast("请输入密码");
            return;
        }
        $.ajax({
            type: "post",
            url: "/user/login",
            data: {
                username: userName,
                password :password
            },
            beforeSend:function () {
                $('.loginBtn').html("正在登录中......");
              },
            success: function (res) {
                $('.loginBtn').html("登录");
                mui.toast("登录成功");
                setTimeout(() => {
                    location.href="user.html";
                }, 2000);
            }
        });
    });
})