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

    public function test($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "Test";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }

    /**
     *
     *
     */
    public function saveIMEI($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "GetEquipmentInfo";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }

    public function saveAppDetectResult($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "ProductCheckItem";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }


    public function bindDetectBarCode($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "GetProfessionDetect";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }

    public function getQuotation($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "PushEngineerDetectResult";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }

    public function getDetectRecord($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_API_INTERFACE') . "PushEngineerDetectResult";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }
}