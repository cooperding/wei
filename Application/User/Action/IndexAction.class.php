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
        $this->assign('sidebar_active','index');
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
        
        $this->assign('sidebar_active','changepwd');
        $this->display();
    }
    /**
     * weixinList
     * 微信公众帐号列表
     * @access public
     * @return array
     */
    public function weixinList()
    {
        
        $this->assign('sidebar_active','weixin');
        $this->display();
    }
    /**
     * message
     * 消息信息
     * @access public
     * @return array
     */
    public function message()
    {
        
        $this->assign('sidebar_active','message');
        $this->display();
    }

}
