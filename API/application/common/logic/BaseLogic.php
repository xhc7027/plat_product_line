<?php

namespace app\common\logic;

use app\common\lib\ErrorCode;
use think\Env;

/**
 * 公共逻辑处理层
 * Class BaseLogic
 * @package app\common\logic
 */
class BaseLogic
{

    /* 调用服务层 API */
    public function InvokingServerApi($interface, $params = [], $flag = 0)
    {
        // 生成请求参数
        $paramJson = $this->setApiParams($interface, $params, $flag);
        // 签名处理
        $head = \ApiHelper::apiSignature($paramJson, ENV::get("app.HSB_PRODUCT_SERVICE_SERVICEID"), Env::get('app.HSB_PRODUCT_SERVICE_SECRET_KEY'));
        //$head = '';

        $res = \CurlHelper::apiRequest(Env::get('app.HSB_PRODUCT_SERVER_API_URL'), $paramJson, '', $head);
        if (!$res) {
            \LogHelper::errorRecord("获取服务层接口失败: [API] : " . Env::get('app.HSB_PRODUCT_SERVER_API_URL') . " [PARAM] : " . $paramJson . " [HEAD] : " . json_encode($head));
            \ResponseHelper::apiFail(ErrorCode::CGI_REQUEST_ERROR, '获取服务层接口失败!' . json_encode($res));
        }

        if (isset($res['_data']) && '0' === $res['_data']['_ret']) {
            $res = $res['_data'];
        } else {
            \ResponseHelper::apiFail($res['_data']['_errCode'], $res['_data']['_errStr']);
        }

        return $res;
    }

    /*生成服务层请求数据*/
    public function setApiParams($interface, $params = [], $flag)
    {
        // 请求头
        $headArr = [
            "_interface" => "{$interface}",
            "_callerServiceId" => ENV::get("app.HSB_PRODUCT_LOGIC_SERVICEID"),
            "_invokeId" => Env::get('app.HSB_DETECT_FLAG') . time() . mt_rand(10000, 99999),
        ];
        // 请求体
        $paramArr = [
        ];

        $params && $paramArr = array_merge($paramArr, $params);

        // 生成json参数
        $paramJson = \ApiHelper::setJsonParam($paramArr, $headArr, $flag);

        return $paramJson;

    }

    /*获取所有操作用户接口*/
    public function getAllUser(Array $params)
    {
        $interface = 'systemusers';
        $url = 'http://api-amc.huishoubao.com.cn' . DS . $interface;
        $param = [
            "login_token" => (string)$params['login_token'],//注册的token
            "login_user_id" => (string)$params['login_user_id'],//用户ID
            "login_system_id" => (string)$params['login_system_id']//系统ID
        ];

        $dataArr = [
            'head' => [
                'interface' => 'systemusers',
                'msgtype' => 'request',
                'remark' => '',
                'version' => '0.01',
            ],
            'params' => [
                "login_token" => (string)$params['login_token'],//注册的token
                "login_user_id" => (string)$params['login_user_id'],//用户ID
                "login_system_id" => (string)$params['login_system_id']//系统ID
            ]
        ];
        $jsonData = json_encode($dataArr);

        $result = \CurlHelper::apiRequest($url, $jsonData);

        if ($result && isset($result['body']['ret']) && '0' === $result['body']['ret']) {
            $result = $result['body']['data'];
        } elseif (isset($result['body']) && isset($result['body']['retinfo'])) {
            $result['body']['retcode'] = isset($result['body']['retcode']) ? $result['body']['retcode'] : ErrorCode::CGI_REQUEST_ERROR;
            \ResponseHelper::apiFail($result['body']['retcode'], $result['body']['retinfo']);
        } else {
            \ResponseHelper::apiFail(ErrorCode::CGI_REQUEST_ERROR, '请求第三方接口无返回 [ 获取所有用户 ]');
        }

        return $result;

    }

}