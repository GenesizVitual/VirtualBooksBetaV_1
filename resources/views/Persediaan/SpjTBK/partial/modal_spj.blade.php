<div class="modal fade" id="modal-lg-spj">
    <div class="modal-dialog modal-md modal-primary">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Panel Surat Pertanggung Jawaban</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('spj-tbk') }}" role="form" method="post" id="quickForm">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="post">
                <input type="hidden" name="kode">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tgl_keluar">Kode SPJ</label>
                                <input type="text" class="form-control" name="kode_spj" id="kode_spj" placeholder="Masukan Kode SPJ">
                                <small style="color: red">* kode tidak boleh kosong atau kode yang telah dimasukan sudah ada</small>
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