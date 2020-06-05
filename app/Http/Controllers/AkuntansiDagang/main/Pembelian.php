<?php

namespace App\Http\Controllers\AkuntansiDagang\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\AkuntansiDagang\Product;
use App\Model\AkuntansiDagang\Pembelian as pembelian_dagang;
use App\Http\Controllers\CustomClass\AkuntansiDagang\PembelianPenjuanlan;

class Pembelian extends Controller
{
    //

    public function create()
    {
        $product = Product::all()->where('id_bisnis', 2);
        return view('AkuntansiDagang.Pembelian.create', array('product'=> $product));
    }

    public function store(Request $req){
        $pembelian = new pembelian_dagang();
        $pembelian->tgl_pembelian = $req->tgl_pembelian;
        $pembelian->product_id = $req->product_id;
        $pembelian->kwantitas = $req->kwantitas;
        $pembelian->harga = $req->harga;
        $total_pembayaran = $req->kwantitas * $req->harga;
        $total_pajak = 0.1 * $total_pembayaran;
        $pembelian->jumlah_pajak = $total_pajak;
        $pembelian->status_pembayaran= $req->status_pembayaran;
        $pembelian->id_bisnis = 2;

        if($pembelian->save()){
            $pembelian = PembelianPenjuanlan::pembelian($pembelian);
            return redirect('jurnal-umum');
        }
    }
}
