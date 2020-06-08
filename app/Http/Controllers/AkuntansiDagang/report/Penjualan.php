<?php

namespace App\Http\Controllers\AkuntansiDagang\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiDagang\Penjualan as penjualan_;
use Session;

class Penjualan extends Controller
{
    //
    public function index(){
        penjualan_::$id_bisnis = Session::get('id_bisnis');
        $data = penjualan_::penjualan('');
        return view('AkuntansiDagang.report.PembelianDanPenjualan', array('data'=>$data,'judul'=>'Penjualan'));
    }

}
