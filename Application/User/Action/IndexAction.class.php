<?php

/**
 * IndexAction.class.php
 * 后台文件
 * 后台核心文件，登录后跳转页面
 * @author 正侠客 <lookcms@gmail.com>
 * @copyright 2012- http://www.dingcms.com http://www.dogocms.com All rights reserved.
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version dogocms 1.0 2012-11-5 11:13
 * @package  Controller
 * @todo 权限验证
 */
namespace User\Action;
use Think\Action;
class IndexAction extends BaseAction {

    /**
     * index
     * 后台首页方法
     * @access public
     * @return array
     * @version dogocms 1.0
     * @todo 权限验证
     */
    public function index()
    {
        $m = M('Weixin');
        $condition['members_id'] = array('eq',  session('LOGIN_U_UID'));
        $count = $m->where($condition)->count();
        $this->assign('count_weixin', $count);
        $this->assign('sidebar_active', 'index');
        $this->display();
    }

    /**
     * changepwd
     * 修改密码
     * @access public
     * @return array
     */
    public function changepwd()
    {

        $this->assign('sidebar_active', 'changepwd');
        $this->display();
    }
    /**
     * changepwd
     * 修改密码
     * @access public
     * @return array
     */
    public function doChangepwd()
    {
        $oldpwd = I('post.oldpwd');//旧密码
        $newpwd1 = I('post.newpwd1');//新密码1
        $newpwd2 = I('post.newpwd2');//新密码2
        if(empty($oldpwd)||empty($newpwd1)||empty($newpwd2)){
            $this->error('原始密码或新密码不能为空');
            exit;
        }
        if($newpwd1!=$newpwd2){
            $this->error('新密码两次输入不一致');
            exit;
        }
        if(!preg_match('/^[0-9a-zA-Z]{6,16}$/', $newpwd2)){
            $this->error('新密码是由6-16位字母或数字组成！');
            exit;
        }
        $condition['id'] = array('eq',session('LOGIN_U_UID'));
        $data_members = M('Members')->field('username,password')->where($condition)->find();
        $pwd = $this->changePassword($data_members['username'],$oldpwd);
        if($pwd!=$data_members['password']){
            $this->error('原始密码不正确');
            exit;
        }
        $data['password'] = $this->changePassword($data_members['username'],$newpwd2);
        $data['updatetime'] = time();
        $rs = M('Members')->where($condition)->save($data);
        if ($rs == true) {
            $this->error('操作成功！', U('Index/index'));
        } else {
            $this->error('操作失败！');
        }
    }

    /**
     * weixinList
     * 微信公众帐号列表
     * @access public
     * @return array
     */
    public function weixinList()
    {
        $this->assign('sidebar_active', 'weixin');
        $this->display();
    }

    /**
     * weixinAdd
     * 添加微信公众帐号
     * @access public
     * @return array
     */
    public function weixinAdd()
    {
        $this->assign('sidebar_active', 'weixin');
        $this->display();
    }

    /**
     * weixinAdd
     * 添加微信公众帐号
     * @access public
     * @return array
     */
    public function weixinEdit()
    {
        $m = M('Weixin');
        $token = I('get.token');
        $condition['token'] = array('eq', $token);
        $condition['members_id'] = array('eq', session('LOGIN_U_UID'));
        $data = $m->where($condition)->find();
        $this->assign('data', $data);
        $this->assign('sidebar_active', 'weixin');
        $this->display();
    }

    /**
     * weixinInsert
     * 写入微信公众帐号
     * @access public
     * @return array
     */
    public function weixinInsert()
    {
        $m = M('Weixin');
        $data['wxname'] = I('post.wxname'); //微信名称
        $data['wxcode'] = I('post.wxcode'); //微信号
        $guid = R('Common/System/guid');
        $token = substr(md5($guid), 8, 16); //随机生成唯一的token值
        $data['token'] = $token;
        $data['addtime'] = time();
        $data['updatetime'] = time();
        $data['status'] = 20;
        $data['apikey'] = I('post.apikey'); //微信号
        $data['apiscecret'] = I('post.apiscecret'); //微信号
        $data['members_id'] = session('LOGIN_U_UID'); //
        $rs = $m->data()->add($data);
        if ($rs == true) {
            $this->error('操作成功！', U('Index/weixinList'));
        } else {
            $this->error('操作失败！');
        }
    }

    /**
     * weixinUpdate
     *  更新微信公众帐号
     * @access public
     * @return array
     */
    public function weixinUpdate()
    {
        $m = M('Weixin');
        $data['wxname'] = I('post.wxname'); //微信名称
        $data['wxcode'] = I('post.wxcode'); //微信号
        $data['updatetime'] = time();
        $data['apikey'] = I('post.apikey'); //微信号
        $data['apiscecret'] = I('post.apiscecret'); //微信号
        $condition['token'] = array('eq', I('post.token'));
        $condition['members_id'] = array('eq', session('LOGIN_U_UID'));
        $rs = $m->where($condition)->save($data);
        if ($rs == true) {
            $this->error('操作成功！', U('Index/weixinList'));
        } else {
            $this->error('操作失败！');
        }
    }

    /**
     * weixinDelete
     * 禁用微信公众帐号
     * @access public
     * @return array
     */
    public function weixinDelete()
    {
        $m = M('Weixin');
        $token = I('get.token');
        $condition['token'] = array('eq', $token);
        $condition['members_id'] = array('eq', session('LOGIN_U_UID'));
        $data['status'] = 10;
        $data['updatetime'] =time();
        $rs = $m->where($condition)->data('status', 10);
        if ($rs == true) {
            $array = array('status' => 0, 'msg' => '操作成功');
        } else {
            $array = array('status' => 1, 'msg' => '操作失败');
        }
        echo json_encode($array);
    }

    /**
     * getWeixinList
     * 获取微信列表信息
     * @access public
     * @return array
     */
    public function getWeixinList()
    {
        $m = M('Weixin');
        $condition['members_id'] = array('eq', session('LOGIN_U_UID'));
        $list = $m->where($condition)->select();
        $this->assign('list', $list);
        $this->display('model_weixinlist');
    }

    /**
     * message
     * 消息信息
     * @access public
     * @return array
     */
    public function message()
    {

        $this->assign('sidebar_active', 'message');
        $this->display();
    }

}
