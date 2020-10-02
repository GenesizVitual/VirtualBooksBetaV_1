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
                        <li class="breadcrumb-item"><a href="#">Nota</a></li>
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
                        <div class="card card-success">
                            <div class="card-body">
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
                                               <td style="width: 400px"><input type="text" class="form-control" name="nomor_surat" placeholder="Nomor Surat" style="width: 100%" required></td>
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
                                                    <label style="padding-left: 5%">Yang Bertanda tangan dibawah ini:</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 75px">Nama</td>
                                                <td style="width: 10px">:</td>
                                                <td style="width: 400px">
                                                    <select class="form-control select2" style="width: 100%;" name="id_berwenang" required>
                                                        <option selected="selected">Pilih yang berwenang</option>
                                                        @foreach($berwenang as $data_berwenang)
                                                            <option value="{{ $data_berwenang->id }}">{{ $data_berwenang->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td style="width: 10px">:</td>
                                                <td style="width: 400px"><input type="text" class="form-control" name="alamat" style="width: 100%" value="{{ $nota->linkToInstansi->alamat }}"></td>
                                            </tr>
                                            <tr>
                                                <td>Jabatan</td>
                                                <td style="width: 10px">:</td>
                                                <td style="width: 400px"><input type="text" class="form-control" name="jabatan" style="width: 100%" ></td>
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

                                                        @if($nota->pph !=0 || $nota->ppn !=0 )
                                                            <tr style="background-color: greenyellow">
                                                                <td rowspan="2">Pajak</td>
                                                                <td colspan="2">PPN 10%</td>
                                                                <td colspan="2">PPH 1.5%</td>
                                                                <td colspan="2">Sub Total Pajak</td>
                                                            </tr>
                                                            <tr style="background-color: greenyellow">
                                                                <td colspan="2">{{ $ppn }}</td>
                                                                <td colspan="2">{{ $pph }}</td>
                                                                <td colspan="2">{{ $total_pajak }}</td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td colspan="5">Total Pembelian </td>
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
                                                Tanggal Barang Diterima: <input type="date" class="form-control" name="tanggal_terima">
                                            </li>
                                            <li>
                                                Syarat-Syarat Pekerjaan: <textarea class="form-control"></textarea>
                                            </li>
                                            <li>
                                                Tanggal Penyelesaian: <input type="date" class="form-control" name="tanggal_penyelesaian">
                                            </li>
                                            <li>
                                                Tempat Pelaksanaan Pekerjaan:
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

        </div><!-- /.container-fluid -->
    </div>
@stop


@section('jsContainer')
    <script src="{{ asset('admin_asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(function () {
            $('.select2').select2()

            $('[name="id_berwenang"]').change(function () {
                $.ajax({
                    url: '{{ url('berwenang') }}/'+$(this).val(),
                    type: 'get',
                    dataType :'json',
                    success: function (result) {
                        $('[name="jabatan"]').val('Kuasa '+result.jabatan);
                        $('#jabatan').text('Kuasa '+result.jabatan);
                    }
                })
            })

            $('#table-data').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@stop