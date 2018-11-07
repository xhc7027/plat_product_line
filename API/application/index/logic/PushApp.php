<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/1
 * Time: 16:06
 */

namespace app\index\logic;


use app\common\logic\BaseLogic;
use app\common\lib\ErrorCode;
use app\common\lib\RedisHelper;
use app\index\model\DetectRecord;
use app\index\apimodel\ProductModel;
use think\Log;
use think\Env;

class PushApp extends BaseLogic
{

    /**
     * @param $params
     * @return array|mixed
     */
    public function test($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "Test";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }

    /**
     * 将App传入的IMEI码进行保存
     *
     * @param $params
     * @return array|mixed
     */
    public function saveIMEI($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "GetEquipmentInfo";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }

    /**
     * 将App检测结果收录，并返回一个唯一存储ke
     *
     * @param $params
     * @return array|mixed
     */
    public function saveAppDetectResult($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "ProductCheckItem";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }



    /**
     * 获取App传来的条形码，并将条码和存储key进行绑定
     *
     * @param $params
     * @return array|mixed
     */
    public function bindDetectBarCode($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "GetProfessionDetect";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }


    /**
     * 获取App传来的条形码，并将条码和存储key进行绑定
     *
     * @param $params
     * @return array|mixed
     */
    public function bindXyDetectBarCode($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "GetProfessionXyDetect";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res;

        return $res;
    }

    /**
     * 根据用户选项返回查询结果
     *
     * @param $params
     * @return array|mixed
     */
    public function getQuotation($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "PushEngineerDetectResult";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }


    /**
     * 根据用户选项返回查询结果
     *
     * @param $params
     * @return array|mixed
     */
    public function pullAppDetectToXyDetect($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "PushXyEngineerDetectResult";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }

    /**
     * @param $params
     * @return array|mixed
     */
    public function getDetectRecord($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "PushEngineerDetectResult";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }

    /**
     * 返回app需要的唯一key
     *
     * @param $params
     * @return array|mixed
     */
    public function getUniqueKey($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "getUniqueKey";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }


    /**
     * 返回app需要的唯一key
     *
     * @param $params
     * @return array|mixed
     */
    public function analyseXyData($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "AnalyseXyData";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }

}