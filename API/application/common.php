<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

if(!function_exists('ltrim4')){
    function ltrim4(&$val, $key, $trim='') {
        $val = ltrim($val, $trim);
    }
}

function curlByPost($url, $post_data = '', $cookie = '', $is_json = true, $header = [])
{
    $curl = curl_init();
    $this_header = array(
        "content-type: application/json; charset=UTF-8"
    );
    if ($header) {
        $this_header = array_merge($this_header, $header);
    }
    curl_setopt($curl, CURLOPT_HTTPHEADER, $this_header);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 当为https请求时,是否需要验证CAI证书（ 0:不验证CAI证书,1:需要验证（要验证的交换证书可以在 CURLOPT_CAINFO 选项中设置，或在 CURLOPT_CAPATH中设置证书目录。））
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // 从证书中检查SSL加密算法是否存在
    //CURLOPT_SSL_VERIFYHOST的值设为1时会报以下警告，但返回数据还是正常
    //Notice: curl_setopt() [function.curl-setopt]: CURLOPT_SSL_VERIFYHOST no longer accepts the value 1, value 2 will be used instead(不再接受值1,值2将使用)
    /*
        CURLOPT_SSL_VERIFYHOST的值
        设为0表示不检查证书
        设为1表示检查证书中是否有CN(common name)字段
        设为2表示在1的基础上校验当前的域名是否与CN匹配
        而libcurl早期版本中这个变量是boolean值，为true时作用同目前设置为2，后来出于调试需求，增加了仅校验是否有CN字段的选项，因此两个值true/false就不够用了，升级为0/1/2三个值。
        再后来(libcurl_7.28.1之后的版本)，这个调试选项由于经常被开发者用错，被去掉了，因此目前也不支持1了，只有0/2两种取值。
    */
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);//TRUE 时将根据 Location: 重定向时，自动设置 header 中的Referer:信息。
    if (!empty($post_data)) {
        curl_setopt($curl, CURLOPT_POST, 1);//发送一个常规的Post请求
        if (is_array($post_data) && $is_json) {
            $json_data = json_encode($post_data);
        } else {
            $json_data = $post_data;
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);//传递一个作为HTTP“POST”操作的所有数据的字符串。
    }

    if ($cookie) {
        curl_setopt($curl, CURLOPT_COOKIE, $cookie);//传递一个包含HTTP cookie的头连接。
    }
    curl_setopt($curl, CURLOPT_HEADER, 0);//是否返回或输出请求头信息(0:不返回头部信息，1:返回)
    curl_setopt($curl, CURLOPT_TIMEOUT, 0);// 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//TRUE/1:获取的信息以文件流的形式返回,而不是直接输出;FALSE/0：内容直接输出到页面。
    $result_data = curl_exec($curl);
    if (curl_errno($curl)) {
//            return curl_error($curl);//捕抓异常
        return array('body' => array('retinfo' => curl_error($curl)));//捕抓异常
    }
    curl_close($curl);

    return json_decode($result_data, true);
}

