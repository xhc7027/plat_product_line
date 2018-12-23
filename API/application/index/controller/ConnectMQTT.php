<?php

namespace app\index\controller;

use app\common\controller\BaseController;
use app\common\lib\ErrorCode;
use app\common\lib\Code;
use think\Request;
use app\common\exceptions\SystemException;
use app\common\exceptions\RequestException;

/**
 * APP获取连接MQTT控制器类
 *
 * Class ConnectMQTT
 * @package app\index\controller
 */
class ConnectMQTT extends BaseController
{
    private $logic = null;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->logic = new \app\index\logic\ConnectMQTT();
    }


    /**
     * 获取列表信息
     * @return array|mixed
     */
    public function registerDevice()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\ConnectMQTT();
        if (!$validate->scene('getDetectTimeDetails')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->registerDevice($params);

        \ResponseHelper::apiSuccess('操作成功', $result);
    }
}