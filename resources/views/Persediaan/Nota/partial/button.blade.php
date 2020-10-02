@if($show==false)

<div class="btn-group">
    <a class="btn btn-sm btn-success" href="{{ url('pembelian-barang/'.$data->id) }}"><i class="fa fa-archive"></i> {{ $data->kode_nota }} </a>
    <button type="button" class="btn btn-warning btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
        <span class="sr-only">Toggle Dropdown</span>
            <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="#" onclick="window.location.href='{{ url('surat-pesanan/'.$data->id) }}' "><i class="fa fa-envelope"> Surat Pesanan </i></a>
                <hr>
                <a class="dropdown-item" href="#" onclick="edit_nota({{ $data->id }})"><i class="fa fa-pen"> Ubah </i></a>
                <a class="dropdown-item" href="#" onclick="delete_nota({{ $data->id }})" ><i class="fa fa-eraser"> Hapus </i></a>
                <a class="dropdown-item" href="#" onclick="window.open('{{ url('cetak-nota/'.$data->id) }}','_blank')"><i class="fa fa-print"> Cetak </i></a>
            </div>
    </button>
</div>

@else
    <p>{{ $data->kode_nota }}</p>
@endif