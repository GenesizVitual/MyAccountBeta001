<?php

namespace App\Model\AkuntansiDagang;

use Illuminate\Database\Eloquent\Model;

class Bisnis extends Model
{
    //
    protected $table = "bisnis";

    protected $fillable = ['nama_bisnis','jenis_bisnis','alamat','gambar','longitude','langitude','user_id'];
}
