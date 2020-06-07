<?php

namespace App\Http\Controllers\AkuntansiDagang\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiDagang\Pembelian as pembelian_data;

class Pembelian extends Controller
{
    //

    public function index(){
        $data = pembelian_data::pembelian('');
        return view('AkuntansiDagang.report.PembelianDanPenjualan', array('data'=>$data,'judul'=>'Laporan Pembelian'));
    }
}
