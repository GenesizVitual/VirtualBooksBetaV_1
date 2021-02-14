@extends('Admin.base')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dokumentasi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dokumentasi</li>
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
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        Daftar Dokumentasi
                    </div>
                    <div class="card-body">
                        <p>
                            <a href="{{ url('dokumentasi/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Konten</a>
                        </p>
                        <table id="table-data-nota" class="table table-bordered table-striped" style="width: 100%" role="grid">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Tanggal Posting</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(!empty($data))
                                    @php($i=1)
                                    @foreach($data as $n_data)
                                        <tr>
                                            <th>{{ $i++ }}</th>
                                            <th>{{ $n_data->judul }}</th>
                                            <th>{{ date('d-m-Y', strtotime($n_data->created_at)) }}</th>
                                            <th>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Menu</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                            <div class="dropdown-menu" role="menu" style="">
                                                                <a class="dropdown-item" href="#" onclick="window.location.href='{{ url('dokumentasi/'.$n_data->id) }}';">Detail</a>
                                                                <a class="dropdown-item" href="#" onclick="window.location.href='{{ url('dokumentasi/'.$n_data->id.'/edit') }}';">Ubah</a>
                                                                <a class="dropdown-item" href="#" onclick="window.location.href='{{ url('dokumentasi/'.$n_data->id.'/delete') }}';">Hapus</a>
                                                            </div>
                                                    </button>
                                                </div>
                                            </th>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@stop