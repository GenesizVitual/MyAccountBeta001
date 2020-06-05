<?php

namespace App\Model\AkuntansiDagang;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table ='product';

    protected $fillable = ['nama_barang','satuan','kwantitas','harga_satuan','margin','stok','id_bisnis'];
}
