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

    public static $begin_date_a_year;
    public static $end_date_a_year;


    public static function set_date_(){
        self::$begin_date_a_year = date('Y-01-01');
        self::$end_date_a_year = date('Y-12-31');
    }

    public static function penjualan($array){
        $model = penjualan_::where('id_bisnis', self::$id_bisnis)->whereBetween('tgl_penjualan',[self::$begin_date_a_year, self::$end_date_a_year]);
        $no = 1;
        $container = array();
        foreach ($model->orderBy('tgl_penjualan','asc')->get() as $data){
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