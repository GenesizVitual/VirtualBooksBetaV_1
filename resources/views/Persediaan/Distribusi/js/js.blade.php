<script src="{{ asset('admin_asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ asset('admin_asset/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/jquery-validation/additional-methods.min.js') }}"></script>

<script>
    $(document).ready(function () {

        var status;

        feedback=function (result) {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            Toast.fire({
                icon: result.status,
                title: result.message
            })
            $('#tombol_simpan').attr('onclick','OnItemOut()');
            $('#modal-lg').modal('hide');
        }

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
            status = status_pembayaran;
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
                $('#table-data-pembelian').DataTable()
                    .columns.adjust()
                    .responsive.recalc();
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

       var form_pengeluaran= $('#sample1').DataTable({
            responsive: true
        });


       CallFormData = function (action) {
            $('#custom-content-below-pembagian-tab').click()
            $.ajax({
                url : '{{ url('form-data-distribusi') }}',
                type: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    '_method': 'put',
                    'kode': action,
                },
            }).done(function (result) {
                $('[name="kode"]').val(action);
                form_pengeluaran.clear().draw()
                form_pengeluaran.rows.add(result.data_form).draw();
                $('#sample1').DataTable()
                    .columns.adjust()
                    .responsive.recalc();
                $('.select2').select2();
            })
        }

        $('#custom-content-below-home-tab').click(function () {
            onLoaded(status);
        })

        onLoaded(0);
    });

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        var nDate =  [day,month,year].join('/');

        return nDate;
    }
</script>

