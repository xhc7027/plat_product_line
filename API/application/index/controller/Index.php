<?php
namespace app\index\controller;

use think\Controller;
use think\exception\HttpException;
use think\exception\HttpResponseException;

class Index extends Controller
{

    public function index()
    {

        $this->redirect('http://product-line.huishoubao.com.cn/index.html#/');

    }

}
