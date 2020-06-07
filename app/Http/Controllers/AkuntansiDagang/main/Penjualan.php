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

    public static $kode;
    public static $range;

    public function index()
    {
        $product = Product::all()->where('id_bisnis',2);
        $model  = penjualan_dagang::all()->where('id_bisnis',2)->sortByDesc('id')->groupBy('kode');
        return view('AkuntansiDagang.Penjualan.view', array('data'=> $model,'product'=>$product));
    }

    public function slip_penjualan($kode, $range)
    {
        self::$kode = $kode;
        self::$range = $range;
        return $this->create();
    }


    public function list_penjualan($range){
        self::$range = $range;
        return $this->create();
    }

    public function create()
    {
        if(empty(self::$kode) ){
            $kode = uniqid();
            $range = self::$range;
        }else{
            $kode = self::$kode;
            $range = self::$range;
        }

        $product = Product::all()->where('id_bisnis', 2);
        return view('AkuntansiDagang.Penjualan.create', array('product'=> $product,'kode'=> $kode,'range'=> $range));
    }

    public function store(Request $req){

        foreach ($req->product_id as $key => $id_product)
        {
            $total_pajak=0;
            $data_product = Product::findOrFail($id_product);
            $penjualan = new penjualan_dagang();
            $penjualan->tgl_penjualan = $req->tgl_penjualan;
            $penjualan->product_id = $id_product;
            $penjualan->kwantitas = $req->kwantitas[$key];
            $penjualan->harga = $data_product->harga;
            $total_pembayaran = $req->kwantitas[$key] * $data_product->harga;
            $total_pajak = 0.1 * $total_pembayaran;

            $penjualan->jumlah_pajak = $total_pajak;
            $penjualan->status_pembayaran = $req->status_pembayaran;
            $penjualan->kode = $req->kode;
            $penjualan->id_bisnis = 2;

            if ($penjualan->save()) {
                $penjurnalan = PembelianPenjuanlan::penjualan($penjualan);
                $product = Product::findOrFail($penjualan->product_id);
                if($req->kwantitas[$key]>$req->kwantitas_lama[$key]){
                    $product->stok += $req->kwantitas[$key]-$req->kwantitas_lama[$key];
                }else{
                    $product->stok -= $req->kwantitas_lama[$key]-$req->kwantitas[$key];
                }
                $product->save();
            }
        }
        return redirect('data-penjualan');
    }

    public function update(Request $req,$kode){
        foreach ($req->product_id as $key => $id_product){
            $total_pajak=0;
            $penjualan = penjualan_dagang::find($req->id[$key]);
            $penjualan->tgl_penjualan = $req->tgl_penjualan[$key];
            $penjualan->product_id = $id_product;
            $penjualan->kwantitas =$req->kwantitas[$key];
            $penjualan->harga = $req->harga[$key];

            $total_pembayaran = $req->kwantitas[$key] * $req->harga[$key];
            $total_pajak = 0.1 * $total_pembayaran;

            $penjualan->jumlah_pajak = $total_pajak;
            $penjualan->status_pembayaran= $req->status_pembayaran[$key];
            $penjualan->id_bisnis = 2;
            if($penjualan->save()){
                $penjurnalan = PembelianPenjuanlan::penjualan($penjualan);
//                $product = Product::findOrFail($pembelian->product_id);
//                $product->stok += $pembelian->kwantitas;
//                $product->save();
            }
        }
        return redirect('data-penjualan');
    }

    public function delete_penjualan($kode){
        $data = penjualan_dagang::all()->where('kode',$kode);
        foreach ($data as $model_penjualan) {
            if ($model_penjualan->delete()) {
                $model_jurnal = Jurnal::where('id_penjualan', $model_penjualan->id)->first();
                $model_jurnal->delete();
            }
        }
        return redirect('data-penjualan');
    }

    public function delete_item_penjualan($id){
        $model_pembelian = penjualan_dagang::fiindOrFail($id);
        if ($model_pembelian->delete()) {
            $model_jurnal = Jurnal::where('id_penjualan', $model_pembelian->id)->first();
            $model_jurnal->delete();
        }
        return redirect('data-penjualan');
    }

}
