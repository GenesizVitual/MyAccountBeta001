<?php

namespace App\Http\Controllers\AkuntansiJasa\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiJasa\LabaRugi as laba_rugi;

class LabaRugi extends Controller
{
    //

    public function LabaRugi(){
        laba_rugi::$kategori_jurnal = array(1);
        laba_rugi::$id_bisnis = 2;
        $data = laba_rugi::LabaRugi('');
        return view('AkuntansiJasa.report.LabaRugi', array('data'=> $data,'judul'=> 'Laba Rugi'));
    }
}