<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class wxmodel extends Model
{
    public $table='user';
    protected $primaryKey='uid';

    public static function getAccessToken()
    {
        $key = 'wx_access_token';
        $access_token = Redis::get($key);
        if($access_token){
            return $access_token;
        }
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('appid').'&secret='.env('secret');
        $data_json = file_get_contents($url);
        $arr = json_decode($data_json,true);
        Redis::set($key,$arr['access_token']);
        Redis::expire($key,3600);
        return $arr['access_token'];
    }


}
