<?php
/**
 * 微信授权
 */

namespace Home\Controller;


use EasyWeChat\Foundation\Application;

class EsaywechatController extends HomeController
{
    //
    public function index()
    {
        // 这行代码是引入 `composer` 的入口文件，这样我们的类才能正常加载。
        require './vendor/autoload.php';
        // 一些配置
        $options = C('ESAY_WECHAT');
        // 使用配置来初始化一个项目。
        $app = new Application($options);
        $server = $app->server;
        $server->setMessageHandler(function ($message) {
            switch ($message->MsgType) {
                case 'event':
                    switch ($message->Event) {
                        case 'subscribe':
                            # code...
                            break;
                        case 'CLICK'://自定义菜单点击事件
                            //根据key值判断点击了哪个按钮
                            if($message->EventKey == 'V1001_INDEX'){
                                //首页
                                return U('Home/Index/index');
                            }elseif($message->EventKey == 'V1002_SERVER'){
                                return U('Home/Wechat/service');
                            }elseif($message->EventKey == 'V1003_FIND'){
                                return U('Home/Wechat/mine');
                            }elseif($message->EventKey == 'V1004_MINE'){
                                return U('Home/Wechat/mine');
                            }

                            break;
                        default:
                            # code...
                            break;
                    }
                    return '收到事件消息';
                    break;
                case 'text':
                    if($message->Content == '排行榜'){
                        $articles = [
                            ['title'=>'第一名','description'=>'','picurl'=>'http://bpic.588ku.com/back_pic/00/01/40/6456016ed443fc3.jpg!/fh/300/quality/90/unsharp/true/compress/true','url'=>'http://588ku.com/print/4019818.html'],
                            ['title'=>'你不知道的事','description'=>'','picurl'=>'http://bpic.588ku.com/back_pic/00/04/13/75/ee25f62e3f6e0a9073cd96d9c9ab36a5.jpg!/fh/300/quality/90/unsharp/true/compress/true','url'=>'http://ganjianying.baijia.baidu.com/article/827740'],
                            ['title'=>'其实','description'=>'','picurl'=>'http://bpic.588ku.com/back_pic/00/04/20/33/82e1333b8a6050aed7fbcc8688c4b7c3.jpg!/fh/300/quality/90/unsharp/true/compress/true','url'=>'http://sichuan.scol.com.cn/dwzw/201704/55879047.html'],
                            ['title'=>'你是个傻儿','description'=>'','picurl'=>'http://bpic.588ku.com/back_pic/00/02/60/285619189a4b2ec.jpg!/fh/300/quality/90/unsharp/true/compress/true','url'=>'http://news.ifeng.com/a/20170419/50965123_0.shtml?_zbs_baidu_news'],
                            ['title'=>'百度新闻','description'=>'','picurl'=>'http://bpic.588ku.com/element_pic/00/16/05/09572ffa2697d89.jpg!/fw/208/quality/90/unsharp/true/compress/true','url'=>'http://www.baidu.com'],
                            ['title'=>'百度','description'=>'','picurl'=>'http://bpic.588ku.com/back_pic/00/04/20/33/a09b0c7cf1ee56ef5dc514c9738dcef9.jpg!/fh/300/quality/90/unsharp/true/compress/true','url'=>'http://www.baidu.com'],
                            ['title'=>'百度','description'=>'','picurl'=>'http://bpic.588ku.com/back_pic/04/88/27/4858f1766a7d205.jpg!/fh/300/quality/90/unsharp/true/compress/true','url'=>'http://www.baidu.com'],
                            ['title'=>'百度','description'=>'','picurl'=>'http://bpic.588ku.com/back_pic/04/86/99/6658ea14bf3f903.jpg!/fh/300/quality/90/unsharp/true/compress/true','url'=>'http://www.baidu.com']
                        ];
                        $result = [];
                        foreach($articles as $article){
                            $news = new News([
                                'title'       => $article['title'],
                                'description' => $article['description'],
                                'url'         => $article['url'],
                                'image'       => $article['picurl'],
                            ]);
                            $result[] = $news;
                        }
                        return $result;
                        /*$news1 = new News(...);
                        $news2 = new News(...);
                        $news3 = new News(...);
                        $news4 = new News(...);
                        return [$news1, $news2, $news3, $news4];*/
                    }elseif($message->Content == '帮助'){
//                        return new Text(['content' => '帮助信息']);
                        return '帮助信息';
                    }

                    break;
                /*case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;*/
            }
            // ...
        });
        $response = $server->serve();
        $response->send();

        if(!session('openid')){
            //获取用户信息
            $response = $app->oauth->redirect();
            //$_SESSION[]='wechat/';  设置回调url
            $response->send();//跳转到回调方法获取用户信息
        }
    }
    //回调页面
    public function callback()
    {
        // 这行代码是引入 `composer` 的入口文件，这样我们的类才能正常加载。
        require './vendor/autoload.php';
        // 一些配置
        $options = C('ESAY_WECHAT');
        // 使用配置来初始化一个项目。
        $app = new Application($options);
        $oauth = $app->oauth;
        $user = $oauth->user();
        session('openid',$user->id);
    }

    public function getmenus()
    {
        $app = new Application(C('ESAY_WECHAT'));
        $menu = $app->menu;
        $menus = $menu->all();
        var_dump($menus);
    }


    public function setmenus()
    {
        $app = new Application(C('ESAY_WECHAT'));
        $menu = $app->menu;
        $buttons = [
            [
                "type" => "click",
                "name" => "首页",
                "key"  => "V1001_INDEX"
            ],
            [
                "type" => "click",
                "name" => "服务",
                "key"  => "V1002_SERVER"
            ],
            [
                "type" => "click",
                "name" => "发现",
                "key"  => "V1003_FIND"
            ],
            [
                "type" => "click",
                "name" => "我的",
                "key"  => "V1004_MINE"
            ],
        ];
        $r = $menu->add($buttons);
        var_dump($r);
    }



    //用户绑定
    public function bang()
    {
        //获取openid
        if(!session('openid')){
            $app = new Application(C('ESAY_WECHAT'));
            $response = $app->oauth->redirect();
            $response->send();
        }
        $openid = session('openid');
        //查看是否绑定
        $member = D('member');
        $member->where(['openid'=>$openid])->select();
        if($member){
            echo '已经绑定!';
        }else{
            if(IS_POST){
                $member->create();
                $member->openid = $openid;
                $member->add();
            }
            redirect(U('User/login'));
        }


    }

}