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
                <div class="row">
                    @if(!empty($bidang))
                        @php($idx=0)
                        @foreach($bidang as $key=> $data_bidang)
                            <div class="col-lg-2">
                                <div class="card card-default">
                                    <div class="card-body ">
                                        <a href="{{ url('surat-pengeluaran/'.$data_bidang[$idx]->linkToBidang->id) }}">{{ $data_bidang[$idx]->linkToBidang->nama_bidang }}</a>
                                    </div>
                                </div>
                            </div>
                            @php($idx++)
                        @endforeach
                    @endif

                    @if(!empty($id_bidang))
                      <div class="col-lg-12">
                          <div class="card card-default">
                             <div class="card-body ">
                                 <table id="table-data" class="table table-bordered table-striped">
                                     <thead>
                                         <tr>
                                             <th>#</th>
                                             <th>Tanggal Minta</th>
                                             <th>Nomor Surat Permintaan</th>
                                             <th>Aksi</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                     @php($no=1)
                                     @foreach($data as $data)
                                         <tr>
                                             <td>{{ $no++ }}</td>
                                             <td>{{ date('d-m-Y', strtotime($data->tgl_permintaan_barang)) }}</td>
                                             <td>{{ $data->nomor_surat }}</td>
                                             <td>
                                                 <a  href="#" onclick="window.location.href='{{ url('buat-surat-pengeluaran/'.$data->id) }}'" class="btn btn-primary">Buatkan Surat Pengeluaran</a>
                                             </td>
                                         </tr>
                                     @endforeach
                                     </tbody>
                                 </table>
                             </div>
                          </div>
                      </div>
                    @endif
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
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });


        });
    </script>
@stop