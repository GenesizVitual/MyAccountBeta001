<?php

namespace App\Model\AkuntansiDagang;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    //
    protected $table = 'penjualan';

    protected $fillable = ['tgl_penjualan','product_id','kwantitas','harga','status_pajak','jumlah_pajak','id_bisnis'];
}
