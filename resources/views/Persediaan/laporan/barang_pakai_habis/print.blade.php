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
            margin-top: 5cm;
            margin-bottom: 5cm;
        }
        @media print {
            body {margin-top: 10mm; margin-bottom: 50mm;
                margin-left: 0mm; margin-right: 0mm}
        }

    </style>

</head>
<body style="background-color: white">
    <div style="background-color: white; padding: 1%">
        <table style="width: 100%; text-align: center">
            <tr>
                <td rowspan="4" style="width: 100px"><img src="{{ asset('persediaan/logo/'.$instansi->logo) }}" alt="Logo tidak ditemukan" style="width:100px;height: 110px; margin-left: 20px"></td>
                <td><h2>Laporan Barang Pakai Habis</h2></td>
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
                        <td style="text-align: center;">{{ $no++ }}</td>
                        <td style="text-align: center;">{{ date('d-m-Y', strtotime($data_pengeluaran['tanggal_terima'])) }}</td>
                        <td >{{ $data_pengeluaran['nama_barang'] }}</td>
                        <td >{{ $data_pengeluaran['satuan'] }}</td>
                        <td >{{ $data_pengeluaran['banyak_barang'] }}</td>
                        <td >{{ $data_pengeluaran['sp'] }}</td>
                        <td >{{ $data_pengeluaran['tgl_BA'] }}</td>
                        <td >{{ $data_pengeluaran['nomor_BA'] }}</td>

                        <td style="text-align: center;">{{ date('d-m-Y', strtotime($data_pengeluaran['tanggal_keluar'])) }}</td>
                        <td >{{ $data_pengeluaran['bidang'] }}</td>
                        <td >{{ $data_pengeluaran['banyak_barang'] }}</td>
                        <td style="text-align: center;">{{ date('d-m-Y', strtotime($data_pengeluaran['tanggal_penyerahan'])) }}</td>
                        <td style="width: 50px;">{{ $data_pengeluaran['keterangan'] }}</td>
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
<script>
    window.print()
</script>
</html>
