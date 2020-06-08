<?php

namespace App\Model\AkuntansiDagang;

use Illuminate\Database\Eloquent\Model;

class Bisnis extends Model
{
    //
    protected $table = "bisnis";

    protected $fillable = ['nama_bisnis','jenis_bisnis','alamat','negara','kota','kab','gambar','longitude','langitude','user_id'];

    public function LinkToProduk(){
        return $this->hasMany('App\Model\AkuntansiDagang\Product','id_bisnis', 'id');
    }
}
