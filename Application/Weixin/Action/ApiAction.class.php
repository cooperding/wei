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

//weixin/api/token/dede
class ApiAction extends ApibaseAction {

    //初始化
    function _initialize() {
        
    }

    function index() {

        //signature 微信加密签名，signature结合了开发者填写的token参数和请求中的timestamp参数、nonce参数。
        //timestamp 时间戳
        //nonce 随机数
        //echostr   随机字符串
        $echoStr = $_GET["echostr"];
        $token = $_GET['token'];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $signature = $_GET["signature"];
        //defined("TOKEN",$token);

        if ($this->checkSignature($token, $timestamp, $nonce, $signature)) {
            $this->responseMsg();
            //exit;
            //echo $echoStr;
            exit;
        }
    }

    public function responseMsg() {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)) {
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
              the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = trim($postObj->FromUserName);
            $toUsername = trim($postObj->ToUserName);
            $keyword = trim($postObj->Content);
            $MsgType = trim($postObj->MsgType);
            $time = time();
            switch ($MsgType) {
                //接收消息
                case "text"://文本消息
                    break;
                case "image"://图片消息
                    break;
                case "voice"://语音消息
                    break;
                case "video"://视频消息
                    break;
                case "shortvideo"://小视频消息
                    break;
                case "location"://地理位置消息
                    break;
                case "link"://链接消息
                    break;
                //接收事件
                case "event":
                    /*
                     * 关注/取消关注事件 
                     * 扫描带参数二维码事件
                     * 上报地理位置事件
                     * 自定义菜单事件
                     * 点击菜单拉取消息时的事件推送
                     * 点击菜单跳转链接时的事件推送
                     * 
                     * 
                     * 
                     */
                    break;
                default:
                    break;
            }
            /*
             * 回复文本消息
             * 回复图片消息
             * 回复语音消息
             * 回复视频消息
             * 回复音乐消息
             * 回复图文消息
             */



            $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
            if (!empty($keyword)) {
                $msgType = "text";
                $contentStr = "Welcome to wechat world!";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            } else {
                echo "Input something...";
            }
        } else {
            echo "";
            exit;
        }
    }

}

?>
