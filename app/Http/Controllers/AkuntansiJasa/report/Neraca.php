<?php

namespace App\Http\Controllers\AkuntansiJasa\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CustomClass\AkuntansiJasa\Neraca as neraca_;
use Session;

class Neraca extends Controller
{
    //
    public function neraca(){
        neraca_::$kategori_jurnal = array(1);
        neraca_::$id_bisnis = Session::get('id_bisnis');
        $data = neraca_::Neraca('');
        $data_group = $this->groupAkun($data);
        return view('AkuntansiJasa.report.Neraca', array('data'=> $data_group,'judul'=> 'Laporan Neraca'));
    }

    private function groupAkun($data_neraca){
        $new_array=array();
        foreach ($data_neraca as $key => $value){
            $new_array[$value['lv1']][$key] = $value;
        }
        return $new_array;
    }
}
