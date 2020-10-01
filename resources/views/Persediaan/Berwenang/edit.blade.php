@extends('Persediaan.base')


@section('content')
    <div class="content-header">

    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid" >
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-primary">
                        <!-- form start -->
                        <div class="card-header">
                            <h3 class="card-title">Formulir Berwenang</h3>
                        </div>
                        <form action="{{ url('berwenang/'. $data->id) }}"  role="form" method="post" id="quickForm">
                            <div class="card-body">
                                <span style="color: green">* Isilah Formulir dibawah ini dengan benar.</span>
                                <hr>
                                <div class="row">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="put">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nip"><small style="color: red">*</small>NIP</label>
                                                    <input type="text" class="form-control" name="nip" value="{{ $data->nip }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama"><small style="color: red">*</small>Nama</label>
                                                    <input type="text" class="form-control" name="nama" value="{{ $data->nama }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jabatan"><small style="color: red">*</small>Jabatan</label>
                                                    <input type="text" class="form-control" name="jabatan" value="{{ $data->jabatan }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@stop

@section('jsContainer')
    <script src="{{ asset('admin_asset/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            $('#quickForm').validate({
                rules: {
                    nip: {
                        required: true,
                    },
                    nama: {
                        required: true,
                    },
                    jabatan: {
                        required: true,
                    },
                },
                messages: {
                    nip: {
                        required: "Nip tidak boleh kosong",
                    },
                    nama: {
                        required: "Nama tidak boleh kosong",
                    },
                    jabatan: {
                        required: "Nama tidak boleh kosong",
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