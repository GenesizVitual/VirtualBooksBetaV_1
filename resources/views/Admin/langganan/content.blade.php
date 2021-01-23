@extends('Admin.base')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pengguna berlangganan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Langganan</li>
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
                        Daftar Langganan
                    </div>
                    <div class="card-body">
                        <table id="table-data-nota" class="table table-bordered table-striped" style="width: 100%" role="grid">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Pengguna</th>
                                <th>Instansi</th>
                                <th>Provinsi</th>
                                <th>Kabupate/Kota</th>
                                <th>Nilai langganan</th>
                                <th>Trial Aktif</th>
                                <th>Durasi</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($instansi)
                                    @php($no=1)
                                    @foreach($instansi as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->LinksToUsers->name }}</td>
                                            <td>{{ $data->name_instansi }}</td>
                                            <td>{{ $data->BelongsToProvinsi->nama }}</td>
                                            <td>{{ $data->BelongsToKabupatenKot->nama }}</td>
                                            <td>{{ number_format($data->nilai_langganan,2,',','.') }}</td>
                                            <td>{{ $data->trial_aktif }}</td>
                                            <td>{{ date('d-m-Y', strtotime($data->durasi)) }}</td>
                                            <td>
                                                <a href="{{ url('langganan/'.$data->id) }}" class="btn btn-primary">Detail</a>
                                            </td>
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