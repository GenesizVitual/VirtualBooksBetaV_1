<div class="btn-group">
    <a class="btn btn-sm btn-success" href="{{ url('pembelian-barang/'.$data->id) }}"><i class="fa fa-archive"></i> {{ $data->kode_nota }} </a>
    <button type="button" class="btn btn-warning btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
        <span class="sr-only">Toggle Dropdown</span>
            <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="#" onclick="edit_nota({{ $data->id }})"><i class="fa fa-pen"> ubah </i></a>
                <a class="dropdown-item" href="#" onclick="delete_nota({{ $data->id }})" ><i class="fa fa-eraser"> hapus </i></a>
                <a class="dropdown-item" href="#" onclick="window.open('{{ url('cetak-nota/'.$data->id) }}','_blank')"><i class="fa fa-print"> cetak </i></a>
            </div>
    </button>
</div>