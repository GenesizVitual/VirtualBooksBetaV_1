<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Laba Rugi</title>
    <link href="{{ asset('Asset/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('Asset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>
<body style="margin-left: 10%; margin-right: 10%">
<center>
<h1>{{ $judul }}</h1>
<h6 style="text-align: center">{{ $bisnis->nama_bisnis }}</h6>
<h6>{{ $bisnis->alamat }}</h6>
<h6>Periode: {{ date('d-m-Y', strtotime($tgl_awal)) }} - {{ date('d-m-Y', strtotime($tgl_akhir)) }}</h6>
 <div style="text-align: left; margin-left: 10%">
<ul>
    @foreach($data as $key=> $list)
        <li>
            <label style="font-weight: bold"> {{ $key }}</label>
            @if(!empty($list['data']))
                <ul>
                    @foreach($list['data'] as $data)
                        <li>
                            <table >
                                <tr>
                                    <td width="300px" style="font-weight: bold">
                                        <label>{{ $data['nama_akun'] }}</label>
                                    </td>
                                    <td>
                                        <label>:{{ number_format($data['total_saldo'],2,',','.') }}</label>
                                    </td>
                                </tr>
                            </table>
                        </li>
                    @endforeach
                    <li>
                        <table>
                            <tr>
                                <td width="300px" style="font-weight: bold">Total {{ $key }}</td>
                                <td> :{{ number_format($list['total'],2,',','.') }}</td>
                            </tr>
                        </table>
                    </li>
                </ul>
            @else
                <label style="margin-left: 24%">:{{ number_format($list,2,',','.') }}</label>
            @endif
        </li>

    @endforeach
</ul>
 </div>
</center>
</body>
<script>
    window.print();
</script>

</html>