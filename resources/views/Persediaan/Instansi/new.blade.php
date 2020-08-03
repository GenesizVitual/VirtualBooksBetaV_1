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
                            <h3 class="card-title">Formulir Perusahaan</h3>
                        </div>
                        <form action="{{ url('perusahaan.store') }}"  role="form" method="post" id="quickForm" enctype="multipart/form-data">
                            <div class="card-body">
                                <span style="color: green">* Isilah Formulir dibawah ini dengan benar.</span>
                                <hr>
                                <div class="row">
                                    {{ csrf_field() }}
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
                                                    <select class="form-control select2" style="width: 100%;" name="provinsi" required>
                                                        <option selected="selected">Pilih Provinsi Anda</option>
                                                        @foreach($provinsi as $data)
                                                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kabupaten">Kabupaten</label>
                                                    <select class="form-control select2" style="width: 100%;" name="kabupaten" required>
                                                        <option selected="selected">Silahkan pilih provinsi terlebih dahulu</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" name="email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telp">No.Telp</label>
                                                    <input type="text" class="form-control" name="telp">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                             <label for="customFile">Logo Instansi</label>

                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="logo" required>
                                                <label class="custom-file-label" for="customFile">Masukan logo instansi *(jpg, png, gif) Max. 2 MB</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr>
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

        $('[name="provinsi"]').change(function () {
            $.ajax({
              url: '{{ url('kota-kab') }}/'+ $(this).val(),
              type : 'post',
              dataType : 'json',
              data :{
                  '_token': '{{ csrf_token() }}',
                  '_method' : 'post'
              },
              success:function (result) {
                 var options;
                 $.each(result, function (i, v) {
                     options +="<option value='"+v.id+"'> "+v.nama+"</option>";
                 });
                 $('[name="kabupaten"]').html(options);
              }
            })
        });


        $('#quickForm').validate({
            rules: {
                nm_perusahaan: {
                    required: true,
                },
                alamat: {
                    required: true,
                },
                provinsi: {
                    required: true
                },
                kabupaten: {
                    required: true
                },
                email: {
                    required: true
                },
                telp: {
                    required: true
                },
                logo: {
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
                provinsi: {
                    required: "Silahkan Pilih Provinsi Anda",
                },
                kabupaten: {
                    required: "Silahkan Pilih Kabupaten/Kota Anda",
                },
                email: {
                    required: "Silahkan Pilih Email Instansi Anda",
                },
                telp: {
                    required: "Silahkan Pilih Telp Instansi Anda",
                },
                logo: {
                    required: "Silahkan Pilih Logo Instansi Anda",
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