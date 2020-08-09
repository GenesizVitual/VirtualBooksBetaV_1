@extends('Persediaan.base')


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
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Panel Nota Pembelian</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('nota') }}" method="post" id="quickForm">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <label for="kode_nota" class="col-sm-3 col-form-label">Kode Nota</label>
                                            <div class="col-sm-9" style="padding-bottom: 3px">
                                                <input type="text" class="form-control" id="kode_nota" name="kode_nota">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tgl_beli" class="col-sm-3 col-form-label">Tanggal Beli</label>
                                            <div class="col-sm-9" style="padding-bottom: 3px">
                                                <input type="date" class="form-control" id="tgl_beli" name="tgl_beli">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tgl_beli" class="col-sm-3 col-form-label">Pajak</label>
                                            <div class="col-sm-9" style="padding-bottom: 3px">
                                                <input type="checkbox" id="ppn" name="ppn" value="1"> ppn 10%
                                                <input type="checkbox" id="pph" name="pph" value="1"> pph 1,5%
                                                <p>
                                                    <small style="color: orange">*Centang ppn atau pph jika nota mempuyai pajak</small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" style="padding-bottom: 3px">
                                            <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">

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
                },
                messages: {
                    kode_nota: {
                        required: "Silahkan isi kode nota, kode nota ini bertujuan untuk membedakan dari nota satu dengan yang lainnya.",
                    },
                    tgl_beli: {
                        required: "Silahkan isi tanggal nota pembelian.",
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