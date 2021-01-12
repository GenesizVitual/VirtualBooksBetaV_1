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
    return redirect('login');
});

Route::get('login', 'User@login');
Route::get('log-out', 'User@LogOut');
Route::get('register', 'User@register');
Route::post('login-check','User@Usercheck');
Route::resource('user', 'User');

//
//Route::get('jurnal-umum', 'Akuntansi\AkuntansiJasa\report\JurnalUmum@JurnalUmum');
//
//Route::get('buku-besar', 'Akuntansi\AkuntansiJasa\report\BukuBesar@buku_besar');
//
//Route::post('ceta-buku-besar', 'Akuntansi\AkuntansiJasa\report\BukuBesar@cetak_buku_besar');
//
//Route::get('neraca-saldo', 'Akuntansi\AkuntansiJasa\report\NeracaSaldo@NeracaSaldo');
//
//Route::post('ceta-neraca-saldo', 'Akuntansi\AkuntansiJasa\report\NeracaSaldo@CetakNeracaSaldo');
//
//Route::get('laba-rugi','Akuntansi\AkuntansiJasa\report\LabaRugi@LabaRugi');
//
//Route::post('cetak-laba-rugi','Akuntansi\AkuntansiJasa\report\LabaRugi@CetakLabaRugi');
//
//Route::get('neraca','Akuntansi\AkuntansiJasa\report\Neraca@neraca');
//
//Route::post('ceta-neraca','Akuntansi\AkuntansiJasa\report\Neraca@cetak_neraca');
//
//Route::get('jurnal-penyesuian', 'Akuntansi\AkuntansiJasa\report\JurnalUmum@JurnalPenyesuian');
//
//Route::get('buku-besar-penyesuaian', 'Akuntansi\AkuntansiJasa\report\BukuBesar@buku_besar_penyesuaian');
//
//Route::get('neraca-saldo-penyesuaian', 'Akuntansi\AkuntansiJasa\report\NeracaSaldo@NeracaSaldoPenyesuaian');

