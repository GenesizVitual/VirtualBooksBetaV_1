<script>
    $('#response_klasifikasi').change(function (e){
        e.preventDefault();
        load_buku_persediaan($(this).val())
    });

    load_buku_persediaan = function(id_klasifikasi){
        $.ajax({
            url:"{{ url('response_rincian_persediaan') }}",
            type:'post',
            data:{
                'id_klasifikasi': id_klasifikasi,
                '_token': '{{ csrf_token() }}'
            },
            success: function (result){
                console.log(result.data)
                table_persediaan.clear().draw();
                table_persediaan.rows.add(result.data).draw();
            }
        })
    }
</script>
