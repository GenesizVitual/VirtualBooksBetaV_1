@extends('Persediaan.base')


@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Laporan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach($setting_laporan as $menu_laporan)
            <div class="col-sm-2 col-md-4">
                <div class="card card-success">
                    <div class="card-body">
                        <a href="#">
                            <p  style="font-size: 50px; text-align: center"><i class="fas fa-book-open fa-md"></i></p>
                            <p style="text-align: center">{{ $menu_laporan['title'] }}</p>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@stop