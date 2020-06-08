<?php

namespace App\Http\Controllers\AkuntansiDagang\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AkuntansiDagang\Bisnis;
use Session;
class Outlate extends Controller
{
    //

    public function index(){
        $model = Bisnis::where('user_id',Session::get('user_id'))->first();
        return view('AkuntansiDagang.Outlate.view',array('data'=>$model));
    }

    public function edit($id){
        $model = Bisnis::findOrFail($id);
        return view('AkuntansiDagang.Outlate.edit',array('data'=>$model));
    }
    public function update(Request $req,$id){
        $model = Bisnis::findOrFail($id);
        $model->nama_bisnis =  $req->nama_bisnis;
        $model->alamat =  $req->alamat;
        $gambar= $req->gambar;

        $imagename = time() . '.' . $gambar->getClientOriginalExtension();
        $model->gambar = $imagename;
        if(!empty($model->gambar))
        {
            $file_path =public_path('bisnis').'/' . $model->gambar;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if($model->save()){
            if(!empty($req->gambar)){
                $gambar->move(public_path('bisnis'), $imagename);
            }
            $req->session()->flash('message_success', 'Anda telah mengubah profil outlate anda');
            return redirect('outlate');
        }
        return redirect('outlate');
    }
}
