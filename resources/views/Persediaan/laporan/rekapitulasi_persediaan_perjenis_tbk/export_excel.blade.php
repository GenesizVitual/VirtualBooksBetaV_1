<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Rekapitulasi Persediaan Perjenis TBK</title>
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
        <table class="table_nota" role="grid" id="customers" border="1">
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
                        @foreach($data_jenis_tbk as $data_nota)
                            @php($saldo+=$data_nota[10])
                        @endforeach
                        <tr>
                            <th>{{ $i++ }}</th>
                            <th style="text-align: left; width: 60px;">{{ $jenis_tbk->where('id',$key)->first()->kode }} - {{ $jenis_tbk->where('id',$key)->first()->jenis_tbk }}</th>
                            <th style="width: 20px;">{{ number_format($saldo,2,',','.') }}</th>
                        </tr>
                        @php($total+=$saldo)
                    @endif
                @endforeach
                <tr>
                    <th style="text-align: left;" colspan="2">Total</th>
                    <th >{{ number_format($total,2,',','.') }}</th>
                </tr>
            @endif
            </tbody>
        </table>

    </div>
</body>
</html>