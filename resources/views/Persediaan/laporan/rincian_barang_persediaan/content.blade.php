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
                    <h1 class="m-0 text-dark">Daftar Rincian persediaan barang perklasifi barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Rincian persediaan barang perklasifi barang</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">Halaman Daftar Rincian persediaan barang perklasifi barang adalah rekapan
                        dari semua stok barang yang tersedia per skpd. Data skpd akan muncul jika telah mengizinkan anda
                        untuk melihat laporan dari skpd tersebut</p>
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
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Panel Stok Barang</h3>
                            <div class="card-tools">
                                <form action="{{ url('rincian-persediaan-barang-pakai-habis') }}" method="post">
                                    {{ csrf_field() }}
                                    <button class="btn btn-warning" name="button" value="cetak"><i class="fa fa-print"></i> Cetak </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 table-responsive p-0">
                                    <div style="overflow-x: scroll; width: 100%">
                                        <table id="table-data-nota" class="table table-bordered table-striped"
                                               style="width: 100%;" role="grid">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>SKPD</th>
                                                @foreach($klasifikasi as $item_klasifikasi)
                                                    <th>{{ $item_klasifikasi->nama }}</th>
                                                @endforeach
                                                <th>Jumlah</th>
                                            </tr>
                                            <tr>
                                                <th>1</th>
                                                <th>2</th>
                                                @php($number_column=2)
                                                @foreach($klasifikasi as $column_klasifikasi)
                                                    <th>{{ $number_column++ }}</th>
                                                @endforeach
                                                <th>{{ $number_column++ }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(!empty($data))
                                                @foreach($data  as $data_rekap)
                                                    <tr>
                                                        <td>{{ $data_rekap['no'] }}</td>
                                                        <td>{{ $data_rekap['skpd'] }}</td>
                                                        @php($number_column=2)
                                                        @foreach($klasifikasi as $column_klasifikasi)
                                                            <td>{{ $data_rekap[$column_klasifikasi->id] }}</td>
                                                        @endforeach
                                                        <td>{{ $data_rekap['jumlah'] }}</td>
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
            </div>
        </div><!-- /.container-fluid -->
    </div>
@stop


@section('jsContainer')
    <script src="{{ asset('admin_asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- InputMask -->
    <script src="{{ asset('admin_asset/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>

    <script>
        $(function () {

            $('.select2').select2();

            $('#table-data-nota').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false,
            });

            //Datemask dd/mm/yyyy
            $('[name="tgl_awal"]').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'});
            $('[name="tgl_akhir"]').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'});
            $('[name="tgl_cetak"]').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'});

            $('[name="berwenang_1"]').change(function () {
                $.ajax({
                    url: '{{ url('berwenang') }}/' + $(this).val(),
                    type: 'get',
                    success: function (result) {
                        $('[name="jabatan1"]').val(result.jabatan);
                    }
                })
            })

            $('[name="berwenang_2"]').change(function () {
                $.ajax({
                    url: '{{ url('berwenang') }}/' + $(this).val(),
                    type: 'get',
                    success: function (result) {
                        $('[name="jabatan2"]').val(result.jabatan);
                    }
                })
            })
        });
    </script>
@stop
