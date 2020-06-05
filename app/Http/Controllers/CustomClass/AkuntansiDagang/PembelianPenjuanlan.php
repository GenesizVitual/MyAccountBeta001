<?php
/**
 * Created by PhpStorm.
 * User: Fandiansyah
 * Date: 05/06/2020
 * Time: 8:03
 */

namespace App\Http\Controllers\CustomClass\AkuntansiDagang;
use App\Model\AkuntansiJasa\Jurnal as Jurnal;
use App\Model\AkuntansiJasa\JurnalTransaksiAkun;


class PembelianPenjuanlan
{

    public static $akun_tunai_atau_kredit;

    public static function jurnal($object, $transaksi){
        $jurnal = new Jurnal();

        if($object->status_pembayaran=='Cash'){
             self::$akun_tunai_atau_kredit = 1;
        }else{
            self::$akun_tunai_atau_kredit = 24;
        }

        if(!empty($object->tgl_pembelian)){
            $jurnal->tgl_transaksi = $object->tgl_pembelian;
            $jurnal->id_pembelian = $object->id;
        }else{
            $jurnal->tgl_transaksi = $object->tgl_penjualan;
            $jurnal->id_penjualan = $object->id;
        }
        $jurnal->kode = '';
        $jurnal->transaksi = $transaksi;
        $jurnal->kategori_jurnal = 1;
        $jurnal->id_bisnis = $object->id_bisnis;

        $jurnal->save();
        $container = $jurnal;
        return $container;
    }

    public static function pembelian($object){
        $data_jurnal = self::jurnal($object, "Pembelian Barang Dagang");
        if($data_jurnal){
            //Akun Pembelian
            $jurnal_transaksi_persediaan = new JurnalTransaksiAkun();
            $jurnal_transaksi_persediaan->jurnal_id = $data_jurnal->id;
            $jurnal_transaksi_persediaan->akun_transaksi_id = 23;
            $jurnal_transaksi_persediaan->jum_debet = ($object->kwantitas * $object->harga);
            $jurnal_transaksi_persediaan->jum_kredit = 0;
            $jurnal_transaksi_persediaan->id_bisnis = $object->id_bisnis;
            $jurnal_transaksi_persediaan->tgl_jurnal = $object->tgl_pembelian;
            $jurnal_transaksi_persediaan->kategori_jurnal = 1;

            if($jurnal_transaksi_persediaan->save()){

                //PPN Masukan
                $jurnal_transaksi_ppn_masukan = new JurnalTransaksiAkun();
                $jurnal_transaksi_ppn_masukan->jurnal_id = $data_jurnal->id;
                $jurnal_transaksi_ppn_masukan->akun_transaksi_id = 26;
                $jurnal_transaksi_ppn_masukan->jum_debet = $object->jumlah_pajak;
                $jurnal_transaksi_ppn_masukan->jum_kredit = 0;
                $jurnal_transaksi_ppn_masukan->id_bisnis = $object->id_bisnis;
                $jurnal_transaksi_ppn_masukan->tgl_jurnal = $object->tgl_pembelian;
                $jurnal_transaksi_ppn_masukan->kategori_jurnal = 1;

                if($jurnal_transaksi_ppn_masukan->save()){
                    //Kas atau hutang dagang
                    $jurnal_transaksi_kas = new JurnalTransaksiAkun();
                    $jurnal_transaksi_kas->jurnal_id = $data_jurnal->id;
                    $jurnal_transaksi_kas->akun_transaksi_id = self::$akun_tunai_atau_kredit;
                    $jurnal_transaksi_kas->jum_debet = 0;
                    $jurnal_transaksi_kas->jum_kredit = ($object->kwantitas * $object->harga) + $object->jumlah_pajak;
                    $jurnal_transaksi_kas->id_bisnis = $object->id_bisnis;
                    $jurnal_transaksi_kas->tgl_jurnal = $object->tgl_pembelian;
                    $jurnal_transaksi_kas->kategori_jurnal = 1;
                    $jurnal_transaksi_kas->save();
                    return true;
                }
                return true;
            }
            return true;
        }
        return false;
    }

    public static function penjualan($object){
        $data_jurnal = self::jurnal($object, "Penjualan Barang Dagang");
        if($data_jurnal){

            //Kas Atau Utang dagang
            $jurnal_transaksi_persediaan = new JurnalTransaksiAkun();
            $jurnal_transaksi_persediaan->jurnal_id = $data_jurnal->id;
            $jurnal_transaksi_persediaan->akun_transaksi_id = self::$akun_tunai_atau_kredit;
            $jurnal_transaksi_persediaan->jum_debet = ($object->kwantitas * $object->harga);
            $jurnal_transaksi_persediaan->jum_kredit = 0;
            $jurnal_transaksi_persediaan->id_bisnis = $object->id_bisnis;
            $jurnal_transaksi_persediaan->tgl_jurnal = $object->tgl_penjualan;
            $jurnal_transaksi_persediaan->kategori_jurnal = 1;

            if($jurnal_transaksi_persediaan->save()){

                //PPN Keluaran
                $jurnal_transaksi_ppn_keluaran = new JurnalTransaksiAkun();
                $jurnal_transaksi_ppn_keluaran->jurnal_id = $data_jurnal->id;
                $jurnal_transaksi_ppn_keluaran->akun_transaksi_id = 27;
                $jurnal_transaksi_ppn_keluaran->jum_debet = 0;
                $jurnal_transaksi_ppn_keluaran->jum_kredit = $object->jumlah_pajak;
                $jurnal_transaksi_ppn_keluaran->id_bisnis = $object->id_bisnis;
                $jurnal_transaksi_ppn_keluaran->tgl_jurnal = $object->tgl_pembelian;
                $jurnal_transaksi_ppn_keluaran->kategori_jurnal = 1;

                if($jurnal_transaksi_ppn_keluaran->save()){
                    //Penjualan
                    $jurnal_transaksi_kas = new JurnalTransaksiAkun();
                    $jurnal_transaksi_kas->jurnal_id = $data_jurnal->id;
                    $jurnal_transaksi_kas->akun_transaksi_id = 21;
                    $jurnal_transaksi_kas->jum_debet = 0;
                    $jurnal_transaksi_kas->jum_kredit = ($object->kwantitas * $object->harga) + $object->jumlah_pajak;
                    $jurnal_transaksi_kas->id_bisnis = $object->id_bisnis;
                    $jurnal_transaksi_kas->tgl_jurnal = $object->tgl_penjualan;
                    $jurnal_transaksi_kas->kategori_jurnal = 1;
                    $jurnal_transaksi_kas->save();
                    return true;
                }
                return true;
            }
            return true;
        }
        return false;
    }

}