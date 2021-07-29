<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Mutasi Persediaan</title>
    <style>
        table.table_nota {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
            padding-left: 30px;
        }

        #customers td, #customers th {
            border: 1px solid #0f0f0f;
            padding: 3px;
        }

        @page {
            size: legal landscape;
            margin-left: 50px;
        }

    </style>

</head>
<body style="background-color: white">
<div style="background-color: white; padding: 1%">
    @if(!empty($data))
        @foreach($data as $key_barang=>$data_barang)
            <table style="width: 100%; text-align: center">
                <tr>
                    <td rowspan="4" style="width: 100px"><img src="{{ asset('persediaan/logo/'.$instansi->logo) }}"
                                                              alt="Logo tidak ditemukan"
                                                              style="width:100px;height: 110px; margin-left: 20px"></td>
                    <td>
                        <h2>LAPORAN BUKU PERSEDIAAN</h2>
                    </td>
                    <td rowspan="4"></td>
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
                    <td>Barang Persediaan</td>
                    <td>:</td>
                    <td>{{ $data_barang['barang'] }}</td>
                </tr>
                <tr>
                    <td>Satuan</td>
                    <td>:</td>
                    <td>{{ $data_barang['satuan'] }}</td>
                </tr>
            </table>
            <br>
            <table class="table_nota" id="customers" role="grid" border="1">
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">Uraian</th>
                    <th rowspan="2">Jenis Bukti</th>
                    <th rowspan="2">Nomor/Tgl Bukti</th>
                    <th colspan="3">Penerimaan</th>
                    <th colspan="3">Pengeluaran</th>
                    <th colspan="3">Saldo Akhir</th>
                </tr>
                <tr>
                    <th>Unit</th>
                    <th>H. Sat</th>
                    <th>Jumlah (RP)</th>
                    <th>Unit</th>
                    <th>H. Sat</th>
                    <th>Jumlah (RP)
                    <th>Unit</th>
                    <th>H. Sat</th>
                    <th>Jumlah (RP)</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($data_barang['data']))
                    @php($no=1)
                    @foreach($data_barang['data'] as $item_persediaan)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item_persediaan['tgl'] }}</td>
                            <td>{{ $item_persediaan['uraian'] }}</td>
                            <td>{{ $item_persediaan['bukti'] }}</td>
                            <td>{{ $item_persediaan['no_nota'] }}</td>
                            <td>{{ $item_persediaan['masuk'] }}</td>
                            <td>{{ $item_persediaan['harga_beli'] }}</td>
                            <td>{{ $item_persediaan['total_penerimaan'] }}</td>
                            <td>{{ $item_persediaan['keluar'] }}</td>
                            <td>{{ $item_persediaan['harga_beli'] }}</td>
                            <td>{{ $item_persediaan['total_pengeluaran'] }}</td>
                            <td>{{ $item_persediaan['sisa'] }}</td>
                            <td>{{ $item_persediaan['satuan'] }}</td>
                            <td>{{ $item_persediaan['total_akhir'] }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <br>
            <br>
            <table style="width: 100%;">
                <tr>
                    <td colspan="2"
                        style="text-align: right;font-weight: bold; height: 80px">{{ $instansi->BelongsToKabupatenKot->nama }}
                        , {{ $tgl_cetak }}</td>
                </tr>
                <tr style="text-align: center;font-weight: bold;">
                    <td>{{ $jabatan_1 }}</td>
                    <td>{{ $jabatan_2 }}</td>
                </tr>
                <tr style="text-align: center; font-weight: bold;">
                    <td style="height: 100px"><label style="text-decoration: underline">{{ $berwenang_1->nama }}</label>
                        <br> {{ $berwenang_1->nip }}</td>
                    <td style="height: 100px"><label style="text-decoration: underline">{{ $berwenang_2->nama }}</label>
                        <br> {{ $berwenang_2->nip }}</td>
                </tr>
            </table>
        @endforeach
    @endif
</div>
</body>
<script>
    window.print()
</script>
</html>
