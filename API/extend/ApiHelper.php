<?php

class ApiHelper
{
    // 默认请求头
    public static $head = [
        '_interface' => '',
        '_msgType' => 'request',
        '_remark' => '',
        '_version' => '0.01',
        '_timestamps' => '',
        '_invokeId' => '',
        '_callerServiceId' => '',
        '_groupNo' => '1',
    ];

    // 默认请求体
    public static $param = [
//        'uname'     => '',
//        'pageIndex' => '',
//        'pageSize'  => ''
    ];

    // 设置参数，返回 Json 参数
    public static function setJsonParam($paramArr = [], $headArr = [], $flag)
    {
        $timestamp = (string)time();
        //$flag区别post请求和get请求
        if ($flag !== 1) {
            $interface = !is_null(request()) && request()->param() && request()->param()['_head']['_interface'] ? request()->param()['_head']['_interface'] : '';
            $interfaceArr = $interface ? ['_interface' => $interface] : [];
            $headArr = array_merge(self::$head, $interfaceArr, ['_timestamps' => $timestamp], $headArr);
        }
        $paramArr = array_merge([], $paramArr);
        $headJson = json_encode($headArr);
        $paramsJson = json_encode($paramArr);
        $params = json_decode('{"_head":' . $headJson . ',"_param":' . $paramsJson . '}', TRUE);
        return json_encode($params);
    }

    // 签名计算方法
    public static function apiSignature($jsonParam, $serverId, $secretKey)
    {
        $server_id = $serverId; // 业务编制层的服务ID
        $secret_key = $secretKey; // 业务编制层的服务ID对应的secret_key
        $signature = md5($jsonParam . '_' . $secret_key);

        return [
            "HSB-OPENAPI-SIGNATURE:{$signature}",
            "HSB-OPENAPI-CALLERSERVICEID:{$server_id}"
        ];
    }

}