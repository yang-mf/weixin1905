<?php

namespace App\Http\Controllers\WX;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\wxmodel;

class WXController extends Controller
{
    protected $access_token;

    public function __construct()
    {
        $this->access_token = $this->getaccess_token();
    }

    public function getaccess_token()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . env('appid') . '&secret=' . env('secret');
//        echo $url;die;
        $data_json = file_get_contents($url);
        $arr = json_decode($data_json, true);
        return $arr['access_token'];
    }

    public function phpinfo()
    {
        phpinfo();
    }


    public function wx()
    {
        $token = '2259b56f5898cd6192c50d338723d9e4';       //开发提前设置好的 token
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $echostr = $_GET["echostr"];

        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {        //验证通过
            echo $echostr;
        } else {
            die("not ok");
        }
    }

    public function receiv()
    {
        $log_file = "wx.log";
        //将接收的数据记录到日志文件
        $xml_str = file_get_contents("php://input");
        $data = date('Y-m-d H:i:s') . $xml_str;
        file_put_contents($log_file, $data, FILE_APPEND);//追加写

        $xml_obj = simplexml_load_string($xml_str);

        $event = $xml_obj->Event;


        $content = date('Y-m-d H:i:s') . $xml_obj->Content;

        if ($event == 'subscribe') {
            $openid = $xml_obj->FromUserName;  //获取用户的openid
            $res = wxmodel::where(['openid' => $openid])->first();
            if($res) {
                dd(11);
                $content = '欢迎回来';
                $response_text = '<xml>
                        <ToUserName><![CDATA[' . $openid . ']]></ToUserName>
                        <FromUserName><![CDATA[' . $xml_obj->ToUserName . ']]></FromUserName>
                        <CreateTime>' . time() . '</CreateTime> 
                        <MsgType><![CDATA[text]]></MsgType>
                        <Content><![CDATA[' . $content . ']]></Content>
                        </xml>';
                echo $response_text;        //回复用户消息
            } else {
                //获取用户信息
                $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $this->access_token . '&openid=' . $openid . '&lang=zh_CN';
                $user_info = file_get_contents($url);
                $u = json_decode($user_info, true);
                $data = [
                    'openid' => $openid,
                    'sub_time' => time(),
                    'sex' => $u['sex'],
                    'nickname' => $u['nickname'],
                    'style' => '1',
                ];
                //openid入库
                $uid = wxmodel::insertGetId($data);
                file_put_contents('wx_user.log', $user_info, FILE_APPEND);

                $content = '欢迎关注';
                $response_text = '<xml>
                        <ToUserName><![CDATA[' . $openid . ']]></ToUserName>
                        <FromUserName><![CDATA[' . $xml_obj->ToUserName . ']]></FromUserName>
                        <CreateTime>' . time() . '</CreateTime> 
                        <MsgType><![CDATA[text]]></MsgType>
                        <Content><![CDATA[' . $content . ']]></Content>
                        </xml>';
                echo $response_text;        //回复用户消息
            }
        }
        //判断消息类型
        $msg_type = $xml_obj->MsgType;
        $touser = $xml_obj->FromUserName;         //接收消息的用户的id
        $formuser = $xml_obj->ToUserName;         //开发者公众号的ID
        $time = time();

        if ($msg_type == 'text') {
            $response_text = '<xml>
        <ToUserName><![CDATA[' . $touser . ']]></ToUserName>
        <FromUserName><![CDATA[' . $formuser . ']]></FromUserName>
        <CreateTime>' . $time . '</CreateTime> 
        <MsgType><![CDATA[text]]></MsgType>
        <Content><![CDATA[' . $content . ']]></Content>
        </xml>';

            echo $response_text;        //回复用户消息


        }
    }
}