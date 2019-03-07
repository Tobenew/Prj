<?php 

include_once './common/checkLogin.php';

?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href=".././static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href=".././static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href=".././static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href=".././static/assets/css/admin.css">
  <script src=".././static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include_once './common/nav.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger" style="display:none">
        <strong>错误！</strong><span id="errMsg"></span>
      </div>
      <div class="row">
        <div class="col-md-4">
          <form>
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            </div>
            <div class="form-group">
              <label for="classname">类名</label>
              <input id="classname" class="form-control" name="classname" type="text" placeholder="类名">
            </div>
            <div class="form-group">
              <input type="button" id="btn-add" value="添加" class="btn btn-primary">
              <input type="button" style="display:none;" id="btn-edit" value="完成编辑" class="btn btn-primary">
              <input type="button" style="display:none;" id="btn-cancel" value="取消编辑" class="btn btn-primary">
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm alldel" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
                <th>Slug</th>
                <th>类名</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
             <!-- 分类信息坑 -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php include_once './common/aside.php'; ?>

<script src="../static/assets/vendors/jquery/jquery.js"></script>
<script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
<script>NProgress.done()</script>
<script src="../static/assets/vendors/art-template/template-web.js"></script>
<script type="text/template" id="cateTpl">
  {{each data}}
    <tr>
      <td class="text-center"><input type="checkbox"></td>
      <td>{{$value.name}}</td>
      <td>{{$value.slug}}</td>
      <td>{{$value.classname}}</td>
      <td class="text-center">
        <a href="javascript:;" data-categoryId="{{$value.id}}" class="btn btn-info btn-xs edit">编辑</a>
        <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
      </td>
    </tr>
  {{/each}}
</script>
<script type="text/template" id="addCate">
    <tr>
      <td class="text-center"><input type="checkbox"></td>
      <td>{{name}}</td>
      <td>{{slug}}</td>
      <td>{{classname}}</td>
      <td class="text-center">
        <a href="javascript:;" class="btn btn-info btn-xs edit">编辑</a>
        <a href="javascript:;" class="btn btn-danger btn-xs del">删除</a>
      </td>
    </tr>
</script>
<script>
  $(function(){
    // 获取分类数据
    $.ajax({
      type:"post",
      url:"./api/getCategories.php",
      dataType:"json",
      success:function(res){
         if(res.code==1){
           var html = template("cateTpl",res);
           $("tbody").html(html);
         }
      }
    })

    // 添加分类信息
    $("#btn-add").click(function(){

      var name = $('#name').val();
      var slug = $('#slug').val();
      var classname = $('#classname').val();

      $.ajax({
        type:"post",
        url:"./api/addCategory.php",
        data:{
          "name":name,
          "slug":slug,
          "classname":classname
        },
        beforeSend:function(){
          if(name.trim()==""||slug.trim()==""||classname.trim()==""){
            $(".alert").show();
            $("#errMsg").html("请填写完整信息");
            return false;
          }
        },
        dataType:"json",
        success:function(res){
            if(res.code==0){
              $(".alert").show();
              $("#errMsg").html(res.msg);
            }else{
              var addHtml = template("addCate",{"name":name,"slug":slug,"classname":classname})
              $(addHtml).appendTo("tbody");
              // $("tbody").append(addHtml);
              $(".alert").hide();
              $("#name").val("");
              $("#slug").val("");
              $("#classname").val("");
            }
        }
      })

    })

    // 编辑按钮的事件绑定 一定要用事件委托的形式，因为分类信息是动态渲染的
    var currentRow = null;
    $("tbody").on("click",".edit",function(){
      
      // 按钮的隐藏与显示
      $("#btn-edit").show();
      $("#btn-cancel").show();
      $("#btn-add").hide();

      // 将当前行的数据取出来显示到文本框中
      var name = $(this).parent().parent().children().eq(1).text();
      var slug = $(this).parent().parent().children().eq(2).text();
      var classname = $(this).parent().parent().children().eq(3).text();  
      $("#name").val(name);
      $("#slug").val(slug);
      $("#classname").val(classname);

      // 获取当前a标签上保存的自定义属性性，这个属性保存的是分类id号
      // 再将这个id号传递给确认更新按钮
      var categoryId = $(this).attr("data-categoryId");
      $("#btn-edit").attr("data-categoryId",categoryId);

      // 保存当前行元素交给"全局变量",在更新成功后还需要把更新后的数据再填充回去
      currentRow = $(this).parent().parent()

    })
    
    // 更新按钮 
    $("#btn-edit").click(function(){
       
      var name = $('#name').val();
      var slug = $('#slug').val();
      var classname = $('#classname').val();
      var id =$(this).attr('data-categoryId');

      $.ajax({
        type:"post",
        url:"./api/updateCategory.php",
        data:{
          "id":id,
          "name":name,
          "slug":slug,
          "classname":classname
        },
        beforeSend:function(){
          if(name.trim()==""||slug.trim()==""||classname.trim()==""){
            $(".alert").show();
            $("#errMsg").html("请填写完整信息");
            return false;
          }
        },
        dataType:"json",
        success:function(res){
            if(res.code==0){
              $(".alert").show();
              $("#errMsg").html(res.msg);
            }else{
              // 将更新后的数据再填充更新行的td中
              currentRow.children().eq(1).text(name);
              currentRow.children().eq(2).text(slug);
              currentRow.children().eq(3).text(classname);
              // 清空
              $(".alert").hide();
              $("#name").val("");
              $("#slug").val("");
              $("#classname").val("");
            }
        }
      })
    })

    // 取消编辑按钮
    $("#btn-cancel").click(function(){
      $(".alert").hide();
      $("#name").val("");
      $("#slug").val("");
      $("#classname").val("");

      $("#btn-add").show();
      $("#btn-edit").hide();
      $("#btn-cancel").hide();
    })
    //单个分类数据删除
    $("tbody").on("click",function () {  
      $that = this;
      var id = $(this).parent().parent().attr("data-categoryId");

      $.ajax({
        type: "post",
        url: "./api/delCategroy.php",
        data:{"id":id},
        dataType: "json",
        success: function (response) {
          if (response.code==0) {
            
          }else{
            $(that).parent().parent().remove();
          }
        }
      });
    })
    //批量的分类删除
    $("thead input").on("click", function () {
      var status = $(this).prop("checked");
      $("tbody :checkbox").prop("checked",status);
    });
    //tbody中的选中按钮
    $("tbody").on("click", function () {
      



    });

    //批量删除功能
    $(".alldel").on("click", function () {
      var arr[];
      $("tbody :checked:checked").each(function (index,value) { 
        var id = $(this).parent().parents().attr("data-categoryId");
        arr.push(id);
       })

       var str = arr.join();

       $.ajax({
         type: "post",
         url: "./api/delCategroies.php",
         data: {"ids":str},
         dataType: "json",
         success: function (response) {
           if (response.code == 0) {
             $(".alert").show();
             $("#errMsg").html(response.mag);
           }else{
             $("tbody:checkbox:checked").parent().parent().remove();
           }
         }
       });
    });
  })



</script>
</body>
</html>
