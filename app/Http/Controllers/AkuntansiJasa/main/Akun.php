<?php

namespace App\Http\Controllers\AkuntansiJasa\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AkuntansiJasa\Akun as akuns;
use App\Model\AkuntansiJasa\BukuBesar;
use App\Model\AkuntansiJasa\AkunTransaksi;

class Akun extends Controller
{
    //

    public function index(){
        $data = akuns::all();
        return view('AkuntansiJasa.main.Akun.view', array('data'=> $data));
    }

    public function create(){
        $data_buku_besar = BukuBesar::all();
        $data_akun = akuns::all();
        return view('AkuntansiJasa.main.Akun.new', array('akun'=>$data_akun,'buku_besar'=>$data_buku_besar));
    }


    public function store(Request $req){
        $model = new AkunTransaksi();
        $model->kode = $req->kode;
        $model->akun_lv3 = $req->akun_lv3;
        $model->posisi_akun = $req->posisi_akun;
        $model->buku_besar_id = $req->buku_besar_id;
        $model->posisi_akun = $req->posisi_akun;
        $model->akun_id = $req->akun_id;

        if($model->save()){
            $req->session()->flash('message_success', 'Anda telah menambahkan akun transaksi baru');
            return redirect('pengaturan-akun');
        }

        $req->session()->flash('message_fail', 'Anda telah menambahkan akun transaksi');
        return redirect('pengaturan-akun');
    }

    public function edit($id){
        $data_buku_besar = BukuBesar::all();
        $data_akun = akuns::all();
        $data = AkunTransaksi::findOrFail($id);
        return view('AkuntansiJasa.main.Akun.edit', array('data_akun_transaki'=>$data,'akun'=>$data_akun,'buku_besar'=>$data_buku_besar));
    }

    public function update(Request $req, $id){
        $model = AkunTransaksi::findOrFail($id);
        $model->kode = $req->kode;
        $model->akun_lv3 = $req->akun_lv3;
        $model->posisi_akun = $req->posisi_akun;
        $model->buku_besar_id = $req->buku_besar_id;
        $model->posisi_akun = $req->posisi_akun;
        $model->akun_id = $req->akun_id;

        if($model->save()){
            $req->session()->flash('message_success', 'Anda telah mengubah akun transaksi');
            return redirect('pengaturan-akun');
        }

        $req->session()->flash('message_fail', 'Anda gagal mengubah akun transaksi');
        return redirect('pengaturan-akun');
    }

    public function delete(Request $req, $id){
        $model = AkunTransaksi::findOrFail($id);
        if($model->delete()){
            $req->session()->flash('message_success', 'Anda telah menghapus akun transaksi');
            return redirect('pengaturan-akun');
        }

        $req->session()->flash('message_fail', 'Anda gagal menghapus akun transaksi');
        return redirect('pengaturan-akun');
    }

}
