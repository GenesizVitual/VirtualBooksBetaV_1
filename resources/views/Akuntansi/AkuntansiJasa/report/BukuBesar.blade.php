{{--@extends('master_akuntansi.base')--}}

{{--@section('content')--}}
    <h1 class="h3 mb-4 text-gray-800">Laporan Buku Besar</h1>

<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Buku Besar</h6>
                <div class="dropdown no-arrow">
                    <a href="{{ url('tambah-produk') }}" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus fa-sm fa-fw text-gray-400"></i>
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Halaman ini akan menampilkan seluruh Akun Buku Besar</p>
                <form action="{{ url('ceta-buku-besar') }}" method="post" target="_blank">
                    <div class="row">
                        <div class="col-3">
                            Tanggal Awal
                            <input class="form-control" type="date" name="tgl_awal" required>
                        </div>
                        <div class="col-3">
                            Tanggal Akhir
                            <input class="form-control" type="date" name="tgl_akhir" required>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-success" style="margin-top: 10%"><i class="fa fa-print"></i> Print</button>
                        </div>
                        {{ csrf_field() }}
                    </div>
                </form>

                @foreach($data as $akun_group)
                    <p style="font-weight: bold">{{ $akun_group['kode'] }} - {{ $akun_group['nama_akun'] }} </p>
                    <table border="1"  class="table table-bordered">
                        <tr style="background-color: lawngreen; font-weight: bold ">
                            <td rowspan="2">Tanggal</td>
                            <td rowspan="2">No. Transaksi</td>
                            <td rowspan="2">Keterangan</td>
                            <td rowspan="2">Debet</td>
                            <td rowspan="2">Kredit</td>
                            <td colspan="2">Saldo</td>
                        </tr>
                        <tr style="background-color: lawngreen; font-weight: bold ">
                            <td>Debet</td>
                            <td>Kredit</td>
                        </tr>
                        @foreach($akun_group['data'] as $akun)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($akun['tanggal_jurnal'])) }}</td>
                                <td>{{ $akun['nomor_transaksi'] }}</td>
                                <td>{{ $akun['keterangan'] }}</td>
                                <td>{{ number_format($akun['debet'],2,',','.') }}</td>
                                <td>{{ number_format($akun['kredit'],2,',','.') }}</td>
                                <td>{{ number_format($akun['saldo_debet'],2,',','.') }}</td>
                                <td>{{ number_format($akun['saldo_kredit'],2,',','.') }}</td>
                            </tr>
                        @endforeach
                        <tr style="background-color: #00AAAA; font-weight: bold;">
                            <td colspan="3" style="text-align: center; color: white">Total</td>
                            <td style="text-align: center; color: white">{{ number_format($akun_group['total_debet'],2,',','.') }}</td>
                            <td style="text-align: center; color: white">{{ number_format($akun_group['total_kredit'],2,',','.') }}</td>
                            <td colspan="2"></td>
                        </tr>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{--@stop--}}