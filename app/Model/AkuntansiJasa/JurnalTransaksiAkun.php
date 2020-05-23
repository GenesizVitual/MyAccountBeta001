<?php

namespace App\Model\AkuntansiJasa;

use Illuminate\Database\Eloquent\Model;

class JurnalTransaksiAkun extends Model
{
    //
    protected $table = "jurnal_transaksi_akun";

    public function LinkToJurnal(){
        return $this->belongsTo('App\Model\AkuntansiJasa\Jurnal', 'jurnal_id');
    }

    public function LinkToAkunTransaksi(){
        return $this->belongsTo('App\Model\AkuntansiJasa\AkunTransaksi', 'akun_transaksi_id');
    }
}
