<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Buku Besar</title>
    <!-- Custom styles for this template-->
    <link href="{{ asset('Asset/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('Asset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>
<body style="margin-left: 10%; margin-right: 20%">
<center>
<h1>{{ $judul }}</h1>
<h6 style="text-align: center">{{ $bisnis->nama_bisnis }}</h6>
<h6>{{ $bisnis->alamat }}</h6>
<h6>Periode: {{ date('d-m-Y', strtotime($tgl_awal)) }} - {{ date('d-m-Y', strtotime($tgl_akhir)) }}</h6>
<p></p>

@foreach($data as $akun_group)
    <div>
    <p style="font-weight: bold; text-align: left; padding-left: 5%">{{ $akun_group['kode'] }} - {{ $akun_group['nama_akun'] }} </p>
    <table border="1" style="width: 90%">
        <tr style="background-color: lawngreen; font-weight: bold ">
            <td rowspan="2">Tanggal</td>
            <td rowspan="2">No. Transaksi</td>
            <td rowspan="2">Keterangan</td>
            <td rowspan="2">Debet</td>
            <td rowspan="2">Kredit</td>
            <td colspan="2">Saldo</td>
        </tr>
        <tr style="background-color: lawngreen; font-weight: bold ">
            <td>Debet</td>
            <td>Kredit</td>
        </tr>
        @foreach($akun_group['data'] as $akun)
            <tr>
                <td>{{ date('d-m-Y', strtotime($akun['tanggal_jurnal'])) }}</td>
                <td>{{ $akun['nomor_transaksi'] }}</td>
                <td>{{ $akun['keterangan'] }}</td>
                <td>{{ number_format($akun['debet'],2,',','.') }}</td>
                <td>{{ number_format($akun['kredit'],2,',','.') }}</td>
                <td>{{ number_format($akun['saldo_debet'],2,',','.') }}</td>
                <td>{{ number_format($akun['saldo_kredit'],2,',','.') }}</td>
            </tr>
        @endforeach
        <tr style="background-color: #00AAAA; font-weight: bold;">
            <td colspan="3" style="text-align: center; color: white">Total</td>
            <td style="text-align: center; color: white">{{ number_format($akun_group['total_debet'],2,',','.') }}</td>
            <td style="text-align: center; color: white">{{ number_format($akun_group['total_kredit'],2,',','.') }}</td>
            <td colspan="2"></td>
        </tr>
    </table>
    </div>
@endforeach
</center>
</body>
<script>
    window.print();
</script>

</html>