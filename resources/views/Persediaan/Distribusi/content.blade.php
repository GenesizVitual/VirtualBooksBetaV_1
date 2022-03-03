@extends('Persediaan.base')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin_asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('admin_asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@stop

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Distribusi Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Distribusi Barang</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">
                        Halaman distribusi berfungsi untuk membagikan barang ke bidang/bagian. metode pengeluaran pada
                        aplikasi ini menggunakan metode FIFO (First In Firts Out).
                        Aturan FIFO akan bekerja hanya untuk pengeluaran barang rutin saja.
                    </p>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content" style="margin-top: 0px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <h3 class="card-title p-3">Panel Distribusi Barang</h3>
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a
                                        class="nav-link  @if(Session::get('tab-menu')=='daftar-barang') active @endif"
                                        href="{{url('distribusi')}}">Daftar
                                        Barang</a></li>
                                <li class="nav-item"><a
                                        class="nav-link @if(Session::get('tab-menu')=='barang-keluar') active @endif"
                                        href="{{url('barang-keluar')}}">Barang
                                        Keluar</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane @if(Session::get('tab-menu')=='daftar-barang') active @endif"
                                     id="tab_1">
                                    <table @if(Session::get('tab-menu')=='daftar-barang') id="table-data"
                                           @endif class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Barang</th>
                                            <th>Stok Barang</th>
                                            {{--<th>Harga Barang</th>--}}
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($data))
                                            @foreach($data as $barang)
                                                <tr>
                                                    <td>{{ $barang['no'] }}</td>
                                                    <td>{{ $barang['nama_barang'] }}</td>
                                                    <td>{{ $barang['stok_barang'] }}</td>
                                                    {{--<td>{{ $barang['harga_barang'] }}</td>--}}
                                                    <td>{!! $barang['aksi'] !!}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane @if(Session::get('tab-menu')=='barang-keluar') active @endif"
                                     id="tab_2">
                                    <table @if(Session::get('tab-menu')=='barang-keluar')id="table-data"
                                           @endif class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal keluar</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Keluar</th>
                                            <th>Bidang</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($data_pengeluaran))
                                            @foreach($data_pengeluaran as $barang)
                                                <tr>
                                                    <td>{{ $barang['no'] }}</td>
                                                    <td>{{ $barang['tgl_keluar'] }}</td>
                                                    <td>{{ $barang['nm_barang'] }}</td>
                                                    <td>{{ $barang['jumlah_keluar'] }}</td>
                                                    <td>{{ $barang['bidang'] }}</td>
                                                    <td>
                                                        <form action="{{ url('hapus-barang-keluar/'.$barang['id']) }}"
                                                              method="post">
                                                            @method('delete')
                                                            {{ csrf_field() }}
                                                            {!! $barang['aksi'] !!}
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </div>
@stop


@section('jsContainer')
    <script src="{{ asset('admin_asset/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(function () {
            $('#table-data').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@stop
