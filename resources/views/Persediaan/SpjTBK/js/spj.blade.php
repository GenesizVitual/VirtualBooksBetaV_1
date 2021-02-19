<script>
    onEditSpj = function (kode) {
        $.ajax({
            url: '{{ url('spj-tbk') }}/'+kode+'/edit',
            type: 'get',
            success : function (result) {
                $('#method_spj').val('put');
                $('#kode_spj').val(result.id);
                $('[name="kode_spj"]').val(result.kode);
                $('#quickForm_spj').attr('action','{{ url('spj-tbk') }}/'+result.id);
                $('#modal-lg-spj').modal('show');
            }
        })
    }

    onDeleteSpj = function (kode) {
        if(confirm('Apakah anda akan menghapus spj ini, jika akan menghapusnya data yang terkait akan dihapuskan'))
        {
            $.ajax({
                url: '{{ url('spj-tbk') }}/'+kode,
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
        }else{
            alert('Proses dihentikan');
        }
    }
</script>