<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Extra Large Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="row">
                   <div class="col-sm-12">
                       Tanggal
                   </div>
                   <div class="col-sm-12">
                       <div class="row">
                           @if(!empty($bidang))
                           @foreach($bidang as $bidang)
                               <div class="col-md-3">
                                   <div class="card card-danger collapsed-card">
                                       <div class="card-header">
                                           <h3 class="card-title">{{ $bidang->nama_bidang }}</h3>

                                           <div class="card-tools">
                                               <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                               </button>
                                           </div>
                                           <!-- /.card-tools -->
                                       </div>
                                       <!-- /.card-header -->
                                       <div class="card-body">
                                           The body of the card
                                       </div>
                                       <!-- /.card-body -->
                                   </div>
                                   <!-- /.card -->
                               </div>
                           @endforeach

                           @else
                               <h3>Bidang/bagian belum dimasukan. mohon masukan data bidang/bagian anda. <a href="{{ url('bidang') }}">klik disini</a></h3>
                           @endif
                       </div>
                   </div>
               </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
