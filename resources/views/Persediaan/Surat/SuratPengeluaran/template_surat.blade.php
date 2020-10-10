@extends('Persediaan.base')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin_asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@stop

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Surat Pengeluaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('nota') }}">Nota</a></li>
                        <li class="breadcrumb-item active">Surat Pengeluaran</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">Halaman Ini adalah untuk menampilkan nama bidang yang mempunyai surat permintaan yang sebelumnya telah dibuat.</p>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content" style="margin-top: 0px">
        <div class="container-fluid" >

                <div class="row justify-content-center">

                    <div class="col-lg-10">
                        <div class="card card-default">
                            <div class="card-header">
                                <a href="#" onclick="alert('Cetak Surat Pengeluaran Belum diaktifkan')" class="btn btn-xs btn-primary float-right"><i class="fa fa-print"></i> Cetak</a>
                            </div>
                            <form action="{{ url('surat-pengeluaran') }}" id="quickForm" method="post">
                            <div class="card-body">
                            {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 style="text-align: center; font-weight: bold; text-decoration: underline">
                                            SURAT PENGELUARAN BARANG
                                        </h5>
                                    </div>
                                    <div class="col-md-12">
                                       <table style="font-weight: bold">
                                           <tr>
                                               <td>Nomor</td>
                                               <td>:</td>
                                               <td style="width: 400px">
                                                   <input type="text" class="form-control" name="nomor_surat" placeholder="Nomor Surat" value="{{ $data_surat->nomor_surat }}" style="width: 100%" required>
                                                   <input type="hidden" name="tgl_permintaan_barang" value="{{ $tgl_permintaan_barang }}">
                                                   <input type="hidden" name="id_surat_permintaan_barang" value="{{ $id_surat_permintaan_barang }}">
                                               </td>
                                           </tr>
                                           <tr>
                                               <td>Perihal</td>
                                               <td>:</td>
                                               <td style="width: 400px"><input type="text" class="form-control" name="perihal" value="Pengeluaran Barang" style="width: 100%" ></td>
                                           </tr>
                                           <tr>
                                               <td>Bidang</td>
                                               <td>:</td>
                                               <td style="width: 400px"><input type="hidden" name="id_bidang" value="{{ $bidang->id }}"> {{ $bidang->nama_bidang }}</td>
                                           </tr>
                                       </table>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 30px">
                                        <table style="font-weight: bold">
                                            <tr>
                                                <td colspan="3">Kepada</td>
                                            </tr>
                                            <tr>
                                                <td>Yth</td>
                                                <td></td>
                                                <td style="width: 400px">
                                                    <select class="form-control select2" style="width: 100%;" name="id_berwenang" required>
                                                        <option selected="selected">Pilih yang berwenang</option>
                                                            @foreach($berwenang as $data_berwenang)
                                                                <option
                                                                        value="{{ $data_berwenang->id }}"
                                                                    @if(!empty($data_surat))
                                                                        @if($data_surat->id_berwenang==$data_berwenang->id)
                                                                            selected
                                                                        @endif
                                                                    @endif
                                                                >{{ $data_berwenang->nama }}
                                                                </option>
                                                            @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">Di tempat</td>
                                            </tr>

                                        </table>
                                    </div>

                                    <div class="col-md-12" style="margin-top: 30px">

                                        <table style="font-weight: bold; width: 100%" >
                                            <tr>
                                                <td colspan="3">
                                                     <textarea class="form-control" name="isi_surat" placeholder="Isi Surat Anda">{{ $data_surat->isi_surat }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <table id="table-data" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Barang</th>
                                                            <th>Satuan</th>
                                                            <th>Jumlah Barang</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php($i=1)
                                                    @php($id="")

                                                    @if(!empty($data_barang))
                                                        @foreach($data_barang as $data)
                                                        <tr>
                                                            <td>{{ $i++ }} </td>
                                                            <td>{{ $data['nama_barang'] }}@php($id.=$data['id'].',')</td>
                                                            <td>{{ $data['satuan'] }}</td>
                                                            <td>{{ $data['jumlah_barang'] }}</td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <input type="hidden" name="id_barang" value="{{ $id }}">
                                                    <textarea class="form-control" name="penutup_surat" placeholder="Penutup Surat Anda">{{ $data_surat->penutup_surat }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="2">
                                                    <br>
                                                    <div class="form-group row float-right">
                                                        <label for="inputEmail3" class="col-sm-4 col-form-label"> {{ $instansi->BelongsToKabupatenKot->nama }},</label>
                                                        <div class="col-sm-8">
                                                            <input type="date" class="form-control" name="tgl_surat" placeholder="tanggal surat">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>

                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="container">
                                            <div class="d-flex justify-content-around">
                                                <div class="p-2">
                                                    <p style="color: white;margin: 0px;"></p>
                                                    <input type="text" class="form-control" name="title_penyedia" value="@if(!empty($data_surat)){{ $data_surat->title_penyedia }}@else {{ "Pengguna Barang" }}@endif"  style="text-align: center">
                                                    <p style="margin: 0px; text-align: center; text-decoration: underline;">
                                                        <select class="form-control select2" style="width: 100%;" name="id_berwenang1" required>
                                                            <option selected="selected">Pilih yang berwenang</option>
                                                            @foreach($berwenang as $data_berwenang)
                                                                <option
                                                                        value="{{ $data_berwenang->id }}"
                                                                        @if(!empty($data_surat))
                                                                            @if($data_surat->id_berwenang1==$data_berwenang->id)
                                                                            selected
                                                                            @endif
                                                                        @endif
                                                                    >{{ $data_berwenang->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                    <p style="margin: 0px; text-align: center;" id="nip1">@if(!empty($data_surat))Nip:{{ $data_surat->linkToBerwenang1->nip }}@endif</p>
                                                </div>
                                                <div class="p-2">
                                                    <p style="text-align: center; margin: 0px;"></p>
                                                    <input type="text" class="form-control" name="title_jabatan" value="@if(!empty($data_surat)){{ $data_surat->title_penyedia }}@else {{ "Kepala bidang/Sub Bagian/Bidang/Sekretaris" }}@endif" style="text-align: center">
                                                    <p style="margin: 0px;text-align: center; text-decoration: underline;">
                                                        <select class="form-control select2" style="width: 100%;" name="id_berwenang2" required>
                                                            <option selected="selected">Pilih yang berwenang</option>
                                                            @foreach($berwenang as $data_berwenang)
                                                                <option
                                                                        value="{{ $data_berwenang->id }}"
                                                                        @if(!empty($data_surat))
                                                                            @if($data_surat->id_berwenang2==$data_berwenang->id)
                                                                                selected
                                                                            @endif
                                                                        @endif
                                                                >{{ $data_berwenang->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </p>
                                                    <p style="margin: 0px; text-align: center;" id="nip2">Nip:{{ $data_surat->linkToBerwenang2->nip }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-around">
                                    <button class="btn btn-primary" type="submit"> <i class="fa fa-save"></i> Simpan</button>
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

    <script src="{{ asset('admin_asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>


    <script>
        $(function () {
            $('.select2').select2()

            $('#table-data').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });

            $('[name="id_berwenang1"]').change(function () {
                $.ajax({
                    url: '{{ url('berwenang') }}/'+$(this).val(),
                    type: 'get',
                    dataType :'json',
                    success: function (result) {
                        $('[name="title_penyedia"]').val(result.jabatan);
                        $('#nip1').text('Nip :'+result.nip);
                    }
                })
            })
            $('[name="id_berwenang2"]').change(function () {
                $.ajax({
                    url: '{{ url('berwenang') }}/'+$(this).val(),
                    type: 'get',
                    dataType :'json',
                    success: function (result) {
                        $('[name="title_jabatan"]').val(result.jabatan);
                        $('#nip2').text('Nip :'+result.nip);
                    }
                })
            })


            $('#quickForm').validate({
                rules: {
                    nomor_surat: {
                        required: true,
                    },

                    perihal: {
                        required: true,
                    },
                    id_berwenang: {
                        required: true,
                    },
                    id_berwenang1: {
                        required: true,
                    },
                    id_berwenang2: {
                        required: true,
                    },

                    isi_surat: {
                        required: true,
                    },
                    penutup_surat: {
                        required: true,
                    },

                    title_penyedia : {
                        required: true
                    },
                    title_jabatan : {
                        required: true
                    },

                },
                messages: {
                    nomor_surat: {
                        required: "Nomor surat tidak boleh kosong",
                    },
                    perihal: {
                        required: "Perihal tidak boleh kosong",
                    },
                    id_berwenang: {
                        required: "Surat ditujukan tidak boleh kosong",
                    },

                    isi_surat: {
                        required: "Isi Surat tidak boleh kosong",
                    },

                    penutup_surat: {
                        required: "Penutup Surat tidak boleh kosong",
                    },

                    id_berwenang1: {
                        required: "Penanda tangan 1 tidak boleh kosong",
                    },
                    id_berwenang2: {
                        required: "Penanda tangan 2 tidak boleh kosong",
                    },
                    title_penyedia: {
                        required: "Judul penyedia tidak boleh kosong",
                    },
                    title_jabatan: {
                        required: "Judul Jabatan tidak boleh kosong",
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