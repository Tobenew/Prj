<?php
/*
    1.连接数据库
    2.查询所有的分类数据
    3.根据数据库的数据生成结构
*/
  // 连接数据库
  $connect = mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME);
  // var_dump($connect);
  //准备SQL语句
  $sql = "SELECT * FROM categories WHERE id!=1" ;
  //执行查询
  $result = mysqli_query($connect,$sql);    
  //把数据集合转换成二维数组
  $arr = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
  }
?>

<div class="header">
      <h1 class="logo"><a href="index.html"><img src="static/assets/img/logo.png" alt=""></a></h1>
      <ul class="nav">
        <!-- <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li> -->
        <!-- 遍历二维数组,生成结构 -->
        <?php foreach ($arr as  $value): ?>
        <li><a href="list.php?categoryId=<?php echo $value['id']?>"><i class="fa <?php echo $value['classname'] ?>"></i><?php echo $value['name']?></a></li>
        <?php endforeach?>

      </ul>
      <div class="search">
        <form> 
          <input type="text" class="keys" placeholder="输入关键字">
          <input type="submit" class="btn" value="搜索">
        </form>
      </div>
      <div class="slink">
        <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
      </div>
    </div>