<?php
    require_once "../config.php";
    require_once "../functions.php";

    $currentPage = $_POST['currentPage'];
    $pageSize = $_POST['$pageSize'];
    // 计算偏移量
    $offset = ($currentPage - 1)*$pageSize;

    // 连接数据库拿数据
   $connect = connect();
   $sql ="";
   $commentArr = query($connect,$sql);
   $res = ["code"=>0,"msg"=>"请求评论数据失败"];
   if($commentArr){
    $res= ["code"=>1,"msg"=>"请求评论数据成功"];
    $res['data']= $commentArr;
   }

   echo json_decode($commentArr);
?>