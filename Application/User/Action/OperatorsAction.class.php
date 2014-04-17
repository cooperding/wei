<?php

/**
 * OperatorsAction.class.php
 * 后台会员
 * @author 正侠客 <lookcms@gmail.com>
 * @copyright 2012- http://www.dingcms.com http://www.dogocms.com All rights reserved.
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version dogocms 1.0 2013-1-5 14:57
 * @package  Controller
 * @todo 信息各项操作
 */
namespace Admin\Action;
use Think\Action;
class OperatorsAction extends BaseAction {

    /**
     * index
     * 信息列表
     * @access public
     * @return array
     * @version dogocms 1.0
     */
    public function index()
    {
        $this->display();
    }

    /**
     * add
     * 添加会员
     * @access public
     * @return array
     * @version dogocms 1.0
     */
    public function add()
    {
        $status = array(
            '20' => '可用',
            '10' => '禁用'
        );
        $this->assign('status', $status);
        $this->display();
    }

    /**
     * edit
     * 编辑会员
     * @access public
     * @return array
     * @version dogocms 1.0
     */
    public function edit()
    {
        $m = D('Operators');
        $id = I('get.id');
        $condition['o.id'] = array('eq', $id);
        $data = $m->Table(C('DB_PREFIX') . 'operators o')
                        ->join(C('DB_PREFIX') . 'role_user r ON r.user_id=o.id')
                        ->where($condition)->find();
        $status = array(
            '20' => '可用',
            '10' => '禁用'
        );
        $this->assign('status', $status);
        $this->assign('data', $data);
        $this->assign('v_status', $data['status']);
        $this->display();
    }

    /**
     * insert
     * 分类插入数据
     * @access public
     * @return boolean
     * @version dogocms 1.0
     */
    public function insert()
    {
        $m = D('Operators');
        $user_name = I('post.username');
        $password = I('post.password');
        $_POST['status'] = $_POST['status'][0];
        if (empty($user_name)) {
            $this->dmsg('1', '用户名不能为空！', false, true);
        }
        if (empty($password)) {
            $this->dmsg('1', '密码不能为空！', false, true);
        }
        $condition['username'] = array('eq', $user_name);
        $data = $m->where($condition)->find();
        if ($data) {
            $this->dmsg('1', '用户名已经存在！', false, true);
        }
        $_POST['creat_time'] = time();
        $_POST['updatetime'] = time();
        $_POST['password'] = $this->changePassword($user_name, $password);
        if ($m->create()) {
            $rs = $m->add($_POST);
            if ($rs == true) {
                $id = $m->getLastInsID();
                $role_user['user_id'] = $id;
                $role_user['role_id'] = I('post.role_id');
                $this->dmsg('2', '操作成功！', true);
            } else {
                $this->dmsg('1', '操作失败！', false, true);
            }
        }//if
    }

    /**
     * update
     * 分类更新数据
     * @access public
     * @return boolean
     * @version dogocms 1.0
     */
    public function update()
    {
        $m = D('Operators');
        $user_name = I('post.username');
        $password = I('post.password');
        $_POST['status'] = $_POST['status'][0];
        if (empty($user_name)) {
            $this->dmsg('1', '用户名不能为空！', false, true);
        }
        if (empty($password)) {
            $this->dmsg('1', '密码不能为空！', false, true);
        }
        $condition['username'] = array('eq', $user_name);
        $data = $m->where($condition)->find();
        if ($data) {
            $this->dmsg('1', '用户名已经存在！', false, true);
        }
        $_POST['creat_time'] = time();
        $_POST['updatetime'] = time();
        if (!empty($password)) {
            $_POST['password'] = $this->changePassword($user_name, $password);
        } else {
            unset($_POST['password']);
        }
        $rs = $m->save($_POST);
        if ($rs == true) {
            $this->dmsg('2', '操作成功！', true);
        } else {
            $this->dmsg('1', '未有操作或操作失败！', false, true);
        }
    }

    /**
     * delete
     * 分类信息删除操作
     * @access public
     * @return boolean
     * @version dogocms 1.0
     */
    public function delete()
    {
        $m = D('Operators');
        $id = I('post.id');
        $uid = session('LOGIN_UID');
        if ($uid == $id || $id == '1') {
            $this->dmsg('1', '该会员不能删除！', false, true);
        }
        $condition['id'] = array('eq', $id);
        $del = $m->where($condition)->delete();
        if ($del == true) {
            $this->dmsg('2', '操作成功！', true);
        } else {
            $this->dmsg('1', '操作失败！', false, true);
        }//if
    }

    /**
     * listJsonId
     * 取得field信息
     * @access public
     * @return array
     * @version dogocms 1.0
     */
    public function listJsonId()
    {
        $m = D('Operators');
        $pageNumber = intval($_REQUEST['page']);
        $pageRows = intval($_REQUEST['rows']);
        $pageNumber = (($pageNumber == null || $pageNumber == 0) ? 1 : $pageNumber);
        $pageRows = (($pageRows == FALSE) ? 10 : $pageRows);
        $count = $m->where($condition)->count();
        new \Think\Page($count, $pageRows); // 导入分页类
        $firstRow = ($pageNumber - 1) * $pageRows;
        $data = $m->where($condition)->limit($firstRow . ',' . $pageRows)->order('id desc')->select();
        if ($data) {
            foreach ($data as $k => $v) {
                $data[$k]['creat_time'] = date('Y-m-d H:i:s', $v['creat_time']);
                if ($v['status'] == '20') {
                    $data[$k]['status'] = '启用';
                } else {
                    $data[$k]['status'] = '启用';
                }
            }
        } else {
            $data = array();
        }
        $array = array();
        $array['total'] = $count;
        $array['rows'] = $data;
        echo json_encode($array);
    }

}

?>