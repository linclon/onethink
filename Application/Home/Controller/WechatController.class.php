<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/27
 * Time: 9:33
 */

namespace Home\Controller;


use Think\Controller;
use EasyWeChat\Foundation\Application;


class WechatController extends Controller
{
    public function index()
    {
        // 这行代码是引入 `composer` 的入口文件，这样我们的类才能正常加载。
        include './vendor/autoload.php';

        // 一些配置
        $options = C('ESAY_WECHAT');
        // 使用配置来初始化一个项目。
        $app = new Application($options);

        if(!$_SESSION['wechat_user']){
            //获取用户信息
            $response = $app->oauth->redirect();
            //$_SESSION[]='wechat/';  设置回调url
            $response->send();//跳转到回调方法获取用户信息
        }
    }

}