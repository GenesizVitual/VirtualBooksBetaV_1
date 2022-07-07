<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Rekapitulasi Pengeluaran Perjenis TBK</title>
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

    </style>
    <link rel="stylesheet" href="{{ asset('persediaan/page_print.css') }}">
</head>
<body style="background-color: white">
    <div style="background-color: white; padding: 1%">
        <table style="width: 100%; text-align: center">
            <tr>
                <td rowspan="4" style="width: 100px"><img src="{{ asset('persediaan/logo/'.$instansi->logo) }}" alt="Logo tidak ditemukan" style="width:100px;height: 110px; margin-left: 20px"></td>
                <td><h2>LAPORAN REKAPITULASI PENGELUARAN PER JENIS TBK</h2></td>
                <td rowspan="4"> </td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
        <br>
        <table style="font-weight: bold;text-align: left;">
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
        <table class="table_nota" role="grid" id="customers" border="1" style="text-align: left;">
            <thead>
            <tr>
                <th>#</th>
                <th style="text-align: left;">Kode - Jenis TBK</th>
                <th>Sub Total</th>
            </tr>
            </thead>
            <tbody>
                @if(!empty($data))
                @php($i=1)
                @php($total=0)
                @foreach($data as $key=>$data_jenis_tbk)
                    @if(!empty($data_jenis_tbk))
                        @php($saldo=0)
                        @php($saldo_keluar=0)
                        @foreach($data_jenis_tbk as $data_nota)
                            @php($saldo+=$data_nota[10])
                            @php($saldo_keluar+=$data_nota[11])
                        @endforeach
                        <tr>
                            <th>{{ $i++ }}</th>
                            <th>{{ $jenis_tbk->where('id',$key)->first()->kode }} - {{ $jenis_tbk->where('id',$key)->first()->jenis_tbk }}</th>
                            <th>{{ number_format($saldo-$saldo_keluar,2,',','.') }}</th>
                        </tr>
                        @php($total+=$saldo-$saldo_keluar)
                    @endif
                @endforeach
                <tr>
                    <th colspan="2">Total</th>
                    <th >{{ number_format($total,2,',','.') }}</th>
                </tr>
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
                <td>{{ $jabatan_1 }}<br><br><br></td>
                <td>{{ $jabatan_2 }}<br><br><br></td>
            </tr>
            <tr style="text-align: center; font-weight: bold;">
                <td style="height: 100px"><label style="text-decoration: underline">{{ $berwenang_1->nama }}</label> <br> {{ $berwenang_1->nip }}</td>
                <td style="height: 100px"><label style="text-decoration: underline">{{ $berwenang_2->nama }}</label> <br> {{ $berwenang_2->nip }}</td>
            </tr>
        </table>
    </div>
</body>
<script>
    window.print();
</script>
</html>
