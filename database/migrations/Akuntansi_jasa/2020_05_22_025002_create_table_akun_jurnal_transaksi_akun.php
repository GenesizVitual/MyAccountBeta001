<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAkunJurnalTransaksiAkun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_transaksi_akun', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurnal_id')->references('id')->on('jurnal')->onDelete('cascade');
            $table->foreignId('akun_transaksi_id')->references('id')->on('akun_transaksi')->onDelete('cascade');
            $table->decimal('jum_debet',12,2);
            $table->decimal('jum_kredit',12,2);
            $table->bigInteger('id_bisnis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurnal_transaksi_akun');
    }
}
