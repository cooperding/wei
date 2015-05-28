<?php

/**
 * ApiAction.class.php
 * 微信接口开发
 * 前台核心文件，其他页面需要继承本类方可有效
 * @author cooper ding <qiuyuncode@163.com.com>
 * @copyright 2012- www.dingcms.com www.dogocms.com www.qiuyuncode.com www.adminsir.net All rights reserved.
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version dogocms 1.0 2012-11-5 11:08
 * @package  Controller
 * @todo 完善更多方法
 */
namespace Weixin\Action;
use Think\Action;
class ApiAction extends ApibaseAction {

    //初始化
    function _initialize() {
        
    }

    /*
     * getNewsListCount
     * 获取apiList数量
     * 
     */

    public function getNewsListCount() {
        $m = D('Title');
        $uid = session('LOGIN_M_ID');
        $condition['members_id'] = array('eq', $uid);
        $count = $m->where($condition)->count();
        return $count;
    }

}

?>
