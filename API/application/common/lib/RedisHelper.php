<?php
/**
 * Created by PhpStorm.
 * User: Jacky
 * Date: 2017/10/10
 * Time: 14:41
 */
namespace app\common\lib;

use think\cache\driver\Redis;

class RedisHelper extends Redis
{
    public function __construct(array $options = [])
    {
        parent::__construct($options);
    }

    /**
     * 98      * 获取值长度
     * 99      * @param string $key
     * 100      * @return int
     * 101      */
    public function lLen($key)
    {
        $handle = $this->handler();
        return $handle->lLen($key);
    }

    public function LPush($key, $value)
    {
        $handle = $this->handler();
        return $handle->lPush($key, $value);
    }

    public function LPop($key)
    {
        $handle = $this->handler();
        return $handle->lPop($key);
    }

    /**
     * 写入缓存，如果存在就写入不存在写入失败
     * @access public
     * @param string    $name 缓存变量名
     * @param mixed     $value  存储数据
     * @param integer   $expire  有效时间（秒）
     * @return boolean
     */
    public function setnx($name, $value, $expire = null)
    {
        if (is_null($expire)) {
            $expire = $this->options['expire'];
        }
        $key = $this->getCacheKey($name);
        //对数组/对象数据进行缓存处理，保证数据完整性  byron sampson<xiaobo.sun@qq.com>
        $value = (is_object($value) || is_array($value)) ? json_encode($value) : $value;
        $result = $this->handler->set($key, $value,['nx', 'ex' => $expire]);
        return $result;
    }
}