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
                            <h3 class="card-title">Formulir Bidang/Bagian</h3>
                        </div>
                        <form action="{{ url('bidang/'.EnDec::setAttribute($data->id)) }}"  role="form" method="post" id="quickForm">
                            <div class="card-body">
                                <input type="hidden" name="_method" value="put">
                                <span style="color: green">* Isilah Formulir dibawah ini dengan benar.</span>
                                <hr>
                                <div class="row">
                                    {{ csrf_field() }}
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="bidang"><small style="color: orange">*</small>Nama Badang/Bagian</label>
                                                    <input type="text" class="form-control" name="nama_bidang" value="{{ $data->nama_bidang }}">
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
                    nama_bidang: {
                        required: true,
                    },
                },
                messages: {
                    nama_bidang: {
                        required: "Silahkan Isi Nama Bidang/bagian anda",
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