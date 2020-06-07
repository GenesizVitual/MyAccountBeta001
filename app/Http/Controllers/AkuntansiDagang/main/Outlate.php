<?php

namespace App\Http\Controllers\AkuntansiDagang\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Outlate extends Controller
{
    //

    public function index(){
        return view('AkuntansiDagang.Outlate.view');
    }
}
