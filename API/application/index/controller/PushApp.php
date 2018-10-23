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
        $this -> checkLogin();
        $data = [
            'login_token'     => $params['login_token'],
            'login_user_id'   => $params['login_user_id'],
            'type'            => $params['_param']['type'],
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
    public function bindDetectBarCode()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('bindDetectBarCode')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $this -> checkLogin();
        $result = $this->logic->bindDetectBarCode($params);

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
        $this -> checkLogin();
        $result = $this->logic->bindXyDetectBarCode($params);

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
        $this -> checkLogin();
        $result = $this->logic->getQuotation($params);
        \ResponseHelper::apiSuccess('操作成功', $result);
    }


    /**
     * 根据用户选项返回查询结果
     */
    public function pullAppDetectToXyDetect()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        if (!$validate->scene('getQuotation')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $this -> checkLogin();
        $result = $this->logic->pullAppDetectToXyDetect($params);
        $url = config('params.xy_detect_api');
        $return = curlByPost($url.'api/addDetRecord',$result);
        if($return['_data']['_ret'] != 0){
            \ResponseHelper::apiFail('推送到闲鱼检测系统失败，请联系管理员', json_encode($return));
        }
        \ResponseHelper::apiSuccess('推送到闲鱼检测系统成功', $return);
    }

    /**
     * 返回app需要的唯一key
     */
    public function getUniqueKey()
    {
        $params = $this->data['_param'];

        $validate = new \app\index\validate\PushApp();
        try {
            $time = \JwtHelper::decode($params['token']);
            if ($time <= date('Y-m-d H:i:s','-1 day')) {
                \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, '超过时间，请重新提交检测');
            }
        } catch (SystemException $e) {
            hsb_write_error('APP获取唯一验证Key错误' . $e->getMessage());
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $e->getMessage());
        }

        if (!$validate->scene('getUniqueKey')->check($params)) {
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate->getError());
        }
        $result = $this->logic->getUniqueKey($params);

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
        $url = config('params.xy_detect_api');
        $return = curlByPost($url,$result);
        \ResponseHelper::apiSuccess('操作成功', $return);
    }

    /**
     * 验证登录token
     */
    protected function checkLogin()
    {
        $params = $this->data['_param'];
        if(!isset($params['login_token']) || !isset($params['login_user_id'])){
            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, '所传数据没有token和user_id');
        }
        $data = [
            'login_token'     => $params['login_token'],
            'login_user_id'   => $params['login_user_id'],
            'login_system_id' => '51',
        ];
        $params = rpcParamsArr('checklogin', $data);

        $result = curlByPost(config('params.check_login'), $params);
        if (0 != $result['body']['ret']) {
            \ResponseHelper::apiFail(Code::LOGIN_ERROR, $result['body']['retinfo']);
        }
    }

}