@extends('Admin.base')

@section('css')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
@stop

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Dokumen</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tambah Dokumen</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        Panel Tambah Dokumen
                    </div>
                    <div class="card-body">
                        <form action="{{ url('dokumentasi') }}" method="post" nctype="multipart/form-data">
                            <div class="row">
                                {{ csrf_field() }}
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>No. urut</label>
                                                    <input type="number" name="no_urut" class="form-control" value="{{ $data->no_urut }}" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Judul Besar</label>
                                                    <input type="text" name="judul" class="form-control" value="{{ $data->judul }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <textarea id="editor" placeholder="Masukan Soalnya disini" name="dokumentasi" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required> {{ $data->konten }} </textarea>
                                                <script>
                                                    CKEDITOR.replace( 'editor', {
                                                        filebrowserUploadUrl: "{{ route('dokumentasi/upload', ['_token' => csrf_token() ])}}",
                                                        filebrowserUploadMethod: 'form'
                                                    });

                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@stop