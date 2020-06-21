<?php

namespace App\Http\Controllers\AkuntansiDagang\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Model\AkuntansiDagang\Product;
use App\Model\AkuntansiDagang\Penjualan as penjualan_dagang;
use App\Model\AkuntansiDagang\Bisnis;

class POS extends Controller
{
    //
    public static $range;
    public static $kode;

    public function list_post($range){
        self::$range = $range;
        return $this->create_pos();
    }

    public function slip_penjualan($kode)
    {
        self::$kode = $kode;
        return $this->create_pos();
    }

    public function create_pos()
    {
        $tanggal_sekarang = date('d-m-Y');

        if(empty(self::$kode) ){
            $kode = uniqid();
            $range = self::$range;
        }else{
            $kode = self::$kode;
            $range = self::$range;
        }

        $product = Product::all()->where('id_bisnis', Session::get('id_bisnis'));
        return view('AkuntansiDagang.Penjualan.pos', array('product'=> $product,'kode'=> $kode,'range'=> $range,'tanggal'=>$tanggal_sekarang));
    }

    public function plug_produk(Request $request){
        $model =Product::findOrFail($request->id_produk);
        return view('AkuntansiDagang.Penjualan.partial.list_produk', array('data'=>$model));
    }


    public function cetak_stuck(Request $req){
        $kode =  $req->kode;
        $total_bayar = $req->uang;
        $data = penjualan_dagang::all()->where('kode',$kode);
        $bisnis = Bisnis::findOrFail(Session::get('id_bisnis'));
        return view('AkuntansiDagang.report.CetakStruk', array('data'=> $data,'tota_bayar'=>$total_bayar,'bisnis'=> $bisnis, 'kode'=> $kode,'tgl'=>$data->first()));
    }

    public function detail_penjualan($kode){
        $data_banyak_data = penjualan_dagang::all()->where('kode', $kode);
        $count_data = 0;
        $total_data = $data_banyak_data->count();
        $total_bayar =0;
        foreach ($data_banyak_data as $data)
        {
            $total_bayar  += ($data->kwantitas * $data->harga) + $data->jumlah_pajak;
        }
        return array( 'banyak_barang'=> $total_data, 'total_bayar'=> $total_bayar);
    }

    public function lihat_belanja(Request $req){

        $container =array();
        $no=1;
        $total = 0;
        $total_pajak= 0;
        foreach ($req->product_id as $key=>$id_produk)
        {
            if(!empty($req->kwantitas[$key])){
                $produk = Product::find($id_produk);
                $array = array();
                $array[] = $no++;
                $array[] = $produk->nama_barang;
                $array[] = $req->kwantitas[$key];
                $array[] = number_format($produk->harga,2,',','.');
                $array[] = number_format($req->kwantitas[$key]*$produk->harga,2,',','.');
                $array[] = number_format(($req->kwantitas[$key]*$produk->harga)*0.1,2,',','.');
                $total +=$req->kwantitas[$key]*$produk->harga;
                $total_pajak +=($req->kwantitas[$key]*$produk->harga)*0.1;
                $container[] = $array;
            }
        }

        return response()->json(array(
            'data'=> $container,
            'sub_total'=>number_format($total,2,',','.'),
            'total_pajak'=>number_format($total_pajak,2,',',''),
            'total_keseluruhan'=>number_format($total+$total_pajak,2,',','.'),
        ));
    }


}
