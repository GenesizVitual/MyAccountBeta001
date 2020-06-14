<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelPembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pembelian');
            $table->bigInteger('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->integer('kwantitas');
            $table->decimal('harga', 12,4);
            $table->enum('status_pajak',[0,1])->default(0);
            $table->decimal('jumlah_pajak', 12,4);
            $table->enum('status_pembayaran',['Cash','Kredit'])->default('Cash');
            $table->string('kode');
            $table->bigInteger('id_bisnis')->references('id')->on('bisnis')->onDelete('cascade');
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
        Schema::dropIfExists('pembelian');
    }
}
