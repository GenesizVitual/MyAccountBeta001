<?php

namespace App\Http\Controllers\AkuntansiDagang\main;

use App\Http\Controllers\Controller;
use App\Model\AkuntansiDagang\Bisnis;
use Illuminate\Http\Request;

use App\Model\AkuntansiDagang\Product;
use App\Model\AkuntansiDagang\Penjualan as penjualan_dagang;
use App\Http\Controllers\CustomClass\AkuntansiDagang\PembelianPenjuanlan;
use Session;

class Penjualan extends Controller
{
    //

    public static $kode;
    public static $range;

    public function index()
    {
        $product = Product::all()->where('id_bisnis',Session::get('id_bisnis'));
        $date_now = date('Y-m-d');
        $model_terbaru  = penjualan_dagang::all()->where('id_bisnis',Session::get('id_bisnis'))->where('tgl_penjualan',$date_now)->sortByDesc('id')->groupBy('kode')->take(1);
        $model_lama  = penjualan_dagang::all()->where('id_bisnis',Session::get('id_bisnis'))->where('tgl_penjualan',$date_now)->sortByDesc('id')->groupBy('kode')->skip(1);
        return view('AkuntansiDagang.Penjualan.view', array('data'=> $model_terbaru,'model_lama'=>$model_lama,'product'=>$product));
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

        $product = Product::all()->where('id_bisnis', Session::get('id_bisnis'));
        return view('AkuntansiDagang.Penjualan.create', array('product'=> $product,'kode'=> $kode,'range'=> $range));
    }


    public function store(Request $req){
        if(!empty($req->product_id)){
            foreach ($req->product_id as $key => $id_product)
            {
                if(!empty($req->kwantitas[$key])) {
                    $total_pajak = 0;
                    $data_product = Product::findOrFail($id_product);
                    $penjualan = new penjualan_dagang();
                    $penjualan->tgl_penjualan = date('Y-m-d',strtotime($req->tgl_penjualan));
                    $penjualan->product_id = $id_product;
                    $penjualan->kwantitas = $req->kwantitas[$key];
                    $penjualan->harga = $data_product->harga;
                    $total_pembayaran = $req->kwantitas[$key] * $data_product->harga;
                    $total_pajak = 0.1 * $total_pembayaran;

                    $penjualan->jumlah_pajak = $total_pajak;
                    $penjualan->status_pembayaran = $req->status_pembayaran;
                    $penjualan->kode = $req->kode;
                    $penjualan->id_bisnis = Session::get('id_bisnis');

                    if ($penjualan->save()) {
                        $penjurnalan = PembelianPenjuanlan::penjualan($penjualan);
                        $product = Product::findOrFail($penjualan->product_id);
                        $product->stok -=$req->kwantitas[$key];
                        $product->save();
                    }
                }
            }
        }else{
            $req->session()->flash('message_fail','Masukan produk terlebih dahulu');
            return redirect('data-penjualan');
        }
        $req->session()->flash('message_success','Nota telah ditambahkan');
        return redirect('data-penjualan');
    }

    public function update(Request $req,$kode){
        foreach ($req->product_id as $key => $id_product){
            $total_pajak=0;
            if(!empty($req->kwantitas[$key])){
                $penjualan = penjualan_dagang::find($req->id[$key]);
                $penjualan->tgl_penjualan = $req->tgl_penjualan[$key];
                $penjualan->product_id = $id_product;
                $penjualan->kwantitas =$req->kwantitas[$key];
                $penjualan->harga = $req->harga[$key];

                $total_pembayaran = $req->kwantitas[$key] * $req->harga[$key];
                $total_pajak = 0.1 * $total_pembayaran;

                $penjualan->jumlah_pajak = $total_pajak;
                $penjualan->status_pembayaran= $req->status_pembayaran[$key];
                $penjualan->id_bisnis = Session::get('id_bisnis');
                if($penjualan->save()){
                    $penjurnalan = PembelianPenjuanlan::penjualan($penjualan);
                    $product = Product::findOrFail($penjualan->product_id);
                    if($req->kwantitas[$key]>$req->kwantitas_lama[$key]){
                        $product->stok += $req->kwantitas_lama[$key] - $req->kwantitas[$key];
                    }else{
                        $product->stok += $req->kwantitas_lama[$key] - $req->kwantitas[$key];
                    }
                    $product->save();
                }
            }
        }
        return redirect('data-penjualan');
    }

    public function delete_penjualan($kode){
        $data = penjualan_dagang::all()->where('kode',$kode);
        foreach ($data as $model_penjualan) {
            if ($model_penjualan->delete()) {
                $model_jurnal = Jurnal::where('id_penjualan', $model_penjualan->id);

                if($model_jurnal->delete()){
                    $product = Product::findOrFail($model_penjualan->product_id);
                    $product->stok += $model_penjualan->kwantitas;
                }
            }
        }
        return redirect('data-penjualan');
    }

    public function delete_item_penjualan($id){
        $model_penjualan = penjualan_dagang::fiindOrFail($id);
        if ($model_penjualan->delete()) {
            $model_jurnal = Jurnal::where('id_penjualan', $model_penjualan->id);
            if($model_jurnal->delete()){
                $product = Product::findOrFail($model_penjualan->product_id);
                $product->stok += $model_penjualan->kwantitas;
            }
        }
        return redirect('data-penjualan');
    }


}
