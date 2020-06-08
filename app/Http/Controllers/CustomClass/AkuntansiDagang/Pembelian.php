<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 06/06/2020
 * Time: 11:06
 */

namespace App\Http\Controllers\CustomClass\AkuntansiDagang;
use App\Model\AkuntansiDagang\Pembelian as pembelian_;

class Pembelian
{
    public static $id_bisnis;

    public static function pembelian($array){
        $model = pembelian_::all()->where('id_bisnis', self::$id_bisnis)->sortBy('tgl_pembelian');
        $no = 1;
        $container = array();
        foreach ($model as $data){
            $row = array();
            $row['no'] = $no++;
            $row['id_pembelian'] = $data->id;
            $row['tgl'] = $data->tgl_pembelian;
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