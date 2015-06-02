<?php

/**
 * IndexAction.class.php
 * 前台首页
 * 前台核心文件，其他页面需要继承本类方可有效
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
     * 会员主页信息
     * @return boolean
     * @version dogocms 1.0
     * @todo 权限验证
     */
    public function index() {
        
        $m = M('Members');
        $uid = session('LOGIN_M_ID');
        $condition['id'] = array('eq', $uid);
        $data['uname'] = session('LOGIN_M_NAME');
        $data['ip'] = get_client_ip();
        $data['logintime'] = session('LOGIN_M_LOGINTIME');
        $data['addtime'] = session('LOGIN_M_ADDTIME');
        $data_signature = $m->field('signature')->where($condition)->find();
        $data['signature'] = $data_signature['signature'];
        $skin = $this->skin; //获取前台主题皮肤名称
        $tpl_user = $this->tpl_user; //获取主题皮肤会员模板名称
        $this->assign('title', '会员中心');
        $this->assign('sidebar_active', 'index');
        $this->assign('data', $data);
        $this->theme($skin)->display($tpl_user . 'wx_list');
    }

    

    /**
     * apiList
     * api 接口列表信息
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function apiList() {
        $m = D('ApiList');
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
        $this->assign('title', 'API列表');
        $this->assign('sidebar_active', 'apilist');
        $this->assign('list', $data);
        $this->theme($skin)->display($tpl_user . 'api_list');
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
        $this->assign('title', '添加API信息');
        $this->assign('sidebar_active', 'apilist');
        $this->theme($skin)->display($tpl_user . 'api_add');
    }

    /**
     * apiListEdit
     * api接口-编辑
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function apiListEdit() {
        $m = D('ApiList');
        $uid = session('LOGIN_M_ID');
        $condition['members_id'] = array('eq', $uid);
        $condition['id'] = array('eq', I('get.id'));
        $data = $m->where($condition)->find();
        $skin = $this->skin; //获取前台主题皮肤名称
        $tpl_user = $this->tpl_user; //获取主题皮肤会员模板名称
        $this->assign('title', '修改API信息');
        $this->assign('sidebar_active', 'apilist');
        $this->assign('data', $data);
        $this->theme($skin)->display($tpl_user . 'api_edit');
    }

    /**
     * doPersonal
     * 更新个人资料
     * @return display
     * @version dogocms 1.0
     * @todo 权限验证
     */
    public function doPersonal() {
        $m = M('Members');
        $uid = session('LOGIN_M_ID');
        $condition['id'] = array('eq', $uid);
        $data['updatetime'] = time();
        $data['sex'] = I('post.sex');
        $data['birthday'] = strtotime(I('post.birthday'));
        $data['signature'] = I('post.signature');
        $rs = $m->where($condition)->save($data);
        if ($rs == true) {
            $this->success('操作成功', __MODULE__ . '/Index/personal');
        } else {
            $this->error('操作失败，请重新操作！');
        }
    }

    /**
     * doEmail
     * 更新邮箱
     * @return display
     * @version dogocms 1.0
     * @todo 权限验证
     */
    public function doEmail() {
        $m = M('Members');
        $uid = session('LOGIN_M_ID');
        $condition['id'] = array('eq', $uid);
        $data['updatetime'] = time();
        $data['email'] = I('post.email');
        $condition_email['email'] = array('eq', $data['email']);
        $condition_email['id'] = array('neq', $uid);
        //判断该邮箱是否存在
        $data_email = $m->where($condition_email)->find();
        if ($data_email) {
            $this->error('您要更改的邮箱已存在，请重新操作！');
            exit();
        }
        $data_one = $m->field('email')->where($condition)->find();
        if ($data_one['email'] != $data['email']) {
            $data['email_status'] = 10;
        } else {
            unset($data['email']);
        }
        $rs = $m->where($condition)->save($data);
        if ($rs == true) {
            $this->success('操作成功', __MODULE__ . '/Index/email');
        } else {
            $this->error('操作失败，请重新操作！');
        }
    }

    /**
     * authEmail
     * 发送验证邮箱信息
     * @return display
     * @version dogocms 1.0
     * @todo 调用邮件接口
     */
    public function authEmail() {
        $m = M('Members');
        $uuid = R('Common/System/guid'); //获取uuid
        $key = md5($uuid);
        $uid = session('LOGIN_M_ID');
        $domain = $_SERVER['SERVER_NAME'];
        $url = 'http://' . $domain . '/Passport/checkEmail/key/' . $key . '/uid/' . $uid;
        $condition['id'] = array('eq', $uid);
        $data = $m->where($condition)->field('email')->find();
        $email = $data['email'];
        $html = 'Hi,亲爱的' . $email . ':<br/> 请点击链接地址验证邮箱<br/>' .
                '<a href="' . $url . '">' . $url . '</a><br/>'
                . '谢谢！<br/>' . date("Y-m-d", time());
        $web_name = R('Common/System/getCfg', array('cfg_sitename'));
        $status = R('Common/System/sendEmail', array($email, '邮箱验证-' . $web_name, $html));
        if ($status) {
            $_data['email_key'] = $key;
            $_data['email_sendtime'] = time();
            $m->where($condition)->save($_data);
            $array = array('status' => 0, 'msg' => '邮件发送成功！');
        } else {
            $array = array('status' => 1, 'msg' => '邮件发送失败，请重试或联系管理员！');
        }
        echo json_encode($array);
    }

    /**
     * doChangePwd
     * 更新密码
     * @return display
     * @version dogocms 1.0
     * @todo 权限验证
     */
    public function doChangePwd() {
        $m = M('Members');
        $uid = session('LOGIN_M_ID');
        $uname = session('LOGIN_M_NAME');
        $oldpwd = I('post.oldpwd'); //原密码
        $newpwd = I('post.newpwd'); //新密码1
        $newpwd2 = I('post.newpwd2'); //新密码2
        if (empty($oldpwd) || empty($newpwd) || empty($newpwd2)) {
            $this->error('密码项不能为空！');
            exit;
        }
        if ($newpwd != $newpwd2) {
            $this->error('两次新密码输入不正确！');
            exit;
        }
        $condition['id'] = array('eq', $uid);
        $data_find = $m->field('password')->where($condition)->find();
        $oldpwd = R('Common/System/getPwd', array($uname, $oldpwd));
        if ($oldpwd != $data_find['password']) {
            $this->error('原密码输入不正确，请重新输入！');
            exit;
        }
        $password = R('Common/System/getPwd', array($uname, $newpwd));
        $data['password'] = $password;
        $data['updatetime'] = time();
        $rs = $m->where($condition)->save($data);
        if ($rs == true) {
            $this->success('操作成功', __MODULE__ . '/Index/changePwd');
        } else {
            $this->error('操作失败，请重新操作！');
        }
    }

    /**
     * addressInsert
     * 添加收货地址
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function addressInsert() {
        $m = D('MembersAddress');
        $uid = session('LOGIN_M_ID');
        $condition['members_id'] = array('eq', $uid);
        $count = $m->where($condition)->count();
        if ($count >= 5) {
            $this->error('最多可以设置5条收货地址！');
            exit;
        }
        $name = I('post.name');
        $address = I('post.address');
        $telphone = I('post.telphone');
        $zipcode = I('post.zipcode');
        $province = I('post.province'); //省
        $city = I('post.city'); //城市
        $county = I('post.county'); //县区
        if (empty($name)) {
            $this->error('收货人姓名不能为空！');
            exit;
        }
        if (empty($address)) {
            $this->error('收货人地址不能为空！');
            exit;
        }
        if (empty($telphone)) {
            $this->error('收货人电话不能为空！');
            exit;
        }
        if ($_POST['is_default']) {
            $m->where($condition)->setField('is_default', 10);
            $data['is_default'] = 20;
        }
        $data['members_id'] = $uid;
        $data['address'] = $address;
        $data['name'] = $name;
        $data['address'] = $address;
        $data['telphone'] = $telphone;
        $data['zipcode'] = $zipcode;
        $data['province'] = $province;
        $data['city'] = $city;
        $data['county'] = $county;
        $data['addtime'] = time();
        $data['updatetime'] = time();
        $rs = $m->data($data)->add();
        if ($rs == true) {
            $this->success('操作成功', __MODULE__ . '/Index/addressList');
        } else {
            $this->error('操作失败，请重新操作！');
        }
    }

    /**
     * addressUpdate
     *  更新收货地址
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function addressUpdate() {
        $m = D('MembersAddress');
        $uid = session('LOGIN_M_ID');
        $condition['members_id'] = array('eq', $uid);
        $count = $m->where($condition)->count();
        if ($count >= 5) {
            $this->error('最多可以设置5条收货地址！');
            exit;
        }
        $name = I('post.name');
        $address = I('post.address');
        $telphone = I('post.telphone');
        $zipcode = I('post.zipcode');
        $province = I('post.province'); //省
        $city = I('post.city'); //城市
        $county = I('post.county'); //县区
        if (empty($name)) {
            $this->error('收货人姓名不能为空！');
            exit;
        }
        if (empty($address)) {
            $this->error('收货人地址不能为空！');
            exit;
        }
        if (empty($telphone)) {
            $this->error('收货人电话不能为空！');
            exit;
        }
        if (empty($province)) {
            $this->error('请选择收货省份！');
            exit;
        }
        if (empty($city)) {
            $this->error('请选择收货城市！');
            exit;
        }
        if (empty($county)) {
            $this->error('请选择收货县/区！');
            exit;
        }
        if ($_POST['is_default']) {
            $m->where($condition)->setField('is_default', 10);
            $data['is_default'] = 20;
        }
        $data['address'] = $address;
        $data['name'] = $name;
        $data['address'] = $address;
        $data['telphone'] = $telphone;
        $data['zipcode'] = $zipcode;
        $data['province'] = $province;
        $data['city'] = $city;
        $data['county'] = $county;
        $data['updatetime'] = time();

        $condition_id['id'] = array('eq', I('post.id'));
        $condition_id['members_id'] = array('eq', $uid);
        $rs = $m->where($condition_id)->save($data);
        if ($rs == true) {
            $this->success('操作成功', __MODULE__ . '/Index/addressList');
        } else {
            $this->error('操作失败，请重新操作！');
        }
    }

    /**
     * addressDelete
     *  删除收货地址
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function addressDelete() {
        $m = D('MembersAddress');
        $uid = session('LOGIN_M_ID');
        $condition['members_id'] = array('eq', $uid);
        $condition['id'] = array('eq', I('get.id'));
        $rs = $m->where($condition)->delete();
        if ($rs == true) {
            $this->success('操作成功', __MODULE__ . '/Index/addressList');
        } else {
            $this->error('操作失败，请重新操作！');
        }
    }

    /**
     * getArea
     *  获取地区相关信息
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function getArea() {
        $m = D('Area');
        $type = I('post.type');
        $skin = $this->skin; //获取前台主题皮肤名称
        $tpl_user = $this->tpl_user; //获取主题皮肤会员模板名称
        if ($type == 'province') {
            $condition['parent_id'] = array('eq', 0);
            $condition['status'] = array('eq', 20);
            $data = $m->field('id,name')->where($condition)->select();
            $this->assign('data', $data);
            $this->theme($skin)->display($tpl_user . 'address_model_province');
        } elseif ($type == 'city') {
            $province_id = I('post.province_id');
            $condition['parent_id'] = array('eq', $province_id);
            $condition['status'] = array('eq', 20);
            $data = $m->field('id,name')->where($condition)->select();
            $this->assign('data', $data);
            $this->theme($skin)->display($tpl_user . 'address_model_city');
        } elseif ($type == 'county') {
            $city_id = I('post.city_id');
            $condition['parent_id'] = array('eq', $city_id);
            $condition['status'] = array('eq', 20);
            $data = $m->field('id,name')->where($condition)->select();
            $this->assign('data', $data);
            $this->theme($skin)->display($tpl_user . 'address_model_county');
        }
    }

    /**
     * getAreaCheck
     *  获取地区已选择的相关信息
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function getAreaCheck() {
        $m = D('Area');
        $type = I('post.type');
        $skin = $this->skin; //获取前台主题皮肤名称
        $tpl_user = $this->tpl_user; //获取主题皮肤会员模板名称
        if ($type == 'province') {
            $condition['parent_id'] = array('eq', 0);
            $condition['status'] = array('eq', 20);
            $data = $m->field('id,name')->where($condition)->select();
            $this->assign('check_province_id', I('post.check_province_id'));
            $this->assign('data', $data);
            $this->theme($skin)->display($tpl_user . 'address_model_province');
        } elseif ($type == 'city') {
            $province_id = I('post.check_province_id');
            $condition['parent_id'] = array('eq', $province_id);
            $condition['status'] = array('eq', 20);
            $data = $m->field('id,name')->where($condition)->select();
            $this->assign('check_city_id', I('post.check_city_id'));
            $this->assign('data', $data);
            $this->theme($skin)->display($tpl_user . 'address_model_city');
        } elseif ($type == 'county') {
            $city_id = I('post.check_city_id');
            $condition['parent_id'] = array('eq', $city_id);
            $condition['status'] = array('eq', 20);
            $data = $m->field('id,name')->where($condition)->select();
            $this->assign('check_county_id', I('post.check_county_id'));
            $this->assign('data', $data);
            $this->theme($skin)->display($tpl_user . 'address_model_county');
        }
    }

    /**
     * apiInsert
     * 添加api
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function apiInsert() {
        $m = D('ApiList');
        $uid = session('LOGIN_M_ID');
        $apitoken = I('post.apitoken');
        if (empty($apitoken)) {
            $this->error('token信息不能为空！');
            exit;
        }
        $_POST['addtime'] = time();
        $_POST['members_id'] = $uid;
        $_POST['updatetime'] = time();
        $_POST['status'] = 10;
        $_POST['apitoken'] = $apitoken; //API用户名
        $secretkey = R('Common/System/guid');
        $signature = R('Common/System/guid');
        $_POST['secretkey'] = md5($secretkey); //API密钥（自动生成）
        $_POST['signature'] = md5(sha1($signature)); //签名（自动生成）
        $_POST['domain'] = I('post.domain');
        $rs = $m->data($_POST)->add();
        if ($rs == true) {
            $this->success('操作成功', __MODULE__ . '/Index/apiList');
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
    public function apiUpdate() {
        $m = D('ApiList');
        $uid = session('LOGIN_M_ID');
        $condition['members_id'] = array('eq', $uid);
        $condition['id'] = array('eq', I('post.id'));
        $_POST['updatetime'] = time();
        $_POST['status'] = '10';
        $rs = $m->where($condition)->save($_POST);
        if ($rs == true) {
            $this->success('操作成功', __MODULE__ . '/Index/apiList');
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
    public function apiDelete() {
        $m = D('ApiList');
        $uid = session('LOGIN_M_ID');
        $condition['members_id'] = array('eq', $uid);
        $condition['id'] = array('eq', I('get.id'));
        $rs = $m->where($condition)->delete();
        if ($rs == true) {
            $this->success('操作成功', __MODULE__ . '/Index/addressList');
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
