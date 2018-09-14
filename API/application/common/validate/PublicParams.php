<?php

namespace app\common\validate;

use \think\Validate;

/**
 * 公共验证器
 * Class PublicParams
 * @package app\common\validate
 * @Author Yu
 */
class PublicParams extends Validate
{
//    use \app\common\traits\Validate;

    protected $rule = [
        '_head'           => 'require|array',
        '_head._interface' => 'require',
        '_head._version'   => 'require',
        '_head._msgType'   => 'require',
        '_param'         => 'require|array',
        //'_param._system'  => 'require',
    ];

    protected $message = [
        '_head.require'           => '请求头不能为空',
        '_head.array'             => '请求头必须是数组',
        '_head._interface.require' => '请求接口不能为空',
        '_head._version.require'   => '接口版本号不能为空',
        '_head._msgType.require'   => '消息类型不能为空',
        '_param.require'         => '请求参数不能为空',
        '_param.array'           => '请求参数必须是数组',
        //'_param.system.require'  => '接口调用方不能为空',
    ];

    protected $scene = [

    ];

//    public function __construct(array $rules = [], array $message = [], array $field = [])
//    {
//        parent::__construct($rules, $message, $field);
//        $this->rule($this->_rule);
//        $this->message($this->_message);
//        $this->scene($this->_scene);
//    }

}