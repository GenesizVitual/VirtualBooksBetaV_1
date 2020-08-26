<script>
    OnSubmit = function () {
        if($('#quickForm').valid()){
            if($('[name="_method"]').val()=="post"){
                OnItemOut();
            }else{
                OnItemOut
            }
        }else{
            alert('Isilah formulir dibawah ini');
        }
    }

    OnItemOut = function () {
        $.ajax({
            url: '{{ url('distribusi') }}',
            type:'post',
            data : $('#quickForm').serialize(),
            success : function (result) {
                feedback(result);
            }
        })
    }

    OnItemUpdate = function (kode) {
        $.ajax({
            url: '{{ url('distribusi') }}/'+kode,
            type:'post',
            data : $('#quickForm').serialize(),
            success : function (result) {
                feedback(result);
            }
        })
    }

    OnItemEdit = function(kode){
        $.ajax({
            url: '{{ url('edit-data-distribusi') }}',
            type: 'post',
            data: {
                '_method':'put',
                '_token':'{{ csrf_token() }}',
                'kode': kode
            }
        }).done(function (result) {
            var d =formatDate(result.tgl_kerluar);
            $('[name="kode"]').val(result.id);
            $('[name="_method"]').val('put');
            $('[name="tgl_kerluar"]').val(d);
            $('[name="id_bidang"]').val(result.id_bidang).trigger('change');
            $('[name="jumlah_keluar"]').val(result.jumlah_keluar);
            $('[name="status_pengeluaran"]').val(result.status_pengeluaran).trigger('change');
            $('[name="keterangan"]').val(result.keterangan);
            $('#tombol_simpan').attr('onclick','OnItemUpdate('+result.id+')');
            $('#modal-lg').modal('show');
        })
    }




</script>