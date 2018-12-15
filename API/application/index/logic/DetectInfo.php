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
    public function test()
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
            'souceDetct' => '业务方',
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
        $res = [];
        foreach ($data['list'] as $k => $v) {
            $res[$k]['sid'] = $k + 1;
            $res[$k]['codeInfo'] = $v['codeInfo'] ?? ' ';
            $res[$k]['uniqueKey'] = $v['uniqueKey'] ?? ' ';
            $res[$k]['souceDetct'] = $v['souceDetct'] ?? ' ';
            $res[$k]['orderId'] = $v['orderId'] ?? ' ';
            $res[$k]['detectId'] = $v['detectId'] ?? ' ';
            $res[$k]['userName'] = $v['userName'] ?? ' ';
            $res[$k]['detectBeginTime'] = $v['detectStartTime'] ?? ' ';
            $res[$k]['detectEndTime'] = $v['detectEndTime'] ?? ' ';
            $res[$k]['totalDetectTime'] = (int)strtotime($v['detectEndTime']) - (int)strtotime($v['detectStartTime']);
        }
        return $res;
    }
}