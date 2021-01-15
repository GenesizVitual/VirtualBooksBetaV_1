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
                    <h1 class="m-0 text-dark">Nota</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Nota</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">Halaman nota berfungsi untuk memanejemen nota pembelian dan menampilkan data barang pembelian.</p>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <h3 class="card-title p-3">Panel Nota</h3>
                                    <ul class="nav nav-pills ml-auto p-2">
                                        <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab" id="tab1"><i class="fa fa-list"></i> Daftar</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab" id="tab2"><i class="fa fa-bookmark"></i> Bukti Terima</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
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

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_2">
                                            <form action="{{ url('nota') }}" method="post" id="quickForm">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="post">
                                                <div class="form-group row">
                                                    <label for="tgl_beli" class="col-sm-2 col-form-label">Jenis TBK</label>
                                                    <div class="col-sm-10" style="padding-bottom: 3px">
                                                        <select class="form-control select2" style="width: 100%;" name="id_jenis_tbk" required>
                                                            <option disabled>Kode TBK - Jenis TBK</option>
                                                            @foreach($jenis_tbk as $data)
                                                                <option value="{{ $data->id }}">{{ $data->kode }} - {{ $data->jenis_tbk }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="kode_nota" class="col-sm-2 col-form-label">Kode Nota</label>
                                                    <div class="col-sm-10" style="padding-bottom: 3px">
                                                        <input type="text" class="form-control" id="kode_nota" name="kode_nota">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="tgl_beli" class="col-sm-2 col-form-label">Tanggal Beli</label>
                                                    <div class="col-sm-10" style="padding-bottom: 3px">
                                                        <input type="date" class="form-control" id="tgl_beli" name="tgl_beli">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="tgl_beli" class="col-sm-2 col-form-label">Penyedia</label>
                                                    <div class="col-sm-10" style="padding-bottom: 3px">
                                                        <select class="form-control select2" style="width: 100%;" name="id_penyedia" required>
                                                            <option selected="selected">Pilih Penyedia</option>
                                                            @foreach($penyedia as $data)
                                                                <option value="{{ $data->id }}">{{ $data->penyedia }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="tgl_beli" class="col-sm-2 col-form-label">Pajak</label>
                                                    <div class="col-sm-4" style="padding-bottom: 3px">
                                                        <input type="checkbox" id="ppn" name="ppn" value="1"> ppn 10%
                                                        <input type="checkbox" id="pph" name="pph" value="1"> pph 1,5%
                                                        <p>
                                                            <small style="color: orange">*Centang ppn atau pph jika nota mempuyai pajak</small>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" style="padding-bottom: 3px">
                                                    <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fa fa-check"></i></button>
                                                </div>
                                            </form>
                                        </div>
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
    @include('Persediaan.Nota.Js.daftar_js')
    <script src="{{ asset('admin_asset/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script type="text/javascript">

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })

        $(document).ready(function () {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            $('#quickForm').validate({
                rules: {
                    kode_nota: {
                        required: true,
                    },
                    tgl_beli: {
                        required: true,
                    },
                    id_penyedia: {
                        required: true,
                    },
                    id_jenis_tbk: {
                        required: true,
                    },
                },
                messages: {
                    kode_nota: {
                        required: "Silahkan isi kode nota, kode nota ini bertujuan untuk membedakan dari nota satu dengan yang lainnya.",
                    },
                    tgl_beli: {
                        required: "Silahkan isi tanggal nota pembelian.",
                    },
                    id_penyedia: {
                        required: "Silahkan isi penyedia barang.",
                    },
                    id_jenis_tbk: {
                        required: "Silahkan isi jenis tbk anda.",
                    },
                },

                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

@stop