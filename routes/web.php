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

Route::get('jurnal','AkuntansiJasa\main\Akuntansi@create');

Route::post('store-jurnal','AkuntansiJasa\main\Akuntansi@store');

Route::get('ubah-jurnal/{id}','AkuntansiJasa\main\Akuntansi@edit');

Route::post('updates-jurnal/{id}','AkuntansiJasa\main\Akuntansi@update');

Route::post('hapus-jurnal/{id}','AkuntansiJasa\main\Akuntansi@delete');

Route::get('detail-jurnal/{id_jurnal}','AkuntansiJasa\main\Akuntansi@detail_jurnal');

Route::get('detail-jurnal/{id_jurnal}/create','AkuntansiJasa\main\Akuntansi@create_akun');

Route::post('store-akun/{id_jurnal}','AkuntansiJasa\main\Akuntansi@store_akun');

Route::post('update-jurnal/{id_jurnal}','AkuntansiJasa\main\Akuntansi@update_akun');

Route::post('delete-akun/{id_akun}','AkuntansiJasa\main\Akuntansi@delete_akun');

Route::get('jurnal-umum', 'AkuntansiJasa\report\JurnalUmum@JurnalUmum');

Route::get('buku-besar', 'AkuntansiJasa\report\BukuBesar@buku_besar');

Route::post('ceta-buku-besar', 'AkuntansiJasa\report\BukuBesar@cetak_buku_besar');


Route::get('neraca-saldo', 'AkuntansiJasa\report\NeracaSaldo@NeracaSaldo');

Route::post('ceta-neraca-saldo', 'AkuntansiJasa\report\NeracaSaldo@CetakNeracaSaldo');

Route::get('laba-rugi','AkuntansiJasa\report\LabaRugi@LabaRugi');

Route::post('cetak-laba-rugi','AkuntansiJasa\report\LabaRugi@CetakLabaRugi');

Route::get('neraca','AkuntansiJasa\report\Neraca@neraca');

Route::post('ceta-neraca','AkuntansiJasa\report\Neraca@cetak_neraca');

Route::get('jurnal-penyesuian', 'AkuntansiJasa\report\JurnalUmum@JurnalPenyesuian');

Route::get('buku-besar-penyesuaian', 'AkuntansiJasa\report\BukuBesar@buku_besar_penyesuaian');

Route::get('neraca-saldo-penyesuaian', 'AkuntansiJasa\report\NeracaSaldo@NeracaSaldoPenyesuaian');

//=============================================== Akuntansi Dagang =====================================================

Route::get('outlate','AkuntansiDagang\main\Outlate@index');

Route::get('ubah-outlate/{id}','AkuntansiDagang\main\Outlate@edit');

Route::post('update-outlate/{id}','AkuntansiDagang\main\Outlate@update');

Route::get('karyawan','User@index');

Route::get('tambah-karyawan','User@create');

Route::post('store-karyawan','User@store_karyawan');

Route::get('ubah-karyawan/{id}','User@edit');

Route::post('delete-produk/{id}','User@delete_produk');

Route::post('update-karyawan/{id}','User@update_karyawan');

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

// ============================================ POS ====================================================================
Route::get('pos/{range}','AkuntansiDagang\main\POS@list_post');

Route::get('selipkan-penjualan-pos/{kode_penjualan}','AkuntansiDagang\main\POS@slip_penjualan');

Route::get('cetak-penjualan/{kode}','AkuntansiDagang\main\POS@cetak_stuck');

Route::post('prev','AkuntansiDagang\main\POS@lihat_belanja' );

Route::post('list-produk','AkuntansiDagang\main\POS@plug_produk');


//********************************************** Laporan Akuntansi Dagang **********************************************

Route::get('laporan-pembelian','AkuntansiDagang\report\Pembelian@index');

Route::post('print-pembelian','AkuntansiDagang\report\Pembelian@print_pembelian');

Route::get('laporan-penjualan','AkuntansiDagang\report\Penjualan@index');

Route::post('print-penjualan','AkuntansiDagang\report\Penjualan@print_penjualan');

Route::get('laporan-stok','AkuntansiDagang\report\StokProduk@index');

Route::post('print-stok','AkuntansiDagang\report\StokProduk@cetak_stok');
