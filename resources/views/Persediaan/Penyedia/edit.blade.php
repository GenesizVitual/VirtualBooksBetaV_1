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
                            <h3 class="card-title">Penyedia Barang</h3>
                        </div>
                        <form action="{{ url('penyedia/'.$data->id) }}"  role="form" method="post" id="quickForm">
                            <div class="card-body">
                                <span style="color: green">* Isilah Formulir dibawah ini dengan benar.</span>
                                <hr>
                                <div class="row">
                                    {{ csrf_field() }}
                                    <div class="col-md-12">
                                        <input type="hidden" name="_method" value="put">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="penyedia"><small style="color: orange">*</small>Nama Toko</label>
                                                    <input type="text" class="form-control" name="penyedia" value="{{ $data->penyedia }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="pimpinan"><small style="color: red">*</small>Pimpinan</label>
                                                    <input type="text" class="form-control" name="pimpinan" value="{{ $data->pimpinan }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="alamat"><small style="color: red">*</small>Alamat</label>
                                                    <textarea class="form-control" name="alamat">{{ $data->alamat }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="no_telp"><small style="color: orange">*</small>No. Telp</label>
                                                            <input type="text" class="form-control" name="no_telp" value="{{ $data->no_telp }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="no_fax"><small style="color: orange">*</small>No. Fax</label>
                                                            <input type="text" class="form-control" name="no_fax" value="{{ $data->no_fax }}">
                                                        </div>
                                                    </div>
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
                    penyedia: {
                        required: true,
                    },
                    pimpinan: {
                        required: true,
                    },
                    alamat: {
                        required: true,
                    },
                },
                messages: {
                    penyedia: {
                        required: "Silahkan Isi Nama Toko",
                    },
                    pimpinan: {
                        required: "Silahkan Isi Nama Pimpinan ",
                    },
                    alamat: {
                        required: "Silahkan Isi Alamat Toko",
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