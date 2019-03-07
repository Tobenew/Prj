<?php
    require_once "../config.php";
    require_once "../functions.php";

$email = $_POST['email'];
$password = $_POST['password'];
// /连接数据库,拿数据
echo $email;
echo $password;

$connect = connect();
$sql = "SELECT * FROM users WHERE email = '{$email}' and password = '{$password}' and status = 'activated' ";
$queryResult = query($connect,$sql);

// 判断数据是对比正确
$response = ['code'=>0,'msg'=>'操作失败'];
if($queryResult){
    $response = ['code'=>1,'msg'=>'登陆成功']; 
}
//以json格式返回数据
header("content-type:application/json;charset=utf-8s")
?>