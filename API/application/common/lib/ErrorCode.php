<?php
/**
 * 接口统一错误码类
 *
 * Class Code
 * @package app\common\lib
 * @author Yu
 */

namespace app\common\lib;

class ErrorCode
{
    /*操作成功*/
    const SUCCESS = '0';

    /*参数有误*/
    const PARAM_ERROR = '1010';

    /*系统错误*/
    const SYSTEM_ERROR	=  '1020';

    /*重复添加*/
    const ADD_REPEAT_ERROR = '1021';

    /*未找到相关记录*/
    const ITEM_NOT_EXISTS = '1022';

    /*框架内部抛错*/
    const HTTP_REQUEST_ERROR = '2010';

    /*请求cgi失败*/
    const CGI_REQUEST_ERROR = '3010';

    /*DB操作错误*/
    const DB_ADD_FAIL = '4010'; //DB添加操作失败

    const DB_EDIT_FAIL = '4020'; //DB更新操作失败

    const DB_QUERY_FAIL	= '4030'; //DB查询操作失败

    const DB_DELETE_FAIL = '4040'; //DB删除操作失败


    /*
     * 是否存在错误信息
     * @param string $msg
     */
    public static function isExistsMsg($msg){
        $msg = trim($msg);
        $x   = new ReflectionClass("Code");
        $result = $x->getConstants();
        $constantsList = is_array($result) ? $result : array();
        return in_array($msg, $constantsList);
    }
}