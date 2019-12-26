<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControlController extends Controller
{
    public function index()
    {
        return $this->view('test.ke');
    }
}
