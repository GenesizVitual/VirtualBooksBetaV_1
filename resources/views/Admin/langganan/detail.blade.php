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
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        Informasi Pelanggan
                    </div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <td>Pengguna</td>
                                <td>:</td>
                                <td>{{ $data->LinksToUsers->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $data->LinksToUsers->email }}</td>
                            </tr>
                            <tr>
                                <td>Instansi</td>
                                <td>:</td>
                                <td>{{ $data->name_instansi }}</td>
                            </tr>
                            <tr>
                                <td>Provinsi</td>
                                <td>:</td>
                                <td>{{ $data->BelongsToProvinsi->nama }}</td>
                            </tr>
                            <tr>
                                <td>Kabupaten/Kota</td>
                                <td>:</td>
                                <td>{{ $data->BelongsToKabupatenKot->nama }}</td>
                            </tr>
                            <tr>
                                <td>Nilai Langgana</td>
                                <td>:</td>
                                <td>{{ number_format($data->nilai_langganan,2,',','.') }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>
                                    <form action="{{ url('langganan/'.$data->id) }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="put">
                                    <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <select class="form-control" name="trial_aktif">
                                                        <option @if($data->trial_aktif=='true') selected @endif value="true">Tidak Aktif</option>
                                                        <option @if($data->trial_aktif=='confirmasi') selected @endif value="confirmasi">Konfirmasi</option>
                                                        <option @if($data->trial_aktif=='false') selected @endif value="false">Aktif</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <button class="btn btn-primary" type="submit">simpan</button>
                                                </div>
                                            </div>
                                    </div>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Durasi/Expired</td>
                                <td>:</td>
                                <td>{{ date('d-m-Y', strtotime($data->durasi)) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        Daftar Pembayaran
                    </div>
                    <div class="card-body">
                        <p>Semua bukti pembayaran akan tampil dibawah ini:</p>
                        <table id="table-data-nota" class="table table-bordered table-striped" style="width: 100%" role="grid">
                            <tr>
                                <td>Kode Bayar</td>
                                <td>Tanggal Bayar</td>
                                <td>Status</td>
                                <td>Bukti Bayar</td>
                            </tr>
                            @if(!empty($data->linkToLangganan))
                                @foreach($data->linkToLangganan as $data_bayar)
                                    <tr>
                                        <td>{{ $data_bayar->kode_bayar }}</td>
                                        <td>{{ $data_bayar->tgl_pembayaran }}</td>
                                        <td>
                                            {{ $data_bayar->status_bayar }}
                                        </td>
                                        <td><a target="_blank" href="{{ asset('persediaan/bukti_pembayaran/'.$data_bayar->bukti_pembayaran) }}">{{ $data_bayar->bukti_pembayaran }}</a> </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@stop