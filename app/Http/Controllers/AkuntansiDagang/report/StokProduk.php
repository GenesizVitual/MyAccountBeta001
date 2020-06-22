<?php

namespace App\Http\Controllers\AkuntansiDagang\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiDagang\Stok;
use App\Model\AkuntansiDagang\Bisnis;
use Session;

class StokProduk extends Controller
{
    //
    public function index(){
        Stok::set_date_();
        Stok::$id_bisnis = Session::get('id_bisnis');
        $data = Stok::StokProses('');
        return view('AkuntansiDagang.report.Stok', array('data'=> $data));
    }

    public function cetak_stok(Request $request){
        Stok::$begin_date_a_year = $request->tgl_awal;
        Stok::$end_date_a_year = $request->tgl_akhir;
        Stok::$id_bisnis = Session::get('id_bisnis');
        $data = Stok::StokProses('');
        $bisnis = Bisnis::findOrFail(Session::get('id_bisnis'));
        return view('AkuntansiDagang.report.Stok_old', array('data'=> $data, 'bisnis'=> $bisnis,
            'tgl_awal'=>$request->tgl_awal,'tgl_akhir'=>$request->tgl_akhir));
    }
}
