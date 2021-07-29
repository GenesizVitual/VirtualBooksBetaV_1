<script>
    linkToKlasifikasi = function(index, value){
        $.ajax({
            url:'{{ url('jenis-tbk-link-klasifikasi') }}',
            type: 'post',
            data: {
                'index':index,
                'value':value,
                '_token':'{{ csrf_token() }}'
            },
            success: function(result){
                alert('Telah berhasil terklasifikasi');
                // window.location.reload();
            },
            error: function (xhr, status, messge){
                alert('Pastikan internet anda stabil');
                // window.location.reload();
            }
        })
    }
</script>
