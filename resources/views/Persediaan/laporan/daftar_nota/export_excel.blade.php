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

        #customers td, #customers th {
            border: 1px solid #0f0f0f;
            padding: 3px;
        }

        @page {
            size: legal landscape;
            margin-left: 100px;
        }

    </style>

</head>
<body style="background-color: grey">
    <div style="background-color: white; padding: 1%">
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
                        <td >{{ $data_nota[0] }}</td>
                        <td style="width: 30px">{{ $data_nota[1] }}</td>
                        <td style="width: 30px">{!! $data_nota[2] !!}</td>
                        <td style="width: 20px">{{ $data_nota[3] }}</td>
                        <td >{{ $data_nota[4] }}</td>
                        <td >{{ $data_nota[5] }}</td>
                        <td style="width: 30px">{{ $data_nota[6] }}</td>
                        <td style="width: 30px">{{ $data_nota[7] }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</body>
</html>