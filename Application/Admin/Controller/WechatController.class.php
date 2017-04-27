<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/26
 * Time: 19:35
 */

namespace Admin\Controller;
// 引入我们的主项目的入口类。
use EasyWeChat\Foundation\Application;


class WechatController extends AdminController
{
    public function index()
    {
        // 这行代码是引入 `composer` 的入口文件，这样我们的类才能正常加载。
        include __DIR__ . '/vendor/autoload.php';

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
        $user = $_SESSION['wechat_user'];
        var_dump($user);
//        echo I('get.echostr');
    }

    //回调页面
    public function callback()
    {
        // 一些配置
        $options = [
            'debug'  => true,
            'app_id'  => 'wx78b074f4099d7bcc',         // AppID
            'secret'  => 'c7df9f23f161907873bf7143c239a983',     // AppSecret
            'token'   => 'stupidfish',
            // 'aes_key' => null, // 可选
            'log' => [
                'level' => 'debug',
                'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
            ],
            'oauth' => [
                'scopes'   => ['snsapi_base'],
                'callback' => '/wechat/callback',//配置授权回调地址【配置文件里面修改】
            ],
            /**
             * 微信支付
             */
            'payment' => [
                'merchant_id'        => 'your-mch-id',
                'key'                => 'key-for-signature',
                'cert_path'          => 'path/to/your/cert.pem', // XXX: 绝对路径！！！！
                'key_path'           => 'path/to/your/key',      // XXX: 绝对路径！！！！
                // 'device_info'     => '013467007045764',
                // 'sub_app_id'      => '',
                // 'sub_merchant_id' => '',
                // ...
            ],
            /**
             * Guzzle 全局设置
             *
             * 更多请参考： http://docs.guzzlephp.org/en/latest/request-options.html
             */
            'guzzle' => [
                'timeout' => 3.0, // 超时时间（秒）
                //'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
            ],
        ];
        // 使用配置来初始化一个项目。
        $app = new Application($options);
        //获取用户信息
        $user = $app->oauth->user();
        //保存到session中
        $_SESSION['wechat_user'] = $user;
    }

    //设置菜单
    public function menus()
    {
        // 一些配置
        $options = [
            'debug'  => true,
            'app_id'  => 'wx78b074f4099d7bcc',         // AppID
            'secret'  => 'c7df9f23f161907873bf7143c239a983',     // AppSecret
            'token'   => 'stupidfish',
            // 'aes_key' => null, // 可选
            'log' => [
                'level' => 'debug',
                'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
            ],
            'oauth' => [
                'scopes'   => ['snsapi_base'],
                'callback' => '/wechat/callback',//配置授权回调地址【配置文件里面修改】
            ],
            /**
             * 微信支付
             */
            'payment' => [
                'merchant_id'        => 'your-mch-id',
                'key'                => 'key-for-signature',
                'cert_path'          => 'path/to/your/cert.pem', // XXX: 绝对路径！！！！
                'key_path'           => 'path/to/your/key',      // XXX: 绝对路径！！！！
                // 'device_info'     => '013467007045764',
                // 'sub_app_id'      => '',
                // 'sub_merchant_id' => '',
                // ...
            ],
            /**
             * Guzzle 全局设置
             *
             * 更多请参考： http://docs.guzzlephp.org/en/latest/request-options.html
             */
            'guzzle' => [
                'timeout' => 3.0, // 超时时间（秒）
                //'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
            ],
        ];
        // 使用配置来初始化一个项目。
        $app = new Application($options);
        $menu = $app->menu;
        $buttons = [
            [
                "type" => "click",
                "name" => "今日歌曲",
                "key"  => "V1001_TODAY_MUSIC"
            ],
            [
                "name"       => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        $r = $menu->add($buttons);
        var_dump($r);
    }

    public function menusall()
    {
//        $menu = $app->menu;
//        $menus = $menu->all();
//        var_dump($menus);
    }

}