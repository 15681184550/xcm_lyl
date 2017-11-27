<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    /**
     * 首页
     */
    public function index()
    {

        $mId = $_COOKIE['memberId'];
        if($mId){
            $m = M('user')->where('id='.$mId)->find();

            $this->assign('m', $m);
        }

        $data = M('users')->select();
        dump($data);die;
        $this->assign('data', $data);
        $this->display('Mui/index');
    }


}