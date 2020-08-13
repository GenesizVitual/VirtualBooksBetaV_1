<script>
    onStore = function () {
        $.ajax({
            url:'{{ url('pembelian-barang') }}/'+'{{ $nota->id }}/store',
            type:'post',
            data: $('#quickForm').serialize(),
            success:function (result) {
                feedback(result)
            }
        })
    }

    feedback=function (result) {
        console.log(result);
    }
</script>