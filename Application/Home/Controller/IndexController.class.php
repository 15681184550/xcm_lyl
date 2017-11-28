<?php
namespace Home\Controller;
use Think\Controller;
use Home\Lib\SendNote;
class IndexController extends Controller {
    /**
     * 首页
     */
    public function index()
    {
        $this->display('index/index');
    }

    /**
     * 发送短信测试
     */
    public function sendMsg(){
        $send = new SendNote();
//        $send -> sendVerify(15681184550,333);                                         //短信验证码
//        $send -> sendShipment(15681184550,'徐昌茂','高级大苹果','12345677654321');    //短信通知
        die;
    }

}