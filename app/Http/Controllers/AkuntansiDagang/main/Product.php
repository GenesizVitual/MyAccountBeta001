<?php

namespace App\Http\Controllers\AkuntansiDagang\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AkuntansiDagang\Product as produk;
use Session;

class Product extends Controller
{
    //
    public function index(){
        $model = produk::all()->where('id_bisnis',Session::get('id_bisnis'));
        return view('AkuntansiDagang.Product.view', array('data'=> $model));
    }

    public function create(){
        return view('AkuntansiDagang.Product.new');
    }

    public function store(Request $req){
        $model = new produk();
        $model->nama_barang = $req->nama_barang;
        $model->satuan = $req->satuan;
        $model->harga = $req->harga;
        $model->stok = $req->stok;
        $model->id_bisnis = Session::get('id_bisnis');
        $gambar= $req->gambar;

        $imagename = time() . '.' . $gambar->getClientOriginalExtension();
        $model->gambar = $imagename;
        if($model->save()){
            if(!empty($req->gambar)){
                $gambar->move(public_path('produk'), $imagename);
            }
           $req->session()->flash('message_success', 'Anda telah menambahkan produk baru');
           return redirect('daftar-produk');
        }

        $req->session()->flash('message_fail', 'Anda gagal menambahkan produk baru');
        return redirect('daftar-produk');
    }

    public function edit($id){
        $model = produk::findOrFail($id);
        return view('AkuntansiDagang.Product.edit', array('data'=> $model));
    }

    public function update(Request $req, $id){
        $model = produk::findOrFail($id);
        $model->nama_barang = $req->nama_barang;

        $model->satuan = $req->satuan;
        $model->harga = $req->harga;
        $model->stok = $req->stok;
        $model->id_bisnis = Session::get('id_bisnis');
        $gambar= $req->gambar;

        $imagename = time() . '.' . $gambar->getClientOriginalExtension();
        $model->gambar = $imagename;
        if(!empty($model->gambar))
        {
            $file_path =public_path('produk').'/' . $model->gambar;
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }

        if($model->save()){
            if(!empty($req->gambar)){
                $gambar->move(public_path('produk'), $imagename);
            }
            $req->session()->flash('message_success', 'Anda telah menambahkan produk baru');
            return redirect('daftar-produk');
        }

        if($model->save()){
            $req->session()->flash('message_success', 'Anda telah mengubah produk');
            return redirect('daftar-produk');
        }

        $req->session()->flash('message_fail', 'Anda gagal mengubah produk baru');
        return redirect('daftar-produk');
    }

    public function delete(Request $req, $id){
        $model = produk::findOrFail($id);
        if($model->delete()){
            $req->session()->flash('message_success', 'Anda telah menghapus produk ');
            return redirect('daftar-produk');
        }

        $req->session()->flash('message_fail', 'Anda gagal menghapus produk');
        return redirect('daftar-produk');
    }
}
