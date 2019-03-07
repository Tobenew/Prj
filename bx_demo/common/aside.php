<?php 
// 1.連接數據庫
// $conn = mysqli_connect("localhost","root","root","baixiu");
// // 2.構建sql語句
// $cate_sql = "select * from categories";
// // 3.執行語句
// $cate_res = mysqli_query($conn,$cate_sql);
// while($row = mysqli_fetch_assoc($cate_res)){
//   $cate_arr[] = $row;
// }
// print_r($arr);
// 
// ----------------------------
include_once './common/mysql.php';

// $conn = connect();
$cate_sql = "select * from categories";
$cate_arr = query($conn,$cate_sql);

?> 

<div class="header">
      <h1 class="logo"><a href="index.php"><img src="./static/assets/img/logo.png" alt=""></a></h1>
      <ul class="nav">
      <?php foreach($cate_arr as $value): ?>
        <li><a href="list.php?categoryId=<?= $value['id'] ?>"><i class="fa <?= $value['classname'] ?>"></i><?= $value['name']   ?></a></li>
      <?php endforeach; ?>
      </ul>
      <div class="search">
        <form>
          <input type="text" class="keys" placeholder="输入关键字">
          <input type="submit" class="btn" value="搜索">
        </form>
      </div>
      <div class="slink">
        <a href="javascript:;">链接011</a> | <a href="javascript:;">链接022</a>
      </div>
</div>
<div class="aside">
  <div class="widgets">
    <h4>搜索</h4>
    <div class="body search">
      <form>
        <input type="text" class="keys" placeholder="输入关键字">
        <input type="submit" class="btn" value="搜索">
      </form>
    </div>
  </div>
  <div class="widgets">
    <h4>随机推荐</h4>
    <ul class="body random">
      <li>
        <a href="javascript:;">
          <p class="title">废灯泡的14种玩法 妹子见了都会心动</p>
          <p class="reading">阅读(819)</p>
          <div class="pic">
            <img src="./static/uploads/widget_1.jpg" alt="">
          </div>
        </a>
      </li>
      <li>
        <a href="javascript:;">
          <p class="title">可爱卡通造型 iPhone 6防水手机套</p>
          <p class="reading">阅读(819)</p>
          <div class="pic">
            <img src="./static/uploads/widget_2.jpg" alt="">
          </div>
        </a>
      </li>
      <li>
        <a href="javascript:;">
          <p class="title">变废为宝！将手机旧电池变为充电宝的Better</p>
          <p class="reading">阅读(819)</p>
          <div class="pic">
            <img src="./static/uploads/widget_3.jpg" alt="">
          </div>
        </a>
      </li>
      <li>
        <a href="javascript:;">
          <p class="title">老外偷拍桂林芦笛岩洞 美如“地下彩虹”</p>
          <p class="reading">阅读(819)</p>
          <div class="pic">
            <img src="./static/uploads/widget_4.jpg" alt="">
          </div>
        </a>
      </li>
      <li>
        <a href="javascript:;">
          <p class="title">doge神烦狗打底南瓜裤 就是如此魔性</p>
          <p class="reading">阅读(819)</p>
          <div class="pic">
            <img src="./static/uploads/widget_5.jpg" alt="">
          </div>
        </a>
      </li>
    </ul>
  </div>
  <div class="widgets">
    <h4>最新评论</h4>
    <ul class="body discuz">
      <li>
        <a href="javascript:;">
          <div class="avatar">
            <img src="./static/uploads/avatar_1.jpg" alt="">
          </div>
          <div class="txt">
            <p>
              <span>鲜活</span>9个月前(08-14)说:
            </p>
            <p>挺会玩的</p>
          </div>
        </a>
      </li>
      <li>
        <a href="javascript:;">
          <div class="avatar">
            <img src="./static/uploads/avatar_1.jpg" alt="">
          </div>
          <div class="txt">
            <p>
              <span>鲜活</span>9个月前(08-14)说:
            </p>
            <p>挺会玩的</p>
          </div>
        </a>
      </li>
      <li>
        <a href="javascript:;">
          <div class="avatar">
            <img src="./static/uploads/avatar_2.jpg" alt="">
          </div>
          <div class="txt">
            <p>
              <span>鲜活</span>9个月前(08-14)说:
            </p>
            <p>挺会玩的</p>
          </div>
        </a>
      </li>
      <li>
        <a href="javascript:;">
          <div class="avatar">
            <img src="./static/uploads/avatar_1.jpg" alt="">
          </div>
          <div class="txt">
            <p>
              <span>鲜活</span>9个月前(08-14)说:
            </p>
            <p>挺会玩的</p>
          </div>
        </a>
      </li>
      <li>
        <a href="javascript:;">
          <div class="avatar">
            <img src="./static/uploads/avatar_2.jpg" alt="">
          </div>
          <div class="txt">
            <p>
              <span>鲜活</span>9个月前(08-14)说:
            </p>
            <p>挺会玩的</p>
          </div>
        </a>
      </li>
      <li>
        <a href="javascript:;">
          <div class="avatar">
            <img src="./static/uploads/avatar_1.jpg" alt="">
          </div>
          <div class="txt">
            <p>
              <span>鲜活</span>9个月前(08-14)说:
            </p>
            <p>挺会玩的</p>
          </div>
        </a>
      </li>
    </ul>
  </div>
</div>