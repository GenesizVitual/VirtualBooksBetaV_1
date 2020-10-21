<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Daftar Nota</title>
    <style>
        table.table_nota{
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }


        @page {
            size: legal landscape;
        }

    </style>

</head>
<body style="background-color: grey">
    <div style="background-color: white; padding: 1%">
        <table style="width: 100%; text-align: center">
            <tr>
                <td rowspan="4" style="width: 100px"><img src="{{ asset('persediaan/logo/'.$instansi->logo) }}" alt="Logo tidak ditemukan" style="width:100px;height: 110px; margin-left: 20px"></td>
                <td><h3>DAFTAR NOTA PEMBELIAN</h3></td>
                <td rowspan="4"> </td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
        <br>
        <table>
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
        <table class="table_nota" role="grid" border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Kode Nota</th>
                    <th>Penyedia</th>
                    <th>PPN 10%</th>
                    <th>PPH 1.5%</th>
                    <th>Total Sebelum Pajak</th>
                    <th>Total Sesudah Pajak</th>
                </tr>
                </thead>
            <tbody>
            @if(!empty($data))
                @foreach($data as $data_nota)
                    <tr>
                        <td style="width: 30px; text-align: center;">{{ $data_nota[0] }}</td>
                        <td style="text-align: center;">{{ $data_nota[1] }}</td>
                        <td style="text-align: left; padding-left:10px;">{!! $data_nota[2] !!}</td>
                        <td style="text-align: left; padding-left:10px;">{{ $data_nota[3] }}</td>
                        <td style="text-align: left; padding-left:10px;">{{ $data_nota[4] }}</td>
                        <td style="text-align: left; padding-left:10px;">{{ $data_nota[5] }}</td>
                        <td style="text-align: left; padding-left:10px;">{{ $data_nota[6] }}</td>
                        <td style="text-align: left; padding-left:10px;">{{ $data_nota[7] }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</body>
</html>