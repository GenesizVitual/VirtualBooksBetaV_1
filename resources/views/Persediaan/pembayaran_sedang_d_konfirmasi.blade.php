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
                    <h1>Pengaturan Awal Aplikasi - Proses Konfirmasi Pembayaran</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">
                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>
                                    Konfirmasi pembayaran anda sedang kami proses. setelah selesai akun anda akan diaktifkan
                                </h3>
                                <br>
                                <h3>
                                    Anda bisa menghubungi kami dengan mengirimkan email:
                                    fandiansyahdev@gmail.com atau dengan chat via Whatshapp di no. 0813 4127 1530 a/n fandiansyah
                                </h3>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-building"></i>
                            </div>
                        </div>
                        <div class="form-bottom text-center">
                            <a href="{{ url('login') }}" class="btn btn-primary"> Kembali ke halaman login</a>
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