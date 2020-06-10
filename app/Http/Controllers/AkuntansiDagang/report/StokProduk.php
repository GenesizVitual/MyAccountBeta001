<?php

namespace App\Http\Controllers\AkuntansiDagang\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiDagang\Stok;
use Session;

class StokProduk extends Controller
{
    //
    public function index(){
        Stok::$id_bisnis = Session::get('id_bisnis');
        $data = Stok::StokProses('');
        return view('AkuntansiDagang.report.Stok', array('data'=> $data));
    }
}
