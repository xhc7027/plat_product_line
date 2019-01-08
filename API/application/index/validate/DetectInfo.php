<?php

namespace app\index\validate;

use think\Validate;
use app\common\validate\PublicParams;

class DetectInfo extends PublicParams
{
    protected $rule = [
        'client' => 'require|integer', //手机操作系统	0：IOS，1：AOS
        'info' => 'require',//设备信息
        'info.imei' => 'require', //IMEI
        'info.brandCode' => 'require',//品牌码（Apple, LG, ZTE）
        'info.spuCode' => 'require',//机械码(iPhone 6S, HTC 5060)
        'result' => 'require',//质检结果

        'codeInfo' => 'require',//条形码
        'uniqueKey' => 'require',//唯一key

        'imei' => 'require',//imei码

        'checkList' => 'require',//检测问题项集合
        'skuList' => 'require',//产品sku选项列表
    ];
    protected $message = [
        'client' => '机型不能为空',
        'info' => '机型不能为空',
    ];
    protected $scene = [
        'getDetectTimeData' => [''],
        'exportDetectTimeData' => [''],
        'getDetectTimeDetails' => [''],
        'getEngineerDetectTime' => [''],
        'pullXianYuDetectTime' => [''],
        'getMachineDetectList' => [''],
        'getMachineDetectDetails' => [''],
        'exportMachineDetectList' => [''],
    ];
}
