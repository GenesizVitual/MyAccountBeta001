<?php

namespace App\Model\AkuntansiDagang;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table ='product';

    protected $fillable = ['nama_barang','gambar','satuan','margin','harga','stok','id_bisnis'];
}
