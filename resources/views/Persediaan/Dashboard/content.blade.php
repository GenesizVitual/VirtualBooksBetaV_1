@extends('Persediaan.base')


@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                <div class="col-md-8">
                    <div class="row">
                        @if(empty($instansi))
                            <div class="col-md-12">
                                <div class="callout callout-danger">
                                    <h5><i class="fa fa-warning"></i>Informasi Instansi</h5>
                                    <p>Pengguna diwajibkan untuk mengisi data instansi anda terlebih dahulu. <a href="instansi/create">Klik disini</a></p>
                                </div>
                            </div>
                        @else
                            <div class="col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        @if(!empty($instansi))
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-default">
                                                        @if($instansi->logo)
                                                            <img src="{{ asset('persediaan/logo/'.$instansi->logo) }}" style="width: 100%; height: 100%">
                                                        @else
                                                            <img src="https://png.pngtree.com/png-clipart/20190619/original/pngtree-vector-building-icon-png-image_3989990.jpg" style="width: 100%; height: 100%">
                                                        @endif
                                                    </button>
                                                </div>
                                                <div class="col-sm-8">
                                                    <table style="width: 100%">
                                                        <tr>
                                                            <td width="150">Nama Instansi</td>
                                                            <td width="10">:</td>
                                                            <td width="300">{{ $instansi->name_instansi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Singkatan Instansi</td>
                                                            <td>:</td>
                                                            <td>{{ $instansi->singkatan_instansi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat</td>
                                                            <td>:</td>
                                                            <td>{{ $instansi->alamat }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Provinsi</td>
                                                            <td>:</td>
                                                            <td>{{ $instansi->BelongsToProvinsi->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kabupaten/Kota</td>
                                                            <td>:</td>
                                                            <td>{{ $instansi->BelongsToKabupatenKot->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>No. Telepon</td>
                                                            <td>:</td>
                                                            <td>{{ $instansi->no_telp }}</td>
                                                        </tr>
                                                        @if($instansi->fax)
                                                            <tr>
                                                                <td>No. Fax</td>
                                                                <td>:</td>
                                                                <td>{{ $instansi->fax }}</td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>:</td>
                                                            <td>{{ $instansi->email }}</td>
                                                        </tr>
                                                    </table>
                                                    <br>
                                                    <a href="{{ url('instansi/'.$instansi->id.'/edit') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-pen"></i></a>
                                                </div>
                                            </div>
                                        @else
                                            <a href="{{ url('instansi/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                                            <label style="color: darkblue"> Instansi masih kosong. </label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if(!empty($data_rekap))
                    <div class="col-sm-4">
                        <div class="row">
                                @foreach($data_rekap as $rekap)
                                <div class="col-sm-12">
                                    <div class="info-box mb-3 bg-primary">
                                        <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">{{ $rekap['jenis_tbk'] }}</span>
                                            <span class="info-box-number">
                                                <table style="width: 100%">
                                                    <tr>
                                                        <td>Ppn : {{ number_format($rekap['total_ppn'],2,',','.') }}</td>
                                                        <td>Pph : {{ number_format($rekap['total_pph'],2,',','.') }}</td>
                                                    </tr>
                                                </table>
                                            </span>
                                            <span class="info-box-number">
                                                Total: {{ number_format($rekap['total_keseluruhan'],2,',','.') }}
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endif
            </div>
        </div><!-- /.container-fluid -->
    </div>
@stop