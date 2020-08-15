<script src="{{ asset('admin_asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $(function () {
        tabel_nota=$('#table-data-nota').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });

        collect_data_nota = function () {
            $.ajax({
                url:'{{ url('load-data-nota') }}',
                dataType: 'json',
                type :'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                }
            }).done(function (result) {
                tabel_nota.clear().draw();
                tabel_nota.rows.add(result.data).draw();
            });
        }

        collect_data_nota();

        edit_nota = function (kode) {
            $("[name='ppn']").prop('checked', false);
            $("[name='pph']").prop('checked', false);
            $('[name="_method"]').val('post')

            $.ajax({
                url: '{{ url('edit-nota') }}/'+kode,
                dataType:'json',
                type : 'post',
                data: {
                    '_token':'{{ csrf_token() }}'
                },
                success: function (result) {
                    $('#quickForm').attr('action','{{ url('nota') }}/'+result.data.id);
                    $("[name='kode_nota']").val(result.data.kode_nota);
                    $("[name='tgl_beli']").val(result.data.tgl_beli);
                    $("[name='id_penyedia']").val(result.data.id_penyedia).trigger('change');
                    $("[name='id_jenis_tbk']").val(result.data.id_jenis_tbk).trigger('change');
                    if(result.data.pph==1){
                        $("[name='ppn']").prop('checked', true);
                    }
                    if(result.data.ppn==1){
                        $("[name='pph']").prop('checked', true);
                    }
                    $('[name="_method"]').val('put');
                    $('#tab2').click();
                }
            });
        }

        delete_nota = function (kode) {
            if(confirm('Jika anda menghapus nota ini, data pembelian yang terkait akan dihilangkan')){
                $.ajax({
                    url: '{{ url('nota') }}/'+kode,
                    type : 'post',
                    data: {
                        '_token':'{{ csrf_token() }}',
                        '_method':'delete'
                    },
                    success: function (result) {
                        if(result.status==true){
                            Toast.fire({
                                icon: 'success',
                                title: result.message
                            })
                            collect_data_nota()
                        }else{
                            Toast.fire({
                                icon: 'error',
                                title: result.message
                            })
                        }
                        $('#tab1').click()
                    }
                });
            }else{
                alert('Hapus nota dibatalkan');
            }
        }
    });
</script>