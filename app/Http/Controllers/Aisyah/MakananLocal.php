<?php

namespace App\Http\Controllers\Aisyah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Aisyah\MakananLocal as makanan;
use App\Model\AkuntansiDagang\Bisnis;

class MakananLocal extends Controller
{
    //
    public function index(){
        $data = makanan::all();
        return view('webpage.content.berita', array('data'=> $data));
    }

    public function outlate(){
        $data = Bisnis::all();
        return view('webpage.content.outlet', array('data'=> $data));
    }

    public function getLatlong(){
        $model = Bisnis::all();
        $array_data = array();
        foreach ($model as $item) {
            $businner = array();
            $businner['name'] = $item->nama_bisnis;
            $businner['location_id'] = $item->id;
            $businner['landmark'] = $item->alamat;
            $businner['country'] = $item->negara;
            $businner['state'] = $item->kota;
            $businner['city'] = $item->kab;
            $businner['latitude'] = (float)$item->latitude;
            $businner['longitude'] = (float)$item->longitude;

            $array_data[] = $businner;
        }
        return response()->json($array_data);
    }

    public function detail_outlate($id){
        $model = Bisnis::find($id);
        return view('webpage.content.detail', array('data'=> $model));
    }
}
