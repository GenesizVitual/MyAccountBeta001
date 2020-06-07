<?php

namespace App\Http\Controllers\AkuntansiDagang\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AkuntansiDagang\Bisnis;

class Outlate extends Controller
{
    //

    public function index(){
        $model = Bisnis::where('user_id',2)->first();
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
        $model->save();
        return redirect('outlate');
    }
}
