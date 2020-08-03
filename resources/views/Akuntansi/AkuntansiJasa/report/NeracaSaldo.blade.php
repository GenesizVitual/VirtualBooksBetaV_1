{{--@extends('master_akuntansi.base')--}}

{{--@section('content')--}}
    <h1 class="h3 mb-4 text-gray-800">Laporan Neraca Saldo</h1>

<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Neraca Saldo</h6>
                <div class="dropdown no-arrow">
                    <a href="{{ url('tambah-produk') }}" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus fa-sm fa-fw text-gray-400"></i>
                    </a>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Halaman ini akan menampilkan Daftar Neraca Saldo</p>
                <form action="{{ url('ceta-neraca-saldo') }}" method="post" target="_blank">
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
                <p></p>
                <table border="1" style="width: 100%"  class="table table-bordered">
                    <tr style="background-color: lawngreen;">
                        <td>Kode</td>
                        <td>Keterangan</td>
                        <td>Debet</td>
                        <td>Kredit</td>
                    </tr>
                    @php($saldo_debet=0)
                    @php($saldo_kredit=0)
                    @foreach($data['data'] as $daftar_akun)
                        @php($saldo_debet = abs($daftar_akun['saldo_debet']))
                        @php($saldo_kredit = abs($daftar_akun['saldo_kredit']))
                        <tr>
                            <td>{{ $daftar_akun['kode'] }}</td>
                            <td>{{ $daftar_akun['nama_akun'] }}</td>
                            <td>{{ number_format($saldo_debet,2,',','.') }}</td>
                            <td>{{ number_format($saldo_kredit,2,',','.') }}</td>
                        </tr>
                    @endforeach
                    <tr style="background-color: #00AAAA; font-weight: bold;">
                        <td colspan="2" style="text-align: center; color: white">Total</td>
                        <td style="text-align: center; color: white">{{ number_format($data['total_debet'],2,',','.') }}</td>
                        <td style="text-align: center; color: white">{{ number_format($data['total_kredit'],2,',','.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
{{--@stop--}}