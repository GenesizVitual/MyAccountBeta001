<?php

namespace App\Http\Controllers\AkuntansiDagang\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\AkuntansiDagang\Product;
use App\Model\AkuntansiDagang\Pembelian as pembelian_dagang;
use App\Http\Controllers\CustomClass\AkuntansiDagang\PembelianPenjuanlan;
use App\Model\AkuntansiJasa\Jurnal;
class Pembelian extends Controller
{
    //

    public static $kode;
    public static $range;

    public function index()
    {
        $product = Product::all()->where('id_bisnis',2);
        $model  = pembelian_dagang::all()->where('id_bisnis',2)->sortByDesc('id')->groupBy('kode');
        return view('AkuntansiDagang.Pembelian.view', array('data'=> $model,'product'=>$product));
    }

    public function list_pembelian($range){
        self::$range = $range;
        return $this->create();
    }

    public function slip_pembelian($kode, $range){
        self::$kode = $kode;
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
        return view('AkuntansiDagang.Pembelian.create', array('product'=> $product,'kode'=> $kode,'range'=> $range));
    }



    public function store(Request $req)
    {
        foreach ($req->product_id as $key => $id_product){
            $total_pajak=0;
            $pembelian = new pembelian_dagang();
            $pembelian->tgl_pembelian = $req->tgl_pembelian;
            $pembelian->product_id = $id_product;
            $pembelian->kwantitas =$req->kwantitas[$key];
            $pembelian->harga = $req->harga[$key];

            $total_pembayaran = $req->kwantitas[$key] * $req->harga[$key];
            $total_pajak = 0.1 * $total_pembayaran;

            $pembelian->jumlah_pajak = $total_pajak;
            $pembelian->status_pembayaran= $req->status_pembayaran;
            $pembelian->kode= $req->kode;
            $pembelian->id_bisnis = 2;
            if($pembelian->save()){
                $penjurnalan = PembelianPenjuanlan::pembelian($pembelian);
                $product = Product::findOrFail($pembelian->product_id);
                $product->stok += $pembelian->kwantitas;
                $product->save();
            }
        }

        return redirect('data-pembelian');
    }

    public function update(Request $req,$kode){
        foreach ($req->product_id as $key => $id_product){
            $total_pajak=0;
            $pembelian = pembelian_dagang::find($req->id[$key]);
            $pembelian->tgl_pembelian = $req->tgl_pembelian[$key];
            $pembelian->product_id = $id_product;
            $pembelian->kwantitas =$req->kwantitas[$key];
            $pembelian->harga = $req->harga[$key];

            $total_pembayaran = $req->kwantitas[$key] * $req->harga[$key];
            $total_pajak = 0.1 * $total_pembayaran;

            $pembelian->jumlah_pajak = $total_pajak;
            $pembelian->status_pembayaran= $req->status_pembayaran[$key];
            $pembelian->id_bisnis = 2;
            if($pembelian->save()){
                $penjurnalan = PembelianPenjuanlan::pembelian($pembelian);
                $product = Product::findOrFail($pembelian->product_id);
                if($req->kwantitas[$key]>$req->kwantitas_lama[$key]){
                    $product->stok += $req->kwantitas[$key]-$req->kwantitas_lama[$key];
                }else{
                    $product->stok -= $req->kwantitas_lama[$key]-$req->kwantitas[$key];
                }
                $product->save();
            }
        }
        return redirect('data-pembelian');
    }


    public function delete_pembelian($kode){
        $data = pembelian_dagang::all()->where('kode',$kode);
        foreach ($data as $model_pembelian) {
            if ($model_pembelian->delete()) {
                $model_jurnal = Jurnal::where('id_pembelian', $model_pembelian->id)->first();
                $model_jurnal->delete();
            }
        }
        return redirect('data-pembelian');
    }

    public function delete_item_pembelian($id){
        $model_pembelian = pembelian_dagang::fiindOrFail($id);
        if ($model_pembelian->delete()) {
            $model_jurnal = Jurnal::where('id_pembelian', $model_pembelian->id)->first();
            $model_jurnal->delete();
        }
        return redirect('data-pembelian');
    }

}
