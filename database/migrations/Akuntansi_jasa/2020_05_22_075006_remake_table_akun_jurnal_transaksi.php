<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemakeTableAkunJurnalTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jurnal_transaksi_akun', function (Blueprint $table) {
            $table->date('tgl_jurnal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jurnal_transaksi_akun', function (Blueprint $table) {
            //
        });
    }
}
