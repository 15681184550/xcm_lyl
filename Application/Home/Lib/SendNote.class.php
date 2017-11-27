<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/27
 * Time: 14:59
 */
namespace Home\lib;

class SendNote
{
    /**
     * @param $phone  电话号码
     * @param $code   验证码
     * @return array
     * 发送短信验证码
     */
    public function sendVerify($phone,$code){
        header("Content-type: text/html; charset=utf-8");
        if($code){
            if($phone){
                if(preg_match_all("/^1[34578]\d{9}$/", $phone)){
                    vendor('alidayu.TopSdk');
                    $c = new \TopClient;
                    $c->appkey = '23329096';
                    $c->secretKey = '84b09b951a6789e3f82c2fdbd57d3629';
                    $req = new \AlibabaAliqinFcSmsNumSendRequest;
                    $req->setExtend("123456");
                    $req->setSmsType("normal");
                    $req->setSmsFreeSignName("康源生态种养殖专业合作社");//签名名称
                    $req->setSmsParam("{\"name\":\"$code\"}");
                    $req->setRecNum("$phone");
                    $req->setSmsTemplateCode("SMS_113760006");           //模板ID
                    $resp = $c->execute($req);
                    if($resp->result->success == 'true'){
                        $return = array('status'=>200,'msg'=>'短信发送成功','err_code'=>'');
                    }else{
                        $return = array('status'=>201,'msg'=>$resp->result->success,'err_code'=>$resp->result->err_code);
                    }
                }else{
                    $return = array('status'=>202,'msg'=>'手机号码格式不正确','err_code'=>'');
                }
            }else{
                $return = array('status'=>203,'msg'=>'没有获取到手机号码','err_code'=>'');
            }
        }else{
            $return = array('status'=>204,'msg'=>'没有获取到短信验证码信息','err_code'=>'');
        }
        return $return;
    }

    /**
     * 已经发货短信通知
     * @param $phone        电话号码
     * @param $name         用户名
     * @param $goods_name   商品信息
     * @param $coder        订单号
     * 尊敬的${name}，您购买的商品${goods_name}已经发货，快递单号为${code},请注意查收
     */
    public function sendShipment($phone,$name,$goods_name,$coder){
        header("Content-type: text/html; charset=utf-8");
        if($phone){
            if(preg_match_all("/^1[34578]\d{9}$/", $phone)){
                if($name){
                    if($goods_name){
                        if($coder){
                            vendor('alidayu.TopSdk');
                            $c = new \TopClient;
                            $c->appkey = '23329096';
                            $c->secretKey = '84b09b951a6789e3f82c2fdbd57d3629';
                            $req = new \AlibabaAliqinFcSmsNumSendRequest;
                            $req->setExtend("123456");
                            $req->setSmsType("normal");
                            $req->setSmsFreeSignName("康源生态种养殖专业合作社");   //签名名称
                            $req->setSmsParam("{\"name\":\"$name\",\"goods_name\":\"$goods_name\",\"code\":\"$coder\"}");
                            $req->setRecNum("$phone");
                            $req->setSmsTemplateCode("SMS_113790010");              //模板ID
                            $resp = $c->execute($req);
                            if($resp->result->success == 'true'){
                                $return = array('status'=>200,'msg'=>'短信发送成功','err_code'=>'');
                            }else{
                                $return = array('status'=>201,'msg'=>$resp->result->success,'err_code'=>$resp->result->err_code);
                            }
                        }else{
                            $return = array('status'=>202,'msg'=>'没有获取到产品订单编号');
                        }
                    }else{
                        $return = array('status'=>203,'msg'=>'没有获取到商品信息');
                    }
                }else{
                    $return = array('status'=>204,'msg'=>'用户名称必须填写');
                }
            }else{
                $return = array('status'=>205,'msg'=>'手机号码格式不正确');
            }
        }else{
            $return = array('status'=>206,'msg'=>'没有获取到手机号码');
        }
        return $return;
    }
}