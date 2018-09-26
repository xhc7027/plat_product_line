<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/1
 * Time: 15:32
 */

namespace app\index\controller;


use app\common\controller\BaseController;
use app\common\lib\ErrorCode;
use think\Request;

class PushApp extends BaseController
{
    private $logic = null;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->logic = new \app\index\logic\PushApp();
    }

    /**
     * 将App传入的IMEI码进行保存
     *
     */
    public function test()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('saveIMEI')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->test($params);

        \ResponseHelper::apiSuccess('操作成功', $result);
    }

    /**
     * 将App传入的IMEI码进行保存
     *
     */
    public function saveIMEI()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('saveIMEI')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->saveIMEI($params);

        \ResponseHelper::apiSuccess('操作成功', $result);
    }

    /**
     * 将App检测结果收录，并返回一个唯一存储key
     *
     */
    public function saveAppDetectResult()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('saveAppDetectResult')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->saveAppDetectResult($params);

        \ResponseHelper::apiSuccess('操作成功', $result);
    }


    /**
     * 获取App传来的条形码，并将条码和存储key进行绑定
     */
    public function bindDetectBarCode()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('bindDetectBarCode')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->bindDetectBarCode($params);

        \ResponseHelper::apiSuccess('操作成功', $result);
    }


    /**
     * 根据用户选项返回查询结果
     */
    public function getQuotation()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('getQuotation')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->getQuotation($params);

        \ResponseHelper::apiSuccess('操作成功', $result);
    }

    /**
     *
     */
    public function getDetectRecord()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('getDetectRecord')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->getDetectRecord($params);

        \ResponseHelper::apiSuccess('操作成功', $result);
    }

}