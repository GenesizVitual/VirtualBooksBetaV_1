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
                    <h1 class="m-0 text-dark">Buku Persediaan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Buku Persediaan</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">Halaman Buku Persediaan akan menampilkan data persediaan barang per barang.</p>
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
                            <h3 class="card-title">Panel Mutasi Barang</h3>
                            <div class="card-tools">
                                {{--<a href="{{ url('gudang/create') }}" class="btn btn-tool" ><i class="fas fa-plus"></i></a>--}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title">Pengaturan Cetak</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body" style="display: none;">
                                            <form action="{{ url('buku-persediaan-fifo') }}" method="post"
                                                  target="_blank">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Tanggal Awal:</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="far fa-calendar-alt"></i></span>
                                                                </div>
                                                                <input type="date" name="tgl_awal" class="form-control"
                                                                       data-inputmask-alias="datetime"
                                                                       data-inputmask-inputformat="dd/mm/yyyy"
                                                                       data-mask="" im-insert="false">
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Tanggal Akhir:</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="far fa-calendar-alt"></i></span>
                                                                </div>
                                                                <input type="date" name="tgl_akhir" class="form-control"
                                                                       data-inputmask-alias="datetime"
                                                                       data-inputmask-inputformat="dd/mm/yyyy"
                                                                       data-mask="" im-insert="false">
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Tanggal Cetak:</label>

                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="far fa-calendar-alt"></i></span>
                                                                </div>
                                                                <input type="date" name="tgl_cetak" class="form-control"
                                                                       data-inputmask-alias="datetime"
                                                                       data-inputmask-inputformat="dd/mm/yyyy"
                                                                       data-mask="" im-insert="false">
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Berwenang 1:</label>
                                                            <div class="input-group">
                                                                <select class="form-control select2"
                                                                        style="width: 100%;" name="berwenang_1"
                                                                        required>
                                                                    <option selected="selected">Nik - Nama Berwenang -
                                                                        Jabatan
                                                                    </option>
                                                                    @foreach($berwenang as $berwenang1)
                                                                        <option
                                                                            value="{{ $berwenang1->id }}">{{ $berwenang1->nip }}
                                                                            - {{ $berwenang1->nama }}
                                                                            - {{ $berwenang1->jabatan }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Berwenang 2:</label>
                                                            <div class="input-group">
                                                                <select class="form-control select2"
                                                                        style="width: 100%;" name="berwenang_2"
                                                                        required>
                                                                    <option selected="selected">Nik - Nama Berwenang -
                                                                        Jabatan
                                                                    </option>
                                                                    @foreach($berwenang as $data2)
                                                                        <option
                                                                            value="{{ $data2->id }}">{{ $data2->nip }}
                                                                            - {{ $data2->nama }}
                                                                            - {{ $data2->jabatan }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Jabatan 1:</label>
                                                            <div class="input-group">
                                                                <input type="text" name="jabatan1" class="form-control"
                                                                       required>
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Jabatan 2:</label>
                                                            <div class="input-group">
                                                                <input type="text" name="jabatan2" class="form-control"
                                                                       required>
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Klasifikasi TBK</label>
                                                            <div class="input-group">
                                                                <select class="form-control select2"
                                                                        style="width: 100%;" name="klasifikasi_persediaan"
                                                                        required>
                                                                    <option selected="selected" value="99">Semua Klasifikasi
                                                                    </option>
                                                                    @foreach($klasifikasi as $data_klasifikasi)
                                                                        <option
                                                                            value="{{ $data_klasifikasi->id }}">{{ $data_klasifikasi->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
{{--                                                    <div class="col-md-12">--}}
{{--                                                        <div class="form-group">--}}
{{--                                                            <label>Barang</label>--}}
{{--                                                            <div class="input-group">--}}
{{--                                                                <select class="form-control select2"--}}
{{--                                                                        style="width: 100%;" name="id_gudang" required>--}}
{{--                                                                    <option value="0">Semua Barang</option>--}}
{{--                                                                    @if(!empty($data))--}}
{{--                                                                        @foreach($data as $key=> $item_barang)--}}
{{--                                                                            <option--}}
{{--                                                                                value="{{$key}}">{{ $item_barang['barang'] }}</option>--}}
{{--                                                                        @endforeach--}}
{{--                                                                    @endif--}}
{{--                                                                </select>--}}
{{--                                                            </div>--}}
{{--                                                            <!-- /.input group -->--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                    <div class="col-md-12">
                                                        <button name="button" value="cetak" class="btn btn-primary">
                                                            Cetak
                                                        </button>
{{--                                                        <button name="button" value="excel" class="btn btn-primary">--}}
{{--                                                            Excel--}}
{{--                                                        </button>--}}
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <p style="height: 2px; background-color: grey; width: 100%; margin-top:10px"></p>
                                <div class="col-md-12 table-responsive p-0" >
                                    <div class="card">
                                        <div class="card-header d-flex p-0">
                                            <h3 class="card-title p-3">Tab Barang</h3>
                                            <ul class="nav nav-pills ml-auto p-2">
                                                <li class="nav-item dropdown">
                                                    <select class="form-control select2" id="response_barang">
                                                        @if(!empty($data))
                                                            @foreach($data as $key=> $item_barang)
                                                                <option
                                                                    value="{{$key}}">{{ $item_barang['barang'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </li>
                                            </ul>
                                        </div><!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane show active" id="tab_1">
                                                    <table id="table_persediaan"
                                                           class="table table-bordered table-responsive table-striped"
                                                           style="width: 100%;" role="grid">
                                                        <thead>
                                                        <tr>
                                                            <th rowspan="2">No</th>
                                                            <th rowspan="2">Tanggal</th>
                                                            <th rowspan="2">Uraian</th>
                                                            <th rowspan="2">Jenis Bukti</th>
                                                            <th rowspan="2">Nomor/Tgl Bukti</th>
                                                            <th colspan="3">Penerimaan</th>
                                                            <th colspan="3">Pengeluaran</th>
                                                            <th colspan="3">Saldo Akhir</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Unit</th>
                                                            <th>H. Sat</th>
                                                            <th>Jumlah (RP)</th>
                                                            <th>Unit</th>
                                                            <th>H. Sat</th>
                                                            <th>Jumlah (RP)
                                                            <th>Unit</th>
                                                            <th>H. Sat</th>
                                                            <th>Jumlah (RP)</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>

                                                </div>
                                                <!-- /.tab-pane -->
                                            </div>
                                            <!-- /.tab-content -->
                                        </div><!-- /.card-body -->
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
            load_buku_persediaan($('#response_barang').val())
            table_persediaan = $('#table_persediaan').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": false,
                data: [],
                column: [
                    {'data': '0'},
                    {'data': '1'},
                    {'data': '2'},
                    {'data': '3'},
                    {'data': '4'},
                    {'data': '5'},
                    {'data': '6'},
                    {'data': '7'},
                    {'data': '8'},
                    {'data': '9'},
                    {'data': '10'},
                    {'data': '11'},
                    {'data': '12'},
                    {'data': '13'},
                    {'data': '14'},
                ],
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
    @include('Persediaan.laporan.buku_persediaan.js')
@stop
