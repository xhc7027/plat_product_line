<?php
namespace app\common\exceptions;


/**
 * 请求异常类
 *
 * Class RequestException
 * @package App\Exceptions
 */
class RequestException extends SystemException
{
    public function getName()
    {
        return 'RequestException';
    }

}