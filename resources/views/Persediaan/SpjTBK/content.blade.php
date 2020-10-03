@extends('Persediaan.base')

@section('css')
    <link href="{{ asset('treeview/css/file-explore.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Surat Pertanggung Jawaban dan Tanda Bukti Kas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">SPK dan TBK</li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <p style="color: darkgray">
                        Halaman ini adalah untuk mengelola data SPJ Dan TBK. Proses pada halaman ini akan dilakukan secara bertahap mulai dari pembuatan surat pertanggung jawaban(SPJ), Pembuatan Tanda Bukti Kas(TBK) dan
                        mengelompokkan nota kedalam 1 Tanda Bukti Kas
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
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Daftar isi Surat Pertanggung Jawaban</h3>
                            <div class="card-tools">
                                {{--<a href="{{ url('jenis-tbk/create') }}" class="btn btn-tool" ><i class="fas fa-plus"></i></a>--}}
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="file-tree">
                                <li><a href="#"><button class="btn btn-sm btn-primary" onclick="$('#modal-lg-spj').modal('show')">Tambah SPJ</button></a></li>
                                @if(!empty($data))
                                    @foreach($data as $spj)
                                        <li {{--class="folder-root open"--}}>
                                            <a href="#">{{ $spj->kode }}</a>
                                            <div class="btn-group btn-xs">
                                                <button type="button" class="btn btn-info btn-xs">Aksi</button>
                                                <button type="button" class="btn btn-info btn-xs dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                    <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                                                        <a class="dropdown-item" href="#" onclick="OnButtonTbk('{{ $spj->id }}')"><i class="fa fa-paperclip"></i> Tambah TBK</a>
                                                        <hr>
                                                        <a class="dropdown-item" href="#" onclick="onEditSpj('{{ $spj->id }}')"><i class="fa fa-pencil"></i> ubah</a>
                                                        <a class="dropdown-item" href="#" onclick="onDeleteSpj('{{ $spj->id }}')"><i class="fa fa-eraser"></i> hapus</a>
                                                    </div>
                                                </button>
                                            </div>
                                            @if(!empty($spj->linkToTbk))
                                                <ul>
                                                    @foreach($spj->linkToTbk as $tbk)
                                                        <li>
                                                            <a href="#">{{ $tbk->kode }}</a>
                                                            {{--: {{ $tbk->keterangan }}--}}
                                                                @if(!empty($tbk->LinkToNota_via_TBK_Nota))
                                                                    <button type="button" class="btn btn-xs btn-primary">
                                                                        @foreach($tbk->LinkToNota_via_TBK_Nota as $nota_tbk)
                                                                            @php($total_tbk =$nota_tbk->LinkToNota->linkToPembelian->sum('total_beli') )
                                                                            @php($total_ppn_tbk =$nota_tbk->LinkToNota->linkToPembelian->sum('total_ppn') )
                                                                            @php($total_pph_tbk =$nota_tbk->LinkToNota->linkToPembelian->sum('total_pph') )
                                                                            {{ number_format($total_tbk+$total_ppn_tbk+$total_pph_tbk,'2',',','.') }}
                                                                        @endforeach
                                                                    </button>
                                                                @endif
                                                            <button class="btn btn-xs btn-danger pull-right" onclick="onDeleteTbk('{{ $tbk->id }}')"><i class="fa fa-eraser"></i> hapus tbk</button>
                                                            <button class="btn btn-xs btn-warning pull-right" onclick="onEditTbk('{{ $tbk->id }}')"><i class="fa fa-pencil"></i> ubah tbk</button>
                                                            <button class="btn btn-xs btn-primary pull-right" onclick="window.location.href='{{ url('tbk-nota/'.$tbk->id) }}' "><i class="fa fa-chain"></i> Hubungkan Nota</button>
                                                            <button class="btn btn-xs btn-default pull-right" onclick="alert('{{ $tbk->keterangan }}')"><i class="fa fa-info-circle"></i> Keterangan</button>
                                                        </li>
                                                        @if(!empty($tbk->LinkToNota_via_TBK_Nota))
                                                            <ul>
                                                                @foreach($tbk->LinkToNota_via_TBK_Nota as $nota)
                                                                    <form action="{{ url('tbk-nota/'.$nota->id) }}" method="post">
                                                                    <li style="background-color: #f5f5f5">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="_method" value="delete">
                                                                            <input type="hidden" name="kode" value="{{ $nota->id }}"> <a href="#" style="margin-right: 1%">{{ $nota->LinkToNota->kode_nota }}</a>
                                                                            <button type="button" class="btn btn-xs btn-success">
                                                                                @php($total_belanja = $nota->LinkToNota->linkToPembelian->sum('total_beli'))
                                                                                @php($total_ppn = $nota->LinkToNota->linkToPembelian->sum('total_ppn'))
                                                                                @php($total_pph = $nota->LinkToNota->linkToPembelian->sum('total_pph'))
                                                                                {{ number_format($total_belanja+$total_ppn+$total_pph,'2',',','.') }}
                                                                            </button>
                                                                            <button type="submit" class="btn btn-xs btn-danger pull-right" onclick="return confirm('Apakah anda ingin memutuskan hubungan nota ini ...?')"><i class="fa fa-eraser"></i> hapus hubungan nota</button>
                                                                            <button class="btn btn-xs btn-success pull-right" onclick="onShareNota('{{ $nota->id }}')"><i class="fa fa-share"></i> Pindah TBK</button>

                                                                    </li>
                                                                    </form>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </div>

    @include('Persediaan.SpjTBK.partial.modal_spj')
    @include('Persediaan.SpjTBK.partial.modal_tbk')
    @include('Persediaan.SpjTBK.partial.modal_share_nota')
@stop


@section('jsContainer')
    <script src="{{ asset('treeview/js/file-explore.js') }}"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });


        $(document).ready(function() {
            $(".file-tree").filetree({
                collapsed:true,
            });

        });
    </script>
    @include('Persediaan.SpjTBK.js.spj')
    @include('Persediaan.SpjTBK.js.tbk')
    @include('Persediaan.SpjTBK.js.nota')
@stop