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
                    <h1 class="m-0 text-dark">Berbagi laporan</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Formulir Berbagi Laporan</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p>Halaman berbagi laporan berfungsi untuk memberikan autoritas atau izin untuk dapat
                        memperlihatkan semua laporan yang anda pada sistem ke pengguna lain</p>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content" style="margin-top: 0px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Pengaturan</h3>
                            <div class="card-tools">
                                {{--<a href="{{ url('gudang/create') }}" class="btn btn-tool" ><i class="fas fa-plus"></i></a>--}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ url('share-report') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <select class="form-control select2" id="prov">
                                                <option>Pilih Provinsi</option>
                                                @if(!empty($provinsi))
                                                    @foreach($provinsi as $data_provinsi)
                                                        <option value="{{ $data_provinsi->id }}">{{ $data_provinsi->nama }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Kabupaten/Kota</label>
                                            <select class="form-control select2" id="kab">
                                                <option>Pilih Kabupaten/Kota</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>SKPD</label>
                                            <select class="form-control select2" name="to_id_instansi" id="skpd">
                                                <option>Pilih Skpd</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-info" type="submit"
                                                    onclick="return confirm('Apakah anda yakin akan akan memilih instansi ini ...?')">
                                                Kirim
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card card-info card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                <li class="pt-2 px-3"><h3 class="card-title">Berbagi Laporan Panel</h3></li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill"
                                       href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home"
                                       aria-selected="false">Daftar Skpd yang anda bagikan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill"
                                       href="#custom-tabs-two-profile" role="tab"
                                       aria-controls="custom-tabs-two-profile" aria-selected="false">Daftar Skpd yang
                                        membagikan ke anda</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel"
                                     aria-labelledby="custom-tabs-two-home-tab">
                                    <table class="table table-striped" id="table-share">
                                        <thead>
                                        <tr>
                                            <th width="30">No</th>
                                            <th width="00">SKPD</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($share_from))
                                            @php($no1=1)
                                            @foreach($share_from as $data)
                                                <tr>
                                                    <td>{{ $no1++ }}</td>
                                                    <td>{{ $data->linkToInstance->name_instansi }}</td>
                                                    <td>
                                                        <button class="btn btn-danger">Batalkan berbagi laporan</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
                                     aria-labelledby="custom-tabs-two-profile-tab">
                                    <table class="table table-striped" id="table-share1">
                                        <thead>
                                        <tr>
                                            <th width="30">No</th>
                                            <th width="00">SKPD</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($share_to))
                                            @php($no2=1)
                                            @foreach($share_to as $data1)
                                                <tr>
                                                    <td>{{ $no2++ }}</td>
                                                    <td>{{ $data1->linkToFromInstance->name_instansi }}</td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
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
            $('#table-share').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false,
            });
            $('#table-share1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false,
            });

            $('#prov').change(function (e) {
                e.preventDefault()
                $.ajax({
                    url: '{{ url('kab-kota') }}/' + $(this).val(),
                    type: 'get',
                    success: function (result) {
                        var kab_option = "";
                        $.each(result, function (i, v) {
                            kab_option += "<option value=" + v.id + ">" + v.nama + "</option>"
                        });
                        $('#kab').html(kab_option);
                    }
                });
            })

            $('#kab').change(function (e) {
                e.preventDefault()
                $.ajax({
                    url: '{{ url('response-instansi') }}',
                    type: 'post',
                    data: {
                        'id_provinsi': $('#prov').val(),
                        'id_kab_kota': $(this).val(),
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function (result) {
                        var skpd = "";
                        $.each(result, function (i, v) {
                            skpd += "<option value=" + v.id + ">" + v.name_instansi + "</option>"
                        });
                        $('#skpd').html(skpd);
                    }
                });
            })
        });
    </script>
@stop