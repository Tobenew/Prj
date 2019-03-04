<?php
    require_once "../config.php";
    require_once "../functions.php";
// 1.获取分类id,一共要获取多少条
    $categoryId = $_POST["categoryId"];
    $currentPage = $_POST["currentPage"];
    $pageSize = $_POST["pageSize"];
    // 1.2
    $offset = ($currentPage - 1)*$pageSize;     
// 2.
    $connect = connect();
    
    
// 3.
    $sql = "SELECT p.id,p.title,p.created,p.content,p.views,p.likes,p.feature,c.name,d.nickname, 
            (SELECT count(id) FROM comments WHERE post_id = p.id) as commentsCount
            FROM posts p
            LEFT JOIN categories c on c.id = p.category_id
            LEFT JOIN users d on d.id = p.user_id
            WHERE p.category_id = {$categoryId}
            LIMIT {$offset},{$pageSize}";

    $postArr = query($connect,$sql); 
    // 查询文章总的数量
    $sqlCount = "SELECT count(id) as postCount FROM posts WHERE category_id = {$categoryId}";
    $countArr = query($connect,$sqlCount);
    $pageCount = $countArr[0]['postCount'];

    $response = ["code"=>0,"msg"=>"操作失败"];

    if($postArr){
        $response["code"] =1;
        $response["msg"] = "操作成功";
        $response["data"] = $postArr;
        $response["pageCount"] = $pageCount;
    }
    header("content-type:application/json;charset=utf-8;");
    echo json_encode($response);
?>