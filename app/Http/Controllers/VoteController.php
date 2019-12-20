<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class VoteController extends Controller
{
    public function index(){
        $code = $_GET['code'];
        //获取access_token
        $data = $this->getAccessToken($code);
        echo '<pre>';print_r($data);echo '</pre>';
    }




    protected function getAccessToken($code)
    {
        $url=' https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx9458fefe0c30d65b&secret=cd8005ff51a74dcc293b4416031c7d0d&code='.$code.'&grant_type=authorization_code';
//        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WX_APPID').'&secret='.env('WX_APPSECRET').'&code='.$code.'&grant_type=authorization_code';
        $json_data = file_get_contents($url);
        return json_decode($json_data,true);
    }



    public function hashTest()
    {
        $uid = 1000;
        $key = 'h:user_info:uid:'.$uid;
        $user_info = [
            'uid'       => $uid,
            'user_name'	=> 'zhangsan',
            'email'		=> 'zhangsan@qq.com',
            'age'		=> 22,
            'sex'		=> 1
        ];
        Redis::hMset($key,$user_info);
        die;
        echo '<hr>';
        $u = Redis::hGetAll($key);
        echo '<pre>';print_r($u);echo '</pre>';
    }

}
