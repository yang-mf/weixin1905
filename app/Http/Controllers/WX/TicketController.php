<?php

namespace App\Http\Controllers\WX;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\wxmodel;
use GuzzleHttp\Client;


class TicketController extends Controller
{
    public function getticket()
    {
        $scene_id=$_GET['scene'];
        $access_token=wxmodel::getAccessToken();
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token;
//        {"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": 123}}}
        $data=[
            'expire_seconds'    =>604800,
            'action_name'       =>'QR_SCENE',
            'action_info'       =>['scene' => [
                'scene_id'      =>$scene_id
                ]
            ]
        ];
        $data=json_encode($data);

        $client = new Client();
        $response = $client->request('POST',$url,[
            'body'=>$data
        ]);
        $json1 = $response->getBody();
        $tickit=json_decode($json1,true)['ticket'];

        $res='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$tickit;
        return redirect($res);



    }
}


