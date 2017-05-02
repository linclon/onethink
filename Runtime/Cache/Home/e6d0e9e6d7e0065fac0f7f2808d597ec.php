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






    <div class="main-title">
        <h2>
            <?php echo ($info['id']?'编辑':'新增'); ?>保修
            <?php if(!empty($pid)): ?>[&nbsp;父导航：<a href="<?php echo U('index','pid='.$pid);?>"><?php echo ($parent["title"]); ?></a>&nbsp;]<?php endif; ?>
        </h2>
    </div>
    <form action="<?php echo U();?>" method="post" class="form-horizontal">
        <input type="hidden" name="pid" value="<?php echo ($pid); ?>">
        <div class="form-item">
            <label class="item-label">姓名<span class="check-tips">（姓名）</span></label>
            <div class="controls">
                <input type="text" class="text input-large" name="name" value="<?php echo ((isset($info["name"]) && ($info["name"] !== ""))?($info["name"]):''); ?>">
            </div>
        </div>
        <div class="form-item">
            <label class="item-label">电话<span class="check-tips">（电话）</span></label>
            <div class="controls">
                <input type="text" class="text input-large" name="tel" value="<?php echo ((isset($info["tel"]) && ($info["tel"] !== ""))?($info["tel"]):''); ?>">
            </div>
        </div>
        <div class="form-item">
            <label class="item-label">地址<span class="check-tips">（地址）</span></label>
            <div class="controls">
                <textarea name="address"><?php echo ((isset($info["address"]) && ($info["address"] !== ""))?($info["address"]):''); ?></textarea>
            </div>
        </div>
        <div class="form-item">
            <label class="item-label">问题描述<span class="check-tips">（问题描述）</span></label>
            <div class="controls">
                <textarea name="question"><?php echo ((isset($info["question"]) && ($info["question"] !== ""))?($info["question"]):''); ?></textarea>
            </div>
        </div>
        <div class="form-item">
            <input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>">
            <button class="btn submit-btn ajax-post" id="submit" type="submit" target-form="form-horizontal">确 定</button>
            <button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
        </div>
    </form>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/Public/Home/js/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/Public/Home/bootstrap/js/bootstrap.min.js"></script>
    </body>




    <script type="text/javascript" charset="utf-8">
        //导航高亮
        highlight_subnav('<?php echo U('index');?>');
    </script>


</html>