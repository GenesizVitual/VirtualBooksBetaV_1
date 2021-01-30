<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Pakai Habis</title>
    <style>
        table.table_nota{
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        #customers td, #customers th {
            border: 1px solid #0f0f0f;
            padding: 3px;
        }

        @page {
            size: legal landscape;
            margin-left: 100px;
        }

    </style>

</head>
<body style="background-color: grey">
    <div style="background-color: white; padding: 1%">
        <table class="table_nota" id="customers" role="grid" border="1">
            <thead>
            <tr>
                <th rowspan="2" style="width: 30px;">No</th>
                <th rowspan="2">Tanggal Terima</th>
                <th rowspan="2">Nama Barang</th>
                <th rowspan="2">Satuan</th>
                <th rowspan="2">Jumlah Satuan</th>
                <th rowspan="2">SP/SPK</th>
                <th colspan="2">Berita Acara</th>
                <th rowspan="2">Tanggal Keluar</th>
                <th rowspan="2">Diserahkan Kepada</th>
                <th rowspan="2">Jumlah Satuan</th>
                <th rowspan="2">Tanggal Penyerahan</th>
                <th rowspan="2"> Keterangan</th>
            </tr>
            <tr>
                <th>Tanggal</th>
                <th>Nomor</th>
            </tr>
            <tr>
                <th >1</th>
                <th >2</th>
                <th >3</th>
                <th >4</th>
                <th >5</th>
                <th >6</th>
                <th >7</th>
                <th >8</th>
                <th >9</th>
                <th >10</th>
                <th >11</th>
                <th >12</th>
                <th >13</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($data))
                @php($no=1)
                @php($no2=1)
                @foreach($data as $data_pengeluaran)
                    <tr>
                        <td style="text-align: center;width: 5px;">{{ $no++ }}</td>
                        <td style="text-align: center;width: 20px;">{{ date('d-m-Y', strtotime($data_pengeluaran['tanggal_terima'])) }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['nama_barang'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['satuan'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['banyak_barang'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['sp'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['tgl_BA'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['nomor_BA'] }}</td>

                        <td style="text-align: center;width: 20px;">{{ date('d-m-Y', strtotime($data_pengeluaran['tanggal_keluar'])) }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['bidang'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['banyak_barang'] }}</td>
                        <td style="text-align: center;width: 20px;">{{ date('d-m-Y', strtotime($data_pengeluaran['tanggal_penyerahan'])) }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['keterangan'] }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

    </div>
</body>
</html>