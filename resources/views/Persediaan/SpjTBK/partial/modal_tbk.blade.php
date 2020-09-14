<div class="modal fade" id="modal-lg-tbk">
    <div class="modal-dialog modal-md modal-primary">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Panel Tanda Bukti Kas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('tbk') }}" role="form" method="post" id="quickForm_tbk">
                {{ csrf_field() }}
                <input type="hidden" name="_method" id="method_tbk" value="post">
                <input type="hidden" name="kode_temp_spj" id="kode_temp_spj">
                <input type="hidden" name="kode" id="kode_tbk">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tgl_keluar">Kode TBK</label>
                                <input type="text" class="form-control" name="kode_tbk" placeholder="Masukan Kode TBK" required>
                                <small style="color: red">* kode tidak boleh kosong atau kode yang telah dimasukan sudah ada</small>
                            </div>
                            <div class="form-group">
                                <label for="tgl_keluar">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan TBK" required></textarea>
                                <small style="color: red">* Keterangan Tidak Boleh Kosong</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="tombol_simpan">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->