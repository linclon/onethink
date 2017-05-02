<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <title>Bootstrap 101 Template</title>

        <!-- Bootstrap -->
        <link href="/Public/Home/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/Public/Home/css/style.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .main{margin-bottom: 60px;}
            .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
        </style>
    </head>








    <body>
    <div class="main">
        <!--&lt;!&ndash;导航部分&ndash;&gt;
        <nav class="navbar navbar-default navbar-fixed-bottom">
            <div class="container-fluid text-center">
                <div class="col-xs-3">
                    <p class="navbar-text"><a href="index.html" class="navbar-link">首页</a></p>
                </div>
                <div class="col-xs-3">
                    <p class="navbar-text"><a href="#" class="navbar-link">服务</a></p>
                </div>
                <div class="col-xs-3">
                    <p class="navbar-text"><a href="#" class="navbar-link">发现</a></p>
                </div>
                <div class="col-xs-3">
                    <p class="navbar-text"><a href="#" class="navbar-link">我的</a></p>
                </div>
            </div>
        </nav>-->
        <!--导航结束-->

        <div class="container-fluid">
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><div class="row noticeList">
                    <a href="<?php echo U('Wechat/detail?id='.$row['id']);?>">
                        <div class="col-xs-2">
                            <img class="noticeImg" src="<?php echo get_cover($row['cover_id'],'path')?>" />
                        </div>
                        <div class="col-xs-10">
                            <p class="title"><?php echo ($row['title']); ?></p>
                            <p class="intro"><?php echo ($row['description']); ?></p>
                            <p class="info">浏览: <?php echo ($row['view']); ?> <span class="pull-right">2016-05-11</span> </p>
                        </div>
                    </a>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <div class="text-center">
        <input type="button" class="btn btn-info get_more" value="获取更多..">
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/Public/Home/js/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/Public/Home/bootstrap/js/bootstrap.min.js"></script>
    </body>




<script type="application/javascript">
$(function(){
    //定义并初始化分页参数
    var p = 1;
    //绑定事件
    $(".get_more").click(function(){
        //发送ajax请求,传入分页参数
        $.post("<?php echo U('inform');?>",{p:p+1},function(data){
            //查看返回数据 判断status
            if(data.status == 1){
                p++;//分页参数自增
                //遍历数据,追加
                var Html = '';
                $(data.info).each(function(i,e){
                    Html = '<div class="row noticeList">\
                            <a href="'+ e.url +'">\
                            <div class="col-xs-2">\
                            <img class="noticeImg" src="'+ e.path +'" />\
                            </div>\
                            <div class="col-xs-10">\
                            <p class="title">'+ e.title +'</p>\
                            <p class="intro">'+ e.description +'</p>\
                            <p class="info">浏览: '+ e.view +' <span class="pull-right">'+ e.create_time +'</span> </p>\
                    </div>\
                    </a>\
                    </div>';
                });
                //追加
                $('.main').append(Html);
            }else{
                //解除事件绑定
                $(".get_more").val("没有更多了");
                $(".get_more").addClass('btn-warning');
                $(".get_more").off();
            }
        });
    });
});
</script>


</html>