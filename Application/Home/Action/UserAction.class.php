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

class UserAction extends BaseuserAction {

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
        $this->theme($skin)->display($tpl_user . 'index');
    }

    /**
     * personal
     * 个人资料
     * @return display
     * @version dogocms 1.0
     * @todo 权限验证
     */
    public function personal() {
        $m = M('Members');
        $uid = session('LOGIN_M_ID');
        $condition['id'] = array('eq', $uid);
        $data = $m->field('username,sex,signature,birthday')->where($condition)->find();
        $skin = $this->skin; //获取前台主题皮肤名称
        $tpl_user = $this->tpl_user; //获取主题皮肤会员模板名称
        $this->assign('title', '个人资料');
        $this->assign('sidebar_active', 'personal');
        $this->assign('data', $data);
        $this->theme($skin)->display($tpl_user . 'personal');
    }

    /**
     * personal
     * 个人资料
     * @return display
     * @version dogocms 1.0
     * @todo 权限验证
     */
    public function email() {
        $m = M('Members');
        $uid = session('LOGIN_M_ID');
        $condition['id'] = array('eq', $uid);
        $data = $m->field('email,email_status')->where($condition)->find();
        $skin = $this->skin; //获取前台主题皮肤名称
        $tpl_user = $this->tpl_user; //获取主题皮肤会员模板名称
        $this->assign('title', '邮箱信息');
        $this->assign('sidebar_active', 'email');
        $this->assign('data', $data);
        $this->theme($skin)->display($tpl_user . 'email');
    }

    /**
     * changePwd
     * 修改密码
     * @return display
     * @version dogocms 1.0
     * @todo 权限验证
     */
    public function changePwd() {
        $skin = $this->skin; //获取前台主题皮肤名称
        $tpl_user = $this->tpl_user; //获取主题皮肤会员模板名称
        $this->assign('title', '修改密码');
        $this->assign('sidebar_active', 'changepwd');
        $this->theme($skin)->display($tpl_user . 'changepwd');
    }

    

    /**
     * newsAdd
     * 信息-添加
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function newsAdd() {
        $skin = $this->skin; //获取前台主题皮肤名称
        $tpl_user = $this->tpl_user; //获取主题皮肤会员模板名称
        $this->assign('title', '我要投稿');
        $this->assign('sidebar_active', 'news_add');
        $this->theme($skin)->display($tpl_user . 'news_add');
    }

    /**
     * newsEdit
     * 信息-编辑
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function newsEdit() {
        $m = D('Title');
        $uid = session('LOGIN_M_ID');
        $condition['t.members_id'] = array('eq', $uid);
        $condition['t.id'] = array('eq', I('get.id'));
        $data = $m->Table(C('DB_PREFIX') . 'title t')
                        ->field('t.*,c.content')
                        ->join(C('DB_PREFIX') . 'content c ON c.title_id = t.id ')
                        ->where($condition)->find();
        $skin = $this->skin; //获取前台主题皮肤名称
        $tpl_user = $this->tpl_user; //获取主题皮肤会员模板名称
        $this->assign('title', '修改信息');
        $this->assign('sidebar_active', 'news_edit');
        $this->assign('data', $data);
        $this->theme($skin)->display($tpl_user . 'news_edit');
    }

    /**
     * newsList
     * news列表信息
     * @return display
     * @version dogocms 1.0
     * @todo 
     */
    public function newsList() {
        $t = D('Title');
        $uid = session('LOGIN_M_ID');
        $condition['t.members_id'] = array('eq', $uid);
        $count = $t->Table(C('DB_PREFIX') . 'title t')
                        ->join(C('DB_PREFIX') . 'content c ON c.title_id = t.id ')
                        ->where($condition)->count();
        $page = new \Org\Util\QiuyunPage($count, 8); // 实例化分页类 传入总记录数和每页显示的记录数
        $page->setConfig('header', '条记录');
        $page->setConfig('theme', "%UP_PAGE% %FIRST% %LINK_PAGE% %DOWN_PAGE% %END% <li><span>%TOTAL_ROW% %HEADER% %NOW_PAGE%/%TOTAL_PAGE% 页</span></li>");
        $show = $page->show(); // 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $t->Table(C('DB_PREFIX') . 'title t')
                ->join(C('DB_PREFIX') . 'content c ON c.title_id = t.id ')
                ->where($condition)
                ->field('t.*,c.*')
                ->order('t.id desc')
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();

        foreach ($list as $k => $v) {
            if ($v['status'] == '12') {
                $list[$k]['status'] = '已审核';
            } else if ($v['status'] == '11') {
                $list[$k]['status'] = '未通过审核';
            } else if ($v['status'] == '10') {
                $list[$k]['status'] = '待审核';
            }
        }
        $skin = $this->skin; //获取前台主题皮肤名称
        $tpl_user = $this->tpl_user; //获取主题皮肤会员模板名称
        $this->assign('title', '我的信息列表');
        $this->assign('sidebar_active', 'news_list');
        $this->assign('list', $list);
        $this->assign('page', $show); // 赋值分页输出
        $this->theme($skin)->display($tpl_user . 'news_list');
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
