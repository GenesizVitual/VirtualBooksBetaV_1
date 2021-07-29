<?php


namespace App\Http\Controllers\Persediaan\utils\data;

use App\Http\Controllers\Persediaan\utils\data\MutasiBarang;


class BukuPersediaan
{
    public static function data($req = null)
    {
        # Inisialisasi Variable
        if (!empty($req->tgl_awal) && !empty($req->tgl_akhir)) {
            MutasiBarang::$tgl_awal = date('Y-m-d', strtotime($req->tgl_awal));
            MutasiBarang::$tgl_akhir = date('Y-m-d', strtotime($req->tgl_akhir));
        }

        if (!empty($req->klasifikasi_persediaan)) {
            MutasiBarang::$klasifikasi_persediaan = $req->klasifikasi_persediaan;
        }

        if (!empty($req->id_gudang)) {
            MutasiBarang::$id_barang = $req->id_gudang;
        }

        if (!empty($req->id_barang)) {
            MutasiBarang::$id_barang = $req->id_barang;
        }
        $data_mutasi = MutasiBarang::mutasi_barang(null);
        $data_group = self::_group_by($data_mutasi, 'id_barang');
        return $data_group;
    }

    public static function response_buku_persediaan($req = null)
    {
        $data_mutasi = self::data($req)[$req->id_barang]['data'];
        $container = [];
        $no = 1;
        foreach ($data_mutasi as $data) {
            $column = [];
            $column[] = $data['no_urut'];
            $column[] = date('d-m-Y', strtotime($data['tgl']));
            $column[] = $data['uraian'];
            $column[] = $data['bukti'];
            $column[] = $data['no_nota'];
            $column[] = $data['masuk'];
            $column[] = $data['harga_beli'];
            $column[] = $data['total_penerimaan'];
            $column[] = $data['keluar'];
            $column[] = $data['harga_beli'];
            $column[] = $data['total_pengeluaran'];
            $column[] = $data['sisa_pp'];
            $column[] = $data['harga_beli'];
            $column[] = $data['total_akhir'];
            $container[] = $column;
        }
        return $container;
    }

    private static function _group_by($array, $key)
    {
        $return = array();
        foreach ($array as $val) {
            $return[$val[$key]]['barang'] = $val['nm_barang'];
            $return[$val[$key]]['satuan'] = $val['satuan'];
            $return[$val[$key]]['data'][] = $val;
        }
        return $return;
    }
}
