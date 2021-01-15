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
                            <h3 class="card-title">Formulir Barang</h3>
                        </div>
                        <form action="{{ url('gudang/'. $data->id) }}"  role="form" method="post" id="quickForm">
                            <input type="hidden" name="_method" value="put">
                            <div class="card-body">
                                <span style="color: green">* Isilah Formulir dibawah ini dengan benar.</span>
                                <hr>
                                <div class="row">
                                    {{ csrf_field() }}
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nama_barang"><small style="color: orange">*</small>Nama barang</label>
                                                    <input type="text" class="form-control" name="nama_barang" value="{{ $data->nama_barang }}">
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
                    nama_barang: {
                        required: true,
                    },
                },
                messages: {
                    nama_barang: {
                        required: "Silahkan Isi Nama Barang",
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