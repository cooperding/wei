<?php

/**
 * WeixinAction.class.php
 * 前台首页
 * 微信信息处理中心
 * @author cooper ding <qiuyuncode@163.com.com>
 * @copyright 2012- www.dingcms.com www.dogocms.com www.qiuyuncode.com www.adminsir.net All rights reserved.
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version dogocms 1.0 2012-11-5 11:08
 * @package  Controller
 * @todo 完善更多方法
 */

namespace Home\Action;

use Think\Action;

class WxmanageAction extends BaseuserAction {

    /**
     * index
     * 微信主页面列表
     * @return boolean
     * @version dogocms 1.0
     * @todo 权限验证
     */
    public function index() {
        $id = I('get.id');
        $token = I('get.token');
        $skin = $this->skin; //获取前台主题皮肤名称
        $tpl_user = $this->tpl_user; //获取主题皮肤会员模板名称
        $this->assign('title', '微信公众帐号列表');
        $this->assign('sidebar_active', 'apilist');
        $this->assign('list', $data);
        $this->theme($skin)->display($tpl_user . 'wxm_index');
    }

    /**
     * uploadImg
     * 上传图片
     * @access public
     * @return array
     * @version dogocms 1.0
     */
    public function uploadImg() {
        $array = R('Common/System/uploadImg');
        echo json_encode($array);
    }

}
