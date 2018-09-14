<?php
/* // 开发环境配置 */
return [
    "database" => [
        // 数据库类型
        'type'            => 'mysql',
        // 服务器地址
        'hostname'        => isset($_SERVER['SALES_DETECT_DB_HOST_MASTER']) ? $_SERVER['SALES_DETECT_DB_HOST_MASTER'] : '119.29.141.207',//'10.135.172.211', // 优先获取 NGINX 配置
        // 数据库名
        'database'        => isset($_SERVER['SALES_DETECT_DB_NAME'])  ? $_SERVER['SALES_DETECT_DB_NAME']  : 'product_line',
        // 用户名
        'username'        => isset($_SERVER['SALES_DETECT_DB_USER']) ? $_SERVER['SALES_DETECT_DB_USER'] : 'hjx', // 优先获取 NGINX 配置
        // 密码
        'password'        => isset($_SERVER['SALES_DETECT_DB_PWD'])  ? $_SERVER['SALES_DETECT_DB_PWD']  : '123456',
        // 端口
        'hostport'        => '3306',
    ],

    //redis
    'redis' => [
        'host'          => isset($_SERVER['REDIS_HOST']) ? $_SERVER['REDIS_HOST'] : '119.29.141.207',
        'port'          => 6379,
        'password'      => isset($_SERVER['REDIS_PWD']) ? $_SERVER['REDIS_PWD'] : 'hsb_redis_123',
        'timeout'       => 0,
    ],

];