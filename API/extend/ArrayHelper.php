<?php

class ArrayHelper
{

    /**
     * 过滤二维数组中子数组均为空的数组
     * @param $array
     * @return array
     */
    public static function removeArrayEmptyElement($array)
    {
        $arrayReindexed = [];
        array_walk(
            $array,
            function ($item, $key) use (&$arrayReindexed) {
                if (array_filter($item)) {
                    $arrayReindexed[] = $item;
                }
            }
        );
        return $arrayReindexed;
    }

    /**
     * 设置二维数组中的$element元素的值为子数组的键
     * @param $array
     * @param $element
     * @return array
     */
    public static function indexArrayByElement($array, $element)
    {
        $arrayReindexed = [];
        array_walk(
            $array,
            function ($item, $key) use (&$arrayReindexed, $element) {
                $arrayReindexed[$item[$element]] = $item;
            }
        );
        return $arrayReindexed;
    }

    /**
     * 对数组中的非空元素进行 Trim 操作
     * @param $arr
     * @param null $character_mask
     */
    public static function arrayTrim(&$arr, $character_mask = null) {
        array_walk_recursive($arr, function (&$item) use ($character_mask) {
            $item && $item = $character_mask ? trim($item, $character_mask) : trim($item);
        });
    }

    /**
     * 数组元素中的int 强制转换为string类型
     * @param $arr
     */
    public static function intToString(&$arr) {
        array_walk_recursive($arr, function (&$item) {
            if (is_numeric($item)) {
                $item = (string)$item;
            }
        });
    }

    /**
     * 设置二维数组的Key为子数组的某字段的值
     * @param array $arr 要设置Key的二维数组
     * @param string $key 设置的子数组的Key
     * @return array
     */
    public static function setKeyForm($arr, $key = 'id') {
        $newArr = array();
        foreach ($arr as $k => $v) {
            $newArr[$v[$key]] = $v;
        }
        return $newArr;
    }

    /**
     * 获取二维数组子数组下某下标的集合
     * 原生函数：array_column — 返回数组中指定的一列(PHP 5 >= 5.5.0, PHP 7)
     * @param array $arr 数组
     * @param string $key 下标
     * @param boolean $isKeepKey 是否保留键值
     * @param string $resultType 返回类型
     * @return array|string
     */
    public static function getKeys($arr, $key, $isKeepKey = false, $resultType = 'str/other') {
        $keyArr = array();

        if ($isKeepKey) {
            foreach ($arr as $k => $item) {
                $keyArr[$k] = $item[$key];
            }
        } else {
            foreach ($arr as $item) {
                array_push($keyArr, $item[$key]);
            }
        }
        if ($resultType == 'str') {
            return implode(',', $keyArr);
        }
        return $keyArr;
    }

    /**
     * 获取二维数组子数组两个字段生成一个键值对的集合
     * @param $arr 数组
     * @param $key 生成键的下标,二维数组子数组中的某字段,注意重复数据被替换
     * @param $val 生成值的下标,二维数组子数组中的某字段
     * @return array
     */
    public static function getKeyValArray($arr, $key, $val) {
        $newArr = array();
        foreach ($arr as $k => $v) {
            $newArr[$v[$key]] = $v[$val];
        }
        return $newArr;
    }

    /**
     * 数组过滤
     * @param array $array 需要过滤的数组
     * @param string $notFilterKeys 需要保留的子元素对应的key值
     * @return array
     */
    public static function filter($array = array(), $notFilterKeys = '') {
        $data = array();
        if (!is_array($notFilterKeys)) {
            $notFilterKeys = explode(',', $notFilterKeys);
        }
        foreach ($notFilterKeys AS $val) {
            if (array_key_exists($val, $array)) {
                $data[$val] = $array[$val];
            }
        }
        return $data;
    }

    /**
     * 移除数组中的null值
     * @param array $data
     * @return array
     */
    public static function removeNull($data = array()) {
        foreach ($data as $key => $val) {
            if (is_array($val)) {
                $data[$key] = self::removeNull($val);
            } else if (is_null($val)) {
                unset($data[$key]);
            }
        }
        return $data;
    }

    /**
     * 重设数组中的null值
     * @param array $arr
     * @param string $resetValue
     * @return array
     */
    public static function resetNull($arr, $resetValue = '') {
        foreach ($arr as $key => $item) {
            if (is_array($item)) {
                $arr[$key] = self::resetNull($item, $resetValue);
            } else if ($item === null) {
                $arr[$key] = $resetValue;
            }
        }
        return $arr;
    }

    /**
     * 移除一维数组中的子元素
     * @param array $arr
     * @param string|array $keys 要移除的键
     * @return array
     */
    public static function unsetKeys($arr, $keys) {
        if (!is_array($keys)) {
            $keys = explode(',', $keys);
        }
        foreach ($keys AS $val) {
            if (isset($arr[$val])) {
                unset($arr[$val]);
            }
        }
        return $arr;
    }

    /**
     * 移除二维数组中的元素
     * @param array $arr
     * @param string|array $keys 要移除的键
     * @return array
     */
    public static function unsetSubKeys($arr, $keys) {
        foreach ($arr as $key => $subArr) {
            $arr[$key] = self::unsetKeys($subArr, $keys);
        }
        return $arr;
    }

    /**
     * 二维数组根据子数组键值查找子数组
     * @param array $arr
     * @param string $subKey 子数组键名
     * @param mixed $keyVal 子数组键值
     * @return array
     */
    public static function search($arr, $subKey, $keyVal) {
        foreach ($arr as $item) {
            if ($item[$subKey] == $keyVal) {
                return $item;
            }
        }
        return array();
    }

    /**
     * 判断数组是否包含某些键
     * @param string|array $keys
     * @param array $array
     * @return bool
     */
    public static function keysExist($keys, $array) {
        $keys = is_array($keys) ? $keys : explode(',', $keys);
        foreach ($keys as $key) {
            if (!array_key_exists($key, $array)) {
                return false;
            }
        }
        return true;
    }

    /**
     * 将二维数组的子数组两个字段的对应数据转换为键值数组形式
     * @param $arr
     * @return array
     */
    public static function map($arr) {
        $newArr = array();
        foreach ($arr as $k => $v) {
            $newArr[current($v)] = next($v);
        }
        return $newArr;
    }

    /**
     * 将二维数组的子数组根据特定层级关系下标转换为树状数组结构
     * @param array $arr    需要生成树状数组的二维数组
     * @param int $pid  父级 ID ,默认从 0 开始
     * @param string $pidKey    父级 ID 对应的下标
     * @param string $key 主键 ID 对应的下标
     * @param string $subKey 生成子数组的下标
     * @return array
     */
    public static function makeTree($arr, $pid = 0, $pidKey='pid', $key='value', $subKey='children') {
        $newArr = [];
        foreach ($arr as $val) {
            if ($val[$pidKey] == $pid)
            $newArr[] = $val;
        }
        if (!empty($newArr)) {
            foreach ($newArr as &$val) {
                $val[$subKey] = self::makeTree ($arr, $val[$key], $pidKey, $key, $subKey); // 此处更改 $pid 的值
            }
        }
        return $newArr;
    }

}