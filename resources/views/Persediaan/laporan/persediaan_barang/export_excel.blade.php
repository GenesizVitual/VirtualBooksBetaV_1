<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Buku Penerimaan Barang</title>
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
       <table class="table_nota" role="grid" id="customers" border="1">
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
                <th rowspan="2"> Keterangan</th>
            </tr>
            <tr>
                <th>Nomor</th>
                <th>Tanggal</th>
                <th>Nomor</th>
                <th>Tanggal</th>
            </tr>
            <tr style="text-align: center;">
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
                        <td style="text-align: center; width: 10px;">{{ $data_persediaan['no'] }}</td>
                        <td style="width: 20px;">{{ $data_persediaan['tanggal_pembelian'] }}</td>
                        <td style="width: 20px;">{{ $data_persediaan['penyedia'] }}</td>
                        <td style="width: 20px;">{{ $data_persediaan['nomor_faktur'] }}</td>
                        <td style="width: 20px;">{{ $data_persediaan['tgl_faktur'] }}</td>
                        <td style="width: 20px;">{{ $data_persediaan['nama_barang'] }}</td>
                        <td style="width: 20px;">{{ number_format($data_persediaan['banyak_barang'],2,',','.') }}</td>
                        <td style="width: 20px;">{{ number_format($data_persediaan['harga_barang'],2,',','.') }}</td>
                        <td style="width: 20px;">{{ number_format($data_persediaan['jumlah_harga'],2,',','.') }}</td>
                        <td style="width: 20px;">{{ $data_persediaan['BA_nomor'] }}</td>
                        <td style="width: 20px;">{{ $data_persediaan['BA_tanggal'] }}</td>
                        <td style="width: 20px;">{{ $data_persediaan['keterangan'] }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</body>
</html>