<?php
    $ids = $_POST["ids"];
    include_once "../../common/mysql.php" ;
    $conn = connect();
    $sql =  "delect from categories where id in ($ids)";
    $bool = query($conn,$sql);

    $res = array("code"=>0,"msg"=>"批量删除成功");
?>