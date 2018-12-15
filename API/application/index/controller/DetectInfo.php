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
}