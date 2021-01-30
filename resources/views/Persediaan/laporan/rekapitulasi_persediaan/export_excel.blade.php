<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Rekapitulasi Persediaan</title>
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
                <tr >
                    <th style="padding: 10px;">#</th>
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
                @foreach($data as $key=>$data_jenis_tbk)
                    @if(!empty($data_jenis_tbk))
                        @php($saldo=0)
                        <tr style="background-color: greenyellow;">
                            <th colspan="9" style="text-align: left; padding: 5px;">{{ $jenis_tbk->where('id',$key)->first()->kode }} - {{ $jenis_tbk->where('id',$key)->first()->jenis_tbk }}</th>
                        </tr>
                        @foreach($data_jenis_tbk as $data_nota)
                            <tr>
                                <td style="text-align: center;">{{ $data_nota[0] }}</td>
                                <td style="width: 20px;">{{ $data_nota[1] }}</td>
                                <td style="width: 30px;">{!! $data_nota[2] !!}</td>
                                <td style="text-align: center;width: 20px;">{{ $data_nota[3] }}</td>
                                <td style="padding: 5px; width: 20px;">{{ $data_nota[4] }}</td>
                                <td style="padding: 5px; width: 20px;">{{ $data_nota[5] }}</td>
                                <td style="padding: 5px; width: 20px;">{{ $data_nota[6] }}</td>
                                <td style="padding: 5px; width: 20px;">{{ $data_nota[7] }}</td>
                            </tr>
                            @php($saldo+=$data_nota[10])
                        @endforeach
                        <tr>
                            <th colspan="7">Total </th>
                            <th colspan="2" style="text-align: left;padding: 5px;">{{ number_format($saldo,2,',','.') }} </th>
                        </tr>
                    @endif
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</body>
</html>