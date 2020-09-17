<script>

    OnButtonTbk = function (kode) {
        $('#kode_temp_spj').val(kode);
        $('#method_tbk').val('post');
        $('#modal-lg-tbk').modal('show');
        $('#quickForm_tbk').attr('action','{{ url('tbk') }}');
    }

    onEditTbk = function (kode) {
        $.ajax({
            url: '{{ url('tbk') }}/'+kode+'/edit',
            type: 'get',
            success : function (result) {
                $('#kode_temp_spj').val(result.id_spj);
                $('#kode_tbk').val(result.id);
                $('[name="kode_tbk"]').val(result.kode);
                $('[name="keterangan"]').text(result.keterangan);
                $('#method_tbk').val('put');
                $('#quickForm_tbk').attr('action','{{ url('tbk') }}/'+result.id);
                $('#modal-lg-tbk').modal('show');
            }
        })
    }

    onDeleteTbk = function (kode) {
       if(confirm('Apakah anda akan menghapus tbk ini. Nota yang telah terhubung akan dilepaskan'))
       {
           $.ajax({
               url: '{{ url('tbk') }}/'+kode,
               type: 'post',
               data : {
                   '_method': 'delete',
                   '_token' : '{{ csrf_token() }}'
               },
               success : function (result) {
                   Toast.fire({
                       icon: result.status,
                       title: result.message
                   })
                   window.location.reload();
               }
           })
       }
    }
</script>