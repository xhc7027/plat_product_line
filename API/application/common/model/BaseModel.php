<?php

namespace app\common\model;

use think\Model;

class BaseModel extends Model
{

    // 开启自动写入时间戳字段
    //protected $autoWriteTimestamp = true;
    // 开启自动写入时间戳字段格式
    protected $autoWriteTimestamp = 'datetime';

    // 定义时间戳字段名
    protected $createTime = 'Fcreate_time';
    protected $updateTime = 'Fupdate_time';

    // 返回的数据集对象
    //protected $resultSetType = 'collection';

}