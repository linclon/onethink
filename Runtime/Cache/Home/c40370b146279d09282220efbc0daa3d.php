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
        <!--导航部分-->
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
        </nav>
        <!--导航结束-->

        <div class="container">
            <div class="blank"></div>
            <div class="row">
                <div class="col-xs-3">
                    <img src="../image/5.png" width="60" height="60" />
                </div>
                <div class="col-xs-9">
                    ZhangSan<br/>
                    北大花园小区<br/>
                    积分:<span class="text-danger">100</span>
                </div>
            </div>
            <div class="blank"></div>
            <div class="row text-center myLabel">
                <div class="col-xs-4 label-danger"><a href="#"><span class="iconfont">&#xe60b;</span>我的资料</a></div>
                <div class="col-xs-4 label-success"><a href="#"><span class="iconfont">&#xe609;</span>我的报修</a></div>
                <div class="col-xs-4 label-primary"><a href="#"><span class="iconfont">&#xe606;</span>报名的活动</a></div>
            </div>
            <div class="blank"></div>
            <div>
                <ul class="list-group fuwuList">
                    <li class="list-group-item"><a href="diaochawenjuan.html" class="text-danger"><span class="iconfont">&#xe60a;</span>我的缴费账单</a> </li>
                    <li class="list-group-item"><a href="yezhurenzheng.html" class="text-info"><span class="iconfont">&#xe608;</span>我的物业通知</a></li>
                    <li class="list-group-item"><a href="yezhurenzheng.html" class="text-info"><span class="iconfont">&#xe607;</span>我的水电气使用</a></li>
                </ul>
            </div>
        </div>
    </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/Public/Home/js/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/Public/Home/bootstrap/js/bootstrap.min.js"></script>
    </body>






</html>