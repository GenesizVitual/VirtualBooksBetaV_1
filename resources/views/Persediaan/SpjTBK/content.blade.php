@extends('Persediaan.base')

@section('css')
    <link href="{{ asset('treeview/css/file-explore.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Surat Pertanggung Jawaban dan Tanda Bukti Kas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">SPK dan TBK</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">
                        Halaman ini adalah untuk mengelola data SPJ Dan TBK. Proses pada halaman ini akan dilakukan secara bertahap mulai dari pembuatan surat pertanggung jawaban(SPJ), Pembuatan Tanda Bukti Kas(TBK) dan
                        mengelompokkan nota kedalam 1 Tanda Bukti Kas
                    </p>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content" style="margin-top: 0px">
        <div class="container-fluid" >
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Daftar isi Surat Pertanggung Jawaban</h3>
                            <div class="card-tools">
                                {{--<a href="{{ url('jenis-tbk/create') }}" class="btn btn-tool" ><i class="fas fa-plus"></i></a>--}}
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="file-tree">
                                <li><a href="#"><button class="btn btn-sm btn-primary" onclick="$('#modal-lg-spj').modal('show')">Tambah SPJ</button></a></li>
                                @if(!empty($data))
                                    @foreach($data as $spj)
                                        <li {{--class="folder-root open"--}} >
                                            <a href="#">{{ $spj->kode }}</a>
                                            <ul>
                                                <li><a href="#">Link 1</a> </li>
                                                <li><a href="#">Link 2</a> </li>
                                                <li><a href="#">Link 3</a> </li>
                                                <li><a href="#">Link 4</a> </li>
                                            </ul>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </div>

    @include('Persediaan.SpjTBK.partial.modal_spj')
@stop


@section('jsContainer')
    <script src="{{ asset('treeview/js/file-explore.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".file-tree").filetree({
                collapsed:true,
            });

        });
    </script>
@stop