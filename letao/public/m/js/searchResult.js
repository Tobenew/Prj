window.onload=function () {
    $(function(){
        //ssearch搜索关键词 
        var kw = location.search.split("=")[1];
        var page = 1;
        var pageSize =2;
        $.ajax({
            type: "get",
            url: "/product/queryProduct",
            data: {
                "proName":kw,
                "page":page,
                "pageAize":pageSize
            },
            success: function (res) {   
                var html = template("searchResultTpl",res);
                $("#searchResultList").html(html);
                
            }
        });
    })
}