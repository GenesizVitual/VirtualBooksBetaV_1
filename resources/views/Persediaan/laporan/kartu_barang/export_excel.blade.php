<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Kartu Barang</title>
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
                <th >No</th>
                <th >Tanggal</th>
                <th >Nama Barang</th>
                <th >Barang Masuk</th>
                <th >Barang Keluar</th>
                <th >Sisa Barang</th>
            </tr>
            <tr>
                <th >1</th>
                <th >2</th>
                <th >3</th>
                <th >4</th>
                <th >5</th>
                <th >6</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($data))
                @php($no=1)

                @foreach($data as $data_mutasi)
                    <tr>
                        <td >{{ $no++ }}</td>
                        <td style="width: 20px;">{{ date('d-m-Y', strtotime($data_mutasi['tgl'])) }}</td>
                        <td style="width: 30px;">{{ $data_mutasi['nm_barang'] }}</td>
                        <td style="width: 10px;">{{ $data_mutasi['masuk'] }}</td>
                        <td style="width: 10px;">{{ $data_mutasi['keluar'] }}</td>
                        <td style="width: 10px;">{{ $data_mutasi['sisa_pp'] }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</body>
</html>