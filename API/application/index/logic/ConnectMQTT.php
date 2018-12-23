<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5
 * Time: 10:26
 */

namespace app\index\logic;


use app\common\logic\BaseLogic;
use ExcelExportHelper;
use app\common\lib\RedisHelper;
use app\index\model\DetectRecord;
use app\index\apimodel\ProductModel;
use think\Log;
use think\Env;

class ConnectMQTT extends BaseLogic
{
    public function registerDevice()
    {
        $interface = Env::get('app.HSB_PRE_CONNECT_MQTT_API_INTERFACE') . "registerDevice";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }

}