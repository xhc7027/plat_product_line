<?php

namespace app\index\apimodel;

use app\common\lib\ErrorCode;
use think\Env;

/**
 * 品牌类，从品牌接口获取
 * Class BrandModel
 * @package app\index\model
 */
class BrandModel
{
    private $productLibApi;
    private $detectServiceId;

    public function __construct()
    {
        $this->productLibApi = ENV::get("app.HSB_NEW_PRODUCT_LIB_API_URL");
        $this->detectServiceId = ENV::get("app.HSB_DETECT_LOGIC_SERVICEID");
    }

    // 查询所有类目
    public function getAll($brandName = '') {
        // 请求头
        $headArr = [
            "_interface" => "brand_ver_get",
            "_callerServiceId" => $this->detectServiceId,
            "_invokeId" => Env::get('app.HSB_DETECT_FLAG') . time() . mt_rand(10000, 99999),
        ];
        // 请求体
        $paramArr = [
            "fkeys" => "",
            "fvalid" => "1",
            "fpageindex" => "0",
            "fpagesize" => "500",
            "fversions" => "2"
        ];

        $brandName && $paramArr = array_merge($paramArr, ['fkeys' => $brandName]);

        // 生成json参数
        $paramJson = \ApiHelper::setJsonParam($paramArr, $headArr);

        $head = \ApiHelper::apiSignature($paramJson, $this->detectServiceId, Env::get('app.HSB_NEW_PRODUCT_LIB_SECRET_KEY'));

        $res = \CurlHelper::apiRequest($this->productLibApi, $paramJson, '', $head);

        if (!$res) return false;

        if (isset($res['_body']) && '0' === $res['_body']['_ret']) {
            return $res['_body']['_data'];
        } else {
            return [];
        }

    }

}