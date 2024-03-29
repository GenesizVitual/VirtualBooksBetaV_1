<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Buku Pengeluaran Barang</title>
    <style>
        table.table_nota{
            width: 100%;

            border: 1px solid black;
            border-collapse: collapse;
        }
        #customers td, #customers th {
            border: 1px solid #0f0f0f;
            padding: 3px;
            height: 20px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('persediaan/page_print.css') }}">
</head>
<body style="background-color: white">
    <div style="background-color: white; padding: 1%">
        <table style="width: 100%; text-align: center">
            <tr>
                <td rowspan="4" style="width: 100px"><img src="{{ asset('persediaan/logo/'.$instansi->logo) }}" alt="Logo tidak ditemukan" style="width:100px;height: 110px; margin-left: 20px"></td>
                <td><h2>BUKU PENGELUARAN BARANG</h2></td>
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
                <th >No</th>
                <th >Tanggal Keluar</th>
                <th >No Urut</th>
                <th >Nama Barang</th>
                <th >Kwantitas</th>
                <th >Harga Barang</th>
                <th >Tota Harga</th>
                <th >Untuk</th>
                <th >Tanggal Penyerahan</th>
                <th style="width: 50px"> Keterangan</th>
            </tr>
            <tr>
                <th >1</th>
                <th width="80">2</th>
                <th >3</th>
                <th >4</th>
                <th >5</th>
                <th >6</th>
                <th >7</th>
                <th width="130">8</th>
                <th width="80">9</th>
                <th >10</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($data))
                @php($no=1)
                @php($no2=1)
                @foreach($data as $data_pengeluaran)
                    <tr>
                        <td style="text-align: center;">{{ $no++ }}</td>
                        <td style="text-align: center;">{{ date('d-m-Y', strtotime($data_pengeluaran['tanggal_keluar'])) }}</td>
                        <td style="text-align: center;">{{ $no2++ }}</td>
                        <td >{{ $data_pengeluaran['nama_barang'] }}</td>
                        <td style="text-align: center;">{{ $data_pengeluaran['banyak_barang'] }}</td>
                        <td >{{ number_format($data_pengeluaran['harga_satuan'],0,'.',',') }}</td>
                        <td >{{ number_format($data_pengeluaran['jumlah_harga'],0,'.',',') }}</td>
                        <td >{{ $data_pengeluaran['bidang'] }}</td>
                        <td style="text-align: center;">{{ date('d-m-Y', strtotime($data_pengeluaran['tanggal_penyerahan'])) }}</td>
                        <td >{{ $data_pengeluaran['keterangan'] }}</td>
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
