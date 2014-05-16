<?php

/**
 * InformationRecordModel.class.php
 * 信息记录表模型
 * @author 正侠客 <lookcms@gmail.com>
 * @copyright 2012- http://www.dingcms.com http://www.dogocms.com All rights reserved.
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @version dogocms 1.0 2014-01-20 20:29
 * @package  Controller
 * @todo 字段验证
 */
namespace Admin\Model;
use Think\Model;
class InformationRecordModel extends Model {

    protected $tableName = 'information_record';
    //_pk 表示主键字段名称 _autoinc 表示主键是否自动增长类型
    protected $fields = array(
        'id', 'key_id', 'type', 'ip', 'addtime', 'updatetime', 'members_id', '_pk' => 'id'
    );

}

?>