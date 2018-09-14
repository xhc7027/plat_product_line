<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
/*
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods:POST,GET,PUT');
header('Access-Control-Allow-Headers:x-requested-with,content-type');
header('Access-Control-Allow-Credentials:true');
//*/
if(strtoupper($_SERVER['REQUEST_METHOD']) == 'OPTIONS'){
    exit;
}

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
// 定义配置文件目录和应用目录同级
define('CONF_PATH', __DIR__.'/../config/');
// 定义模块
//define('HSB_SYS', 'detect_clouds_sys');
// 加载框架引导文件 //require __DIR__ . '/../thinkphp/start.php';
require __DIR__ . '/../../../thinkphp/start.php'; // 引用 回收宝 thinkphp_core 文件