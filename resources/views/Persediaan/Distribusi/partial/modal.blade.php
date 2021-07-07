<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg modal-primary">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pengeluaran Barang : {{ $gudang->nama_barang }} <label class="stok_label"></label></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" role="form" method="post" id="quickForm" >
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="post">
                <input type="hidden" name="kode">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="tgl_terima">
                                <input type="hidden" name="status">
                                <input type="hidden" name="stok_terakhir">
                                <label for="tgl_keluar">Tanggal Keluar</label>
                                <input type="date" class=" form-control" name="tgl_kerluar" id="tgl_keluar" format='dd/mm/yyyy' required>
                                <span id="notif_tgl" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="id_gudang">Bidang</label>
                                <select class="form-control select2" style="width: 100%;" name="id_bidang" required>
                                    @if(!empty($bidang))
                                        @foreach($bidang as $bidang)
                                            <option value="{{ $bidang->id }}">{{ $bidang->nama_bidang }}</option>
                                        @endforeach
                                    @else
                                        <option selected="selected" disabled>Masukan data bidang terlebih dahulu</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_keluar">Jumlah Keluar</label>
                                <input type="number" min="0" class="form-control" name="jumlah_keluar" id="jumlah_keluar" required>
                                <span id="notif_jumlah" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label for="status_pengeluaran">Status Pengeluaran</label>
                                <select class="form-control select2" style="width: 100%;" name="status_pengeluaran" required>
                                    @foreach($status_penerimaan as $key=>$data)
                                        <option value="{{ $key }}">{{ $data }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan Tambahan</label>
                                <textarea class="form-control" name="keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="OnSubmit()" class="btn btn-primary" id="tombol_simpan">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->