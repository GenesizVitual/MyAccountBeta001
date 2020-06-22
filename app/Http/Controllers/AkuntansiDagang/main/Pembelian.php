<?php

namespace App\Http\Controllers\AkuntansiDagang\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\AkuntansiDagang\Product;
use App\Model\AkuntansiDagang\Pembelian as pembelian_dagang;
use App\Http\Controllers\CustomClass\AkuntansiDagang\PembelianPenjuanlan;
use App\Model\AkuntansiJasa\Jurnal;
use Session;
class Pembelian extends Controller
{
    //

    public static $kode;
    public static $range;

    public function index()
    {
        $product = Product::all()->where('id_bisnis', Session::get('id_bisnis'));
        $model  = pembelian_dagang::all()->where('id_bisnis', Session::get('id_bisnis'))->sortByDesc('id')->groupBy('kode');
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

        $product = Product::all()->where('id_bisnis', Session::get('id_bisnis'));
        return view('AkuntansiDagang.Pembelian.create', array('product'=> $product,'kode'=> $kode,'range'=> $range));
    }



    public function store(Request $req)
    {
        foreach ($req->product_id as $key => $id_product){
            if(!empty($req->kwantitas[$key])){
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
                $pembelian->id_bisnis = Session::get('id_bisnis');
                if($pembelian->save()){

                    $penjurnalan = PembelianPenjuanlan::pembelian($pembelian);
                    $product = Product::findOrFail($pembelian->product_id);
                    $product->stok += $pembelian->kwantitas;
                    $product->save();
                }
            }
        }
        $req->session()->flash('message_success', 'Nota Pembelian Berhasil Dibuat');
        return redirect('data-pembelian');
    }

    public function update(Request $req,$kode){
        foreach ($req->product_id as $key => $id_product){
            $total_pajak=0;
            $pembelian = pembelian_dagang::find($req->id[$key]);
            $pembelian->tgl_pembelian = $req->tgl_pembelian[$key];
            $pembelian->product_id = $req->product_id[$key];
            $pembelian->kwantitas =$req->kwantitas[$key];
            $pembelian->harga = $req->harga[$key];

            $total_pembayaran = $req->kwantitas[$key] * $req->harga[$key];
            $total_pajak = 0.1 * $total_pembayaran;

            $pembelian->jumlah_pajak = $total_pajak;
            $pembelian->status_pembayaran= $req->status_pembayaran[$key];
            $pembelian->id_bisnis = Session::get('id_bisnis');
            if($pembelian->save()){
                $penjurnalan = PembelianPenjuanlan::pembelian($pembelian);
                $total_stok_old = PembelianPenjuanlan::stok($req->product_id_lama[$key]);
                $old_produk = Product::findOrFail($req->product_id_lama[$key]);
                $old_produk->stok = $total_stok_old;
                if($old_produk->save()){
                    $total_stok_new = PembelianPenjuanlan::stok($req->product_id[$key]);
                    $new_product = Product::findOrFail($req->product_id[$key]);
                    $new_product->stok = $total_stok_new;
                    $new_product->save();
                }

            }
        }
        $req->session()->flash('message_success', 'Nota Pembelian Berhasil Diubah');
        return redirect('data-pembelian');
    }


    public function delete_pembelian(Request $req, $kode){
        $data = pembelian_dagang::all()->where('kode',$kode);
        foreach ($data as $model_pembelian) {
            if ($model_pembelian->delete()) {

                $product = Product::findOrFail($model_pembelian->product_id);
                $product->stok -= $model_pembelian->kwantitas;
                $product->save();

                $model_jurnal = Jurnal::where('id_pembelian', $model_pembelian->id)->first();
                $model_jurnal->delete();
                $req->session()->flash('message_success', 'Nota Pembelian Berhasil Dihapus');
                return redirect('data-pembelian');
            }
        }
        $req->session()->flash('message_fail', 'Nota Pembelian Gagal Dihapus');
        return redirect('data-pembelian');
    }

    public function delete_item_pembelian(Request $req,$id){
        $model_pembelian = pembelian_dagang::findOrFail($id);
        if ($model_pembelian->delete()) {

            $product = Product::findOrFail($model_pembelian->product_id);
            $product->stok -= $model_pembelian->kwantitas;
            $product->save();

            $model_jurnal = Jurnal::where('id_pembelian', $model_pembelian->id)->first();
            $model_jurnal->delete();
            $req->session()->flash('message_success', 'Nota Pembelian Berhasil Dihapus');
            return redirect('data-pembelian');
        }
        $req->session()->flash('message_fail', 'Nota Pembelian Gagal Dihapus');
        return redirect('data-pembelian');
    }

}
