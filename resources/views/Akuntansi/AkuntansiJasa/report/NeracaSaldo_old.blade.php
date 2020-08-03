<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Neraca Saldo</title>
    <link href="{{ asset('Asset/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('Asset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>
<body  style="margin-left: 10%; margin-right: 20%">
<center>
<h1>{{ $judul }}</h1>
<h6 style="text-align: center">{{ $bisnis->nama_bisnis }}</h6>
<h6>{{ $bisnis->alamat }}</h6>
<h6>Periode: {{ date('d-m-Y', strtotime($tgl_awal)) }} - {{ date('d-m-Y', strtotime($tgl_akhir)) }}</h6>
<p></p>
    <table border="1" style="width: 90%">
        <tr>
            <td>Kode</td>
            <td>Keterangan</td>
            <td>Debet</td>
            <td>Kredit</td>
        </tr>
        @php($saldo_debet=0)
        @php($saldo_kredit=0)
        @foreach($data['data'] as $daftar_akun)
            @php($saldo_debet = abs($daftar_akun['saldo_debet']))
            @php($saldo_kredit = abs($daftar_akun['saldo_kredit']))
            <tr>
                <td>{{ $daftar_akun['kode'] }}</td>
                <td>{{ $daftar_akun['nama_akun'] }}</td>
                <td>{{ number_format($saldo_debet,2,',','.') }}</td>
                <td>{{ number_format($saldo_kredit,2,',','.') }}</td>
            </tr>
        @endforeach
        <tr style="background-color: #00AAAA; font-weight: bold;">
            <td colspan="2" style="text-align: center; color: white">Total</td>
            <td style="text-align: center; color: white">{{ number_format($data['total_debet'],2,',','.') }}</td>
            <td style="text-align: center; color: white">{{ number_format($data['total_kredit'],2,',','.') }}</td>
        </tr>
    </table>
</center>
</body>
<script>
    window.print();
</script>

</html>