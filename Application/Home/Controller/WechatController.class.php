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
        require './vendor/autoload.php';
        // 一些配置
        $options = C('ESAY_WECHAT');
        // 使用配置来初始化一个项目。
        $app = new Application($options);

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

    //我的首页
    public function mine()
    {
        //已经登录
        if(is_login()){
            //跳转到我的
            $this->display('mine');
        }else{
            //未登录跳转到登录页
            $this->error('请登录',U('User/login'));
        }
    }

    //小区通知
    public function inform()
    {
        $model = D('document');
        //获取通知数据,接收p分页参数
        $list = $model->where(['category_id'=>40])->page(I('p',1),1)->select();
        foreach($list as &$v){
            $v['path'] = get_cover($v['cover_id'],'path');
            $v['create_time'] = date("Y-m-d H:i",$v['create_time']);
            $v['url'] = U('detail',['id'=>$v['id']]);
        }

        if(IS_AJAX){
            if(empty($list)){
                $this->error('没有数据');
            }else{
                $this->success($list);
            }
        }
        $this->assign('list',$list);
        $this->display('notice');
    }

    /*
     * M:方法:简单的增删改查,不能调用模型上的自定义方法
     * D方法:可以调用自动验证,模型中的自定义方法
     */

    public function detail($id)
    {
        //实例化文档模型
        $model = D('document');
        //获取id文档数据
        $rows = $model->where(['id'=>$id])->select();
        //实例化文档内容模型
        $model_detail = D('document_article');
        //根据id获取数据
        $rows_detail = $model_detail->where(['id'=>$id])->select();
        //放到数组容器中
        $list['content'] = $rows_detail[0]['content'];
        $list['create_time'] = $rows[0]['create_time'];
        $list['name'] = get_username($rows[0]['uid']);//根据uid获取username
        /*
         * setInc:自增(字段,数据)
         * setDec:自减
         */
        $model->where(['id'=>$id])->setInc('view');
        //分配数据
        $this->assign('list',$list);
        //到页面
        $this->display('detail');
    }

    //便民服务模块
    public function service()
    {
//        if(is_login()){
            $this->display('fuwu');
//        }else{
//            $this->error('请登录',U('User/login'));
//        }
    }

    //调查问卷
    public function surver()
    {
        $model = D('Document');
        $list = $model->where(['category_id'=>43])->page(I('p',1),1)->select();
        foreach($list as &$v){
            $v['url'] = U('sdetail',['id'=>$v['id']]);
            $v['path'] = get_cover($v['cover_id'],'path');
            $v['create_time'] = date("Y-m-d H:i",$v['create_time']);
        }
        if(IS_AJAX){
            if(empty($list)){
                $this->error('数据不存在');
            }else{
                $this->success($list);
            }
        }
        $this->assign('list',$list);
        $this->display('surver');
    }
    //调查详情
    public function sdetail($id)
    {

    }



    //业主认证
    public function ident()
    {
        if(IS_POST){
            $model = D('ident');
            $data = $model->create();
//            var_dump($data);exit;
            if($data){
                $id = $model->add();
                if($id){
                    $this->success('新增成功', U('service'));
                }else{
                    $this->error('新增失败');
                }
            }else{
                $this->error($model->getError());
            }
        }
        $this->display('ident');
    }


    //生活贴士
//    public function tips()
//    {
//        $this->display('tips');
//    }

    //关于我们
    public function about()
    {
        $this->display('about');
    }

    //活动列表
    public function active()
    {
        $model = D('Document');
        $list = $model->where(['category_id'=>41])->page(I('p',1),1)->select();
        foreach($list as &$v){
            $v['url'] = U('activity',['id'=>$v['id']]);
            $v['path'] = get_cover($v['cover_id'],'path');
            $v['create_time'] = date("Y-m-d H:i",$v['create_time']);
        }
        if(IS_AJAX){
            if(empty($list)){
                $this->error('数据不存在');
            }else{
                $this->success($list);
            }
        }
        $this->assign('list',$list);
        $this->display('active');
    }

    //活动详情
    public function activity($id)
    {
        if(is_login()){
            $document = D('document');
            $document_article = D('document_article');
            $list1 = $document->where(['id'=>$id])->find();
            $list2 = $document_article->where(['id'=>$id])->find();
            $document->where(['id'=>$id])->setInc('view');
            $this->assign('list1',$list1);
            $this->assign('list2',$list2);
            $this->display('activity');
        }else{
            $this->error('请登录',U('User/login'));
            session('url',U());
        }
    }
    //活动报名    type=2是小区活动 1是商家活动  status=1 已报名
    public function acsave()
    {
        if(IS_AJAX){
                $uid = session('uid');//获取登录用户id
                $status = I('status');//获取ajax报名状态
                $ac_id = I('ac_id');//获取活动id
                $model = D('join');//实例化报名表
                $data = $model->where(['user_id'=>$uid])->where(['ac_id'=>$ac_id])->select();
                if(!$data){//报名表数据不存在
                    $model->user_id=$uid;
                    $model->status=$status;
                    $model->ac_id=$ac_id;
                    $model->type=1;
                    $model->add();
                    $this->success($data);//返回状态status:1
                }else{
                    $this->error('已经报名');//返回状态status:0
                }
            }
    }

    //小区活动
    public function zone()
    {
        $model = D('Document');
        $list = $model->where(['category_id'=>42])->page(I('p',1),1)->select();
        foreach($list as &$v){
            $v['url'] = U('zonedetail',['id'=>$v['id']]);
            $v['path'] = get_cover($v['cover_id'],'path');
            $v['create_time'] = date("Y-m-d H:i",$v['create_time']);
        }
        if(IS_AJAX){
            if(empty($list)){
                $this->error('数据不存在');
            }else{
                $this->success($list);
            }
        }
        $this->assign('list',$list);
        $this->display('zone');
    }

    //活动详情
    public function zonedetail($id)
    {
        if(is_login()){
            $document = D('document');
            $document_article = D('document_article');
            $document->where(['id'=>$id])->setInc('view');//浏览次数
            $list1 = $document->where(['id'=>$id])->find();
            $list2 = $document_article->where(['id'=>$id])->find();
            $this->assign('list1',$list1);
            $this->assign('list2',$list2);
            $this->display('zones');
        }else{
            $this->error('请登录',U('User/login'));
            session('url',U());
        }
    }
    //活动报名  type=2是小区活动 1是商家活动
    public function zonesave()
    {
        if(IS_AJAX){
            $uid = session('uid');//获取登录用户id
            $status = I('status');//获取ajax报名状态
            $ac_id = I('ac_id');//获取活动id
            $model = D('join');//实例化报名表
            $data = $model->where(['user_id'=>$uid])->where(['ac_id'=>$ac_id])->select();
            if(!$data){//报名表数据不存在
                $model->user_id=$uid;
                $model->status=$status;
                $model->ac_id=$ac_id;
                $model->type=2;
                $model->add();
                $this->success($data);//返回状态status:1
            }else{
                $this->error('已经报名');//返回状态status:0
            }
        }
    }

    //租售
    public function sale()
    {

    }

    //调查问卷

}