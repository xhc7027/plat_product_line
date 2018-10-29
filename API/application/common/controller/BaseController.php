<?php

namespace app\common\controller;

use think\Request;
use think\Controller;
use think\exception\HttpException;
use app\common\lib\Code;
use app\common\lib\ErrorCode;

class BaseController extends CommonController
{

    public function _initialize(Request $request = null)
    {
        parent::_initialize($request);

        // 通过OPTION请求
        if($this->request->isOptions()) {
            $header = ['Access-Control-Allow-Headers' => 'x-requested-with,content-type', 'Access-Control-Allow-Origin' => '*'];
            $response = \think\Response::create('', 'json', 200, $header);
            throw new \think\exception\HttpResponseException($response);
        }

        //验证公共参数
        if (true !== ($validate = $this->validate($this->data, 'PublicParams'))) {
            //throw new HttpException(404, $validate);
            abort(404, $validate);
        }

//        // 设置默认返回格式
//        Config::set('default_return_type', 'json');
//        if (true !== ($validate = $this->validate($this->data, 'PublicParams'))) {
//            \ResponseHelper::apiFail(ErrorCode::PARAM_ERROR, $validate);
//        }

        //$this->checkLogin();
    }


    /**
     * 验证登录token
     */
    protected function checkLogin()
    {
        $params = $this->data['_param'];
        $data = [
            'login_token'     => $params['login_token'],
            'login_user_id'   => $params['login_user_id'],
            'login_system_id' => '51',
        ];
        $params = rpcParamsArr('checklogin', $data);

        $result = curlByPost(config('params.check_login'), $params);
        if (0 != $result['body']['ret']) {
            throw new HttpException(Code::LOGIN_ERROR, $result['body']['retinfo']);
        }
    }


}
