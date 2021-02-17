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
                    <h1 class="m-0 text-dark">Pembelian Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pembelian Barang</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">Halaman pembelian barang berfungsi sebagai memasukan data barang yang terdaftar didalam nota pembelian anda.</p>
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
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Detail Nota</h3>
                            <div class="card-tools">
                                {{--<a href="{{ url('jenis-tbk/create') }}" class="btn btn-tool" ><i class="fas fa-plus"></i></a>--}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="row">
                                       <div class="col-md-4 alert alert-success alert-dismissible" style="height: 100%">
                                               <table>
                                                   <tr>
                                                       <td style="font-weight: bold; width:100px" >Kode Nota</td>
                                                       <td>:</td>
                                                       <td>{{ $nota->kode_nota }}</td>
                                                   </tr>
                                                   <tr>
                                                       <td style="font-weight: bold">Tanggal Beli</td>
                                                       <td> : </td>
                                                       <td>{{ date('d M Y', strtotime($nota->tgl_beli)) }}</td>
                                                   </tr>
                                                   <tr>
                                                       <td style="font-weight: bold">Penyedia</td>
                                                       <td>:</td>
                                                       <td>{{ $nota->linkToPenyedia->penyedia }}</td>
                                                   </tr>
                                                   <tr>
                                                       <td style="font-weight: bold" colspan="3">
                                                           <p style="color: yellow">Isilah data barang sesuai dengan nota pembelian manual anda.</p>
                                                       </td>
                                                   </tr>
                                               </table>
                                       </div>
                                       <div class="col-md-4"></div>
                                       <div class="col-md-4 ">
                                            <div class="row">
                                                <div class="col-md-12 alert alert-info alert-dismissible">
                                                    <table>
                                                        <tr>
                                                            <td><h3>Total</h3></td>
                                                            <td><h3>:</h3></td>
                                                            <td><h3 id="total_pembelian">-</h3></td>
                                                        </tr>

                                                        <tr>
                                                            <td><h6>PPN 10%</h6></td>
                                                            <td><h6>:</h6></td>
                                                            <td><h6 id="ppn">-</h6></td>
                                                        </tr>

                                                        <tr>
                                                            <td><h6>PPH 1.5%</h6></td>
                                                            <td><h6>:</h6></td>
                                                            <td><h6 id="pph">-</h6></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">
                                                                Total akan dijumlahkan setelah barang dimasukan
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>


                                            </div>
                                       </div>
                                   </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="callout callout-success">
                                        <form action="#" role="form" method="post" id="quickForm">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="id_gudang">Barang</label>
                                                    <select class="form-control select2" style="width: 100%;" name="id_gudang" required>
                                                        <option disabled>Silahkan pilih barang</option>
                                                        @foreach($gudang as $data)
                                                            <option value="{{ $data->id }}">{{ $data->nama_barang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="jumlah_barang">Jumlah Barang</label>
                                                    <input type="number" class="form-control" name="jumlah_barang" id="jumlah_barang" placeholder=''>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="satuan">Satuan</label>
                                                    <input type="text" class="form-control" name="satuan" id="satuan" placeholder=''>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="harga_barang">Harga Barang</label>
                                                    <input type="number" class="form-control" name="harga_barang" id="harga_barang" placeholder=''>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="tgl_expired">Tanggal Expired / Tanggal Tidak Layak Pakai</label>
                                                    <input type="date" class="form-control" name="tanggal_expired" id="tgl_expired" placeholder=''>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="keterangan">Keterangan</label>
                                                    <textarea class="form-control" name="keterangan" id="keterangan" placeholder='Keterangan bisa saja seperti Spesifikasi Barang, Berat, Warna, Asal Barang, dll'></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                               <span style="color: orange">
                                                    @if($nota->ppn==1)
                                                       Pajak PPN 10%.
                                                    @endif
                                                    @if($nota->pph==1)
                                                        Pajak PPH 1.5%.
                                                    @endif
                                               </span>
                                               <button type="button" onclick="onSubmit()" class="btn btn-primary float-right"><i class="fa fa-check"></i> Simpan</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <h3>Daftar Barang Anda</h3>
                                    <table id="table-data" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Barang</th>
                                            <th>Kwatintas</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Sub Total</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->

@stop


@section('jsContainer')
    <script src="{{ asset('admin_asset/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    @include('Persediaan.Pembelian.js.table')

    <script>

        focus = function(){
            $("html, body").animate({
                scrollTop: $("#quickForm").offset().top
            }, 2000);
        }

        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })

        $('#quickForm').validate({
            rules: {
                id_gudang: {
                    required: true,
                },
                jumlah_barang: {
                    required: true,
                },
                satuan: {
                    required: true,
                },
                harga_barang: {
                    required: true,
                },
            },
            messages: {
                id_gudang: {
                    required: "Silahkan Pilih Barang",
                },
                jumlah_barang: {
                    required: "Silahkan Isi Jumlah Barang",
                },
                satuan: {
                    required: "Silahkan Isi Satuan Barang",
                },
                harga_barang: {
                    required: "Silahkan Isi Harga Barang",
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

        onSubmit = function () {
            if($('#quickForm').valid()){
                if($('[name="_method"]').val()=="post")
                {
                    onStore('{{ url('pembelian-barang') }}/'+'{{ $nota->id }}/store');
                    clear();
                }else{
                    onUpdate();
                    clear();
                }
            }else{
                alert('Pastikan formulir diisi dengan benar');
            }
        }
    </script>

    @include('Persediaan.Pembelian.js.action')
@stop