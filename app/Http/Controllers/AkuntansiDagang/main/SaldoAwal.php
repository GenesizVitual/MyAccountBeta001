<?php

namespace App\Http\Controllers\AkuntansiDagang\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AkuntansiJasa\Jurnal;
use App\Model\AkuntansiJasa\JurnalTransaksiAkun;

class SaldoAwal extends Controller
{
    //

    public function create(){
        return view('AkuntansiDagang.SaldoAwal.create');
    }

    public function store(Request $req){
        $jurnal = new Jurnal();
        $jurnal->tgl_transaksi = $req->tgl_transaksi;
        $jurnal->kode = $req->kode;
        $jurnal->transaksi = $req->transaksi;
        $jurnal->kategori_jurnal = 1;
        $jurnal->id_bisnis = Session::get('id_bisnis');

        if($jurnal->save()){
            $jurnal_transaksi_kas = new JurnalTransaksiAkun();
            $jurnal_transaksi_kas->jurnal_id = $jurnal->id;
            $jurnal_transaksi_kas->akun_transaksi_id = 1;
            $jurnal_transaksi_kas->jum_debet = $req->jumlah_saldo;
            $jurnal_transaksi_kas->jum_kredit = 0;
            $jurnal_transaksi_kas->tgl_jurnal = $jurnal->tgl_transaksi;
            $jurnal_transaksi_kas->kategori_jurnal = $jurnal->kategori_jurnal;
            $jurnal_transaksi_kas->id_bisnis = $jurnal->id_bisnis;
            $jurnal_transaksi_kas->save();

            $jurnal_transaksi_modal = new JurnalTransaksiAkun();
            $jurnal_transaksi_modal->jurnal_id = $jurnal->id;
            $jurnal_transaksi_modal->akun_transaksi_id = 12;
            $jurnal_transaksi_modal->jum_debet =0;
            $jurnal_transaksi_modal->jum_kredit =$req->jumlah_saldo;
            $jurnal_transaksi_modal->tgl_jurnal = $jurnal->tgl_transaksi;
            $jurnal_transaksi_modal->kategori_jurnal = $jurnal->kategori_jurnal;
            $jurnal_transaksi_modal->id_bisnis = $jurnal->id_bisnis;
            $jurnal_transaksi_modal->save();
        }

        return redirect('jurnal-umum');
    }

}
