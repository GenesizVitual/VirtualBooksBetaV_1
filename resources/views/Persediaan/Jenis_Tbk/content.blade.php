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
                    <h1 class="m-0 text-dark">Jenis Tanda Bukti Kas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Jenis TBK</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">Halaman Instansi berfungsi untuk mengolah data jenis tanda bukti kas(TBK) anda.</p>
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
                            <h3 class="card-title">Daftar Jenis TBK</h3>
                            <div class="card-tools">
                                <a href="{{ url('jenis-tbk/create') }}" class="btn btn-tool" ><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="table-data" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Kode Rekening</th>
                                    <th>Jenis TBK</th>
                                    <th>Status Penerimaan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                   @foreach($data as $data)
                                        <tr>
                                            <td>{{ $data->kode }}</td>
                                            <td>{{ $data->jenis_tbk }}</td>
                                            <td><span class="badge bg-danger">{{ $status_pembayaran[$data->status_pembayaran] }}</span></td>
                                            <td>
                                                <form action="{{ url('jenis-tbk/'.EnDec::setAttribute($data->id)) }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="delete">
                                                    <div class="btn-group">
                                                        <a href="{{ url('jenis-tbk/'.EnDec::setAttribute($data->id).'/edit') }}" class="btn btn-info btn-warning"><i class="fa fa-pen"></i></a>
                                                        <button type="submit" class="btn btn-info btn-danger" onclick="return confirm('Jika anda ingin menghapus Tbk ini, maka data yang terkait akan dihilangkan')"><i class="fa fa-eraser"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                   @endforeach
                                </tbody>
                            </table>
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
            $('#table-data').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@stop