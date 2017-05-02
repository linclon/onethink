<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/27
 * Time: 14:01
 */

namespace Home\Controller;


class FixController extends HomeController
{
    /*
     * 在这里判断是否登录
     */
    public function add()
    {
        if(is_login()){
            if(IS_POST){
                $fix = D('Fix');//实例化模型
                $data = $fix->create();//验证
               // dump($data);exit;
                if($data){
//                $fix->create_time = time();
                    $fix->order = substr(str_shuffle('12346579879KLVNIOANGSOKLN'),0,11);
                    $id = $fix->add();
                    if($id){//返回数据的id
                        $this->success('新增成功', U('index'));
                        //记录行为
                        action_log('update_channel', 'channel', $id, UID);
                    } else {
                        $this->error('新增失败');
                    }
                } else {
                    $this->error($fix->getError());
                }
            } else {
                $pid = I('get.pid', 0);
                //获取父导航
                if(!empty($pid)){
                    $parent = M('Channel')->where(array('id'=>$pid))->field('title')->find();
                    $this->assign('parent', $parent);
                }

                $this->assign('pid', $pid);
                $this->assign('info',null);
                $this->meta_title = '新增导航';
                $this->display('add');
            }
        }
        $this->error('请登录',U('User/login'));
    }

}