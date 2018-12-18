<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5
 * Time: 10:25
 */

namespace app\index\controller;

use app\common\controller\BaseController;
use app\common\lib\ErrorCode;
use app\common\lib\Code;
use think\Request;
use app\common\exceptions\SystemException;
use app\common\exceptions\RequestException;

class DetectInfo extends BaseController
{
    private $logic = null;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->logic = new \app\index\logic\DetectInfo();
    }


    /**
     * 获取检测时效列表
     */
    public function getDetectTimeData()
    {
        $params = $this->data['_param'];

        /*$validate = new \app\index\validate\DetectInfo();
        if (!$validate->scene('getDetectTimeData')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }*/
        $this->checkLogin();
        $result = $this->logic->getDetectTimeData($params);

        $result = (array)$result;
        \ResponseHelper::apiSuccess('操作成功', $result);
    }

    /**
     * 数据导出
     */
    public function exportDetectTimeData()
    {
        $params = $this->request->get();
//        $params = $this->data['_param'];
//
//        $validate = new \app\index\validate\DetectInfo();
//        if (!$validate->scene('exportDetectTimeData')->check($params)) {
//            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
//        }
        $result = $this->logic->exportDetectTimeData($params);

        return $result;
    }


    public function getDetectTimeDetails()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\DetectInfo();
        if (!$validate->scene('getDetectTimeDetails')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->getDetectTimeDetails($params);

        \ResponseHelper::apiSuccess('操作成功', $result);
    }


    /**
     * 验证登录token
     */
    protected function checkLogin()
    {
        $params = $this->data['_param'];
        if (!isset($params['login_token']) || !isset($params['login_user_id'])) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, '所传数据没有token和user_id');
        }
        $data = [
            'login_token' => $params['login_token'],
            'login_user_id' => $params['login_user_id'],
            'login_system_id' => '51',
        ];
        $params = rpcParamsArr('checklogin', $data);

        $result = curlByPost(config('params.check_login'), $params);
        if (0 != $result['body']['ret']) {
            \ResponseHelper::apiFail(Code::LOGIN_ERROR, $result['body']['retinfo']);
        }
    }


    /**
     * 获取工程师检测平均时效
     */
    public function getEngineerDetectTime()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\DetectInfo();
        if (!$validate->scene('getEngineerDetectTime')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->getEngineerDetectTime($params);

        \ResponseHelper::apiSuccess('操作成功', $result);
    }
}