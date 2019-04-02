window.onload=function () {
    mui('.mui-scroll-wrapper').scroll({
        deceleration: 0.0005 //flick 减速系数，系数越大，滚动速度越慢，滚动距离越小，默认值0.0006
    });
    // 请求一级分类书籍
    $.ajax({
        type:'get',
        url:'/category/queryTopCategory',
        dataType:'json',
        success: function(res) {
            console.log(res);
            var html = template("topCategoryTpl",res);
            $("#topCategoryList").html(html);
            // 一级分类加载完成后请求第一个分类的二级分类信息
            $("#topCategoryList").find("li").eq(0).addClass("active");
            var firstTopid = res.rows[0].id;
            console.log(firstTopid);
            
            getSecondCategory(firstTopid);
        }

    })

    // 请求二级分类数据
   $("#topCategoryList").on('click',"li",function(){
    //    alert(1);
      $(this).addClass('active').siblings().removeClass('active');
      var id = $(this).data("id");
      getSecondCategory(id);

   })

   //封装二级分类的方法
   function getSecondCategory(id) {
        $.ajax({
        type: "get",
        url: "/category/querySecondCategory",
        data: {
            "id" : id,
        },
        dataType: "json",
        success: function (res) {
            console.log(res);
            var html = template("secondCategoryTpl",res);
            $("#secondCategoryList").html(html);
        }
    })
   }
}