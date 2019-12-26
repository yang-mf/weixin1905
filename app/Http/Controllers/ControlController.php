<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControlController extends Controller
{
    public function index()
    {
                echo '<pre>';print_r($_GET);echo '</pre>';
die;
        return $this->view('test.ke');
    }
}
