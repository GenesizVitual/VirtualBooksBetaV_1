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
                    <h1 class="m-0 text-dark">Rekapitulasi Persediaan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Rekapitulasi Persediaan</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">Halaman rekapitulasi persediaan akan menampilkan semua nota pembelian pertahun dikelompokkan ke jenis tanda bukti kas.</p>
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
                            <h3 class="card-title">Panel Rekapitulasi Persediaan</h3>
                            <div class="card-tools">
                                {{--<a href="{{ url('gudang/create') }}" class="btn btn-tool" ><i class="fas fa-plus"></i></a>--}}
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title">Pengaturan Cetak</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-print"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body" style="display: none;">
                                            <form action="{{ url('cetak-rekapitulasi-persediaan') }}" method="post" target="_blank">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Tanggal Awal:</label>

                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                                </div>
                                                                <input type="date" name="tgl_awal" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Tanggal Akhir:</label>

                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                                </div>
                                                                <input type="date" name="tgl_akhir" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Tanggal Cetak:</label>

                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                                </div>
                                                                <input type="date" name="tgl_cetak" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Berwenang 1:</label>
                                                            <div class="input-group">
                                                                <select class="form-control select2" style="width: 100%;" name="berwenang_1" required>
                                                                    <option selected="selected">Nik - Nama Berwenang - Jabatan</option>
                                                                    @foreach($berwenang as $berwenang1)
                                                                        <option value="{{ $berwenang1->id }}">{{ $berwenang1->nip }} - {{ $berwenang1->nama }} - {{ $berwenang1->jabatan }}</option>
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
                                                                <select class="form-control select2" style="width: 100%;" name="berwenang_2" required>
                                                                    <option selected="selected">Nik - Nama Berwenang -  Jabatan</option>
                                                                    @foreach($berwenang as $data2)
                                                                        <option value="{{ $data2->id }}">{{ $data2->nip }} - {{ $data2->nama }} - {{ $data2->jabatan }}</option>
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
                                                                <input type="text" name="jabatan1" class="form-control" required>
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Jabatan 2:</label>
                                                            <div class="input-group">
                                                                <input type="text" name="jabatan2" class="form-control" required>
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary">Cetak</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>

                                <p style="height: 2px; background-color: grey; width: 100%; margin-top:10px"></p>
                                <div class="col-md-12 table-responsive p-0">

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
                                            @foreach($data as $key=>$data_jenis_tbk)
                                                @if(!empty($data_jenis_tbk))
                                                    @php($saldo=0)
                                                    <tr>
                                                        <th colspan="8">{{ $jenis_tbk->where('id',$key)->first()->kode }} - {{ $jenis_tbk->where('id',$key)->first()->jenis_tbk }}</th>
                                                    </tr>
                                                    @foreach($data_jenis_tbk as $data_nota)
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
                                                        @php($saldo+=$data_nota[10])
                                                    @endforeach
                                                    <tr>
                                                        <th colspan="7">Total </th>
                                                        <th colspan="7">{{ number_format($saldo,2,',','.') }} </th>
                                                    </tr>
                                                @endif
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

    <!-- InputMask -->
    <script src="{{ asset('admin_asset/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>

    <script>
        $(function () {

            $('.select2').select2();

//            $('#table-data-nota').DataTable({
//                "paging": true,
//                "lengthChange": false,
//                "searching": true,
//                "ordering": true,
//                "info": true,
//                "autoWidth": false,
//                "responsive": true,
//            });

            //Datemask dd/mm/yyyy
            $('[name="tgl_awal"]').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
            $('[name="tgl_akhir"]').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
            $('[name="tgl_cetak"]').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });

            $('[name="berwenang_1"]').change(function () {
                $.ajax({
                    url:'{{ url('berwenang') }}/'+$(this).val(),
                    type: 'get',
                    success: function (result) {
                        $('[name="jabatan1"]').val(result.jabatan);
                    }
                })
            })

            $('[name="berwenang_2"]').change(function () {
                $.ajax({
                    url:'{{ url('berwenang') }}/'+$(this).val(),
                    type: 'get',
                    success: function (result) {
                        $('[name="jabatan2"]').val(result.jabatan);
                    }
                })
            })
        });
    </script>
@stop