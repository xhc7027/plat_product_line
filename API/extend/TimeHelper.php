<?php

class TimeHelper
{

    /**
     * 获取当前时间
     * @param string $dateFormat
     * @return false|string
     */
    public static function now($dateFormat = 'Y-m-d H:i:s') {
        return date($dateFormat, time());
    }


    /**
     * 获取当前日期
     * @param string $dateFormat
     * @return false|string
     */
    public static function today($dateFormat = 'Y-m-d') {
        return date($dateFormat, time());
    }

    /**
     * 获取指定日期
     * @param string $timeStr
     * @param string $dateFormat
     * @return false|string
     */
    public static function getDate($timeStr = '', $dateFormat = 'Y-m-d') {
        return date($dateFormat, $timeStr ? strtotime($timeStr) : time());
    }

    /**
     * 获取指定时间
     * @param string $timeStr
     * @param string $dateFormat
     * @return false|string
     */
    public static function getDateTime($timeStr = '', $dateFormat = 'Y-m-d H:i:s') {
        return date($dateFormat, $timeStr ? strtotime($timeStr) : time());
    }
}