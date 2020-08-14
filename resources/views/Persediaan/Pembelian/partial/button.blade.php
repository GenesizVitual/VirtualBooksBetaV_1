<div class="btn-group dropup">
    <button type="button" class="btn btn-info"><i class="fa fa-door-open"></i></button>
    <button type="button" class="btn btn-info dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
        <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
            <a class="dropdown-item" href="#" onclick="onEdit('{{ $data->id }}')"><i class="fa fa-pen"></i> ubah</a>
            <a class="dropdown-item" href="#" onclick="onDelete('{{ $data->id }}')"><i class="fa fa-eraser"></i> hapus</a>
        </div>
    </button>
</div>