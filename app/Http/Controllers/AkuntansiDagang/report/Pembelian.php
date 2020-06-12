<?php

namespace App\Http\Controllers\AkuntansiDagang\report;

use App\Http\Controllers\Controller;
use App\Model\AkuntansiDagang\Bisnis;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiDagang\Pembelian as pembelian_data;
use Session;

class Pembelian extends Controller
{
    //

    public function index(){
        pembelian_data::$id_bisnis = Session::get('id_bisnis');
        $set_tgl = pembelian_data::set_date_();
        $data = pembelian_data::pembelian('');
        return view('AkuntansiDagang.report.PembelianDanPenjualan',
            array('data'=>$data,'judul'=>'Pembelian')
        );
    }

    public function print_pembelian(Request $req){
        pembelian_data::$id_bisnis = Session::get('id_bisnis');
        pembelian_data::$begin_date_a_year = $req->tgl_awal;
        pembelian_data::$end_date_a_year= $req->tgl_akhir;
        $bisnis = Bisnis::findOrFail(Session::get('id_bisnis'));
        $data = pembelian_data::pembelian('');
        return view('AkuntansiDagang.report.PembelianDanPenjualan_old',
            array('data'=>$data,'judul'=>'Laporan Pembelian', 'bisnis'=>$bisnis)
        );
    }
}
