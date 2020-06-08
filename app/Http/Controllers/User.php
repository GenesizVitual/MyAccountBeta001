<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\AkuntansiDagang\Bisnis;
use Hash;
use Session;

class User extends Controller
{
    //
    public function login(Request $req){
        $user = Users::where('email', $req->email)->first();
        if(Hash::check($req->password, $user->password)){
            $req->session()->put('user_id', $user->id);
            $req->session()->put('nama', $user->name);
            $bisnis = Bisnis::where('user_id', $user->id)->first();
            $req->session()->put('id_bisnis', $bisnis->id);
            $req->session()->flash('message_success','Selamat Datang di Aplikasi Manajemen Persediaan');
            return redirect('outlate');
        }else{
            $req->session()->flash('message_fail','email dan password anda salah');
            return redirect('login');
        }
    }

    public function store(Request $req){

        if($req->password != $req->repeat_password){
            $req->session()->flash('message_fail','Password Anda Tidak Sama');
            return redirect('register');
        }

        $user = new Users();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->level = 0;


        if($user->save()){
           $bisnis = new Bisnis();
           $bisnis->nama_bisnis = $req->nama_bisnis;
           $bisnis->nama_bisnis = $req->nama_bisnis;
           $bisnis->jenis_bisnis = "DAGANG";
           $bisnis->alamat = $req->alamat;
           $bisnis->user_id = $user->id;
           if($bisnis->save()){
               $req->session()->flash('message_success','Anda telah berhasil mendaftar');
               return redirect('login');
           }
        }
    }

    public function out(Request $req){
        $req->session()->forget('user_id');
        $req->session()->forget('id_bisnis');
        return redirect('/');
    }
}
