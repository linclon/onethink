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


    <h2>用户登录</h2>






    <div class="container-fluid">
        <form action="<?php echo U('User/login');?>" method="post">
            <div class="form-group">
                <label>用户名:</label>
                <input type="text" class="form-control" name="username"/>
            </div>
            <div class="form-group">
                <label>密码:</label>
                <input type="password" class="form-control" name="password"/>
            </div>
            <!--<div class="form-group">
                <label>您的地址(必填):</label>
                <input type="text" class="form-control" name="address"/>
            </div>
            <div class="form-group">
                <label>标题(必填):</label>
                <input type="text" class="form-control" name="title"/>
            </div>
            <div class="form-group">
                <label>内容(详细描述需要报修的内容):</label>
                <textarea type="text" class="form-control" name="question"></textarea>
            </div>-->
            <!--<div class="form-group">-->
            <!--<div><a href="#"><span class="glyphicon glyphicon-plus onlineUpImg"></span></a></div>-->
            <!--<label>图片(最多上传5张,可不上传):</label>-->
            <!--</div>-->
            <p>
                <label for="inputCaptcha" class="sr-only">验证码</label>
                <input type="text" name="verify" id="inputCaptcha" class="form-control" placeholder="请输入验证码" required>
            </p>
            <div class="controls" style="margin-bottom: 20px;">
                <img class="verifyimg reloadverify" alt="点击切换" onclick="this.src='<?php echo U('User/verify');?>'" src="<?php echo U('User/verify');?>" style="cursor:pointer;height: 40px;">
            </div>
            <div class="form-group">
                <button class="btn btn-primary onlineBtn" type="submit">确认提交</button>
            </div>
            <p style="float: right">
                <a href="<?php echo U('User/register');?>">马上注册</a>
            </p>
        </form>
    </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/Public/Home/js/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/Public/Home/bootstrap/js/bootstrap.min.js"></script>
    </body>






</html>