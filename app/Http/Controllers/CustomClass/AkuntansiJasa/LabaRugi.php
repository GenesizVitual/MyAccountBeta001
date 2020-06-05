<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 23/05/2020
 * Time: 13:56
 */

namespace App\Http\Controllers\CustomClass\AkuntansiJasa;
use App\Http\Controllers\CustomClass\AkuntansiJasa\NeracaSaldo;
use App\Model\AkuntansiJasa\Akun;

class LabaRugi
{
    public static $kategori_jurnal;
    public static $id_bisnis;

    public static $key_laba = [
        'Akun Pendapatan'=>4,
        'Akun Beban'=>5,
    ];

    public static function LabaRugi($array){
        NeracaSaldo::$kategori_junal = self::$kategori_jurnal;
        NeracaSaldo::$id_bisnis = self::$id_bisnis;
        $data = NeracaSaldo::NeracaSaldo('');
        $data_akun = Akun::all()->where('buku_besar_id',2);
        $container = array();
        $total_laba_bersih = 0;
        foreach ($data_akun as $data_akun){
            $total_akun = 0;
            $row = array();
            foreach ($data_akun->LinkToAkunJurnalTransaksi()->get() as $data_akun_transaksi){
                if(!empty($data['data'][$data_akun_transaksi->kode])){
                    $total_akun +=$data['data'][$data_akun_transaksi->kode]['saldo_debet']+$data['data'][$data_akun_transaksi->kode]['saldo_kredit'];
                    $row[] = $data['data'][$data_akun_transaksi->kode];
                    $container[$data_akun->akun_lv2]['data'] = $row;
                    $container[$data_akun->akun_lv2]['total'] = $total_akun;
                    $container[$data_akun->akun_lv2]['akun_id'] = $data_akun_transaksi->akun_id;
                }
            }
        }
         $laba_bersih = self::Laba_bersih($container);
        $container['Total']=$laba_bersih;
        return $container;
    }

    public static function Laba_bersih($conainer){
        $total_laba = 0;
        if(!empty($conainer)){
             foreach (self::$key_laba as $key => $id){
               if(!empty($conainer[$key]['akun_id'])){
                    if($conainer[$key]['akun_id'] == 4){
                        $total_laba += $conainer[$key]['total'];
                    }else{
                        $total_laba -=$conainer[$key]['total'];
                    }
               }
            }
        }
        return $total_laba;
    }
}