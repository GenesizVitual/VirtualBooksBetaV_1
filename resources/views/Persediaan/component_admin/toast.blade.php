<script type="text/javascript">
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        @if(!empty(Session::get('message_success')))
            Toast.fire({
                icon: 'success',
                title: '{{ Session::get('message_success') }}'
            })
        @endif

        @if(!empty(Session::get('message_info')))
            Toast.fire({
                icon: 'info',
                title: '{{ Session::get('message_info') }}'
            })
        @endif

        @if(!empty(Session::get('message_error')))
            Toast.fire({
                icon: 'error',
                title: '{{ Session::get('message_error') }}'
            })
        @endif

        @if(!empty(Session::get('message_warning')))
            Toast.fire({
                icon: 'warning',
                title: '{{ Session::get('message_warning') }}'
            })
        @endif

        @if(!empty(Session::get('message_question')))
            Toast.fire({
                icon: 'question',
                title: '{{ Session::get('message_question') }}'
            })
        @endif

        @if(count($errors) > 0)
            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'error',
                    title: '{{ $error }}'
                })
            @endforeach
        @endif

        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultInfo').click(function() {
            Toast.fire({
                icon: 'info',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });

        $('.swalDefaultError').click(function() {
            Toast.fire({
                icon: 'error',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });

        $('.swalDefaultWarning').click(function() {
            Toast.fire({
                icon: 'warning',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });

        $('.swalDefaultQuestion').click(function() {
            Toast.fire({
                icon: 'question',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });

    });

</script>