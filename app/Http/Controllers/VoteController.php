<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index(){
//        echo 4565456;
        $url='http://1905yangmf.comcto.com/vote';
        $redirect_uri = urlencode($url);
        echo $redirect_uri;
    }
}
