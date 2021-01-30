<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Semester</title>
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

        @page {
            size: legal landscape;
            margin-left: 50px;
        }

    </style>

</head>
<body style="background-color: grey">
    <div style="background-color: white; padding: 1%">
        <table class="table_nota" id="customers" role="grid" border="1">
            <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Tanggal Terima</th>
                <th rowspan="2">Supplier</th>
                <th colspan="4">Dokumen Faktur</th>
                <th rowspan="2">Kwantitas</th>
                <th rowspan="2">Barang</th>
                <th rowspan="2">Satuan</th>
                <th rowspan="2">Harga Satuan</th>
                <th colspan="2">Berita Acara</th>
                <th rowspan="2">Ket</th>
                <th rowspan="2">No</th>
                <th rowspan="2">Tanggal Keluar</th>
                <th colspan="2">Surat Bon</th>
                <th rowspan="2">Untuk</th>
                <th rowspan="2">Banyak Barang</th>
                <th rowspan="2">Harga Satuan</th>
                <th rowspan="2">Jumlah Harga</th>
                <th rowspan="2">Tanggal Penyerahan</th>
                <th rowspan="2">Ket</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis Surat</th>
                <th>No. Surat</th>
                <th>Tanggal</th>
                <th>Nomor</th>
                <th>Tanggal</th>
                <th>Nomor</th>
            </tr>
            <tr>
                <th >1</th>
                <th >2</th>
                <th >3</th>
                <th >4</th>
                <th >5</th>
                <th >6</th>
                <th >7</th>
                <th >8</th>
                <th >9</th>
                <th >10</th>
                <th >11</th>
                <th >12</th>
                <th >13</th>
                <th >14</th>
                <th >15</th>
                <th >16</th>
                <th >17</th>
                <th >18</th>
                <th >19</th>
                <th >20</th>
                <th >21</th>
                <th >22</th>
                <th >23</th>
                <th >24</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($data))
                @php($no=1)
                @php($no2=1)
                @foreach($data as $data_pengeluaran)
                    <tr>
                        <td style="width: 10px;">{{ $no++ }}</td>
                        <td style="width: 20px;">{{ date('d-m-Y', strtotime($data_pengeluaran['tanggal_terima'])) }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['penyedia'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['no_faktur'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['tgl_faktur'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['jenis_surat'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['no_surat_faktur'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['banyak_barang'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['nama_barang'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['satuan'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['harga_satuan'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['tgl_BA'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['nomor_BA'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['keterangan_pem'] }}</td>
                        <td style="width: 20px;">{{ $no2++ }}</td>
                        <td style="width: 20px;">{{ date('d-m-Y', strtotime($data_pengeluaran['tanggal_keluar'])) }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['tgl_bon'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['nomor_bon'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['bidang'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['banyak_barang'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['harga_satuan'] }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['jumlah_harga'] }}</td>
                        <td style="width: 20px;">{{ date('d-m-Y', strtotime($data_pengeluaran['tanggal_penyerahan'])) }}</td>
                        <td style="width: 20px;">{{ $data_pengeluaran['keterangan'] }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
     </div>
</body>
</html>