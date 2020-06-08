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

Route::get('/', 'Aisyah\MakananLocal@index');

Route::get('rumah-makan','Aisyah\MakananLocal@outlate');

Route::get('get-lokasi','Aisyah\MakananLocal@getLatlong');

Route::get('detail-outlate/{id}','Aisyah\MakananLocal@detail_outlate');

Route::get('tentang','Aisyah\MakananLocal@tentang');

Route::get('login',function(){
    return view('webpage.register_dan_login.login');
});

Route::get('register',function(){
    return view('webpage.register_dan_login.register');
});

Route::post('register-post', 'User@store');

Route::post('login-post', 'User@login');

Route::get('logout','User@out');

//============================================= Akuntansi Jasa =========================================================

Route::get('akuntansi', 'AkuntansiJasa\main\Akuntansi@index');

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

Route::get('ubah-outlate/{id}','AkuntansiDagang\main\Outlate@edit');

Route::post('update-outlate/{id}','AkuntansiDagang\main\Outlate@update');

Route::get('daftar-produk','AkuntansiDagang\main\Product@index');

Route::get('tambah-produk','AkuntansiDagang\main\Product@create');

Route::post('store-produk','AkuntansiDagang\main\Product@store');

Route::get('ubah-produk/{id}','AkuntansiDagang\main\Product@edit');

Route::post('update-produk/{id}','AkuntansiDagang\main\Product@update');

Route::post('delete-produk/{id}','AkuntansiDagang\main\Product@delete');


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

Route::get('pos/{range}','AkuntansiDagang\main\Penjualan@list_post');

Route::get('cetak-penjualan/{kode}','AkuntansiDagang\main\Penjualan@cetak_stuck');

Route::post('prev','AkuntansiDagang\main\Penjualan@lihat_belanja' );
//********************************************** Laporan Akuntansi Dagang **********************************************

Route::get('laporan-pembelian','AkuntansiDagang\report\Pembelian@index');

Route::get('laporan-penjualan','AkuntansiDagang\report\Penjualan@index');
