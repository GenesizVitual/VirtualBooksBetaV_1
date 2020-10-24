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
                    <h1 class="m-0 text-dark">Daftar Barang Pakai Habus</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Daftar  Barang Pakai Habus</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">Halaman daftar daftar barang pakai habus akan menampilkan semua data penerimaan yang telah dikeluarkan selama satu tahun.</p>
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
                            <h3 class="card-title">Panel Barang Pakai Habis</h3>
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
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-print"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body" style="display: none;">
                                            <form action="{{ url('cetak-barang-pakai-habis') }}" method="post">
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
                                                        <div class="form-group">
                                                            <label>Status Penerimaan</label>
                                                            <div class="input-group">
                                                                <select class="form-control select2" style="width: 100%;" name="status_penerimaan" required>
                                                                    <option selected="selected" value="99">Semua Status Penerimaan</option>
                                                                    @foreach($jenis_penerimaan as $key =>$data_jenis_penerimaan)
                                                                        <option value="{{ $key }}">{{ $data_jenis_penerimaan }}</option>
                                                                    @endforeach
                                                                </select>
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
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Tanggal Terima</th>
                                                <th rowspan="2">Nama Barang</th>
                                                <th rowspan="2">Satuan</th>
                                                <th rowspan="2">Jumlah Satuan</th>
                                                <th rowspan="2">SP/SPK</th>
                                                <th colspan="2">Berita Acara</th>
                                                <th rowspan="2">Tanggal Keluar</th>
                                                <th rowspan="2">Diserahkan Kepada</th>
                                                <th rowspan="2">Jumlah Satuan</th>
                                                <th rowspan="2">Tanggal Penyerahan</th>
                                                <th rowspan="2"> Keterangan</th>
                                            </tr>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Nomor</th>
                                            </tr>
                                            <tr>
                                                <th >1</th>
                                                <th >2</th>
                                                <th >3</th>
                                                <th >4</th>
                                                <th >5</th>
                                                <th >6</th>
                                                <th >7</th>
                                                <th >8</th>
                                                <th >9</th>
                                                <th >10</th>
                                                <th >11</th>
                                                <th >12</th>
                                                <th >13</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($data))
                                                @php($no=1)
                                                @php($no2=1)
                                                @foreach($data as $data_pengeluaran)
                                                    <tr>
                                                        <td >{{ $no++ }}</td>
                                                        <td >{{ date('d-m-Y', strtotime($data_pengeluaran['tanggal_terima'])) }}</td>
                                                        <td >{{ $data_pengeluaran['nama_barang'] }}</td>
                                                        <td >{{ $data_pengeluaran['satuan'] }}</td>
                                                        <td >{{ $data_pengeluaran['banyak_barang'] }}</td>
                                                        <td >{{ $data_pengeluaran['sp'] }}</td>
                                                        <td >{{ $data_pengeluaran['tgl_BA'] }}</td>
                                                        <td >{{ $data_pengeluaran['nomor_BA'] }}</td>

                                                        <td >{{ date('d-m-Y', strtotime($data_pengeluaran['tanggal_keluar'])) }}</td>
                                                        <td >{{ $data_pengeluaran['bidang'] }}</td>
                                                        <td >{{ $data_pengeluaran['banyak_barang'] }}</td>
                                                        <td >{{ date('d-m-Y', strtotime($data_pengeluaran['tanggal_penyerahan'])) }}</td>
                                                        <td >{{ $data_pengeluaran['keterangan'] }}</td>
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
                "responsive": true,
            });

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