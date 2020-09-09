<button class="btn btn-success"
        {{--data-toggle="modal" data-target="#modal-xl"--}}
        onclick="CallFormData('{{ $data[0]->id }}','{{ $data[0]->stok }}')"
>{{ $data[1] }}</button>