<?php

namespace App\Imports;

//use App\tbl_gudang;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Model\Persediaan\Gudang;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Session;

class GudangImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Gudang::firstOrCreate([
            'nama_barang'=> $row[1],
            ],
            ['id_instansi'=> Session::get('id_instansi')]
        );
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        // TODO: Implement startRow() method.
        return 2;
    }
}
