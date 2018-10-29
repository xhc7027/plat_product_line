<?php

class LogHelper
{
    // Log 默认配置
    public static $config = [
        // 时间戳格式
        'time_format' => 'Y-m-d H:i:s',
        // 日志记录方式，内置 file socket 支持扩展
        'type' => 'File',
        // 日志保存目录
        'path' => ''
    ];

    /**
     * 记录日志
     * @param array $data
     * @param array $config
     */
    public static function record($data, $config=[]) {
        !$config && $config = array_merge(self::$config, ['path' => RUNTIME_PATH . 'log' . DS]);
        $log = new \think\log\driver\File($config);
        $log->save(['request' => [json_encode(input())]]);
        $log->save(['requestTime' => [date('Y-m-d H:i:s')]]);
        $log->save(['response' => [json_encode($data, JSON_UNESCAPED_UNICODE)]]);
    }

    /**
     * requestRecord
     * 成功日志
     * @param array $result
     */
    public static function requestRecord($result) {
        $config = array_merge(self::$config, ['path' => RUNTIME_PATH . 'request' . DS]);
        self::record($result, $config);
    }

    /**
     * errorRecord
     * 错误日志
     * @param array $result
     */
    public static function errorRecord($result) {
        $config = array_merge(self::$config, ['path' => RUNTIME_PATH . 'error' . DS]);
        self::record($result, $config);
    }

    /**
     * 调试日志
     * @param array $result
     */
    public static function debug($result) {
        $config = array_merge(self::$config, ['path' => RUNTIME_PATH . 'debug' . DS]);
        self::record($result, $config);
    }

}