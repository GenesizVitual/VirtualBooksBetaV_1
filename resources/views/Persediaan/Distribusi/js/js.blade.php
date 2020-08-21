<script src="{{ asset('admin_asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>



<script>
    $(function () {

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
               {'data':'harga'},
               {'data':'sub_total'},
               {'data':'aksi'},
           ]

        });

        onLoaded = function (status_pembayaran) {
            $.ajax({
                url : '{{ url('load-data-pembelian') }}',
                type : 'post',
                data : {
                    '_token':'{{ csrf_token() }}',
                    '_method':'put',
                    'kode_barang': '{{ $gudang->id }}',
                    'status_pembayaran': status_pembayaran
                }
            }).done(function (result) {
                $('#stok_tersedian').text(result.banyak_barang);
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



        CallFormData = function (action) {

            var form_pengeluaran = $('#xample1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $.ajax({
                url : '{{ url('form-data-distribusi') }}',
                type: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    '_method': 'put',
                    'kode': action,
                },
            }).done(function (result) {
                $('#modal-xl').modal('show');
                form_pengeluaran.clear().draw()
                form_pengeluaran.rows.add(result.data_form).draw();
            })
        }


//        CallFormData(1)

        onLoaded(0);
    });
</script>

