<script>

    OnPressButtonIncreate = function (action, stok) {
        $('#modal-lg').modal({backdrop: 'static', keyboard: false});
        $('[name="kode"]').val(action);
        $('[name="stok_terakhir"]').val(stok);
//        $('.select2').select2();

    }

    OnSubmit = function () {
        if($('#quickForm').valid()){
            if($('[name="_method"]').val()=="post"){
                OnItemOut();
            }else{
                OnItemUpdate();
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
                CallFormData(result.kode, result.stok);
                onLoaded(result.status_penerimaan,'#table-data-pembelian','pem');
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
                CallFormData(result.kode,result.stok);
                $('[name="_method"]').val('post');
                onLoaded(result.status_penerimaan,'#table-data-pembelian','pem');
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
            console.log(result.tgl_kerluar);
            $('#modal-lg').modal('show');
            $('[name="kode"]').val(result.id);
            $('[name="_method"]').val('put');
            $('[name="tgl_kerluar"]').val(result.tgl_kerluar);

            $('[name="id_bidang"]').val(result.id_bidang).trigger('change');
            $('[name="jumlah_keluar"]').val(result.jumlah_keluar);
            $('[name="status_pengeluaran"]').val(result.status_pengeluaran).trigger('change');
            $('[name="keterangan"]').val(result.keterangan);
            $('#tombol_simpan').attr('onclick','OnItemUpdate('+result.id+')');

        })
    }

    OnItemDelete = function (kode) {
        if(confirm('Apakah anda ingin menghapus barang ditribusi ini ...?')){
            $.ajax({
                url: '{{ url('delete-data-distribusi') }}/'+kode,
                type:'post',
                data : {
                    '_token': '{{ csrf_token() }}',
                    '_method': 'put',
                    'kode': kode,
                    'status': $('[name="status"]').val()
                },
                success : function (result) {
                    feedback(result);
                    CallFormData(result.kode, result.stok);
                    onLoaded(result.status_penerimaan,'#table-data-pembelian','pem');
                }
            })
        }else {
            alert('Proses hapus dibatalkan');
        }
    }


</script>