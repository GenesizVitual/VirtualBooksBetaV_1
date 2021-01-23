<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SayaKetik | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin_asset/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin_asset/dist/css/adminlte.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> SayaKetik,Inc.
          <small class="float-right">Date: {{ $tanggal }}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Dari
        <address>
          <strong>SayaKetik, Inc.</strong><br>
          Jln. Kendari Permai, Blok L3 No.18<br>
          Kendari, Sulawesi Tengga 93231<br>
         </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>{{ $data->linkToInstansi->LinksToUsers->name }}</strong><br>
          {{ $data->linkToInstansi->name_instansi }},{{ $data->linkToInstansi->alamat }}<br>
          Telp: {{ $data->linkToInstansi->no_telp }}<br>
          Email:{{ $data->linkToInstansi->LinksToUsers->email }}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #{{ $uid }}</b><br>
        <br>
        <b>Order ID:</b> {{ $data->kode_bayar }}<br>
        <b>Payment Due:</b> {{ date('d/m/Y', strtotime($data->tgl_pembayaran)) }}<br>
       </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>Product</th>
            <th>Description</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>1</td>
            <td>Persediaan</td>
            <td>Biaya berlangganan aplikasi persediaan selama 31 hari </td>
            <td>{{ number_format($data->linkToInstansi->nilai_langganan,2,',','.') }}</td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">

      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead">Amount Due {{ $tanggal }}</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th>Total:</th>
              <td>{{ number_format($data->linkToInstansi->nilai_langganan,2,',','.') }}</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
</html>
