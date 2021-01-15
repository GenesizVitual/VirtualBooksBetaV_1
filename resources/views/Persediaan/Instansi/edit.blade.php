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
                            <h3 class="card-title">Formulir Instansi</h3>
                        </div>
                        <form action="{{ url('instansi/'.$instansi->id) }}"  role="form" method="post" id="quickForm" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="card-body">
                                <span style="color: green">* Isilah Formulir dibawah ini dengan benar.</span>
                                <hr>
                                <div class="row">
                                    {{ csrf_field() }}
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nm_instansi"><small style="color: red">*</small> Nama Instansi</label>
                                                    <input type="text" class="form-control" name="name_instansi" value="{{ $instansi->name_instansi }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="singkatan_instansi"><small style="color: red">*</small> Singkatan Instansi</label>
                                                    <input type="text" class="form-control" name="singkatan_instansi" value="{{ $instansi->singkatan_instansi }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="alamat"><small style="color: red">*</small> Alamat</label>
                                            <textarea class="form-control" name="alamat">{{ $instansi->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="provinsi"><small style="color: red">*</small> Provinsi</label>
                                                    <select class="form-control select2" style="width: 100%;" name="id_provinsi" required>
                                                        <option selected="selected">Pilih Provinsi Anda</option>
                                                        @foreach($provinsi as $data)
                                                            <option value="{{ $data->id }}" @if($instansi->id_provinsi==$data->id) selected @endif>{{ $data->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kabupaten"><small style="color: red">*</small> Kabupaten</label>
                                                    <select class="form-control select2" style="width: 100%;" name="id_kab_kota" required>
                                                        <option>Silahkan pilih provinsi terlebih dahulu</option>
                                                        @foreach($kabkot as $data)
                                                            <option value="{{ $data->id }}" @if($instansi->id_kab_kota==$data->id) selected @endif>{{ $data->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_telp"><small style="color: red">*</small> No.Telp</label>
                                                    <input type="text" class="form-control" name="no_telp" value="{{ $instansi->no_telp }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fax"><small style="color: orange">*</small> No. Fax</label>
                                                    <input type="fax" class="form-control" name="fax" value="{{ $instansi->fax }}">
                                                    {{--<small style="color: orange">* Logo tidak diwajibkan diisi</small>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email"><small style="color: red">*</small>Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ $instansi->email }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="level"><small style="color: red">*</small>Tingkat Instansi :</label> <span style="padding: 2px;"></span>
                                            <input  type="radio" name="level_instansi" value="0" @if($instansi->level_instansi==0) checked @endif required> <label> Provinsi</label><span style="padding: 2px;"></span>
                                            <input type="radio" name="level_instansi" value="1" @if($instansi->level_instansi==1) checked @endif> <label> Kabupaten</label><span style="padding: 2px;"></span>
                                            <input type="radio" name="level_instansi" value="2" @if($instansi->level_instansi==2) checked @endif> <label> Kota</label>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
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

        $('[name="id_provinsi"]').change(function () {
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
                 $('[name="id_kab_kota"]').html(options);
              }
            })
        });


        $('#quickForm').validate({
            rules: {
                name_instansi: {
                    required: true,
                },
                singkatan_instansi: {
                    required: true,
                },
                alamat: {
                    required: true,
                },
                email: {
                    required: true
                },
                no_telp: {
                    required: true
                },

            },
            messages: {
                name_instansi: {
                    required: "Silahkan Isi Nama Instansi Anda",
                },
                singkatan_instansi: {
                    required: "Silahkan Isi Singkatan Instansi Anda",
                },
                alamat: {
                    required: "Silahkan isi Alamat lengkap perusahaan anda",
                },
                email: {
                    required: "Silahkan Masukan Email Instansi Anda",
                },
                no_telp: {
                    required: "Silahkan Masukan No.Telepon Instansi Anda",
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