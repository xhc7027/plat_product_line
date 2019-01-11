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

class DetectInfo extends BaseLogic
{
    public function test($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_DATA_API_INTERFACE') . "Test";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }


    /**
     * 获取列表信息
     * @return array|mixed
     */
    public function getDetectTimeData($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_DATA_API_INTERFACE') . "getDetectTimeData";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }

    /**
     * APP详情时效统计
     */
    public function getDetectTimeDetails($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_DATA_API_INTERFACE') . "getDetectTimeDetails";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }


    /**
     * 导出数据
     */
    public function exportDetectTimeData($params)
    {
        $params['flag'] = 1;
        $interface = Env::get('app.HSB_PRE_DETECT_DATA_API_INTERFACE') . "getDetectTimeData";

        $res = $this->InvokingServerApi($interface, $params, 1);

        $res = $res['_data'];

        return self::createSumSourceDataExcel($res);
    }

    /**
     * 合计数据导出
     *
     * @param $data
     * @return bool
     */
    public static function createSumSourceDataExcel(array $data)
    {
        $cellHeadArr = [
            'sid' => '序号',
            'codeInfo' => '机身条码',
            'uniqueKey' => '检测条码',
            'sourceDetect' => '业务方',
            'orderId' => '订单号',
            'detectId' => '检测单号',
            'userName' => '检测人员',
            'detectBeginTime' => '检测开始时间',
            'detectEndTime' => '检测结束时间',
            'totalDetectTime' => '总时效',
        ];
        $excelExport = new ExcelExportHelper('统计列表', $cellHeadArr);
        //组装要导出的数据
        $exportData = self::collatingSumSourceDataExcel($data);
        //echo json_encode($exportData);die;
        $excelExport->setExcelData($exportData);
        $excelExport->doExportToBrowser('产线检测时效' . date('YmdHis'));
        return true;
    }


    /**
     * 合计数据导出组装
     *
     * @param $data
     * @return array
     */
    public static function collatingSumSourceDataExcel(array $data)
    {
        //判断是否含有list
        if (!isset($data['list'])) {
            $data['list'][0] = [];
        }
        $res = [];
        foreach ($data['list'] as $k => $v) {
            $res[$k]['sid'] = $k + 1;
            $res[$k]['codeInfo'] = isset($v['codeInfo']) && $v['codeInfo'] ? $v['codeInfo'] : ' ';
            $res[$k]['uniqueKey'] = isset($v['uniqueKey']) && $v['uniqueKey'] ? $v['uniqueKey'] : ' ';
            $res[$k]['sourceDetect'] = isset($v['sourceDetect']) && $v['sourceDetect'] ? $v['sourceDetect'] : ' ';
            $res[$k]['orderId'] = isset($v['orderId']) && $v['orderId'] ? $v['orderId'] : ' ';
            $res[$k]['detectId'] = isset($v['detectId']) && $v['detectId'] ? $v['detectId'] : ' ';
            $res[$k]['userName'] = isset($v['userName']) && $v['userName'] ? $v['userName'] : ' ';
            $res[$k]['detectBeginTime'] = isset($v['detectStartTime']) && $v['detectStartTime'] ? $v['detectStartTime'] : ' ';
            $res[$k]['detectEndTime'] = isset($v['detectEndTime']) && $v['detectEndTime'] ? $v['detectEndTime'] : ' ';
            $res[$k]['totalDetectTime'] = isset($v['detectEndTime']) && isset($v['detectStartTime']) ?
                (int)strtotime($v['detectEndTime']) - (int)strtotime($v['detectStartTime']) : '';
        }
        return $res;
    }


    /**
     * 获取工程师检测平均时效
     *
     * @param $params
     * @return array|mixed
     */
    public function getEngineerDetectTime($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_DATA_API_INTERFACE') . "getEngineerDetectTime";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }

    /**
     * 获取工程师检测平均时效
     *
     * @param $params
     * @return array|mixed
     */
    public function pullXianYuDetectTime($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_DATA_API_INTERFACE') . "pullXianYuDetectTime";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }

    /**
     * 获取机台检测时效列表
     *
     * @param $params
     * @return array|mixed
     */
    public function getMachineDetectList($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_DATA_API_INTERFACE') . "getMachineDetectList";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }

    /**
     * 获取机台检测详细检测结果
     *
     * @param $params
     * @return array|mixed
     */
    public function getMachineDetectDetails($params)
    {
        $interface = Env::get('app.HSB_PRE_DETECT_DATA_API_INTERFACE') . "getMachineDetectDetails";

        $res = $this->InvokingServerApi($interface, $params);

        $res = $res['_data'];

        return $res;
    }


    /**
     * 导出数据
     */
    public function exportMachineDetectList($params)
    {
        $params['flag'] = 1;
        $interface = Env::get('app.HSB_PRE_DETECT_DATA_API_INTERFACE') . "getMachineDetectList";

        $res = $this->InvokingServerApi($interface, $params, 1);

        $res = $res['_data'];

        return self::createMachineDetectExcel($res);
    }

    /**
     * 机台数据导出
     *
     * @param $data
     * @return bool
     */
    public static function createMachineDetectExcel(array $data)
    {
        $cellHeadArr = [
            'sid' => '序号',
            'codeInfo' => '机身条码',
            'uniqueKey' => '检测条码',
            'sourceDetect' => '业务方',
            'machineNum' => '机台编号',
            'detectBeginTime' => '检测开始时间',
            'detectEndTime' => '检测结束时间',
            'totalDetectTime' => '总时效',
        ];
        $excelExport = new ExcelExportHelper('统计列表', $cellHeadArr);
        //组装要导出的数据
        $exportData = self::collatingMachineDetectExcel($data);
        //echo json_encode($exportData);die;
        $excelExport->setExcelData($exportData);
        $excelExport->doExportToBrowser('产线检测时效' . date('YmdHis'));
        return true;
    }


    /**
     * 合计数据导出组装
     *
     * @param $data
     * @return array
     */
    public static function collatingMachineDetectExcel(array $data)
    {
        //判断是否含有list
        if (!isset($data['list'])) {
            $data['list'][0] = [];
        }
        $res = [];
        foreach ($data['list'] as $k => $v) {
            $res[$k]['sid'] = $k + 1;
            $res[$k]['codeInfo'] = isset($v['codeInfo']) && $v['codeInfo'] ? $v['codeInfo'] : ' ';
            $res[$k]['sourceDetect'] = isset($v['sourceDetect'])  ? $v['sourceDetect'] : ' 闲鱼 ';
            $res[$k]['uniqueKey'] = isset($v['uniqueKey']) && $v['uniqueKey'] ? $v['uniqueKey'] : ' ';
            $res[$k]['machineNum'] = isset($v['machineNum']) && $v['machineNum'] ? $v['machineNum'] : ' ';
            $res[$k]['detectBeginTime'] = isset($v['detectStartTime']) && $v['detectStartTime'] ? $v['detectStartTime'] : ' ';
            $res[$k]['detectEndTime'] = isset($v['detectEndTime']) && $v['detectEndTime'] ? $v['detectEndTime'] : ' ';
            $res[$k]['totalDetectTime'] = isset($v['detectEndTime']) && isset($v['detectStartTime']) ?
                (int)strtotime($v['detectEndTime']) - (int)strtotime($v['detectStartTime']) : '';
        }
        return $res;
    }

}
