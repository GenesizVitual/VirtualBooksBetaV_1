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
                    <h1 class="m-0 text-dark">Daftar Stok Opname</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Stok Opname</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">Halaman Stok opname akan menampilkan sisa stok barang dan sisa uang yang tersisa ditahun anggaran yang aktif.</p>
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
                            <h3 class="card-title">Panel Stok Opname</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-default"><i class="fas fa-file-export"> Transfer Stok</i></a>
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
                                            <form action="{{ url('cetak-stok-opname') }}" method="post" target="_blank">
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
                                                                    <option selected="selected" value="-">Semua Status Penerimaan</option>
                                                                    @foreach($jenis_penerimaan as $key =>$data_jenis_penerimaan)
                                                                        <option value="{{ $key }}">{{ $data_jenis_penerimaan }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <!-- /.input group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Barang</label>
                                                            <div class="input-group">
                                                                <select class="form-control select2" style="width: 100%;" name="id_gudang" required>
                                                                    <option value="-">Semua Barang</option>
                                                                    @foreach($data_barang as $barang)
                                                                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
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
                                <div class="col-md-12 table-responsive p-0" >
                                    <div style="overflow-x: scroll; width: 100%">
                                        <table id="table-data-nota" class="table table-bordered table-striped" style="width: 100%;" role="grid">
                                            <thead>
                                                <tr>
                                                    <th >No</th>
                                                    <th >Nama Barang</th>
                                                    <th >Satuan</th>
                                                    <th >Stok Barang</th>
                                                    <th >Harga Satuan</th>
                                                    <th >Harga Total</th>
                                                    <th >Keterangan</th>
                                                </tr>
                                                <tr>
                                                    <th >1</th>
                                                    <th >2</th>
                                                    <th >3</th>
                                                    <th >4</th>
                                                    <th >5</th>
                                                    <th >6</th>
                                                    <th >7</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($data))
                                                    @php($no=1)

                                                    @foreach($data as $data_mutasi)
                                                        <tr>
                                                            <td >{{ $no++ }}</td>
                                                            <td >{{ $data_mutasi['nama_barang'] }}</td>
                                                            <td >{{ $data_mutasi['satuan'] }}</td>
                                                            <td >{{ number_format($data_mutasi['stok_barang'],2,',','.') }}</td>
                                                            <td >{{ number_format($data_mutasi['harga_barang'],2,',','.') }}</td>
                                                            <td >{{ number_format($data_mutasi['stok_barang']*$data_mutasi['harga_barang'],2,',','.') }}</td>
                                                            <td >{{ $data_mutasi['keterangan'] }}</td>
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
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Transfer Stok</h4>
                    </div>
                    <form action="{{ url('transfer-stok') }}" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <select class="form-control" name="tahun_anggaran">
                                @if(!empty($tahun_anggaran))
                                    @foreach($tahun_anggaran as $data)
                                        <option value="{{ $data->id }}" @if($thn_anggaran_aktif->id==$data->id or $thn_anggaran_aktif->thn_anggaran >= $data->thn_anggaran) disabled @endif> {{ $data->thn_anggaran }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
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