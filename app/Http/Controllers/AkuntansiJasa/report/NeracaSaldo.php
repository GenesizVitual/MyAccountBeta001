<?php

namespace App\Http\Controllers\AkuntansiJasa\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiJasa\NeracaSaldo as neraca_saldo;
use Session;
class NeracaSaldo extends Controller
{
    //
    public function NeracaSaldo(){
        neraca_saldo::$kategori_junal = array(1);
        neraca_saldo::$id_bisnis = Session::get('id_bisnis');
        $data = neraca_saldo::NeracaSaldo('');
        return view('AkuntansiJasa.report.NeracaSaldo', array('data'=>$data, 'judul'=>'Neraca Saldo'));
    }

    public function NeracaSaldoPenyesuaian(){
        neraca_saldo::$kategori_junal = array(1,2);
        neraca_saldo::$id_bisnis = Session::get('id_bisnis');
        $data = neraca_saldo::NeracaSaldo('');
        return view('AkuntansiJasa.report.NeracaSaldo',  array('data'=>$data, 'judul'=>'Neraca Saldo Penyesuaian'));
    }
}
