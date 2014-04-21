<?php

//menu菜单
defined('THINK_PATH') or exit();
$array = array(
    array('label' => L('menu_sys_name'), 'type' => 'sys_name', 'items' => array(
            array('label' => L('menu_nav_name'), 'type' => 'nav_name', 'items' => array(
                    array('label' => L('menu_nav_head'), 'type' => 'nav_head', 'link' => __MODULE__ . '/NavHead/index'),
                    array('label' => L('menu_nav_foot'), 'type' => 'nav_foot', 'link' => __MODULE__ . '/NavFoot/index')
                )),
            array('label' => '日志管理', 'type' => 'flash', 'items' => array(
                    array('label' => '日志记录', 'type' => 'list', 'link' => __MODULE__ . '/Logs/index'),
                    array('label' => '日志设置', 'type' => 'navhead', 'link' => __MODULE__ . '/Logsinfo/index')
                )),
            array('label' => '友情链接', 'type' => 'setting', 'items' => array(
                    array('label' => '友情链接', 'type' => 'list', 'link' => __MODULE__ . '/Links/index'),
                    array('label' => '友情链接分类', 'type' => 'list', 'link' => __MODULE__ . '/Links/sort'),
                    array('label' => '添加友情链接', 'type' => 'links', 'rel' => 'dialog', 'link' => __MODULE__ . '/Links/add')
                )),
            array('label' => '邮件模板', 'type' => 'setting', 'items' => array(
                    array('label' => '基础设置', 'type' => 'setting', 'link' => 'www.baidu.com')
                ))
        )),
    array('label' => L('menu_info_name'), 'type' => 'info_name', 'items' => array(
            array('label' => L('menu_news_name'), 'type' => 'news_name', 'items' => array(
                    array('label' => L('menu_news_list'), 'type' => 'news_list', 'link' => __MODULE__ . '/News/index'),
                    array('label' => L('menu_news_list_add'), 'type' => 'news_list_add', 'rel' => 'dialog', 'link' => __MODULE__ . '/News/add'),
                    array('label' => L('menu_news_recycle'), 'type' => 'news_recycle', 'link' => __MODULE__ . '/News/recycle'),
                array('label' => L('menu_sort_list'), 'type' => 'sort_list', 'link' => __MODULE__ . '/NewsSort/index'),
                    array('label' => L('menu_sort_add'), 'type' => 'newssort', 'rel' => 'dialog', 'link' => __MODULE__ . '/NewsSort/add')
                )),
            array('label' => L('menu_message_name'), 'type' => 'message_name', 'items' => array(
                    array('label' => L('menu_message_list'), 'type' => 'message_list', 'link' => __MODULE__ . '/Message/index'),
                    array('label' => L('menu_message_sort'), 'type' => 'message_setting', 'link' => __MODULE__ . '/Message/sort')
                )),
            array('label' => L('menu_comment_name'), 'type' => 'comment_name', 'items' => array(
                    array('label' => L('menu_comment_list'), 'type' => 'comment_list', 'link' => __MODULE__ . '/Comment/index')
                )),
            array('label' => L('menu_singlepage_name'), 'type' => 'singlepage_name', 'items' => array(
                    array('label' => L('menu_singlepage_list'), 'type' => 'singlepage_list', 'link' => __MODULE__ . '/Pages/index'),
                    array('label' => L('menu_singlepage_sort'), 'type' => 'singlepage_sort', 'link' => __MODULE__ . '/Pages/sort'),
                )),
            array('label' => L('menu_block_name'), 'type' => 'block_name', 'items' => array(
                    array('label' => L('menu_block_list'), 'type' => 'block_list', 'link' => __MODULE__ . '/Block/index'),
                    array('label' => L('menu_block_cat'), 'type' => 'block_cat', 'link' => __MODULE__ . '/Block/sort')
                )),
            array('label' => '广告管理', 'type' => 'flash', 'items' => array(
                    array('label' => '广告列表', 'type' => 'advertising', 'link' => __MODULE__ . '/Ads/index'),
                    array('label' => '广告分类', 'type' => 'advertising', 'link' => __MODULE__ . '/Ads/sort')
                ))
        )),
    array('label' => L('menu_user_name'), 'type' => 'user_name', 'items' => array(
            array('label' => L('menu_member_name'), 'type' => 'member_name', 'items' => array(
                    array('label' => L('menu_member_perinfo'), 'type' => 'perinfo', 'rel' => 'dialog', 'link' => __MODULE__ . '/Account/perinfo'),
                    array('label' => L('menu_member_changepwd'), 'type' => 'changepwd', 'rel' => 'dialog', 'link' => __MODULE__ . '/Account/changepwd'),
                    array('label' => L('menu_member_adminlist'), 'type' => 'member_adminlist', 'link' => __MODULE__ . '/Operators/index'),
                    array('label' => L('menu_member_frontlist'), 'type' => 'member_frontlist', 'link' => __MODULE__ . '/Members/index')
                )),
            array('label' => L('menu_backcom_name'), 'type' => 'backcom_name', 'items' => array(
                    array('label' => L('menu_node_name'), 'type' => 'member_adminlist', 'link' => __MODULE__ . '/Node/index'),
                    array('label' => L('menu_role_name'), 'type' => 'member_adminlist', 'link' => __MODULE__ . '/Role/index')
                )),
            array('label' => L('menu_frontcom_name'), 'type' => 'frontcom_name', 'items' => array(
                    array('label' => L('menu_frontcom_cat'), 'type' => 'frontcom_cat', 'link' => 'www.baidu.com'),
                    array('label' => L('menu_frontcom_list'), 'type' => 'frontcom_list', 'link' => 'www.baidu.com')
                )),
        )),
    array('label' => '扩展管理', 'type' => 'templet_name', 'items' => array(
            array('label' => '微站基础设置', 'type' => 'setting', 'items' => array(
                    array('label' => '自定义菜单', 'type' => 'setting', 'link' => 'www.baidu.com')
                )),
            array('label' => '微站广告管理', 'type' => 'templet_', 'items' => array(
                    array('label' => '微广告列表', 'type' => 'ffg', 'link' => 'www.baidu.com'),
                    array('label' => '基础设置', 'type' => 'setting', 'link' => 'www.baidu.com')
                )),
            array('label' => L('menu_channel_name'), 'type' => 'channel_name', 'items' => array(
                    array('label' => L('menu_model_cat'), 'type' => 'model_cat', 'link' => __MODULE__ . '/ContentModel/sort'),
                    array('label' => L('menu_model_list'), 'type' => 'model_list', 'link' => __MODULE__ . '/ContentModel/sortlist')
                )),
            array('label' => L('menu_linkpage_name'), 'type' => 'linkpage_name', 'items' => array(
                    array('label' => L('menu_linkpage_cat'), 'type' => 'linkpage_cat', 'link' => __MODULE__ . '/LinkPage/sort'),
                    array('label' => L('menu_linkpage_list'), 'type' => 'linkpage_list', 'link' => __MODULE__ . '/LinkPage/sortlist')
                )),
        ))
);

return $array;
?>