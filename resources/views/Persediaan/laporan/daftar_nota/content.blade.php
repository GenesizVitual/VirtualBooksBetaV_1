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
                    <h1 class="m-0 text-dark">Daftar Nota</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Nota</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">Halaman daftar nota akan menampilkan semua nota pembelian pertahun.</p>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content" style="margin-top: 0px">
        <div class="container-fluid" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Panel Daftar Nota</h3>
                            <div class="card-tools">
                                {{--<a href="{{ url('gudang/create') }}" class="btn btn-tool" ><i class="fas fa-plus"></i></a>--}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ url('cetak-data-nota') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Awal</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" name="tgl_awal" class="form-control" id="inputEmail3"  required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Akhir</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" name="tgl_akhir" class="form-control" id="inputEmail3"  required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-primary">Cetak</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <table id="table-data-nota" class="table table-bordered table-striped" style="width: 100%" role="grid">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Kode Nota</th>
                                            <th>Penyedia</th>
                                            <th>PPN 10%</th>
                                            <th>PPH 1.5%</th>
                                            <th>Total Sebelum Pajak</th>
                                            <th>Total Sesudah Pajak</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($data))
                                            @foreach($data as $data_nota)
                                                <tr>
                                                    <td>{{ $data_nota[0] }}</td>
                                                    <td>{{ $data_nota[1] }}</td>
                                                    <td>{!! $data_nota[2] !!}</td>
                                                    <td>{{ $data_nota[3] }}</td>
                                                    <td>{{ $data_nota[4] }}</td>
                                                    <td>{{ $data_nota[5] }}</td>
                                                    <td>{{ $data_nota[6] }}</td>
                                                    <td>{{ $data_nota[7] }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@stop


@section('jsContainer')
    <script src="{{ asset('admin_asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(function () {
            $('#table-data-nota').DataTable({
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