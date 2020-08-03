{{--@extends('master_akuntansi.base')--}}

{{--@section('content')--}}
    <h1 class="h3 mb-4 text-gray-800">Laba Rugi</h1>

<div class="row">
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Laba Rugi</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p>Halaman ini akan menampilkan seluruh Akun Laba Rugi</p>

                <form action="{{ url('cetak-laba-rugi') }}" method="post" target="_blank">
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
                <hr>
                <ul>
                    @foreach($data as $key=> $list)
                        <li>
                            <label style="font-weight: bold"> {{ $key }}</label>
                            @if(!empty($list['data']))
                                <ul>
                                    @foreach($list['data'] as $data)
                                        <li style="list-style:none">
                                            <table >
                                                <tr>
                                                    <td width="300px" style="font-weight: bold">
                                                        <label>{{ $data['nama_akun'] }}</label>
                                                    </td>
                                                    <td>
                                                        <label>:{{ number_format($data['total_saldo'],2,',','.') }}</label>
                                                    </td>
                                                </tr>
                                            </table>
                                        </li>
                                    @endforeach
                                    <li style="list-style:none">
                                        <table>
                                            <tr>
                                                <td width="300px" style="font-weight: bold">Total {{ $key }}</td>
                                                <td> :{{ number_format($list['total'],2,',','.') }}</td>
                                            </tr>
                                        </table>
                                    </li>
                                </ul>
                            @else
                                <label style="margin-left: 24%">:{{ number_format($list,2,',','.') }}</label>
                            @endif
                        </li>

                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
{{--@stop--}}