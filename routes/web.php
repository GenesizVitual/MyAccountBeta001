<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('jurnal-umum', 'AkuntansiJasa\report\JurnalUmum@JurnalUmum');

Route::get('buku-besar', 'AkuntansiJasa\report\BukuBesar@buku_besar');

Route::get('neraca-saldo', 'AkuntansiJasa\report\NeracaSaldo@NeracaSaldo');

Route::get('laba-rugi','AkuntansiJasa\report\LabaRugi@LabaRugi');

Route::get('neraca','AkuntansiJasa\report\Neraca@neraca');

Route::get('jurnal-penyesuian', 'AkuntansiJasa\report\JurnalUmum@JurnalPenyesuian');

Route::get('buku-besar-penyesuaian', 'AkuntansiJasa\report\BukuBesar@buku_besar_penyesuaian');

Route::get('neraca-saldo-penyesuaian', 'AkuntansiJasa\report\NeracaSaldo@NeracaSaldoPenyesuaian');


//=============================================== Akuntansi Dagang =====================================================

Route::get('saldo-awal-dagang', 'AkuntansiDagang\main\SaldoAwal@create');

Route::post('simpan-saldo-awal-dagang', 'AkuntansiDagang\main\SaldoAwal@store');

Route::get('pembelian','AkuntansiDagang\main\Pembelian@create');

Route::post('pembelian-store','AkuntansiDagang\main\Pembelian@store');

Route::get('penjualan','AkuntansiDagang\main\Penjualan@create');

Route::post('penjualan-store','AkuntansiDagang\main\Penjualan@store');
