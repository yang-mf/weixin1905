<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\test;
//use App\User;
use GuzzleHttp\Client;

class weather extends Controller
{
    public function index()
    {
        $data=test::all('openid')->toArray();
        $openid=array_column($data,'openid');

        $weather_api = 'https://free-api.heweather.net/s6/weather/now?location=beijing&key=b2e92f2df77e48b3a36f20e912b796d9';
        $weather_info = file_get_contents($weather_api);
        $weather_info_arr = json_decode($weather_info,true);
//                print_r($weather_info_arr);die;
        $cond_txt = $weather_info_arr['HeWeather6'][0]['now']['cond_txt'];
        $tmp = $weather_info_arr['HeWeather6'][0]['now']['tmp'];
        $wind_dir = $weather_info_arr['HeWeather6'][0]['now']['wind_dir'];
        $msg = $cond_txt . ' 温度： '.$tmp . ' 风向： '. $wind_dir;


        $msg_url='https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=28_QGpOW8qlW6c9VU3DUeSjUIiyoeLIqQODdUczZgsLqPbHNqeWqbt50yWMK3SmN_gyK8GH1hTto40eCxRlRBITwZnIO6WSA7ElFHKOrzw0NU3FET_h_v7bvPwMs_61UINZ7Ga9ThzaOs3znLPvHAPiAEAXQF';

        $msg = date('Y-m-d H:i:s') . $msg;
        $data = [
            'touser'    => $openid,
            'msgtype'   => 'text',
            'text'      => ['content'=>$msg]
        ];
        $client = new Client();
        $response = $client->request('POST',$msg_url,[
            'body'  => json_encode($data,JSON_UNESCAPED_UNICODE)
        ]);
        echo $response->getBody();

    }
}
