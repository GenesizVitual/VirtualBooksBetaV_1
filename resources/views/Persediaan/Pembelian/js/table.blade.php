<script src="{{ asset('admin_asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
    $(function () {
       var tabel_pembelian=$('#table-data').DataTable({
            "columnDefs":[
                {'width':'20%','targets':6}
            ],
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        collect_data_pembelian = function () {
            $.ajax({
                url: '{{ url('load-data-pembelian') }}/'+'{{ $nota->id }}',
                dataType: 'json',
                type:'post',
                data : {
                    '_token':'{{ csrf_token() }}'
                }
            }).done(function (result) {
                $('#total_pembelian').text(result.total_beli);
                $('#pph').text(result.pph);
                $('#ppn').text(result.ppn);
                tabel_pembelian.clear().draw();
                tabel_pembelian.rows.add(result.data).draw();
            })
        }

        collect_data_pembelian();
    });
</script>