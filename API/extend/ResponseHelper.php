<?php

class ResponseHelper
{
    // 默认请求/响应头
    public static $header = [
        '_interface' => '',
        '_msgType' => 'response',
        '_remark' => '',
        '_version' => '0.01'
    ];

    // 默认响应体
    public static $body = [
        '_data' => '',
        '_errCode' => '',
        '_errStr' => '',
    ];

    /**
     * combineJsonData
     * 组建请求
     * @param Array $headArr 扩展请求/响应头
     * @param Array $paramArr 扩展请求/响应体
     * @param Boolean $isRequest 是否请求： true:请求； false:响应 ；为 true 时默认请求体为空数组
     * @return String string
     */
    public static function combineJsonData($paramArr = [], $headArr = [], $isRequest = false)
    {
        $interface = request()->param()['_head']['_interface'];
        $headArr = array_merge(self::$header, ['_interface' => $interface], $headArr);
        $paramArr = $isRequest ? array_merge([], $paramArr) : array_merge(self::$body, $paramArr);
        $headJson = json_encode($headArr);
        $paramsJson = json_encode($paramArr);
        $params = json_decode('{"_head":' . $headJson . ',"_param":' . $paramsJson . '}', TRUE);
        return json_encode($params);
    }

    /**
     * apiSuccess
     * 接口成功返回数据
     * @param string $msg 返回提示信息
     * @param array $data 返回数据
     */
    public static function apiSuccess($msg = 'SUCCESS', $data = [], $isObj = true)
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');

        if (empty($data) && $isObj == true) {
            empty($data) && $data = new \stdClass();
        } else {
            empty($data) && $data = [];
        }
        $interface = !is_null(request()) && request()->param() && request()->param()['_head']['_interface'] ? request()->param()['_head']['_interface'] : '';
	
	$redata = array_merge(['_errCode' => '0','_errStr' => $msg,],$data);


        $result = [
            '_head' => [
                '_interface' => $interface, //->path(),
                '_msgtype' => 'response',
                '_remark' => '',
                '_version' => '0.01'
            ],
            '_data' =>$redata
        ];
	
        ArrayHelper::intToString($result);
        LogHelper::requestRecord($result);

        //验证来源域名,支持跨域
        $response = \think\Response::create($result, 'json', 200, self::allowOriginHead());
        throw new \think\exception\HttpResponseException($response);
    }

    public static function allowOriginHead()
    {
        $origin = '*';
        $header = ['Access-Control-Allow-Headers' => 'x-requested-with,content-type', 'Access-Control-Allow-Origin' => $origin];
        return $header;
    }

    /**
     * apiFail
     * 接口请求失败返回数据
     * @param int $errcode
     * @param string $msg
     * @param array $data
     */
    public static function apiFail($errcode = 0, $msg = 'Fail', $data = [])
    {
        empty($data) && $data = new \stdClass();

        $interface = !is_null(request()) && request()->param() && request()->param()['_head']['_interface'] ? request()->param()['_head']['_interface'] : '';
        $errcode = substr($errcode,3,6);
        $result = [
            '_head' => [
                '_interface' => $interface,
                '_msgType' => 'response',
                '_remark' => '',
                '_version' => '0.01'
            ],
            '_data' => [
                '_data' => $data,
                '_errCode' => $errcode,
                '_errStr' => $msg,
            ]
        ];
        ArrayHelper::intToString($result);
        LogHelper::errorRecord($result);
        $response = \think\Response::create($result, 'json', 200);
        throw new \think\exception\HttpResponseException($response);
    }
}