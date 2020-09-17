<div class="modal fade" id="modal-lg-nota">
    <div class="modal-dialog modal-md modal-primary">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Panel Pindah Nota</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('tbk-nota') }}" role="form" method="post" id="quickForm_nota">
                {{ csrf_field() }}
                <input type="hidden" name="kode" id="kode_tbk_nota">
                <input type="hidden" name="_method" value="put">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_gudang">Tanda Bukti Kas</label>
                                <select class="form-control select2" style="width: 100%;" name="tbk_nota" required>
                                    @if(!empty($data))
                                        @foreach($data as $data_spj)
                                            <optgroup label="{{ $data_spj->kode }}">
                                                @foreach($data_spj->linkToTbk as $data_tbk)
                                                    <option value="{{ $data_tbk->id }}">{{ $data_tbk->kode }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    @endif
                                </select>
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