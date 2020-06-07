<?php

namespace App\Model\AkuntansiDagang;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    //

    protected $table = "pembelian";

    protected $fillable = ['tgl_pembelian','product_id','kwantitas','harga','status_pajak','jumlah_pajak','kode','id_bisnis'];

    public function LinkToProduk(){
        return $this->belongsTo('App\Model\AkuntansiDagang\Product','product_id');
    }
}
