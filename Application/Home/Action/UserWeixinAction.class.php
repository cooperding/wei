<?php

/**
 * UserWeixinAction.class.php
 * 会员微信
 * @author cooper ding <qiuyuncode@163.com.com>
 * @copyright 2012- www.dingcms.com www.dogocms.com www.qiuyuncode.com www.adminsir.net All rights reserved.
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version dogocms 1.0 2012-11-5 11:08
 * @package  Controller
 * @todo 完善更多方法
 */

namespace Home\Action;

use Think\Action;

class UserWeixinAction extends BaseuserAction {

    /**
     * index
     * 微信主页面列表
     * @return boolean
     * @version dogocms 1.0
     * @todo 权限验证
     */
    public function index() {

        $m = D('WxInfo');
        $uid = session('LOGIN_M_ID');
        $condition['members_id'] = array('eq', $uid);
        $data = $m->where($condition)->select();
        foreach ($data as $k => $v) {
            if ($v['status'] == '20') {
                $data[$k]['status'] = '可用';
            } else {
                $data[$k]['status'] = '禁用';
            }
        }
        $skin = $this->skin; //获取前台主题皮肤名称
        $tpl_user = $this->tpl_user; //获取主题皮肤会员模板名称
        $this->assign('title', '微信公众帐号列表');
        $this->assign('sidebar_active', 'apilist');
        $this->assign('list', $data);
        $this->theme($skin)->display($tpl_user . 'wx_list');
    }

    /**
     * apiListAdd
     * api接口-添加
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function wxListAdd() {
        $skin = $this->skin; //获取前台主题皮肤名称
        $tpl_user = $this->tpl_user; //获取主题皮肤会员模板名称
        $this->assign('title', '添加微信公众帐号');
        $this->assign('sidebar_active', 'wxlist');
        $this->theme($skin)->display($tpl_user . 'wx_add');
    }

    /**
     * wxListEdit
     * 微信接口-编辑
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function wxListEdit() {
        $m = D('WxInfo');
        $uid = session('LOGIN_M_ID');
        $condition['members_id'] = array('eq', $uid);
        $condition['id'] = array('eq', I('get.id'));
        $data = $m->where($condition)->find();
        $skin = $this->skin; //获取前台主题皮肤名称
        $tpl_user = $this->tpl_user; //获取主题皮肤会员模板名称
        $this->assign('title', '修改信息');
        $this->assign('sidebar_active', 'apilist');
        $this->assign('data', $data);
        $this->theme($skin)->display($tpl_user . 'wx_edit');
    }

    /**
     * apiInsert
     * 添加api
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function wxInsert() {
        $m = D('WxInfo');
        $uid = session('LOGIN_M_ID');
        $wxcode = trim(I('post.wxcode'));
        if (empty($wxcode)) {
            $this->error('微信号不能为空！');
            exit;
        }
        $wxname = trim(I('post.wxname'));
        if (empty($wxname)) {
            $this->error('微信名称不能为空！');
            exit;
        }
        $data['addtime'] = time();
        $data['members_id'] = $uid;
        $data['updatetime'] = time();
        $data['status'] = 20;
        $data['name'] = $wxname; //微信名称
        $data['wx_code'] = $wxcode; //微信号
        $data['wxtoken'] = R('Common/System/guid'); //生成token
        $data['dtoken'] = R('Common/System/guid',array('status'=>'true')); //生成dtoken
        $data['appid'] = trim(I('post.appid'));
        $data['appsecret'] = trim(I('post.appsecret'));
        $data['remark'] = I('post.remark');


        $rs = $m->data($data)->add();
        if ($rs == true) {
            $this->success('操作成功', U('UserWeixin/index'));
        } else {
            $this->error('操作失败，请重新操作！');
        }
    }

    /**
     * apiUpdate
     *  更新api
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function wxUpdate() {
        $m = D('WxInfo');
        $uid = session('LOGIN_M_ID');
        $condition['members_id'] = array('eq', $uid);
        $condition['id'] = array('eq', I('post.id'));

        $wxcode = trim(I('post.wxcode'));
        if (empty($wxcode)) {
            $this->error('微信号不能为空！');
            exit;
        }
        $wxname = trim(I('post.wxname'));
        if (empty($wxname)) {
            $this->error('微信名称不能为空！');
            exit;
        }
        $data['updatetime'] = time();
        $data['status'] = I('post.status');
        $data['name'] = $wxname; //微信名称
        $data['wx_code'] = $wxcode; //微信号
        $data['appid'] = trim(I('post.appid'));
        $data['appsecret'] = trim(I('post.appsecret'));
        $data['remark'] = I('post.remark');
        $rs = $m->where($condition)->save($data);
        if ($rs == true) {
            $this->success('操作成功', U('UserWeixin/index'));
        } else {
            $this->error('操作失败，请重新操作！');
        }
    }

    /**
     * apiDelete
     *  删除api
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function wxDelete() {
        $m = D('WxInfo');
        $uid = session('LOGIN_M_ID');
        $condition['members_id'] = array('eq', $uid);
        $condition['id'] = array('eq', I('get.id'));
        $rs = $m->where($condition)->delete();
        if ($rs == true) {
            $this->success('操作成功', U('UserWeixin/index'));
        } else {
            $this->error('操作失败，请重新操作！');
        }
    }

    /**
     * newsInsert
     * 添加信息
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function newsInsert() {
        $m = D('Title');
        $uid = session('LOGIN_M_ID');
        $title = I('post.title');
        $content = I('post.content');
        if (empty($content)) {
            $this->error('当真SHI内容不能为空！');
            exit;
        }
        $_POST['addtime'] = time();
        $_POST['members_id'] = $uid;
        $_POST['updatetime'] = time();
        $_POST['status'] = 10;
        $rs = $m->data($_POST)->add();
        $title_id = $m->getLastInsID();
        if ($rs == true) {
            $c = D('Content');
            $_data['title_id'] = $title_id;
            $_data['content'] = $content;
            $c->data($_data)->add();
            $email = R('Common/System/getCfg', array('cfg_email_remind'));
            $time = date('Y-m-d H:i:s', time());
            R('Common/System/sendEmail', array($email, '当真网--会员提交信息提醒-' . $time, $content));
            $this->success('操作成功', __MODULE__ . '/Index/newsList');
        } else {
            $this->error('操作失败，请重新操作！');
        }
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
