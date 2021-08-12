<!doctype HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Cetak Daftar Nota</title>
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
        @media print {
        }
    </style>

</head>
<body style="background-color: white">
    <div style="background-color: white; padding: 1%">
        <table style="width: 100%; text-align: center">
            <tr>
                <td rowspan="4" style="width: 100px">
                    <img src="{{ asset('persediaan/logo/'.$instansi->logo) }}" alt="Logo tidak ditemukan" style="width:100px;height: 110px; margin-left: 20px">
                </td>
                <td><h2 style="text-align: center;">DAFTAR NOTA PEMBELIAN</h2></td>
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
        <br>
        <br>
        <div style="height: 300px;">
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
    </div>
</body>
</html>
