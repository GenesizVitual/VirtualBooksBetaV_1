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
Route::get('cetak-surat-pesanan/{id_nota}','Persediaan\SuratPesanan@cetak');

Route::resource('pembelian-barang','Persediaan\PembelianBarang');
Route::post('pembelian-barang/{id_nota}/store','Persediaan\PembelianBarang@store_barang');
Route::post('load-data-pembelian/{id_nota}','Persediaan\PembelianBarang@data_pembelian_barang_pernota');
Route::put('load-data-pembelian','Persediaan\PembelianBarang@data_pembelian_barang_perbarang');

Route::resource('distribusi','Persediaan\Distribusi');
Route::get('bagikan-barang/{id}','Persediaan\Distribusi@show');
Route::put('form-data-distribusi','Persediaan\Distribusi@form_distribusi');
Route::put('edit-data-distribusi','Persediaan\Distribusi@edit');
Route::put('delete-data-distribusi/{id}','Persediaan\Distribusi@destroy');

Route::resource('surat-permintaan','Persediaan\SuratPermintaan');
Route::get('buat-surat/{id_bidang}/{tgl}','Persediaan\SuratPermintaan@created_surat');

Route::resource('surat-pengeluaran','Persediaan\SuratPengeluaran');
Route::get('buat-surat-pengeluaran/{id_surat_pemintaan}','Persediaan\SuratPengeluaran@created_surat');

Route::resource('spj-tbk','Persediaan\SPJ');
Route::resource('tbk','Persediaan\TBK');
Route::resource('tbk-nota','Persediaan\TBK_NOTA');

#laporan
Route::get('laporan','Persediaan\MasterLaporan@index');
# Preview Daftar Nota
Route::get('daftar-nota','Persediaan\MasterLaporan@preview_data_daftar_nota');
# Cetak Daftar Nota
Route::post('cetak-data-nota','Persediaan\MasterLaporan@print_data_daftar_nota');
# Preview Rekapitulasi Persediaan Nota
Route::get('rekapitulasi-persediaan','Persediaan\MasterLaporan@preview_data_rekapitulasi_persediaan');
# Cetak Data rekapitulasi persediaan
Route::post('cetak-rekapitulasi-persediaan','Persediaan\MasterLaporan@print_data_rekapitulasi_persediaan');
# Preview Rekapitulasi Persediaan Per Jenis TBK
Route::get('rekapitulasi-persediaan-perjenis-tbk','Persediaan\MasterLaporan@preview_data_rekapitulasi_persediaan_perjenis_tbk');
# Cetak Data rekapitulasi persediaan Per Jenis TBK
Route::post('cetak-rekapitulasi-persediaan-perjenis-tbk','Persediaan\MasterLaporan@print_data_rekapitulasi_persediaan_per_jenis_tbk');
# Preview Persediaan Barang
Route::get('persediaan-barang','Persediaan\MasterLaporan@preview_data_persediaan_barang');
# Cetak Data rekapitulasi persediaan Per Jenis TBK
Route::post('cetak-persediaan-barang','Persediaan\MasterLaporan@print_data_persediaan_barang');
# Preview Pengeluaran Barang
Route::get('pengeluaran-barang','Persediaan\MasterLaporan@preview_data_pengeluaran_barang');
# Cetak Pengeluaran Barang
Route::post('cetak-pengeluaran-barang','Persediaan\MasterLaporan@print_data_pengeluaran_barang');
# Preview Barang Pakai Habis
Route::get('barang-pakai-habis','Persediaan\MasterLaporan@preview_data_barang_barang_pakai_habis');
# Cetak Pengeluaran Barang
Route::post('cetak-barang-pakai-habis','Persediaan\MasterLaporan@print_data_barang_pakai_habis');
# Preview Barang Semester
Route::get('semester','Persediaan\MasterLaporan@preview_data_semester');
# Cetak Semeter
Route::post('cetak-semester','Persediaan\MasterLaporan@print_data_barang_semester');
# Preview Barang Semester
Route::get('kartu-barang','Persediaan\MasterLaporan@preview_kartu_barang');




# setting laporan berwenang


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

