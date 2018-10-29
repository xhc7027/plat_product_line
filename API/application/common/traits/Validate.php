<?php

namespace app\common\traits;

trait Validate
{

    private $signAuthKey = '342e1d5cd7a801d218e55b76053a1ab4'; // 密钥
    private $expire = 5; // 签名有效期（单位：秒）
    private $validateSign = true; // 开启签名验证

    protected $_rule = [
        'head'           => 'require|array',
        'head.interface' => 'require',
        'head.version'   => 'require',
        'head.msgtype'   => 'require',
        'params'         => 'require|array',
        'params.system'  => 'require',
        'params.time'    => 'require|number',
        'params.sign'    => 'require|Authentication',

    ];

    protected $_message = [
        'head.require'               => '请求头不能为空',
        'head.array'                 => '请求头必须是数组',
        'head.interface.require'     => '请求接口不能为空',
        'head.version.require'       => '接口版本号不能为空',
        'head.msgtype.require'       => '消息类型不能为空',
        'params.require'             => '请求参数不能为空',
        'params.array'               => '请求参数必须是数组',
        'params.system.require'      => '接口调用方不能为空',
        'params.time.require'        => '时间戳不能为空',
        'params.sign.require'        => '签名不能为空',
        'params.sign.Authentication' => '签名认证失败',
    ];

    protected $_scene = [
    ];

    protected function Authentication($value, $rule, $data)
    {
        if (!$this->validateSign) {
            return true;
        }
        $time = time();
        // 时间戳过期
        if (!isset($data['params']['time']) || ($time - $data['params']['time']) > $this->expire) {
            return false;
        }
        $sign = $data['params']['sign'];
        unset($data['params']['sign']);
        $newArray = array_merge($data['head'], $data['params']);
        ksort($newArray);
        $realSign = md5(urldecode(http_build_query($newArray) . '&key=' . $this->signAuthKey));
        if ($sign != $realSign) {
            return false;
        }
        return true;
    }

}