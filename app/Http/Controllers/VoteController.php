<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class VoteController extends Controller
{
    public function index(){
        echo '<pre>';print_r($_GET);echo '</pre>';
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
