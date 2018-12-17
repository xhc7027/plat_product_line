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
use app\common\lib\Code;
use think\Request;
use app\common\exceptions\SystemException;
use app\common\exceptions\RequestException;

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
     * 获取用户信息
     *
     * @return mixed
     */
    public function getLoginUserInfo()
    {
        $params = $this->data['_param'];
        $this->checkLogin();
        $data = [
            'login_token' => $params['login_token'],
            'login_user_id' => $params['login_user_id'],
            'type' => $params['_param']['type'],
            'system_id' => '51'
        ];

        $result = curlByPost(config('params.login_user_info'), rpcParamsArr('loginuserinfo', $data));

        return rpcResult($result['body']['ret'], $result['body']['retinfo'], $result['body']['data']);
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
    public function bindCodeInfo()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('bindDetectBarCode')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $this->checkLogin();
        $result = $this->logic->bindCodeInfo($params);

        \ResponseHelper::apiSuccess('操作成功', $result);
    }

    /**
     * 获取App传来的条形码，并将条码和存储key进行绑定
     */
    public function bindXyDetectBarCode()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('bindDetectBarCode')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->bindXyDetectBarCode($params);
        if (isset($result['_data']['_ret']) && $result['_data']['_ret'] !== '0') {
            $error = json_decode($result['_data']['_errStr'], true);
            \ResponseHelper::apiFail(1, $error['error_str']);
        }
        if (isset($result['flag']) && $result['flag'] == 1) {
            \ResponseHelper::apiFail(1, $result['_data']);
        }

        \ResponseHelper::apiSuccess('操作成功', $result['_data']);
    }


    /**
     * 根据用户选项返回查询结果
     */
    public function getDetectInfo()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('getDetectInfo')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->getDetectInfo($params);

        \ResponseHelper::apiSuccess('操作成功', $result);
    }

    /**
     * 将APP检测结果推送到闲鱼检测
     */
    public function pullAppDetectToXyDetect()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('getQuotation')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $this->checkLogin();
        $result = $this->logic->pullAppDetectToXyDetect($params);
        if ($result['_data']['_ret'] !== '0') {
            \ResponseHelper::apiFail(10001, '推送到闲鱼检测系统失败，闲鱼返回错误信息：' . $result['_data']['_errStr'], $result);
        }
        \ResponseHelper::apiSuccess('推送到闲鱼检测系统成功', $result);
    }


    /**
     * 返回app需要的唯一key
     */
    public function getUniqueKey()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        try {
            $Jwt = new \JwtHelper();
            $time = $Jwt->decode($params['token']);
            //$aaa = json_decode($time->data,true);
            $time = $time->data->time;
            $aaa = strtotime(date("Y-m-d H:i:s", strtotime("-1months")));
            //var_dump($aaa);die;
            if ((int)$time <= (int)$aaa) {
                \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, '超过时间，请重新提交检测');
            }
        } catch (SystemException $e) {
            hsb_write_error('APP获取唯一验证Key错误' . $e->getMessage());
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $e->getMessage());
        }

        if (!$validate->scene('getUniqueKey')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->getUniqueKey(['time' => $time]);

        \ResponseHelper::apiSuccess('操作成功', $result);
    }

    /**
     * 获取检测数据
     */
    public function getDetectRecord()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('getDetectRecord')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->getDetectRecord($params);
        $url = config('params.xy_detect_api');
        $return = curlByPost($url, $result);
        \ResponseHelper::apiSuccess('操作成功', $return);
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
     * 根据用户选项返回查询结果
     */
    public function SelectDetectInfo()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('selectDetectInfo')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $this->checkLogin();
        $result = $this->logic->SelectDetectInfo($params);
        \ResponseHelper::apiSuccess('操作成功', $result);
    }

    /**
     * 数据导出接口
     */
    public function DetectDataExport()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('detectDataExport')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $this->checkLogin();
        $result = $this->logic->SelectDetectInfo($params);
        \ResponseHelper::apiSuccess('操作成功', $result);
    }

    /**
     * 分析闲鱼检测数据结果
     */
    public function analyseXyData()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('analyseXyData')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->analyseXyData($params);
        \ResponseHelper::apiSuccess('操作成功', $result);
    }


    /**
     * 上报检测信息
     */
    public function pushAppDetectResult()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('pushAppDetectResult')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->pushAppDetectResult($params);
        \ResponseHelper::apiSuccess('操作成功', $result);
    }


}
