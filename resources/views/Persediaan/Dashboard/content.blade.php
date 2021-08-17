@extends('Persediaan.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin_asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@stop

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
                        <div class="col-md-4">
                            <div class="callout callout-danger">
                                <h5><i class="fa fa-warning"></i>Total Penerimaan</h5>
                                <p>Rp. {{ number_format($jumlah_perimaan,2,',','.') }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="callout callout-warning">
                                <h5><i class="fa fa-warning"></i>Total Pengeluaran</h5>
                                <p>Rp. {{ number_format($jumlah_keluar,2,',','.') }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="callout callout-success">
                                <h5><i class="fa fa-warning"></i>Total Sisa Pembelian</h5>
                                <p>Rp. {{ number_format($sisa_uang_pembelian,2,',','.') }}</p>
                            </div>
                        </div>
                        @if(empty($instansi))
                            <div class="col-md-12">
                                <div class="callout callout-danger">
                                    <h5><i class="fa fa-warning"></i>Informasi Instansi</h5>
                                    <p>Pengguna diwajibkan untuk mengisi data instansi anda terlebih dahulu. <a
                                            href="{{ url('instansi/create') }}">Klik disini</a></p>
                                </div>
                            </div>
                        @else
                            <div class="col-sm-12">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        @if(!empty($instansi))
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <button class="btn btn-default" type="button" data-toggle="modal"
                                                            data-target="#modal-default">
                                                        @if($instansi->logo)
                                                            <img src="{{ asset('persediaan/logo/'.$instansi->logo) }}"
                                                                 style="width: 100%; height: 100%">
                                                        @else
                                                            <img
                                                                src="https://png.pngtree.com/png-clipart/20190619/original/pngtree-vector-building-icon-png-image_3989990.jpg"
                                                                style="width: 100%; height: 100%">
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
                                                    <a href="{{ url('instansi/'.$instansi->id.'/edit') }}"
                                                       class="btn btn-primary btn-sm float-right"><i
                                                            class="fa fa-pen"></i></a>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="modal-default">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Panel Upload Logo</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ url('instansi/'.$instansi->id.'/upload') }}"
                                                              id="#quickForm" method="post"
                                                              enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="_method" value="put">
                                                            <div class="modal-body">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input"
                                                                           name="logo" id="customFile">
                                                                    <label class="custom-file-label" for="customFile">format
                                                                        logo .jpeg .jpg .png. Max file 2MB </label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default"
                                                                        data-dismiss="modal">Tutup
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">Upload
                                                                    Logo
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        @else
                                            <a href="{{ url('instansi/create') }}" class="btn btn-primary"><i
                                                    class="fa fa-plus"></i> Tambah</a>
                                            <label style="color: darkblue"> Instansi masih kosong. </label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Grafik Rekap</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="myChart" style="width:100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        @if(!empty($stok_opname))
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Stok Opname</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped" id="table-stok">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Barang</th>
                                                <th>Stok</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($no=1)
                                            @foreach($stok_opname as $data_stok)
                                                <tr>
                                                    <th>{{ $no++ }}</th>
                                                    <th>{{ $data_stok['nama_barang'] }}</th>
                                                    <th>{{ $data_stok['stok_barang'] }}</th>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(!empty($data_rekap))
                            <div class="col-sm-12" style="overflow-x: scroll; height: 500px">
                                <div class="row">
                                    <div class="col-sm-12"><h5>Rekapitulasi Persediaan</h5></div>
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
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </div>
@stop

@section('jsContainer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="{{ asset('admin_asset') }}/plugins/flot/jquery.flot.js"></script>
    <script src="{{ asset('admin_asset') }}/plugins/flot-old/jquery.flot.resize.min.js"></script>
    <script src="{{ asset('admin_asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    @include('Persediaan.Dashboard.char_js')
    <script>
        $('#table-stok').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "responsive": true,
        });
    </script>
@stop
