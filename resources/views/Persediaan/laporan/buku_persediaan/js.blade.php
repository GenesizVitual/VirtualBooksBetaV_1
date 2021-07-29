<script>
    $('#response_barang').change(function (e){
        e.preventDefault();
        load_buku_persediaan($(this).val())
    });

    load_buku_persediaan = function(id_barang){
        $.ajax({
            url:"{{ url('response_buku_persediaan') }}",
            type:'post',
            data:{
                'id_barang': id_barang,
                '_token': '{{ csrf_token() }}'
            },
            success: function (result){
                console.log(result)
                var no =1;
                table_persediaan.clear().draw();
                table_persediaan.rows.add(result.data).draw();
            }
        })
    }
</script>
