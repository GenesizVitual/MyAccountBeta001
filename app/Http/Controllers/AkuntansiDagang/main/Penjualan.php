<?php

namespace App\Http\Controllers\AkuntansiDagang\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\AkuntansiDagang\Product;
use App\Model\AkuntansiDagang\Penjualan as penjualan_dagang;
use App\Http\Controllers\CustomClass\AkuntansiDagang\PembelianPenjuanlan;

class Penjualan extends Controller
{
    //
    public function create()
    {
        $product = Product::all()->where('id_bisnis', 2);
        return view('AkuntansiDagang.Penjualan.create', array('product'=> $product));
    }

    public function store(Request $req){
        $penjualan = new penjualan_dagang();
        $penjualan->tgl_penjualan = $req->tgl_penjualan;
        $penjualan->product_id = $req->product_id;
        $penjualan->kwantitas = $req->kwantitas;
        $penjualan->harga = $req->harga;
        $total_pembayaran = $req->kwantitas * $req->harga;
        $total_pajak = 0.1 * $total_pembayaran;
        $penjualan->jumlah_pajak = $total_pajak;
        $penjualan->status_pembayaran = $req->status_pembayaran;
        $penjualan->id_bisnis = 2;

        if($penjualan->save()){
            $penjualan = PembelianPenjuanlan::penjualan($penjualan);
            return redirect('jurnal-umum');
        }
    }

}
