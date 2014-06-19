<?php

/**
 * WeixinAction.class.php
 * 前台首页
 * 前台核心文件，其他页面需要继承本类方可有效
 * @author 正侠客 <lookcms@gmail.com>
 * @copyright 2012- http://www.dingcms.com http://www.dogocms.com All rights reserved.
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version dogocms 1.0 2012-11-5 11:08
 * @package  Controller
 * @todo 完善更多方法
 */
namespace Api\Action;
use Think\Action;
class WeixinAction extends BaseapiAction {

    public function index()
    {
        if (isset($_GET['echostr'])) {
            $token = 'ding123456';
            $this->valid($token);
        } else {
            $this->responseMsg($token);
        }
    }

    /*
     * responseMsg 
     * 回复信息
     * @return json string
     * 
     */

    public function responseMsg($token)
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $msgtype = $postObj->MsgType; //接收到的消息类型
            switch ($msgtype) {
                case 'event'://消息类型
                    //事件类型，subscribe(订阅)、unsubscribe(取消订阅)、CLICK(自定义菜单事件)、LOCATION(上报地理位置)、scan(用户已关注时的事件推送)
                    $this->responseMsgEvent($postObj, $token);
                    break;
                case 'text'://接收文本消息
                    $this->responseMsgText($postObj, $token);
                    break;
                case 'image'://接收图片消息
                    //$this->getImage($postObj, $uid);
                    break;
                case 'voice'://接收语音消息
                    //$this->eee($postObj);
                    break;
                case 'video'://接收视频消息
                    //$this->eee($postObj);
                    break;
                case 'location'://接收地理消息
                    $this->getLocation($postObj, $token);
                    break;
                case 'link'://接收链接消息
                    //$this->eee($postObj);
                    break;
                default:
                    echo '';
            }
        } else {
            echo "";
            exit;
        }
    }

    /*
     * responseMsg 
     * 回复信息
     * @return json string
     * @todo important
     */

    public function responseMsgText($postObj, $token)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $time = time();
        $keyword = trim($postObj->Content);
        //不是手机号继续查询，先查询单条信息，如果单条信息不存在查询全部信息
        $msgType = "news";
        $textTpl = $this->getSingleNews($token);
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType);

        echo $resultStr;
    }

    /*
     * responseMsgEvent 
     * 事件相关信息
     * @return json string
     * 
     */

    public function responseMsgEvent($postObj, $token)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $EventKey = $postObj->EventKey;
        //事件类型，subscribe(订阅)、unsubscribe(取消订阅)、CLICK(自定义菜单事件)、LOCATION(上报地理位置)、scan(用户已关注时的事件推送)
        $event = $postObj->Event;
        switch ($event) {
            case 'subscribe'://订阅
                $msgType = "news";
                $textTpl = $this->getSingleNews($token);
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType);
                echo $resultStr;
                break;
            case 'CLICK'://自定义菜单事件
                if ($EventKey == 'idui20130001') {
                    $text = '123';
                }
                $msgType = "text";
                //$textTpl = $this->getXmlText($text);
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType);
                echo $resultStr;
                break;
        }
    }

    /*
     * getXmlText 
     * 获取单条文本信息
     * @return json string
     * 
     */

    public function getXmlText($text)
    {

        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[" . $text . "]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";
        return $textTpl;
    }

    /*
     * getSingleNews 
     * 获取单条图文信息
     * @return json string
     * 
     */

    public function getSingleNews($token)
    {
        $m_name = '房产';
        $m_description = '别墅风情，美丽风景';
        $m_wx_title_img = 'http://weixin.adminsir.net/Public/Uploads/Images/20140224/123.jpg';
        $m_url = 'http://weixin.adminsir.net/wei/index/index';
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[]]></Content>
                    <ArticleCount>1</ArticleCount>
                    <Articles>
                        <item>
                            <Title><![CDATA[" . $m_name . "]]></Title>
                            <Description><![CDATA[" . $m_description . "]]></Description>
                            <PicUrl><![CDATA[" . $m_wx_title_img . "]]></PicUrl>
                            <Url><![CDATA[" . $m_url . "]]></Url>
                        </item>
                    </Articles>
                    <FuncFlag>0</FuncFlag>
                </xml>";
        return $textTpl;
    }

}
