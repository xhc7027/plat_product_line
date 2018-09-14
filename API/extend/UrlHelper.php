<?php

class URLHelper
{

    /**
     * 重置某个GET请求参数值，并返回重置后的URL
     * @param $requestKey
     * @param $requestVal
     * @return string
     */
    public static function resetRequestValue($requestKey, $requestVal) {
        $get = array();
        foreach (explode('&', $_SERVER['QUERY_STRING']) as $item) {
            if (strstr($item, $requestKey)) {
                $item = "$requestKey=$requestKey";
            }
            $get[] = $item;
        }
        return URL . '?' . implode('&', $get);
    }

    /**
     * 移除某个GET请求参数值，并返回移除后的URL
     * @param $requestKey
     * @return string
     */
    public static function unsetRequestParam($requestKey) {
        $get = array();
        foreach (explode('&', $_SERVER['QUERY_STRING']) as $item) {
            if (strstr($item, $requestKey)) {
                $item = "$requestKey=$requestKey";
            }
            $get[] = $item;
        }
        return URL . '?' . implode('&', $get);
    }
}