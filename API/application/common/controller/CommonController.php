<?php

namespace app\common\controller;

use think\Request;
use think\Controller;
use think\exception\HttpException;
//use app\common\lib\ErrorCode;

class CommonController extends Controller
{
    protected $input;
    protected $data;

    public function _initialize(Request $request = null)
    {
        parent::_initialize();

        // 通过OPTION请求
        if($this->request->isOptions()) {
            $header = ['Access-Control-Allow-Headers' => 'x-requested-with,content-type', 'Access-Control-Allow-Origin' => '*'];
            $response = \think\Response::create('', 'json', 200, $header);
            throw new \think\exception\HttpResponseException($response);
        }

        // 接口公共参数检查
        $this->input = $this->request->getInput();
        $this->data = json_decode($this->input, true);

    }

}