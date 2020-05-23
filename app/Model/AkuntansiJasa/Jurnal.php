<?php

namespace App\Model\AkuntansiJasa;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    //
    protected $table = "jurnal";

    public function LinkToJurnalTransaksiAkun(){
        return $this->hasMany('App\Model\AkuntansiJasa\JurnalTransaksiAkun','jurnal_id', 'id');
    }

}
