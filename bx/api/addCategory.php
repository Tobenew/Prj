<?php
    require_once "../config.php";
    require_once "../functions.php";
//接收数据
$name = $_POST['name'];
$slug = $_POST['slug'];
$className = $_POST['className'];

include_once '../functions.php';
$connect = connect();
$sql = "select count(*) as count from categories where name = '$name'";
$arrQuery = query($connect,$sql);

$res = ["code"=>0,"msg"=>"该分类已经存在,无法添加"];
if($arrQuery[0]['count']>0){
    $res['msg']= "分类名称重名";
}else{
    $addSql = "insert into categories values(null,'$slug','$name','$className')";
    $bool = mysqli_query($connect,$addSql);
    if($bool){
        $res['code'] = 1;
        $res['msg'] = "分类插入成功";
    }
}
    echo json_encode($res);
?>