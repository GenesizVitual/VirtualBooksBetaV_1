<script>
    var kode_pembelian;
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    onStore = function (url) {
        $.ajax({
            url: url,
            type:'post',
            data: $('#quickForm').serialize(),
            success:function (result) {
                feedback(result);
                collect_data_pembelian();
                $('[name="_method"]').val('post');
                focus();
            }
        })
    }

    onEdit = function (kode) {
        $.ajax({
           url: '{{ url('pembelian-barang') }}/'+kode+'/edit',
           type: 'get',
           dataType: 'json',
           success: function (result) {
               focus();
               kode_pembelian = result.data.id;
               $('[name="_method"]').val('put');
               $('[name="id_gudang"]').val(result.data.id_gudang).trigger('change');
               $('[name="jumlah_barang"]').val(result.data.jumlah_barang);
               $('[name="satuan"]').val(result.data.satuan);
               $('[name="harga_barang"]').val(result.data.harga_barang);
               $('[name="tanggal_expired"]').val(result.data.tanggal_expired);
               $('[name="keterangan"]').val(result.data.keterangan);
           }
        });
    }

    onUpdate = function () {
        onStore('{{ url('pembelian-barang') }}/'+kode_pembelian);
        $('[name="_method"]').val('post');

    }

    onDelete = function (kode) {
        if(confirm('Apakah anda yakin akan menghapus barang ini ... ?')){
            $.ajax({
                url:'{{ url('pembelian-barang') }}/'+kode,
                type:'post',
                data:{
                    '_method':'delete',
                    '_token' : '{{ csrf_token() }}'
                },
                success: function (result) {
                    feedback(result);
                    collect_data_pembelian();
                }
            })
        }else{
            alert('Proses hapus dibatalkan');
        }
    }

    feedback=function (result) {
        Toast.fire({
            icon: result.status,
            title: result.message
        })
    }

    clear = function(){
        $('[name="jumlah_barang"]').val('');
        $('[name="satuan"]').val('');
        $('[name="harga_barang"]').val('');
        $('[name="tanggal_expired"]').val('');
        $('[name="keterangan"]').val('');
    }
</script>