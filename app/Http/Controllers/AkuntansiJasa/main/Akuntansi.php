<?php

namespace App\Http\Controllers\AkuntansiJasa\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiJasa\JurnalUmum;
use Session;
class Akuntansi extends Controller
{
    //
    public function index(){
        JurnalUmum::$id_bisnis = Session::get('id_bisnis');
        JurnalUmum::$ketegori_jurnal = array(1);
        $data = JurnalUmum::JurnalUmum('');
        return view('AkuntansiJasa.main.Akuntansi.view', array('data'=> $data));
    }
}
