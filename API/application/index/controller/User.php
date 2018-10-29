<?php
namespace app\admin\controller;

use \think\Controller;

class User extends Controller
{
    public function loginout()
    {
        $params = request()->post();

        $data = [
            'login_token'     => $params['_param']['login_token'],
            'login_user_id'   => $params['_param']['user_id'],
            'login_system_id' => '48',
        ];

        $result = curlByPost(config('params.logout'), rpcParamsArr('logout',$data));

        return rpcResult($result['body']['ret'],$result['body']['retinfo'],$result['body']['data']);
    }
}