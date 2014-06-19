<?php

/**
 * BaseapiAction.class.php
 * api接口方法
 * @author 正侠客 <lookcms@gmail.com>
 * @copyright 2012- http://www.dingcms.com http://www.dogocms.com All rights reserved.
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version dogocms 1.0 2012-11-5 11:08
 * @package  Controller
 * @todo 完善更多方法
 */
namespace Api\Action;
use Think\Action;
class BaseapiAction extends Action {

    //初始化
    function _initialize()
    {
        //define("TOKEN", "ding123456");
    }

    /*
     * valid 
     * 验证
     * @return json string
     * 
     */

    public function valid($token)
    {
        $echoStr = $_GET["echostr"];
        if ($this->checkSignature($token)) {
            echo $echoStr;
            exit;
        }
    }

    /*
     * checkSignature 
     * 验证消息真实性
     * @return json string
     * 
     */

    private function checkSignature($token)
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

}

?>
