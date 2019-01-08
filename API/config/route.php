<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------

return [

    // 新增/修改配置
    'pushApp/saveIMEI' => 'index/pushApp/saveIMEI',
    'pushApp/test' => 'index/pushApp/test',
    'pushApp/saveAppDetectResult' => 'index/pushApp/saveAppDetectResult',

    'pushApp/bindCodeInfo' => 'index/pushApp/bindCodeInfo',
    'pushApp/getQuotation' => 'index/pushApp/getQuotation',
    'pushApp/pullAppDetectToXyDetect' => 'index/pushApp/pullAppDetectToXyDetect',
    'pushApp/getUniqueKey' => 'index/pushApp/getUniqueKey',
    'pushApp/analyseXyData' => 'index/pushApp/analyseXyData',
    'pushApp/getDetectInfo' => 'index/pushApp/getDetectInfo',
    'pushApp/pushAppDetectResult' => 'index/pushApp/pushAppDetectResult',
    'pushApp/pushMachineDetect' => 'index/pushApp/pushMachineDetect',


    //数据统计
    'detectInfo/getDetectTimeData' => 'index/detectInfo/getDetectTimeData',

    'detectInfo/exportDetectTimeData' => 'index/detectInfo/exportDetectTimeData',
    'detectInfo/getDetectTimeDetails' => 'index/detectInfo/getDetectTimeDetails',
    'detectInfo/getEngineerDetectTime' => 'index/detectInfo/getEngineerDetectTime',
    'detectInfo/pullXianYuDetectTime' => 'index/detectInfo/pullXianYuDetectTime',
    'detectInfo/getMachineDetectList' => 'index/detectInfo/getMachineDetectList',
    'detectInfo/getMachineDetectDetails' => 'index/detectInfo/getMachineDetectDetails',
    'detectInfo/exportMachineDetectList' => 'index/detectInfo/exportMachineDetectList',

    //MQTT连接
    'connectMQTT/registerDevice' => 'index/connectMQTT/registerDevice',

];
