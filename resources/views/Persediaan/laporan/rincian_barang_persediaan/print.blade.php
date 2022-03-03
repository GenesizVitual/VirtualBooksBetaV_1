<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Rincian barang Pakai Habis</title>
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
    </style>
    <link rel="stylesheet" href="{{ asset('persediaan/page_print.css') }}">
</head>
<body style="background-color: white">
    <div style="background-color: white; padding: 1%">
        <table style="width: 100%; text-align: center">
            <tr>
                <td rowspan="4" style="width: 100px"><img src="{{ asset('persediaan/logo/'.$instansi->logo) }}" alt="Logo tidak ditemukan" style="width:100px;height: 110px; margin-left: 20px"></td>
                <td>
                    <h2>RINCIAN PERSEDIAAN HABIS PAKAI BERDASARKAN KLASIFIKASI BARANG <br> PER 30 DESEMBER {{ $current_years }}</h2>
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
        <table class="table_nota" id="customers" role="grid" border="1">
            <thead>
            <tr>
                <th>No</th>
                <th>SKPD</th>
                @foreach($klasifikasi as $item_klasifikasi)
                    <th>{{ $item_klasifikasi->nama }}</th>
                @endforeach
                <th>Jumlah</th>
            </tr>
            <tr>
                <th>1</th>
                <th>2</th>
                @php($number_column=2)
                @foreach($klasifikasi as $column_klasifikasi)
                    <th>{{ $number_column++ }}</th>
                @endforeach
                <th>{{ $number_column++ }}</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($data))
                @foreach($data  as $data_rekap)
                    <tr>
                        <td>{{ $data_rekap['no'] }}</td>
                        <td>{{ $data_rekap['skpd'] }}</td>
                        @php($number_column=2)
                        @foreach($klasifikasi as $column_klasifikasi)
                            <td>{{ $data_rekap[$column_klasifikasi->id] }}</td>
                        @endforeach
                        <td>{{ $data_rekap['jumlah'] }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

    </div>
</body>
</html>
