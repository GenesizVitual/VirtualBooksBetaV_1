@extends('base')


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
                            <h3 class="card-title">Formulir Perusahaan</h3>
                        </div>
                        <form action="#"  role="form" method="post" id="quickForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nm_perusahaan">Nama Perusaha</label>
                                            <input type="text" class="form-control" name="nm_perusahaan">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control" name="alamat"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="provinsi">Provinsi</label>
                                                    <select class="form-control select2" style="width: 100%;" name="provinsi">
                                                        <option selected="selected">Alabama</option>
                                                        <option>Alaska</option>
                                                        <option>California</option>
                                                        <option>Delaware</option>
                                                        <option>Tennessee</option>
                                                        <option>Texas</option>
                                                        <option>Washington</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kabupaten">Kabupaten</label>
                                                    <select class="form-control select2" style="width: 100%;" name="kabupaten">
                                                        <option selected="selected">Alabama</option>
                                                        <option>Alaska</option>
                                                        <option>California</option>
                                                        <option>Delaware</option>
                                                        <option>Tennessee</option>
                                                        <option>Texas</option>
                                                        <option>Washington</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p for="kabupaten"><label>Jenis Perusahaan</label></p>
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" id="radioPrimary1" name="jenis_perusahaan" >
                                                        <label for="radioPrimary1">
                                                            Jasa
                                                        </label>
                                                    </div>
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" id="radioPrimary2" name="jenis_perusahaan" >
                                                        <label for="radioPrimary2">
                                                            Dagang
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kabupaten">Logo</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile">
                                                        <label class="custom-file-label" for="customFile">Klik disini</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                </div>
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
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    })

    $(document).ready(function () {
//        $.validator.setDefaults({
//            submitHandler: function () {
//                alert( "Form successful submitted!" );
//            }
//        });
        $('#quickForm').validate({
            rules: {
                nm_perusahaan: {
                    required: true,
                },
                alamat: {
                    required: true,
                },
                terms: {
                    required: true
                },
            },
            messages: {
                nm_perusahaan: {
                    required: "Silahkan isi nama perusahaan anda",
                },
                alamat: {
                    required: "Silahkan isi Alamat lengkap perusahaan anda",
                },
                terms: "Please accept our terms"
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