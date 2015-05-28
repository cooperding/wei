<?php

return array(
    //单点登录实现配置
    'SSO_MEMBERS_LOGIN' => C('API_URL_SSO') . 'Members/login', // 会员登录
    'SSO_MEMBERS_LOGIN_CHECKMEMBERINFO' => C('API_URL_SSO') . 'Members/checkMemberInfo', // 检验会员信息
    'SSO_MEMBERS_REGISTER' => C('API_URL_SSO') . 'Members/register', // 会员注册
    'SSO_MEMBERS_FORGET_PWD' => C('API_URL_SSO') . 'Members/forgetPwd', // 密码
    'SSO_' => '3306', // 端口
    'SSO_' => 'ding_', // 数据库表前缀
    'SSO_' => false, // 是否进行字段类型检查
    'SSO_' => true, // 启用字段缓存
    'SSO_' => 'utf8', // 数据库编码默认采用utf8
);
