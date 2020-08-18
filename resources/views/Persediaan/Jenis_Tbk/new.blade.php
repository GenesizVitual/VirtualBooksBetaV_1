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
                            <h3 class="card-title">Formulir Jenis TBK</h3>
                        </div>
                        <form action="{{ url('jenis-tbk') }}"  role="form" method="post" id="quickForm">
                            <div class="card-body">
                                <span style="color: green">* Isilah Formulir dibawah ini dengan benar.</span>
                                <hr>
                                <div class="row">
                                    {{ csrf_field() }}
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="kode"><small style="color: orange">*</small> Kode Rekening</label>
                                                    <input type="text" class="form-control" name="kode">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="jenis_tbk"><small style="color: red">*</small>Nama Jenis TBK</label>
                                                    <input type="text" class="form-control" name="jenis_tbk">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="level"><small style="color: red">*</small>Status Penerimaan :</label> <span style="padding: 2px;"></span>
                                                    @foreach($status_pembayaran as $key=> $keterangan)
                                                        <input  type="radio" name="status_pembayaran" value="{{ $key }}" @if($key==0) checked @endif required> <label> {{ $keterangan }}</label><span style="padding: 2px;"></span>
                                                    @endforeach
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
                kode: {
                    required: true,
                },
                jenis_tbk: {
                    required: true,
                },
            },
            messages: {
                kode: {
                    required: "Silahkan Isi Kode Rekening",
                },
                jenis_tbk: {
                    required: "Silahkan Isi Nama Jenis TBK",
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