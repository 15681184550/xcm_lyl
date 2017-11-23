<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/10
 * Time: 10:54
 */

namespace Home\Controller;
require APP_PATH."wechat/autoload.php";
use Think\Controller;
//微信SDK

use Overtrue\Wechat\Menu;
use Overtrue\Wechat\MenuItem;
use Overtrue\Wechat\Server;
use Overtrue\Wechat\Message;
define("TOKEN", "xcm");

class WxController extends Controller {

    public function index(){
        $appId  = 'wx0a02d5ac2abf6d81';

        $server = new Server($appId, TOKEN);
        $server->on('event', 'subscribe', function($event){
            //获取用户openid
            $openid = $event['FromUserName'];
            return Message::make('text')->content('您好！欢迎关注111');
        });

        $server->on('message', 'text', function($message) {
            if($message['Content'] == '1') {
                $articles = [
                    ['id' => 1, 'title' => '第1条活动', 'pic' => 'http://pic.58pic.com/58pic/14/00/69/66858PICNfJ_1024.jpg'],
                    ['id' => 2, 'title' => '第2条活动', 'pic' => 'http://pic2.ooopic.com/11/07/15/30bOOOPICd7.jpg'],
                    ['id' => 3, 'title' => '第3条活动', 'pic' => 'http://pic2.ooopic.com/11/07/15/30bOOOPICd7.jpg'],
                ];
                $items = [];
                foreach ($articles as $article) {
                    $item = Message::make('news_item')->title($article['title'])
                        ->url('http://phpweixin.itsource.cn/itsource/vip/index.php?p=front&c=Zhang&a=viewArticle&id=' . $article['id'])
                        ->picUrl($article['pic']);
                    $items[] = $item;
                }
                return Message::make('news')->items($items);
            }

        });
        echo $server->serve();
    }

    /**
     * 自定义菜单  (必须要微信认证)
     */
    public function setMenu(){
//        $appId  = 'wx72c9dc618390caf4';
//        $secret = 'db3f148142930613908102088ededc66';
        $appId  = 'wx0a02d5ac2abf6d81';
        $secret = '30e2b0576f569860e9ceeafa8aaf762b';
        vendor('SDK.autoload');
        $menuService = new Menu($appId, $secret);
        $menuService->delete();
        $button = new MenuItem("菜单");

        $menus = array(
            new MenuItem("入口首页", 'view', 'http://www.xcm.party'),
            $button->buttons(array(
                new MenuItem('图文消息', 'view', 'http://www.xcm.party/index.php/Home/Wx/tuWen.html'),
                new MenuItem('视频', 'view', 'http://v.qq.com/'),
                new MenuItem('赞一下我们', 'click', 'V1001_GOOD'),
            )),
        );

        try {
            $menuService->set($menus);// 请求微信服务器
            echo '设置成功！';
        } catch (\Exception $e) {
            echo '设置失败：' . $e->getMessage();
        }
    }

    /**
     * 图文消息
     */
    public function tuWen(){
        $appId  = 'wx0a02d5ac2abf6d81';

        $server = new Server($appId, TOKEN);
        $server->on('message', 'text', function($message) {
            $articles = [
                ['id'=>1,'title'=>'第1条活动','pic'=>'http://pic.58pic.com/58pic/14/00/69/66858PICNfJ_1024.jpg'],
                ['id'=>2,'title'=>'第2条活动','pic'=>'http://pic2.ooopic.com/11/07/15/30bOOOPICd7.jpg'],
                ['id'=>3,'title'=>'第3条活动','pic'=>'http://pic2.ooopic.com/11/07/15/30bOOOPICd7.jpg'],
            ];
            $items = [];
            foreach($articles as $article){
                $item =  Message::make('news_item')->title($article['title'])
                    ->url('http://phpweixin.itsource.cn/itsource/vip/index.php?p=front&c=Zhang&a=viewArticle&id='.$article['id'])
                    ->picUrl($article['pic']);
                $items[] = $item;
            }
            return Message::make('news')->items($items);

        });
        echo $server->serve();
    }
    /**
     * 验证token
     */
    public function valid(){
        $echoStr = $_GET["echostr"];
        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    /**
     * 验证token
     */
    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!emptyempty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            <FuncFlag>0</FuncFlag>
            </xml>";
            if(!emptyempty( $keyword ))
            {
                $msgType = "text";
                $contentStr = "Welcome to wechat world!";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
            }else{
                echo "Input something...";
            }
        }else {
            echo "";
            exit;
        }
    }

    /**
     * @return bool验证token
     */
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

}