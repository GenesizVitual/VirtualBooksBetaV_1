<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Mutasi Persediaan</title>
    <style>
        table.table_nota{
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
            padding-left: 30px;
        }


        @page {
            size: legal landscape;
            margin-left: 50px;
        }

    </style>

</head>
<body style="background-color: grey">
    <div style="background-color: white; padding: 1%">
        <table style="width: 100%; text-align: center">
            <tr>
                <td rowspan="4" style="width: 100px"><img src="{{ asset('persediaan/logo/'.$instansi->logo) }}" alt="Logo tidak ditemukan" style="width:100px;height: 110px; margin-left: 20px"></td>
                <td>
                    <h2>LAPORAN MUTASI PERSEDIAAN</h2>
                </td>
                <td rowspan="4"> </td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
        <br>
        <table style="font-weight: bold;">
            <tr>
                <td>Instansi</td>
                <td>:</td>
                <td>{{ $instansi->name_instansi }}</td>
            </tr>
            <tr>
                <td>Kab/Kota</td>
                <td>:</td>
                <td>{{ $instansi->BelongsToKabupatenKot->nama }}</td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td>:</td>
                <td>{{ $instansi->BelongsToProvinsi->nama }}</td>
            </tr>
        </table>
        <br>
        <table class="table_nota" role="grid" border="1">
            <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Nama Barang</th>
                <th colspan="3">Saldo Awal</th>
                <th colspan="6">Mutasi</th>
                <th colspan="2">Saldo Akhir</th>
            </tr>
            <tr>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Total</th>
                <th>Penerimaan</th>
                <th>Harga Beli</th>
                <th>Total Penerimaan</th>
                <th>Pengeluaran</th>
                <th>Harga Beli</th>
                <th>Total Pengeluaran</th>
                <th>Sisa Barang</th>
                <th>Jumlah Akhir</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($data))
                @php($no=1)

                @foreach($data as $data_mutasi)
                    <tr>
                        <td >{{ $no++ }}</td>
                        <td >{{ date('d-m-Y', strtotime($data_mutasi['tgl'])) }}</td>
                        <td >{{ $data_mutasi['nm_barang'] }}</td>
                        <td >{{ $data_mutasi['sisa'] }}</td>
                        <td >{{ $data_mutasi['satuan'] }}</td>
                        <td >{{ $data_mutasi['total'] }}</td>
                        <td >{{ $data_mutasi['masuk'] }}</td>
                        <td >{{ $data_mutasi['harga_beli'] }}</td>
                        <td >{{ $data_mutasi['total_penerimaan'] }}</td>
                        <td >{{ $data_mutasi['keluar'] }}</td>
                        <td >{{ $data_mutasi['harga_beli'] }}</td>
                        <td >{{ $data_mutasi['total_pengeluaran'] }}</td>
                        <td >{{ $data_mutasi['sisa_pp'] }}</td>
                        <td >{{ $data_mutasi['total_akhir'] }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <br>
        <br>
        <table style="width: 100%;">
            <tr>
                <td colspan="2" style="text-align: right;font-weight: bold; height: 80px">{{ $instansi->BelongsToKabupatenKot->nama }}, {{ $tgl_cetak }}</td>
            </tr>
            <tr style="text-align: center;font-weight: bold;">
                <td>{{ $jabatan_1 }}</td>
                <td>{{ $jabatan_2 }}</td>
            </tr>
            <tr style="text-align: center; font-weight: bold;">
                <td style="height: 100px"><label style="text-decoration: underline">{{ $berwenang_1->nama }}</label> <br> {{ $berwenang_1->nip }}</td>
                <td style="height: 100px"><label style="text-decoration: underline">{{ $berwenang_2->nama }}</label> <br> {{ $berwenang_2->nip }}</td>
            </tr>
        </table>
    </div>
</body>
</html>