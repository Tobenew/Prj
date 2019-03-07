<?php
    require_once "../config.php";
    require_once "../functions.php";

    // 接收前台发送过来的数据
    $email = $_POST["email"];
    $password = $_POST["password"];

    // 向服务器发送请求
    $conn = connect();
    $sql = "select * from users where email = '{$email}' and password = '{$password}' and status = 'activated'";
    $loginArr = query($conn,$sql);
    // print_r($loginArr);
    $response = ["code"=>0,"msg"=>"登录失败"];
    if ($loginArr) {
        $response = ["code"=>1,"msg"=>"登录成功"];
        session_start();
        $_SESSION['isLogin'] = 1314; 
    }
    //以json格式返回
    header("content-type:application/json;charset=utf-8");
    echo json_encode($response);
?>  