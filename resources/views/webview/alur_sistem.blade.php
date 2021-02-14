<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>SayaKetik</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="{{ asset('front/assets/css/main.css') }}" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<section>
								<header class="main">
									<h1>Alur Sistem</h1>
								</header>

								<span class="image main"><img src="{{ asset('front/images/alur.png') }}" alt="" /></span>

								<p>
									Alur system terfokus terhadap nota pembelian. Proses dalam memasukan data kedalam aplikasi dimulai dari semua barang pembelian yang ada didalam nota pesanan atau nota pembelian akan dimasukan kedalam aplikasi sebagai persediaan barang. kemudian barang tersebut akan didistribusikan ke masing-masing bidang atau unit sesuai kebutuhannya. Dan hasil semua tersaksi akan terekam didalam laporan pembelian barang pernota, penerimaan barang, pengeluaran barang, dll.
								</p>

								<hr class="major" />

							</section>

						</div>
					</div>

				<!-- Sidebar -->
				@include('webview.component.sidebar')

			</div>

		<!-- Scripts -->
			<script src="{{ asset('front/assets/js/jquery.min.js') }}"></script>
			<script src="{{ asset('front/assets/js/browser.min.js') }}"></script>
			<script src="{{ asset('front/assets/js/breakpoints.min.js') }}"></script>
			<script src="{{ asset('front/assets/js/util.js') }}"></script>
			<script src="{{ asset('front/assets/js/main.js') }}"></script>

	</body>
</html>