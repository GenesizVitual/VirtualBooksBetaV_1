<div class="col-sm-12" style="margin-top: 2%">
    @if(!empty(Session::get('message_success')))
        <div class="alert alert-success alert-dismissible">
            {{ Session::get('message_success') }}
        </div>
    @endif

    @if(!empty(Session::get('message_error')))
        <div class="alert alert-danger alert-dismissible">
            {{ Session::get('message_error') }}
        </div>
    @endif
</div>