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

Route::get('jurnal-penyesuian', 'AkuntansiJasa\report\JurnalUmum@JurnalPenyesuian');

Route::get('buku-besar-penyesuaian', 'AkuntansiJasa\report\BukuBesar@buku_besar_penyesuaian');

Route::get('neraca-saldo-penyesuaian', 'AkuntansiJasa\report\NeracaSaldo@NeracaSaldoPenyesuaian');
