<?php

namespace App\Http\Controllers\AkuntansiDagang\report;

use App\Http\Controllers\Controller;
use App\Model\AkuntansiDagang\Bisnis;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiDagang\Penjualan as penjualan_;
use Session;

class Penjualan extends Controller
{
    //
    public function index(){
        penjualan_::set_date_();
        penjualan_::$id_bisnis = Session::get('id_bisnis');
        $data = penjualan_::penjualan('');
        return view('AkuntansiDagang.report.PembelianDanPenjualan', array('data'=>$data,'judul'=>'Penjualan'));
    }

    public function print_penjualan(Request $req){
        penjualan_::$begin_date_a_year = $req->tgl_awal;
        penjualan_::$end_date_a_year = $req->tgl_akhir;
        penjualan_::$id_bisnis = Session::get('id_bisnis');
        $bisnis = Bisnis::findOrFail(Session::get('id_bisnis'));
        $data = penjualan_::penjualan('');
        return view('AkuntansiDagang.report.PembelianDanPenjualan_old', array('data'=>$data,'judul'=>'Penjualan',
            'bisnis'=>$bisnis,'tgl_awal'=>$req->tgl_awal,'tgl_akhir'=>$req->tgl_akhir));
    }

}
