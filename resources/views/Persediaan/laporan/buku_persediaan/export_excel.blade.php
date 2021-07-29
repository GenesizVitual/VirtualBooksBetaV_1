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

        #customers td, #customers th {
            border: 1px solid #0f0f0f;
            padding: 3px;
        }

        @page {
            size: legal landscape;
            margin-left: 50px;
        }

    </style>

</head>
<body style="background-color: grey">
    <div style="background-color: white; padding: 1%">
        <table class="table_nota" id="customers" role="grid" border="1">
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
                        <td style="width: 20px">{{ date('d-m-Y', strtotime($data_mutasi['tgl'])) }}</td>
                        <td style="width: 30px">{{ $data_mutasi['nm_barang'] }}</td>
                        <td style="width: 20px">{{ $data_mutasi['sisa'] }}</td>
                        <td style="width: 20px">{{ $data_mutasi['satuan'] }}</td>
                        <td style="width: 20px">{{ $data_mutasi['total'] }}</td>
                        <td style="width: 20px">{{ $data_mutasi['masuk'] }}</td>
                        <td style="width: 20px">{{ $data_mutasi['harga_beli'] }}</td>
                        <td style="width: 20px">{{ $data_mutasi['total_penerimaan'] }}</td>
                        <td style="width: 20px">{{ $data_mutasi['keluar'] }}</td>
                        <td style="width: 20px">{{ $data_mutasi['harga_beli'] }}</td>
                        <td style="width: 20px">{{ $data_mutasi['total_pengeluaran'] }}</td>
                        <td style="width: 20px">{{ $data_mutasi['sisa_pp'] }}</td>
                        <td style="width: 20px">{{ $data_mutasi['total_akhir'] }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</body>
</html>