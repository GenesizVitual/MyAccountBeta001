<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 06/06/2020
 * Time: 11:06
 */

namespace App\Http\Controllers\CustomClass\AkuntansiDagang;
use App\Model\AkuntansiDagang\Penjualan as penjualan_;

class Penjualan
{
    public static $id_bisnis;
    public static function penjualan($array){
        $model = penjualan_::all()->where('id_bisnis', self::$id_bisnis)->sortBy('tgl_penjualan');
        $no = 1;
        $container = array();
        foreach ($model as $data){
            $row = array();
            $row['no'] = $no++;
            $row['id_penjualan'] = $data->id;
            $row['tgl'] = $data->tgl_penjualan;
            $row['product'] = $data->LinkToProduk->nama_barang;
            $row['kwantitas'] =  $data->kwantitas;
            $row['harga'] =  $data->harga;
            $row['total'] =  $data->kwantitas*$data->harga;
            $row['pajak'] =  ($data->kwantitas*$data->harga)*0.1;
            $row['status_pembayaran'] =  $data->status_pembayaran;
            $container[] = $row;
        }
        return $container;
    }
}