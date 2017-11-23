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
        $data = M('jiu')->select();
        $this->assign('data', $data);
        $this->display('Mui/index');
    }

    /**
     * 具体知识点列表
     */
    public function knowledge(){
        $study = $_GET['study'];
        $data  = M('knowledge')->where('study="'.$study.'"')->select();
        if($data){
            $idss = '(';
            $mIds = '(';
            for($i=0; $i<count($data); ++$i){
                $idss .= $data[$i]['id'];
                if($i<count($data)-1){
                    $idss .= ',';
                }
                $data[$i]['zCount'] = 0;
                if($data[$i]['zan_member_id']){
                    $t = explode('##',$data[$i]['zan_member_id']);
                    $data[$i]['zCount'] = count($t);
                    if($_COOKIE['memberId']){
                        if(in_array($_COOKIE['memberId'],$t)){
                            $data[$i]['zan_token'] = 1;
                        }
                    }
                }
                if($data[$i]['zan_member_name']){
                    $data[$i]['zan_member_name'] = explode('##',$data[$i]['zan_member_name']);
                }
                if($data[$i]['zan_member_id']){
                    $data[$i]['zan_id'] = explode('##',$data[$i]['zan_member_id']);
                }
                if($data[$i]['zan_id']){
                    for($k=0; $k<count($data[$i]['zan_id']); ++$k){
                        for($m=0; $m<count($data[$i]['zan_member_name']); ++$m){
                            if($k == $m){
                                $data[$i]['zan'][$k]['zan_id']   = $data[$i]['zan_id'][$k];
                                $data[$i]['zan'][$k]['zan_name'] = $data[$i]['zan_member_name'][$m];
                                continue;
                            }
                        }
                    }
                }
                $mIds .= $data[$i]['send_member_id']?$data[$i]['send_member_id']:0;
                if($i < count($data)-1){
                    $mIds .= ',';
                }
            }
            $idss .= ')';
            $mIds .= ')';
            $sayD = M('sayknowledge')->where('knowledge_id in '.$idss)->select();
            $dataM = M('user')->field('id,img')->where('id in '.$mIds)->select();
            for($j=0; $j<count($data); ++$j){
                for($i=0; $i<count($dataM); ++$i){
                    if($data[$j]['send_member_id'] == $dataM[$i]['id']){
                        $data[$j]['cover'] = $dataM[$i]['img'];
                        continue;
                    }
                }
            }
            if($sayD){
                for($j=0; $j<count($data); ++$j){
                    $p = 0;
                    for($i=0; $i<count($sayD); ++$i){
                        if($data[$j]['id'] == $sayD[$i]['knowledge_id']){
                            $data[$j]['say'][$p]['sayName']  = $sayD[$i]['say_member_name'];
                            $data[$j]['say'][$p]['say_info'] = $sayD[$i]['say_info'];
                            $p = $p + 1;
                        }
                    }
                }
            }
        }
        $this->assign('data', $data);
        $this->assign('study', $study);
        $this->display('Mui/knowledge');
    }

    /**
     * 登录注册页面
     */
    public function login(){
        $this->display('Mui/login');
    }

    /**
     * 驾校知识异步数据获取
     */
    public function jiaApiAjax(){
        $page = $_POST['page']?$_POST['page']:1;
        $pageSize = 10;
//        $html = file_get_contents('http://api.jisuapi.com/driverexam/query?appkey=89cfa28649d2b48a&type=C1&subject=1&pagesize=100&pagenum='.$page.'&sort=normal');
//        exit($html);
        $where = '';
        $p = ($page-1)*$pageSize;
        $list = M('jia_api')->where($where)->limit($page,$pageSize)->select();
        $return['result']['list'] = $list;
        $return['result']['pagenum'] = $page;
        exit(json_encode($return,JSON_UNESCAPED_UNICODE));
    }

    /**
     * 驾校知识
     */
    public function jiaApi(){
        $this->display('Mui/jiaApi');
    }

    /**
     * 菜谱分类
     */
    public function caiPuTypeList(){
        $data = M('cai_type')->select();
        $this->assign('data', $data);
        $this->display('Mui/caiPuTypeList');
    }

    /**
     *菜谱列表
     */
    public function caiPuList(){
        $id   = $_GET['id'];
        $name = $_GET['name'];
        $this->assign('id', $id);
        $this->assign('name', $name);
        $this->display('Mui/caiPuList');
    }
    /**
     * 菜谱列表异步数据
     */
    public function caiPuListAjax(){
        $id   = $_POST['id'];
        $page = $_POST['page']?$_POST['page']:1;
        $pageSize = 15;
        $p    = ($page-1)*$pageSize;
//        $html = file_get_contents('http://www.tngou.net/api/cook/list?id='.$id);
        $return = M('cai_list')->where('parent_id='.$id)->limit($p,$pageSize)->select();
        exit(json_encode($return,JSON_UNESCAPED_UNICODE));
    }

    /**
     * 菜谱详细做法
     */
    public function caiPuShow(){
        $id = $_GET['id'];
        $html = file_get_contents('http://www.tngou.net/api/cook/show?id='.$id);
        $html = json_decode($html);
        $data = [];
        $data['count'] = $html->count;
        $data['description'] = $html->description;
        $data['fcount'] = $html->fcount;
        $data['food'] = $html->food;
        $data['id'] = $html->id;
        $data['images'] = $html->images;
        $data['img'] = 'http://tnfs.tngou.net/img'.$html->img;
        $data['keywords'] = $html->keywords;
        $data['message'] = $html->message;
        $data['name'] = $html->name;
        $data['rcount'] = $html->rcount;
        $data['status'] = $html->status;
        $data['url'] = $html->url;
        $this->assign('data', $data);
//        dump($data);die;
        $this->display('Mui/caiPuShow');
    }

    /**
     * 验证手势解锁是否正确
     */
    public function verify(){
        $n = $_POST['n'];
        if($n=='0,4,8,5,2,1'){
            $return['status'] = 1;
        }else{
            $return['status'] = 0;
        }
        exit(json_encode($return,JSON_UNESCAPED_UNICODE));
    }

    /**
     * 朋友管理列表
     */
    public function friendList(){
        $data = M('jiu')->select();
        if($data){
            for($i=0; $i<count($data); ++$i){
                $arr = explode(',',$data[$i]['cover']);
                $data[$i]['cover'] = $arr[0];
            }
        }
//        dump($data);die;
        $this->assign('data', $data);
        $this->display('Mui/friendList');
    }

    /**
     * 删除一条朋友数据
     */
    public function delFriendData(){
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
     * 修改一条朋友信息
     */
    public function saveFriendData(){
        $id    = $_GET['id']?$_GET['id']:'';
        if($id){
            $data = M('jiu')->find($id);
            if($data){
                if($data['cover']){
                    $data['cover'] = explode(',',$data['cover']);
                }
            }
            $this->assign('data', $data);
        }
        $this->display('Mui/eidtFriend');
    }

    /**
     * 操作九宫格数据
     */
    public function saveFriendDataAjax(){
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
                $data =  M('user')->where('id='.$rst)->find();
                $return['id']     = $rst;
                $return['name']   = $data['re_name'];
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
    public function loginAjax(){
        $name = $_POST['name'];
        $pass = md5($_POST['pass']);
        $rst  = M('user')->where('name="'.$name.'" and pass="'.$pass.'"')->find();
        if($rst){
            $return['status'] = 1;
            $return['img']    = $rst['img'];
            $return['id']     = $rst['id'];
            $return['name']   = $rst['re_name'];
            setCookie('memberId',$rst['id'],time()+24 * 60 * 60 * 1000);
        }else{
            $return['status'] = 0;
            $return['msg']    = '用户名或密码错误';
        }
        exit(json_encode($return,JSON_UNESCAPED_UNICODE));
    }

    /*获取一条用户信息*/
    public function mInfo(){
        $id = $_POST['id'];
        $rst  = M('user')->where('id='.$id)->find();
        if($rst){
            $return['status'] = 1;
            $return['img']    = $rst['img'];
            $return['id']     = $rst['id'];
            $return['name']   = $rst['re_name'];
        }else{
            $return['status'] = 0;
        }
        exit(json_encode($return,JSON_UNESCAPED_UNICODE));
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
                    $return['msg']    = '操作失败';
                }
            }else{
                $return['status'] = 0;
                $return['msg']    = '系统错误';
            }
            exit(json_encode($return));
        }
    }

    /**
     * 修改知识点赞数据(增加)
     */
    public function saveZan(){
        $memberId = cookie('memberId');
        if($memberId){
            $id   = $_POST['id'];
            $name = M('user')->field('re_name')->where('id='.$memberId)->find(); //获取评论者名称
            $data['zan_member_name'] = $name['re_name'];
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
                    if($zi[$i] == $memberId){
                        for($j=0; $j<count($zn); ++$j){
                            if($i==$j){
                                unset($zn[$j]);
                            }
                        }
                        unset($zi[$i]);
                    }
                }
                $data['zan_member_id']   = join('##',$zi);
                $data['zan_member_name'] = join('##',$zn);
                M('knowledge')->where('id='.$id)->save($data);
            }
        }
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

    /*周公解梦视图类型页面*/
    public function untieDream(){
//        $html = file_get_contents('http://api.avatardata.cn/ZhouGongJieMeng/LookUp?key=58702d0a7163427b9ec7011a144c2843&keyword=蛇');
//        $html = json_decode($html);
//        dump($html);
        $this->display('Mui/zhouM');
    }

    /*根据类型周公解梦列表*/
    public function untieDreamList(){
        $keyword  = $_GET['keyword']?$_GET['keyword']:'';
        $type     = $_GET['type'];
        $page     = 1;
        $pageSize = 10;
        if($keyword){
            $type = '';
            $data = M('zhou_m_list')->where('title like "%'.$keyword.'%"')->limit($page,$pageSize)->select();
            $this->assign('keyword', $keyword);
        }else{
            $data = M('zhou_m_list')->where('type="'.$type.'"')->limit($page,$pageSize)->select();
        }
        $this->assign('data', $data);
        $this->assign('type', $type);
        $this->display('Mui/zhouMList');
//        dump($data);
    }
    public function untieDreamListAjax(){
        $page = $_POST['page'];
        $type = $_POST['type']?$_POST['type']:'';
        $key  = $_POST['key']?$_POST['key']:'';
        $pageSize = 10;
        $p    = ($page-1)*$pageSize+1;
        if($key){
            $data = M('zhou_m_list')->where('title like "%'.$key.'%"')->limit($p,$pageSize)->select();
        }else{
            $data = M('zhou_m_list')->where('type="'.$type.'"')->limit($p,$pageSize)->select();
        }
        if($data){
            $return['status'] = 1;
            $return['data']   = $data;
        }else{
            $return['status'] = 0;
        }
        exit(json_encode($return,JSON_UNESCAPED_UNICODE));
    }

    public function bbb(){
        $id = $_GET['id'];
        $html = file_get_contents('http://www.tngou.net/api/cook/list?id='.$id.'&page=1&rows=100');//3
        $html = json_decode($html);
        $data = $html->tngou;
        $datas = [];
        for($i=0; $i<count($data); ++$i){
            $datas[$i]['count'] = $data[$i]->count;
            $datas[$i]['description'] = $data[$i]->description;
            $datas[$i]['fcount'] = $data[$i]->fcount;
            $datas[$i]['food'] = $data[$i]->food;
            $datas[$i]['data_id'] = $data[$i]->id;
            if($data[$i]->images){
                $datas[$i]['images'] = 'http://tnfs.tngou.net/img'.$data[$i]->images;
            }else{
                $datas[$i]['images'] = '';
            }
            $datas[$i]['img'] = 'http://tnfs.tngou.net/img'.$data[$i]->img;
            $datas[$i]['keywords'] = $data[$i]->keywords;
            $datas[$i]['name'] = $data[$i]->name;
            $datas[$i]['rcount'] = $data[$i]->rcount;
            $datas[$i]['parent_id'] = $id;
        }
        M('cai_list')->addAll($datas);
        dump($datas);
        die;
        exit($html);
    }
}