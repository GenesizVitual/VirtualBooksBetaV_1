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
                    <h1 class="m-0 text-dark">Distribusi Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Distribusi Barang</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">
                        Halaman distribusi berfungsi untuk membagikan barang ke bidang/bagian. metode pengeluaran pada aplikasi ini menggunakan metode FIFO (First In Firts Out).
                        Aturan FIFO akan bekerja hanya untuk pengeluaran barang rutin saja.
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
                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                <li class="pt-2 px-3"><h3 class="card-title">Status Penerimaan</h3></li>
                                @if(!empty($data))
                                    @foreach($data as $key=> $data_list)
                                        <li class="nav-item">
                                            <a onclick="onLoaded('{{ $key }}','#table-data-pembelian','pem')" class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-home" aria-selected="false"><span class="badge badge-danger right">{{ $data_list['root_data']['banyak_data'] }}</span> {{ $data_list['judul'] }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="small-box bg-info">
                                                                <div class="inner">
                                                                    <h3 id="stok_tersedian">0</h3>

                                                                    <p>Stok Tersediaan</p>
                                                                </div>
                                                                <div class="icon">
                                                                    <i class="ion ion-pie-graph"></i>
                                                                </div>
                                                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="small-box bg-danger">
                                                                <div class="inner">
                                                                    <h3 id="stok_pengeluaran">0</h3>

                                                                    <p>Stok Keluar</p>
                                                                </div>
                                                                <div class="icon">
                                                                    <i class="ion ion-pie-graph"></i>
                                                                </div>
                                                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="card-body">
                                                        <h4>Pilihlah konten dibawah ini</h4>
                                                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Penerimaan</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="custom-content-below-pembagian-tab" data-toggle="pill" href="#custom-content-below-pembagian" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Pembagian</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Pengeluaran</a>
                                                            </li>


                                                        </ul>
                                                        <div class="tab-content" id="custom-content-below-tabContent">
                                                            <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                                                <p style="color: green">* Tabs Penerimaan akan menampilkan barang yang telah dimasukan pada nota pembelian. Barang yang telah dikeluarkan akan tampilkan ke tabs pengembalian ketika tombol keluarkan yang ada pada tabs penerimaan dan pengeluarkan ditekan.</p>
                                                                <table id="table-data-pembelian" class="table table-bordered table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Tanggal Beli</th>
                                                                        <th>Nama Barang</th>
                                                                        <th>Banyak Barang</th>
                                                                        <th>Harga Barang</th>
                                                                        <th>Total Harga</th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                                                <p style="color: red">* Tabs Pengeluaran akan menampilkan barang yang telah/habis dikeluarkan pada tabs penerimaan ke bidang masing-masing</p>
                                                                <table id="table-data-pengeluaran" class="table table-bordered table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Tanggal Beli</th>
                                                                        <th>Nama Barang</th>
                                                                        <th>Banyak Barang</th>
                                                                        <th>Harga Barang</th>
                                                                        <th>Total Harga</th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="tab-pane fade" id="custom-content-below-pembagian" role="tabpanel" aria-labelledby="custom-content-below-pembagian-tab">
                                                                <p style="color: darkblue">* Tabs Pembagian akan menampilkan formulir pembagian dalam format tabel. Tabs pembagian ini juga berfungsi untuk menampilkan barang yang telah dibagi</p>
                                                                <p id="set_ket" style="color: orangered">Anda belum memilih barang yang anda ingin keluarkan</p>
                                                                <button class="btn btn-primary" id="tombol-form-keluar" style="margin-bottom: 10px; display: none;">Keluarkan</button>
                                                                <hr>
                                                                <form id="form-pembagian">
                                                                    <table id="sample1" cellspacing="0" class="table table-striped table-bordered dt-responsive " style="width:100%">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Bidang</th>
                                                                            <th>Tanggal Keluar</th>
                                                                            <th>Jumlah Keluar</th>
                                                                            <th>Status Pengeluaran</th>
                                                                            <th>Keterangan</th>
                                                                            <th>Aksi</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        </tbody>
                                                                    </table>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- /.card -->
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </div>

    @include('Persediaan.Distribusi.partial.modal')

@stop


@section('jsContainer')
    @include('Persediaan.Distribusi.js.js')
    @include('Persediaan.Distribusi.js.action')

    <script>

        $('#quickForm').validate({
            rules: {
                tgl_keluar: {
                    required: true,
                },
                id_gudang: {
                    required: true,
                },
                jumlah_keluar: {
                    required: true,
                },
                status_pengeluaran: {
                    required: true,
                },
            },
            messages: {
                tgl_keluar: {
                    required: "Silahkan Isi Tanggal Keluar",
                },
                id_gudang: {
                    required: "Silahkan Pilih Bidang",
                },
                jumlah_keluar: {
                    required: "Silahkan Isi Jumlah Keluar",
                },
                status_pengeluaran: {
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
    </script>
@stop