<?php

namespace app\index\apimodel;

use think\Env;

/**
 * 产品类，从产品接口获取
 * Class ProductModel
 * @package app\index\model
 */
class ProductModel
{
    private $productLibApi;
    private $detectServiceId;

    public function __construct()
    {
        $this->productLibApi = ENV::get("app.HSB_NEW_PRODUCT_LIB_API_URL");
        $this->detectServiceId = ENV::get("app.HSB_DETECT_LOGIC_SERVICEID");
    }

    public function getProductInfo($productIds = []) {
        if (!$productIds) { return []; }

        $productIds = implode('#', $productIds);

        // 请求头
        $headArr = [
            "_interface" => "product_id_info_get",
            "_callerServiceId" => $this->detectServiceId,
            "_invokeId" => Env::get('app.HSB_DETECT_FLAG') . time() . mt_rand(10000, 99999),
        ];
        // 请求体
        $paramArr = [
            'fproduct_id' => $productIds,
        ];

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

    // 根据条件获取产品信息列表
    public function getAll($productName = '', $brandId = '', $classId = '', $productId = '') {
        // 请求头
        $headArr = [
            "_interface" => "product_con_get",
            "_callerServiceId" => $this->detectServiceId,
            "_invokeId" => Env::get('app.HSB_DETECT_FLAG') . time() . mt_rand(10000, 99999),
        ];
        // 请求体
        $paramArr = [
            'fkeyword' => "",
            'fbrandid' => "",
            'fclassid' => "",
            'fvalid' => "1",
            'fpageindex' => "0",
            'fpagesize' => "500",
            'frecycle_type_id' => ""
        ];

        if ($productName || $brandId || $classId || $productId) {
//            $updateParamArr = ['productname' => $productName, "brandid" => $brandId, "classid" => $classId, "productid"=> $productId];
            $updateParamArr = ['fkeyword' => $productName, "fbrandid" => $brandId, "fclassid" => $classId];
            $updateParamArr = array_filter($updateParamArr);
            $updateParamArr && $paramArr = array_merge($paramArr, $updateParamArr);
        }

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

    // 查询所有产品
    /*
    public function getAll($productName = '', $brandId = '', $classId = '', $productId = '') {

        return $this->getProductList($productName, $brandId, $classId, $productId);

        // 请求头
        $headArr = [
            "_interface" => "productget",
            "_callerServiceId" => $this->detectServiceId,
            "_invokeId" => Env::get('app.HSB_DETECT_FLAG') . time() . mt_rand(10000, 99999),
        ];
        // 请求体
        $paramArr = [
            "bossuserid" => "394",
            "bossuserkey" => "",
            "productid" => "",
            "isupper" => "1",
            "productname" => "",
            "pageindex" => "",
            "pagesize" => "",
            "precise" => "1",//(1.代表精确查找:sql条件用 and 组合;0:模糊查找,sql条件用or组合,只面向前端)
            "keyword" => "",
            "brandid" => "",
            "classid" => "",
            "who" => "2",
            "valid_1_0" => "",
            "recycletype" => ""
        ];

        if ($productName || $brandId || $classId || $productId) {
            $updateParamArr = ['productname' => $productName, "brandid" => $brandId, "classid" => $classId, "productid"=> $productId];
            $updateParamArr = array_filter($updateParamArr);
            $updateParamArr && $paramArr = array_merge($paramArr, $updateParamArr);
        }

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
    */

    // 查询单条产品
    public function getOne($productId = '', $brandId = '', $classId = '') {
        if (!$productId) return false;
        // 请求头
        $headArr = [
            "_interface" => "product_id_info_get",
            "_callerServiceId" => $this->detectServiceId,
            "_invokeId" => Env::get('app.HSB_DETECT_FLAG') . time() . mt_rand(10000, 99999),
        ];
        // 请求体
        $paramArr = [
            "fproduct_id" => ""
        ];

        $paramArr = array_merge($paramArr, ['fproduct_id' => (string) $productId]);

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