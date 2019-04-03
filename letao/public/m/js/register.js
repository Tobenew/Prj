$(function () {
    $(".registerBtn").on("tap", function () {
        // alert(1);
        var userName = $('[name="userName"]').val();
        var mobile = $('[name="mobile"]').val();
        var password = $('[name="password"]').val();
        var againPass = $('[name="againPass"]').val();
        var vCode = $('[name="vCode"]').val();
        //注册信息验证部分
        // console.log(userName);
        


        $.ajax({
            type: "post",
            url: "/user/register",
            data: {
                "username":userName,
                "password":password,
                "mobile":mobile,
                "vCode":vCode
            },
            // dataType: "dataType",
            success: function (res) {
                console.log(res);
                setTimeout(() => {
                    location.href = "login.html"
                }, 2000);
                
            }
        });
    });
    $("#getCode").on("tap", function () {

        $.ajax({
            type: "get",
            url: "/user/vCode",
            success: function (res) {
                console.log(res.vCode);
            }
        });
    });
  })