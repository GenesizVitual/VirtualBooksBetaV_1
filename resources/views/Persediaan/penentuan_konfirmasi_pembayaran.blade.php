<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengaturan Awal - Konfirmasi Pembayaran</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="{{ asset('first_app/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('first_app/assets/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('first_app/assets/css/form-elements.css') }}">
    <link rel="stylesheet" href="{{ asset('first_app/assets/css/style.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{ asset('first_app/assets/ico/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('first_app/assets/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('first_app/assets/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('first_app/assets/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('first_app/assets/ico/apple-touch-icon-57-precomposed.png') }}">

</head>

<body>

<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1>Pengaturan Awal Aplikasi - Konfirmasi Pembayaran</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>
                                    Konfirmasi pembayaran dengan cara mengupload bukti pembayaran.
                                </h3>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-building"></i>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form action="{{ url('upload-konfirmasi-pembayaran') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="form-username">Detail Pembayaran</label>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="kode_bayar" value="{{ $kode_pembayaran }}">
                                    <label for="form-username">Kode Pembayaran : #{{ $kode_pembayaran }}</label>
                                </div>
                                <div class="form-group">
                                    <label for="form-username">Nama Instansi : {{ $data->name_instansi }}</label>
                                </div>
                                <div class="form-group">
                                    <label for="form-username">Email : {{ $data->email }}</label>
                                </div>
                                 <div class="form-group">
                                    <label for="form-username">Provinsi : {{ $data->BelongsToProvinsi->nama }}</label>
                                </div>
                                <div class="form-group">
                                    <label for="form-username">Kab/Kota : {{ $data->BelongsToKabupatenKot->nama }}</label>
                                </div>
                                <div class="form-group">
                                    <label for="form-username">Paket :
                                        {{ $paket[$data->paket_langganan]['ket'] }}.
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="form-username">Biaya yang Harus Dibayarkan : {{ number_format($paket[$data->paket_langganan]['val'],2,',','.') }}. Dengan masa aktif selama 31 hari</label>
                                </div>
                                <div class="form-group">
                                    <label for="form-username" style="color: green">Biaya dapat ditransfer melalui Bank Muamalat no rek. 8280001291 a/n Fandiansyah atau transfer melalui Aplikasi Dana dengan no Telp/Wa : 0813 4127 1530 </label>
                                </div>
                                <div class="form-group">
                                    <label for="form-username">Tanggal Pembayaran</label>
                                    <input type="date" name="tgl_pembayaran" placeholder="Tanggal Pembayaran" class="form-username form-control" required>
                                </div>
                                 <div class="form-group">
                                    <label for="form-username">Bukti Pembayaran</label>
                                    <input type="file" name="bukti_pembayaran" placeholder="Upload Bukti Pembayaran" class="form-username form-control" required>
                                </div>
                                <button type="submit" class="btn">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="{{ asset('first_app/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('first_app/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('first_app/assets/js/scripts.js') }}"></script>

<!--[if lt IE 10]>
<script src="{{ asset('first_app/assets/js/placeholder.js') }}"></script>
<![endif]-->

</body>

</html>