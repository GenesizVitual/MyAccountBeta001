<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_penjualan');
            $table->bigInteger('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->integer('kwantitas');
            $table->decimal('harga', 12,4);
            $table->enum('status_pajak',[0,1])->default(0);
            $table->decimal('jumlah_pajak', 12,4);
            $table->string('kode');
            $table->bigInteger('id_bisnis')->references('id')->on('bisnis')->onDelete('cascade');
            $table->enum('status_pembayaran',['Cash','Kredit'])->default('Cash');
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
        Schema::dropIfExists('penjualan');
    }
}
