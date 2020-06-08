<?php

namespace App\Http\Controllers\AkuntansiJasa\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiJasa\BukuBesar as buku_besar;
use Session;

class BukuBesar extends Controller
{
    //
    public function buku_besar(){
        buku_besar::$kategori_jurnal = array(1);
        buku_besar::$id_bisnis = Session::get('id_bisnis');
        $data = buku_besar::BukuBesar('');
        return view('AkuntansiJasa.report.BukuBesar', array('data'=> $data,'judul'=>'Buku Besar'));
    }

    public function buku_besar_penyesuaian(){
        buku_besar::$kategori_jurnal = array(1,2);
        buku_besar::$id_bisnis = Session::get('id_bisnis');
        $data = buku_besar::BukuBesar('');
        return view('AkuntansiJasa.report.BukuBesar', array('data'=> $data,'judul'=>'Buku Besar Penyesuaian'));
    }
}
