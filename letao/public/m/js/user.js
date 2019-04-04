// 在html渲染之前就获取用户信息


$(function () {
    $.ajax({
        type: "get",
        url: "/user/queryUserMessage",
        async:false,
        success: function (res) {
            console.log(res);
            if (res.error&&res.error == 400) {
                location.href = "login.html";
            }
            var html = template("userTpl",res);
            console.log(html);
            
            $("#userMsg").html(html);
        }
    });
    $("#logout").on("tap", function () {
        $.ajax({
            type: "get",
            url: "/user/logout",
            success: function (res) {
               if(res.success){
                   mui.toast("退出登录成功");
               }
               setTimeout(() => {
                   location.href = "login.html"
               }, 2000);
                
            }
        });
    });
  })