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
        //signature 微信加密签名，signature结合了开发者填写的token参数和请求中的timestamp参数、nonce参数。
        //timestamp 时间戳
        //nonce 随机数
        //echostr   随机字符串
        
        $echoStr = $_GET["echostr"];
        $token = $_GET['token'];
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        
        defined("TOKEN",$token);
        if ($this->checkSignature($token, $timestamp, $nonce, $signature)) {
            echo $echoStr;
            exit;
        }
        
        
        
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        
        
        
        
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
