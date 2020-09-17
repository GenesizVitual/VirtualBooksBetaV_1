<script>
    onShareNota = function (kode) {
        $('[name="tbk_nota"]').select2();
        $('#quickForm_nota').attr('action','{{ url('tbk-nota') }}/'+kode);
        $('#kode_tbk_nota').val(kode);
        $("#modal-lg-nota").modal('show');
    }
</script>