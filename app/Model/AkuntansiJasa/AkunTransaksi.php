<?php

namespace App\Model\AkuntansiJasa;

use Illuminate\Database\Eloquent\Model;

class AkunTransaksi extends Model
{
    //
    protected $table="akun_transaksi";

    public function LinkToAkun(){
        return $this->belongsTo('App\Model\AkuntansiJasa\Akun','akun_id');
    }
}
