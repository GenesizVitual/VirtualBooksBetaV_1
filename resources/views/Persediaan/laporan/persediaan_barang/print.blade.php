<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Buku Penerimaan Barang</title>
    <style>
        body{
            margin: 0px;
        }
        table.table_nota{
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }


        #customers td, #customers th {
            border: 1px solid #0f0f0f;
            padding: 3px;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('persediaan/page_print.css') }}">
</head>
<body style="background-color: white">
    <div style="background-color: white; padding: 1%">
        <table style="width: 12in; text-align: center">
            <tr>
                <td rowspan="4" style="width: 100px"><img src="{{ asset('persediaan/logo/'.$instansi->logo) }}" alt="Logo tidak ditemukan" style="width:100px;height: 110px; margin-left: 20px"></td>
                <td><h2>BUKU PENERIMAAN BARANG</h2></td>
                <td rowspan="4"> </td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
        <br>
        <table style="font-weight: bold;" >
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
        <table style="width: 100%; " class="table_nota" role="grid" id="customers" border="1">
            <thead>
            <tr>
                <th rowspan="2" style="width: 30px">#</th>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Dari</th>
                <th colspan="2">Dokumen Faktur</th>
                <th rowspan="2">Nama Barang</th>
                <th rowspan="2">Kwantitas</th>
                <th rowspan="2">Harga Satuan</th>
                <th rowspan="2">Jumlah Harga</th>
                <th colspan="2">Bukti Penerimaan <br> BA. Penerimaan</th>
                <th rowspan="2" width="50"> Keterangan</th>
            </tr>
            <tr>
                <th>Nomor</th>
                <th>Tanggal</th>
                <th>Nomor</th>
                <th>Tanggal</th>
            </tr>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
                <th>11</th>
                <th>12</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($data))
                @foreach($data as $data_persediaan)
                    <tr>
                        <td style="text-align: center">{{ $data_persediaan['no'] }}</td>
                        <td>{{ $data_persediaan['tanggal_pembelian'] }}</td>
                        <td>{{ $data_persediaan['penyedia'] }}</td>
                        <td>{{ $data_persediaan['nomor_faktur'] }}</td>
                        <td>{{ $data_persediaan['tgl_faktur'] }}</td>
                        <td>{{ $data_persediaan['nama_barang'] }}</td>
                        <td>{{ number_format($data_persediaan['banyak_barang'],2,',','.') }}</td>
                        <td>{{ number_format($data_persediaan['harga_barang'],2,',','.') }}</td>
                        <td>{{ number_format($data_persediaan['jumlah_harga'],2,',','.') }}</td>
                        <td>{{ $data_persediaan['BA_nomor'] }}</td>
                        <td>{{ $data_persediaan['BA_tanggal'] }}</td>
                        <td>{{ $data_persediaan['keterangan'] }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <br>
        <br>
        <table style="width: 12in;">
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
