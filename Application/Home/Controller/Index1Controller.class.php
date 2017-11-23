<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    /**
     * 首页
     */
    public function aaa(){
        $return['status'] = 0;
        $return['msg']    = '成功';
        exit(json_encode($return,JSON_UNESCAPED_UNICODE));
    }

    public function index()
    {
        $data = M('jiu')->select();
        $this->assign('data', $data);
        $this->display('Index/SJ/index');
//        $this->display('Mui/index');
    }

    /**
     * 验证是否有管理员资格
     */
    public function admin(){
        if($_POST['token']==555){
            $return['status'] = 1;
        }else{
            $return['status'] = 0;
        }
        exit(json_encode($return));
    }

    public function jiuList(){
        $data = M('jiu')->select();
        if($data){
            for($i=0; $i<count($data); ++$i){
                $arr = explode(',',$data[$i]['cover']);
                $data[$i]['cover'] = $arr[0];
            }
        }
//        dump($data);die;
        $this->assign('data', $data);
        $this->display('Index/SJ/jiuList');
    }
    /**
     * 九宫格管理
     */
    public function jiu(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $data = M('jiu')->find($id);
            $data['cover'] = explode(',',$data['cover']);
            $this->assign('data', $data);
        }
        $this->display('Index/SJ/jiu');
    }

    /**
     * 首页ifrome
     */
    public function contacts(){
        $data = M('friend')->select();
        for($i=0; $i<count($data); ++$i){
            if($data[$i]['cover']){
                $arr = explode(',',$data[$i]['cover']);
                $data[$i]['cover'] = $arr[0];
            }
        }
//        dump($data);die;
        $this->assign('data', $data);
        $this->display('contacts');
    }

    /**
     * 编辑朋友信息
     */
    public function eidtFriend(){
        $id   = $_GET['id'];
        $data = M('friend')->find($id);
        if($data){
            if($data['cover']){
                $data['cover'] = explode(',',$data['cover']);
            }
        }
//        dump($data);die;
        $this->assign('data', $data);
        $this->display('eidtFriend');
    }

    /**
     * 圖片上傳  并创建缩略图
     */
    public function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 5242880;             //上传文件最大大小
        $upload->allowExts = array('jpg','jpeg','gif','png');//允许上传文件类型
        $upload->rootPath = "./Application/Home/Public/";  //文件保存根目录，可以自定义
        $upload->savePath = "Uploads/";                //文件保存目录
        $upload->replace = 'true';                      //可以替换相同名称的文件
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        for ( $i = 0; $i < 8; $i++ )
        {
            $password .= $str[ mt_rand(0, strlen($str) - 1) ];
        }
        $upload->saveName = $password.'image';
        $file = $upload->upload()['file'];
        if(!$file){
            $this->ajaxReturn($upload->getError());
        }else {
            $img = "./Application/Home/Public/".$file['savepath'].$file['savename'];//获取文件上传目录
            $image = new \Think\Image();
            $image->open($img);    //打开上传图片
            $image->thumb(500, 500, \Think\Image::IMAGE_THUMB_SCALE)->save($img);//生成缩略图
            $this->ajaxReturn($file);
        }
    }

    /**
     * @param $url  文件路径
     */
    public function delFile(){
        $url = $_POST['url'];
        $url = '.'.$url;
        if( file_exists($url) && is_file( $url ) ){
            if(unlink ($url)){
                $return['status'] = 1;
            }else{
                $return['status'] = 0;
            }
        }
        exit(json_encode($return));
    }

    /**
     * 操作九宫格数据
     */
    public function jiuData(){
        $data = $_POST;
        $data['update_time'] = date('Y-m-d h:s:i',time());
//        dump($data);die;
        if(isset($data['dataId'])){
            $rst = M('jiu')->where('id='.$data['dataId'])->save($data);
        }else{
            $data['create_time'] = date('Y-m-d h:s:i',time());
            $rst = M('jiu')->add($data);
        }
        if($rst>0){
            $return['status'] = 1;
        }else{
            $return['status'] = 0;
        }
        exit(json_encode($return));
    }

    /**
     * 删除一条九宫格数据
     */
    public function delJiuList(){
        $id    = $_POST['id'];
        $data  = M('jiu')->find($id);
        $cover = explode(',',$data['cover']);
        if($cover){
            for($i=0; $i<count($cover); ++$i){
                unlink ($cover[$i]);
            }
        }
        $rst  = M('jiu')->where('id='.$id)->delete();
        if($rst > 0){
            $return['status'] = 1;
        }else{
            $rturn['status'] = 0;
        }
        exit(json_encode($return));
    }

    /**
     * 提交保存朋友信息
     */
    public function saveInfo(){
        $data = $_POST;
        $data['update_time'] = date('Y-m-d h:s:i',time());
        if(isset($data['id']) && $data['id']){

        }else{
            $data['create_time'] = date('Y-m-d h:s:i',time());
        }
        $rst = M('friend')->add($data);
        if($rst > 0){
            $return['status'] = 1;
        }else{
            $return['status'] = 0;
        }
        exit(json_encode($return));
    }

    /**
     * 具体知识点列表
     */
    public function knowledge(){
        $study = $_GET['study'];
        $data  = M('knowledge')->where('study="'.$study.'"')->select();
        $this->assign('data', $data);
        $this->assign('study', $study);
//        dump($data);die;
        $this->display('Index/SJ/study');
    }

    /**
     * 增加知识点数据
     */
    public function knowledgeAdd(){
        if($_POST){
            $memberId = cookie('memberId');
            if($memberId){
                $arr = $_POST;
                $arr['create_time'] = date('Y-m-d h:s:i',time());
                $arr['update_time'] = date('Y-m-d h:s:i',time());
                $arr['send_member_id']= $memberId;
                $name = M('user')->field('name')->where('id='.$memberId)->find(); //获取发布者者名称
                $arr['send_member_name'] = $name['name'];
                $rst = M('knowledge')->add($arr);
                if($rst > 0){
                    $return['status'] = 1;
                }else{
                    $return['status'] = 0;
                }
            }else{
                $return['status'] = 0;
                $return['msg']    = '系统错误';
            }
            exit(json_encode($return));
        }else{
            $study = $_GET['study'];
            $this->assign('study', $study);
            $this->display('Index/SJ/studyAdd');
        }
    }

    /**
     * 查看知识点
     */
    public function knowledgeShow(){
        $id   = $_GET['id'];
        $memId= cookie('memberId');
        $data = M('knowledge')->find($id);
        if($data['zan_member_name']){
            $zn = explode('##',$data['zan_member_name']);
            $zi = explode('##',$data['zan_member_id']);
            if(in_array($memId,$zi)){
                $this->assign('isZan', 1);
            }
            for($i=0; $i<count($zn); ++$i){
                for($j=0; $j<count($zi); ++$j){
                    if($i==$j){
                        $data['mem'][$i]['id']   = $zi[$j];
                        $data['mem'][$i]['name'] = $zn[$j];
                    }
                }
            }
        }
//        dump($data);die;
        $count= $data['look_count']+1;
        $save = array('look_count'=>$count);
        $data['look_count'] = $count;
        M('knowledge')->where('id='.$id)->save($save);
        $comment = M('sayknowledge')->where('knowledge_id='.$data['id'])->order('id desc')->select();
        if($comment){
            $this->assign('comment', $comment);
        }
//        dump($comment);die;
        if($memId){
            $name = M('user')->field('re_name,id')->where('id='.$memId)->find(); //获取评论者名称
            $this->assign('memberName', $name['re_name']);
            $this->assign('memberId', $name['id']);
        }
        $this->assign('data', $data);
        $this->assign('id', $id);
        $this->display('Index/SJ/knowledgeShow');
    }

    /**
     * 跳转个人中心
     */
    public function person(){
        $this->display('Index/SJ/person');
    }

    /**
     * 执行注册
     */
    public function ZC(){
        $data = $_POST;
        $data['create_time'] = date('Y-m-d h:s:i',time());
        $data['update_time'] = date('Y-m-d h:s:i',time());
        $data['pass']         = md5($data['pass']);
        $count = M('user')->where('phone='.$data['phone'])->find();
        if($count){
            $return['msg']    = '手机号码已经存在';
            $return['status'] = 0;
        }else{
            $rst = M('user')->add($data);
            if($rst>0){
                setCookie('memberId',$rst,time()+24 * 60 * 60 * 1000);
                $return['id']     = $rst;
                $return['status'] = 1;
            }else{
                $return['msg']    = '注册失败';
                $return['status'] = 0;
            }
        }
        exit(json_encode($return,JSON_UNESCAPED_UNICODE));
    }

    /**
     * 验证登录
     */
    public function login(){
        $name = $_POST['name'];
        $pass = md5($_POST['pass']);
        $rst  = M('user')->where('name="'.$name.'" and pass="'.$pass.'"')->find();
        if($rst > 0){
            $return['status'] = 1;
            $return['img']    = $rst['img'];
            setCookie('memberId',$rst['id'],time()+24 * 60 * 60 * 1000);
        }else{
            $return['status'] = 0;
            $return['msg']    = '用户名或密码错误';
        }
        exit(json_encode($return,JSON_UNESCAPED_UNICODE));
    }

    /**
     * 添加评论消息
     */
    public function addSay(){
        $memId = cookie('memberId');
        $data  = $_POST;
        if($memId != $data['say_member_id']){
            $return['status'] = 0;
            $return['msg']    = '系统错误';
        }else{
            $data['create_time'] = date('Y-m-d h:s:i',time());
            $name = M('user')->field('re_name')->where('id='.$data['say_member_id'])->find(); //获取评论者名称
            $data['say_member_name'] = $name['re_name'];
            $rst  = M('sayknowledge')->add($data);
            if($rst > 0){
                $return['status'] = 1;
                $return['sayMemberName'] = $data['say_member_name'];
                $return['sayInfo']        = $data['say_info'];
            }else{
                $return['status'] = 0;
                $return['msg']    = '评论失败，请联系(徐昌茂)';
            }
            exit(json_encode($return,JSON_UNESCAPED_UNICODE));
        }
    }

    /**
     * 修改知识点赞数据(增加)
     */
    public function saveZan(){
        $memberId = cookie('memberId');
        if($memberId){
            $id   = $_POST['id'];
            $name = M('user')->field('name')->where('id='.$memberId)->find(); //获取评论者名称
            $data['zan_member_name'] = $name['name'];
            $data['zan_member_id']   = $memberId;
            $rst  = M('knowledge')->where('id='.$id)->find();
            $ids  = explode('##',$rst['zan_member_id']);
            if(!in_array($data['zan_member_id'],$ids)){
                if($rst['zan_member_id'] && $rst['zan_member_name']){
                    $data['zan_member_id']   = $rst['zan_member_id'].'##'.$data['zan_member_id'];
                    $data['zan_member_name'] = $rst['zan_member_name'].'##'.$data['zan_member_name'];
                }
                M('knowledge')->where('id='.$id)->save($data);
            }
        }
    }

    /**
     * 修改知识点赞数据(减少)
     */
    public function jianZan(){
        $memberId = cookie('memberId');
        if($memberId){
            $id   = $_POST['id'];
            $rst  = M('knowledge')->where('id='.$id)->find();
            if($rst['zan_member_name']){
                $zn = explode('##',$rst['zan_member_name']);
                $zi = explode('##',$rst['zan_member_id']);
                for($i=0; $i<count($zi); ++$i){
                    for($j=0; $j<count($zn); ++$j){
                        if($zi[$i] == $memberId){
                            unset($zi[$i]);
                            if($i==$j){
                                unset($zn[$j]);
                            }
                        }
                    }
                }
                $data['zan_member_id']   = join('##',$zi);
                $data['zan_member_name'] = join('##',$zn);
                M('knowledge')->where('id='.$id)->save($data);
            }
        }
    }
}