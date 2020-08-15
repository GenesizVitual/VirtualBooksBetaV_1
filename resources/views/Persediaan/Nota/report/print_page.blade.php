<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nota: {{ $nota->kode_nota }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin_asset/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin_asset/dist/css/adminlte.min.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <table>
                    <tr>
                        <td>Penyedia</td>
                        <td>:</td>
                        <td>{{ $nota->linkToPenyedia->penyedia }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $nota->linkToPenyedia->alamat }}</td>
                    </tr>
                    <tr>
                        <td>No Hp/Telepon</td>
                        <td>:</td>
                        <td>{{ $nota->linkToPenyedia->no_telp }}</td>
                    </tr>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <p></p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Satuan</th>
                            <th>Kwantitas</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $barang)
                        <tr>
                            <td>{{ $barang[0] }}</td>
                            <td>{{ $barang[1] }}</td>
                            <td>{{ $barang[3] }}</td>
                            <td>{{ $barang[2] }}</td>
                            <td>{{ $barang[4] }}</td>
                            <th>{{ $barang[5] }}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">

            <!-- /.col -->
            <div class="col-6">
                <p class="lead">Tanggal Beli : {{ $nota->tgl_beli }}</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>{{ $total_sebelum_bajak }}</td>
                        </tr>
                        @if($nota->ppn==1)
                        <tr>
                            <th>PPN 10%:</th>
                            <td>{{ $ppn }}</td>
                        </tr>
                        @endif

                        @if($nota->pph==1)
                        <tr>
                            <th>PPH 1.5:</th>
                            <td>{{ $pph }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Total:</th>
                            <td>{{ $total_beli }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>
</body>
</html>
