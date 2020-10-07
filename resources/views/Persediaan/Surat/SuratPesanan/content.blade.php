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
                    <h1 class="m-0 text-dark">Surat Pesanan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('nota') }}">Nota</a></li>
                        <li class="breadcrumb-item active">Surat Pesanan</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">Halaman Ini adalah halaman untuk membuatkan surat pesanan dari nota yang anda pilih.</p>
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
                                <a href="{{ url('cetak-surat-pesanan/'.$nota->id) }}" target="_blank" class="btn btn-xs btn-primary float-right"><i class="fa fa-print"></i> Cetak</a>
                            </div>
                            <form action="{{ url('surat-pesanan') }}" id="quickForm" method="post">
                            <div class="card-body">
                            {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 style="text-align: center; font-weight: bold; text-decoration: underline">
                                            Surat Pesanan (SP)
                                        </h5>
                                        <h5 style="text-align: center; font-weight: bold;">
                                            (Permintaan Pembelian)
                                        </h5>
                                    </div>
                                    <div class="col-md-12">
                                       <table style="font-weight: bold">
                                           <tr>
                                               <td>Nomor</td>
                                               <td>:</td>
                                               <td style="width: 400px">
                                                   <input type="hidden" class="form-control" name="id_nota" value="{{ $nota->id }}" required>
                                                   <input type="text" class="form-control" name="nomor_surat" placeholder="Nomor Surat" value="@if(!empty($nota->linkToSuratPesanan->nomor_surat)) {{ $nota->linkToSuratPesanan->nomor_surat }} @endif" style="width: 100%" required>
                                               </td>
                                           </tr>
                                           <tr>
                                               <td>Paket Pekerjaan</td>
                                               <td>:</td>
                                               <td style="width: 400px"><input type="text" class="form-control" value="{{ $nota->linkToNotaBelongsToTbk->kode }} - {{ $nota->linkToNotaBelongsToTbk->jenis_tbk }}" style="width: 100%" readonly></td>
                                           </tr>
                                       </table>
                                    </div>
                                    <div class="col-md-12">
                                        <table style="font-weight: bold;">
                                            <tr>
                                                <td colspan="3">
                                                    <label style="padding-left: 5%">Yang bertanda tangan dibawah ini:</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 75px">Nama</td>
                                                <td style="width: 10px">:</td>
                                                <td style="width: 400px">
                                                    <select class="form-control select2" style="width: 100%;" name="id_berwenang" required>
                                                        <option selected="selected">Pilih yang berwenang</option>
                                                        @foreach($berwenang as $data_berwenang)
                                                            <option
                                                                    @if(!empty($nota->linkToSuratPesanan->id_berwenang))
                                                                        @if($nota->linkToSuratPesanan->id_berwenang == $data_berwenang->id)
                                                                            selected
                                                                        @endif
                                                                    @endif
                                                                    value="{{ $data_berwenang->id }}" >{{ $data_berwenang->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td style="width: 10px">:</td>
                                                <td style="width: 400px"><input type="text" class="form-control" name="alamat" style="width: 100%" value="@if(!empty($nota->linkToSuratPesanan->alamat)) {{ $nota->linkToSuratPesanan->alamat }} @else {{ $nota->linkToInstansi->alamat }}  @endif" ></td>
                                            </tr>
                                            <tr>
                                                <td>Jabatan</td>
                                                <td style="width: 10px">:</td>
                                                <td style="width: 400px"><input type="text" class="form-control" name="jabatan" style="width: 100%" value="@if(!empty($nota->linkToSuratPesanan->jabatan)) {{ $nota->linkToSuratPesanan->jabatan }} @endif" required></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <label>Dalam Hal ini mewakili Pengguna Barang/Jasa pada {{ $nota->linkToInstansi->name_instansi }} Selanjutnya disebut:</label><label id="jabatan"></label><br>
                                                    <label style="padding-left: 5%">Dengan Ini memerintahkah :</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 75px">Nama</td>
                                                <td style="width: 10px">:</td>
                                                <td style="width: 400px">{{ $nota->linkToPenyedia->penyedia }}</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td style="width: 10px">:</td>
                                                <td style="width: 400px">{{ $nota->linkToPenyedia->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <label>Yang Dalam Hal ini diwakili oleh : {{ $nota->linkToPenyedia->pimpinan }} selanjutnya disebut sebagai penyedia</label><br>
                                                    <label>Untuk mengirimkan barang dengan memperhatikan ketentuan-ketentuan sebagai berikut:</label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-lg-12">
                                        <ol style="font-weight: bold">
                                            <li> Rincian Barang:
                                                <div>
                                                    <table id="table-data" class="table table-bordered table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Barang</th>
                                                            <th>Kuantitas</th>
                                                            <th>Satuan</th>
                                                            <th>Harga Satuan (Rp)</th>
                                                            <th>Sub Total(Rp)</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($no=1)
                                                        @foreach($data as $data)
                                                        <tr>
                                                            <td>{{ $data[0] }}</td>
                                                            <td>{{ $data[1] }}</td>
                                                            <td>{{ $data[2] }}</td>
                                                            <td>{{ $data[3] }}</td>
                                                            <td>{{ $data[4] }}</td>
                                                            <td>{{ $data[5] }}</td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <table style="width: 100%" class="table table-bordered table-striped">
                                                        <tbody>
                                                        <tr>
                                                            <td colspan="5" style="width: 555px">Total Pembelian </td>
                                                            <td >{{ $total_sebelum_bajak }}</td>
                                                        </tr>
                                                        @if($nota->pph !=0 || $nota->ppn !=0 )
                                                            <tr style="background-color: greenyellow">
                                                                <td rowspan="2">Pajak</td>
                                                                <td colspan="2">PPN 10%</td>
                                                                <td colspan="2">PPH 1.5%</td>
                                                                <td >Sub Total Pajak</td>
                                                            </tr>
                                                            <tr style="background-color: greenyellow">
                                                                <td colspan="2">{{ $ppn }}</td>
                                                                <td colspan="2">{{ $pph }}</td>
                                                                <td >{{ $total_pajak }}</td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td colspan="5">Total Pembelian Setelah Pajak </td>
                                                            <td >{{ $total_beli }}</td>
                                                        </tr>
                                                        <tr style="background-color: coral; text-align: center">
                                                            <td colspan="6">Terbilang : {{ $terbilang }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </li>
                                            <li>
                                                Tanggal Barang Diterima: <input type="date" class="form-control" name="tanggal_terima" value="@if(!empty($nota->linkToSuratPesanan->tanggal_terima)) {{ $nota->linkToSuratPesanan->tanggal_terima }} @endif" required>
                                            </li>
                                            <li>
                                                Syarat-Syarat Pekerjaan: <textarea class="form-control" name="syarat" placeholder="Masukan syarat-syarat khusus jika ada untuk nota ini.">@if(!empty($nota->linkToSuratPesanan->syarat)) {{ $nota->linkToSuratPesanan->syarat }} @endif</textarea>
                                            </li>
                                            <li>
                                                Tanggal Penyelesaian: <input type="date" class="form-control" name="tanggal_penyelesaian"  value="@if(!empty($nota->linkToSuratPesanan->tanggal_penyelesaian)) {{ $nota->linkToSuratPesanan->tanggal_penyelesaian }} @endif" required>
                                            </li>
                                            <li>
                                                Tempat Pelaksanaan Pekerjaan: {{ $nota->linkToPenyedia->alamat }}
                                            </li>
                                        </ol>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="container">
                                            <div class="d-flex justify-content-around">
                                                <div class="p-2">
                                                    <p style="color: white;margin: 0px;">-</p>
                                                    <input type="text" class="form-control" name="title_penyedia" value="@if(!empty($nota->linkToSuratPesanan->judul_penyedia)) {{ $nota->linkToSuratPesanan->judul_penyedia }} @else {{ "Menerima dan Menyetujui" }} @endif"  style="text-align: center">
                                                    <p style="margin: 0px; text-align: center; text-decoration: underline;">{{ $nota->linkToPenyedia->pimpinan }}</p>
                                                    <p style="margin: 0px; text-align: center;">Perwakilan {{ $nota->linkToPenyedia->penyedia }}</p>
                                                </div>
                                                <div class="p-2">
                                                    <p style="text-align: center; margin: 0px;">Untuk dan atas nama</p>
                                                    <input type="text" class="form-control" name="title_jabatan" value="@if(!empty($nota->linkToSuratPesanan->judul_jabatan)) {{ $nota->linkToSuratPesanan->judul_jabatan }} @else {{ "Pejabat Anggaran" }} @endif" style="text-align: center">
                                                    <p style="margin: 0px;text-align: center; text-decoration: underline;" id="pengadaan">@if(!empty($nota->linkToSuratPesanan->linkToBerwenang->nama)) {{ $nota->linkToSuratPesanan->linkToBerwenang->nama }} @endif</p>
                                                    <p style="margin: 0px; text-align: center;" id="nip">@if(!empty($nota->linkToSuratPesanan->linkToBerwenang->nip)) {{ $nota->linkToSuratPesanan->linkToBerwenang->nip }} @endif</p>
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

            $('[name="id_berwenang"]').change(function () {
                $.ajax({
                    url: '{{ url('berwenang') }}/'+$(this).val(),
                    type: 'get',
                    dataType :'json',
                    success: function (result) {
                        $('[name="jabatan"]').val('Kuasa '+result.jabatan);
                        $('#jabatan').text('Kuasa '+result.jabatan);
                        $('#pengadaan').text(result.nama);
                        $('#nip').text(result.nip);
                    }
                })
            })


            $('#quickForm').validate({
                rules: {
                    nomor_surat: {
                        required: true,
                    },
                    id_berwenang: {
                        required: true,
                    },
                    alamat: {
                        required: true,
                    },
                    jabatan: {
                        required: true
                    },
                    tanggal_terima: {
                        required: true
                    },
                    tanggal_penyelesaian: {
                        required: true
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
                    id_berwenang: {
                        required: "Nama berwenang tidak boleh kosong",
                    },
                    alamat: {
                        required: "Alamat tidak boleh kosong",
                    },
                    jabatan: {
                        required: "Jabatan tidak boleh kosong",
                    },
                    tanggal_terima: {
                        required: "Tanggal terima tidak boleh kosong",
                    },
                    tanggal_penyelesaian: {
                        required: "Tanggal penyelesaian tidak boleh kosong",
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