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
                    <h1 class="m-0 text-dark">TBK NOTA</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item ">SPJ - TBK</li>
                        <li class="breadcrumb-item active">TBK - NOTA</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">Halaman ini berguna untuk mengelompokkan nota-nota pembelian kedalam satu tanda bukti kas.</p>
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
                            <h3 class="card-title">{{ $tbk->kode }}</h3>
                            {{--<div class="card-tools">--}}
                                {{--<a href="{{ url('jenis-tbk/create') }}" class="btn btn-tool" ><i class="fas fa-plus"></i></a>--}}
                            {{--</div>--}}
                        </div>
                        <div class="card-body">
                            <p style="color: green">* Data nota yang tampil pada tabel dibawah ini adalah nota yang belum dihubungkan dengan tanda bukti kas lainnya.</p>
                            <form action="{{ url('tbk-nota') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="kode" value="{{ $tbk->id }}" >
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
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($data))
                                            @foreach($data as $key=>$data_nota)
                                                @if(empty($data_nota[9]))
                                                    <tr>
                                                        <td>{{ $data_nota[0] }}</td>
                                                        <td>{{ $data_nota[1] }}</td>
                                                        <td>{!! $data_nota[2] !!}</td>
                                                        <td>{{ $data_nota[3] }}</td>
                                                        <td>{{ $data_nota[4] }}</td>
                                                        <td>{{ $data_nota[5] }}</td>
                                                        <td>{{ $data_nota[6] }}</td>
                                                        <td>{{ $data_nota[7] }}</td>
                                                        <td>
                                                            <input type="hidden" name="kode_nota[]" value="{{ $data_nota[8] }}"/>
                                                            <input type="radio" name="status_nota_{{ $key }}[]" value="0" />Putuskan
                                                            <br>
                                                            <input type="radio" name="status_nota_{{$key}}[]" value="1"
                                                                   @if(!empty($data_nota[9]))
                                                                        @if(!empty($data_nota[9]->where('id_tbk', $tbk->id)->where('id_nota', $data_nota[8])->first()->id_nota))
                                                                             checked
                                                                        @endif
                                                                   @endif
                                                            />Hubungkan
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                <button class="btn btn-primary"><i class="fa fa-chain"></i>Proses Hubungkan</button>
                            </form>
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