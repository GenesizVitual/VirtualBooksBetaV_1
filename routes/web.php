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

//#admin
Route::resource('user', 'User');
//======================================================================================================================

Route::get('dashboard','Persediaan\Dashboard@index');
Route::resource('instansi','Persediaan\Instansi');
Route::put('instansi/{id}/upload','Persediaan\Instansi@upload');
Route::post('kota-kab/{id}','Apps\Provinsi@getLinkKab');
Route::resource('tahun-anggaran', 'Persediaan\TahunAnggaran');
Route::resource('jenis-tbk','Persediaan\JenisTbk');
Route::resource('penyedia','Persediaan\Penyedia');
Route::resource('bidang','Persediaan\Bidang');
Route::resource('gudang','Persediaan\Gudang');
Route::resource('berwenang','Persediaan\Berwenang');

//======================================================================================================================


Route::get('data-gudang','Persediaan\Gudang@data_gudang');

Route::resource('nota','Persediaan\Nota');
Route::post('edit-nota/{id}','Persediaan\Nota@edit_nota');
Route::post('load-data-nota','Persediaan\Nota@data_nota_pembelian');
Route::get('cetak-nota/{id}','Persediaan\Nota@cetak_nota');

Route::resource('surat-pesanan','Persediaan\SuratPesanan');

Route::resource('pembelian-barang','Persediaan\PembelianBarang');
Route::post('pembelian-barang/{id_nota}/store','Persediaan\PembelianBarang@store_barang');
Route::post('load-data-pembelian/{id_nota}','Persediaan\PembelianBarang@data_pembelian_barang_pernota');
Route::put('load-data-pembelian','Persediaan\PembelianBarang@data_pembelian_barang_perbarang');

Route::resource('distribusi','Persediaan\Distribusi');
Route::get('bagikan-barang/{id}','Persediaan\Distribusi@show');
Route::put('form-data-distribusi','Persediaan\Distribusi@form_distribusi');
Route::put('edit-data-distribusi','Persediaan\Distribusi@edit');
Route::put('delete-data-distribusi/{id}','Persediaan\Distribusi@destroy');

Route::resource('spj-tbk','Persediaan\SPJ');
Route::resource('tbk','Persediaan\TBK');
Route::resource('tbk-nota','Persediaan\TBK_NOTA');
//#admin


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

