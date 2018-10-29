<?php

namespace app\index\apimodel;

use think\Env;

/**
 * 类目类，从类目接口获取
 * Class ClassModel
 * @package app\index\model
 */
class ClassModel
{
    private $productLibApi;
    private $detectServiceId;

    public function __construct()
    {
        $this->productLibApi = ENV::get("app.HSB_NEW_PRODUCT_LIB_API_URL");
        $this->detectServiceId = ENV::get("app.HSB_DETECT_LOGIC_SERVICEID");
    }

    // 查询所有类目
    public function getAll($className = '') {
        // 请求头
        $headArr = [
            "_interface" => "pdtclass_get_info",
            "_callerServiceId" => $this->detectServiceId,
            "_invokeId" => Env::get('app.HSB_DETECT_FLAG') . time() . mt_rand(10000, 99999),
        ];
        // 请求体
        $paramArr = [
            "fvalid" =>"1",
            "fkeys" =>"",
            "fpageindex" =>"0",
            "fpagesize" =>"500"
        ];

        $className && $paramArr = array_merge($paramArr, ['fkeys' => $className]);

        // 生成json参数
        $paramJson = \ApiHelper::setJsonParam($paramArr, $headArr);

        $head = \ApiHelper::apiSignature($paramJson, $this->detectServiceId, Env::get('app.HSB_NEW_PRODUCT_LIB_SECRET_KEY'));

        $res = \CurlHelper::apiRequest($this->productLibApi, $paramJson, '', $head);

        if ( !$res ) return false; // 接口请求错误无返回

        if (isset($res['_body']) && '0' === $res['_body']['_ret']) {
            return $res['_body']['_data'];
        } else {
            return [];
        }

    }

}