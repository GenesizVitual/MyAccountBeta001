<?php

namespace App\Http\Controllers\AkuntansiJasa\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiJasa\NeracaSaldo as neraca_saldo;
class NeracaSaldo extends Controller
{
    //
    public function NeracaSaldo(){
        neraca_saldo::$kategori_junal = array(1);
        $data = neraca_saldo::NeracaSaldo('');
        return view('AkuntansiJasa.report.NeracaSaldo', $data);
    }

    public function NeracaSaldoPenyesuaian(){
        neraca_saldo::$kategori_junal = array(1,2);
        $data = neraca_saldo::NeracaSaldo('');
        return view('AkuntansiJasa.report.NeracaSaldo', $data);
    }
}
