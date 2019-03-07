<?php
  require_once 'config.php';
  require_once 'functions.php';
  $categoryId = $_GET["categoryId"];

  $connect = connect();
  $sql = "SELECT p.id,p.title,p.created,p.content,p.views,p.likes,p.feature,c.name,d.nickname, 
          (SELECT count(id) FROM comments WHERE post_id = p.id) as commentsCount
          FROM posts p
          LEFT JOIN categories c on c.id = p.category_id
          LEFT JOIN users d on d.id = p.user_id
          WHERE p.category_id = {$categoryId}
          LIMIT 10";
  $listArr = query($connect,$sql);
	// echo "<pre>";
	// print_r($listArr);
	// echo "</pre>";

	
?>

<!DOCTYPE html>  
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="static/assets/css/style.css">
  <link rel="stylesheet" href="static/assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>
    <?php include_once 'public/_header.php'?>
    <?php include_once 'public/_aside.php'?>
    <div class="content">
      <div class="panel new">
        <h3><?php echo $listArr[0]['name']?></h3>
        <?php foreach ($listArr as $value):?>
        <div class="entry">
                <div class="head">
                  <span class="sort"><?php echo $value['name']?></span>
                  <a href="detail.php?postId=<?php echo $value['id']?>"><?php echo $value['title']?></a>
                </div>
                <div class="main">
                  <p class="info"><?php echo $value['nickname']?> 发表于 <?php echo $value['created']?></p>
                  <p class="brief"><?php echo $value['content']?></p>
                  <p class="extra">
                    <span class="reading">阅读(<?php echo $value['views']?>)</span>
                    <span class="comment">评论(<?php echo $value['commentsCount']?>)</span>
                    <a href="javascript:;" class="like">
                      <i class="fa fa-thumbs-up"></i>
                      <span>赞(<?php echo $value['likes']?>)</span>
                    </a>
                    <a href="javascript:;" class="tags">
                      分类：<span>星球大战</span>
                    </a>
                  </p>   
                  <a href="javascript:;" class="thumb">
                    <img src="<?php echo $value['feature']?>" alt="">
                  </a>
                </div>
              </div> 
        <?php endforeach ?> 
        <!-- 加载更多的按钮功能 -->
        <div class="loadMore">
          <span class="btn">加载更多</span>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
<script src="static/assets/vendors/jquery/jquery.js"></script>
<script>
  $(function () {
      var currentPage = 1;
      //给加载更多的按钮 注册点击事件
      $(".loadMore .btn").on("click",function () {  
          //请求后台,加载更多与当前分类相关的接口
          var categoryId = location.search.split("=")[1];
          currentPage++; 
          $.ajax({
            type: "POST",
            url: "api/_getMorePost.php",
            data: {
              categoryId:categoryId,
              currentPage:currentPage,
              pageSize:10
            },
            success: function (response) {
                if (response.code ==1) {
                  var data = response.data;
                  data.forEach(value => {
                  var str='<div class="entry">\
															<div class="head">\
																 <span class="sort">'+value["name"]+'</span>\
																 <a href="detail.php?postId='+value["id"]+'">'+value["title"]+'</a>\
															</div>\
															<div class="main">\
																<p class="info">'+value["nickname"]+' 发表于 '+value["created"]+'</p>\
																<p class="brief">'+value["content"]+'</p>\
																<p class="extra">\
																<span class="reading">阅读('+value["views"]+')</span>\
																<span class="comment">评论('+value["commentCounts"]+')</span>\
																<a href="javascript:;" class="like">\
																<i class="fa fa-thumbs-up"></i>\
																<span>赞('+value["likes"]+')</span>\
																</a>\
																<a href="javascript:;" class="tags">\
																分类：<span>星球大战</span>\
																</a>\
																</p>\
																<a href="javascript:;" class="thumb">\
																<img src="'+value["feature"]+'" alt="">\
																</a>\
															 </div>\
                        </div> ';
                        var entry = $(str);
                        // console.log(entry);
                        entry.insertBefore(".loadMore .btn");
                  });
                  //生成完成结构完毕之后,判断是否在没有文章了
                  var maxPage = Math.ceil(response.pageCount / 10);
                  if(currentPage == maxPage){
                    $(".loadMore .btn").hide();
                  }
                }
            }
          });
      });
  });
</script>
</html>
