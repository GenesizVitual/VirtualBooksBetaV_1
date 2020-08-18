<script src="{{ asset('admin_asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $(function () {

        var status_pembayaran=0;

       var pembelian = $('#table-data-pembelian').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
           "columns":[
               {'data':'no'},
               {'data':'tgl_beli'},
               {'data':'nama_barang'},
               {'data':'stok'},
               {'data':'aksi'},
           ]

        });

        onLoaded = function () {
            $.ajax({
                url : '{{ url('load-data-pembelian') }}',
                type : 'post',
                data : {
                    '_token':'{{ csrf_token() }}',
                    '_method':'put',
                    'kode_barang': '{{ $id_barang }}',
                    'status_pembayaran': status_pembayaran
                }
            }).done(function (result) {
                pembelian.clear().draw();
                pembelian.rows.add(result.data).draw();
            })
        }

       var pengeluaran= $('#table-data-pengeluaran').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        onLoaded();
    });
</script>

