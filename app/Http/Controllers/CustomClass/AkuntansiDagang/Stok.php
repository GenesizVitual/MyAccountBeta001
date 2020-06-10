<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 11/06/2020
 * Time: 6:22
 */

namespace App\Http\Controllers\CustomClass\AkuntansiDagang;

use App\Model\AkuntansiDagang\Pembelian;
use App\Model\AkuntansiDagang\Penjualan;
use App\Model\AkuntansiDagang\Product;

class Stok
{
    public static $id_bisnis;

    public static function StokProses($array){
        $container = array();
        $no = 1;
        $model_produk = Product::all()->where('id_bisnis', self::$id_bisnis);
        foreach ($model_produk as $produk){
            $array =array();
            $model_pembelian = Pembelian::all()->where('product_id', $produk->id)->where('id_bisnis', self::$id_bisnis)->sortBy('tgl_pembelian')->groupBy('tgl_pembelian');
            $array['no'] = $no++;
            $array['nama_barang'] = $produk->nama_barang;

            foreach ($model_pembelian as $tgl => $data){
                $data_stok = array();
                $model_penjualan = Penjualan::where('product_id', $produk->id)->where('id_bisnis', self::$id_bisnis)->where('tgl_penjualan', $tgl)->sum('kwantitas');
                $stok = $data->sum('kwantitas') - $model_penjualan;
                $data_stok['tgl'] = $tgl;
                $data_stok['sisa_stok'] = $stok;
                $array['sub_data'][] = $data_stok;
            }
            $container[] = $array;
        }
        return $container;
    }
}