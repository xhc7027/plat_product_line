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
    /**
     * 设备注册
     *
     * @param $params
     * @return array|mixed
     */
    public function registerDevice($params)
    {
        $interface = Env::get('app.HSB_PRE_CONNECT_MQTT_API_INTERFACE') . "registerDevice";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }


    /**
     * 定时脚本任务删除设备
     *
     * @param $params
     * @return array|mixed
     */
    public function deleteDeviceName()
    {
        $interface = Env::get('app.HSB_PRE_CONNECT_MQTT_API_INTERFACE') . "deleteDeviceName";

        $res = $this->InvokingServerApi($interface);

        $res = $res['_data'];

        return $res;
    }
}
