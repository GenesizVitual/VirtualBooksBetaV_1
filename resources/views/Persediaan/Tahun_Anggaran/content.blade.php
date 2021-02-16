@extends('Persediaan.base')


@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tahun Anggaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tahun Anggaran</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">Halaman tahun anggaran berfungsi untuk menambah, mengubah, menghapus dan mengaktifkan tahun anggaran.</p>
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
                    <div class="card card-primary">
                        <div class="card-body">
                            <form action="{{ url('tahun-anggaran') }}" method="post" id="quickForm">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tahun Anggaran</label>
                                    <div class="col-sm-9" style="padding-bottom: 3px">
                                        <input type="number" class="form-control" id="inputEmail3" name="thn_anggaran">
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        @foreach($tahun_anggaran as $data)
                            <div class="col-sm-3">
                                <div class="card card-primary">
                                    <div class="card-body">
                                        <form action="{{ url('tahun-anggaran/'.$data->id) }}" method="post" id="quickForm">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="put">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <input type="number" class="form-control" id="inputEmail3" name="thn_anggaran" value="{{ $data->thn_anggaran }}">
                                                </div>
                                                <div class="col-sm-12">
                                                    Status <br>
                                                    <input type="radio" name="status" value="1" @if($data->status==1) checked @endif > Aktif
                                                    @if($tahun_anggaran->count() > 1)
                                                        <input type="radio" name="status" value="0" @if($data->status==1) disabled @endif   @if($data->status==0) checked @endif > Tidak Aktif
                                                    @endif
                                                </div>
                                                <div class="col-sm-12" style="padding-top: 2px">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-pen"></i></button>
                                                    <button type="button" class="btn btn-primary" onclick="destroy('{{ $data->id }}')"><i class="fa fa-eraser"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12">
                    {{ $tahun_anggaran->links() }}
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

            destroy = function (kodes) {
                if(confirm('Jika tahun anggaran ini dihapus maka data dengan tahun anggaran yang sama akan ikut terhapus ')){
                    $.ajax({
                        url:'{{ url('tahun-anggaran') }}/'+kodes,
                        type : 'post',
                        data:{
                            '_token': '{{ csrf_token() }}',
                            '_method': 'delete'
                        },success:function (result) {
                            console.log(result);
                            Toast.fire({
                                icon: result.status,
                                title: result.message
                            });
                            setTimeout(function () {
                                window.location.reload();
                            },1000);
                        }
                    })
                }else{
                    alert('Tahun anggaran tidak terhapus');
                }
            }            
            
            $('#quickForm').validate({
                rules: {
                    thn_anggaran: {
                        required: true,
                    },
                },
                messages: {
                    thn_anggaran: {
                        required: "Silahkan Isi Tahun Anggaran",
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