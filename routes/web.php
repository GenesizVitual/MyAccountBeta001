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
    return view('master_akuntansi.base');
});

//============================================= Akuntansi Jasa =========================================================

Route::get('jurnal-umum', 'AkuntansiJasa\report\JurnalUmum@JurnalUmum');

Route::get('buku-besar', 'AkuntansiJasa\report\BukuBesar@buku_besar');

Route::get('neraca-saldo', 'AkuntansiJasa\report\NeracaSaldo@NeracaSaldo');

Route::get('laba-rugi','AkuntansiJasa\report\LabaRugi@LabaRugi');

Route::get('neraca','AkuntansiJasa\report\Neraca@neraca');

Route::get('jurnal-penyesuian', 'AkuntansiJasa\report\JurnalUmum@JurnalPenyesuian');

Route::get('buku-besar-penyesuaian', 'AkuntansiJasa\report\BukuBesar@buku_besar_penyesuaian');

Route::get('neraca-saldo-penyesuaian', 'AkuntansiJasa\report\NeracaSaldo@NeracaSaldoPenyesuaian');

//=============================================== Akuntansi Dagang =====================================================

Route::get('outlate','AkuntansiDagang\main\Outlate@index');

Route::get('saldo-awal-dagang', 'AkuntansiDagang\main\SaldoAwal@create');

Route::post('simpan-saldo-awal-dagang', 'AkuntansiDagang\main\SaldoAwal@store');

Route::get('data-pembelian','AkuntansiDagang\main\Pembelian@index');

Route::get('tambah-pembelian/{range}','AkuntansiDagang\main\Pembelian@list_pembelian');

Route::get('selipkan-pembelian/{kode_pembelian}/{range}','AkuntansiDagang\main\Pembelian@slip_pembelian');

Route::post('pembelian-store','AkuntansiDagang\main\Pembelian@store');

Route::post('ubah-pembelian/{kode}','AkuntansiDagang\main\Pembelian@update');

Route::get('hapus-pembelian/{kode}','AkuntansiDagang\main\Pembelian@delete_pembelian');

Route::get('hapus-item-pembelian/{id}','AkuntansiDagang\main\Pembelian@delete_item_pembelian');

Route::get('data-penjualan','AkuntansiDagang\main\Penjualan@index');

//Route::get('tambah-penjualan','AkuntansiDagang\main\Penjualan@create');
Route::get('tambah-penjualan/{range}','AkuntansiDagang\main\Penjualan@list_penjualan');

Route::post('penjualan-store','AkuntansiDagang\main\Penjualan@store');

Route::post('ubah-penjualan/{kode}','AkuntansiDagang\main\Penjualan@update');

Route::get('selipkan-penjualan/{kode_penjualan}/{range}','AkuntansiDagang\main\Penjualan@slip_penjualan');

Route::get('hapus-penjualan/{kode}','AkuntansiDagang\main\Penjualan@delete_penjualan');

Route::get('hapus-item-penjualan/{id}','AkuntansiDagang\main\Penjualan@delete_item_penjualan');

//********************************************** Laporan Akuntansi Dagang **********************************************

Route::get('laporan-pembelian','AkuntansiDagang\report\Pembelian@index');

Route::get('laporan-penjualan','AkuntansiDagang\report\Penjualan@index');
