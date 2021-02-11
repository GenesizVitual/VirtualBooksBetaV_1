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



							<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1>SayaKetik<br /></h1>
											<p></p>
										</header>
										<p>
											Sayaketik (Persediaan) adalah aplikasi berbasis online yang digunakan untuk membantu anda dalam mengelola atau memonitor data transaksi persediaan dalam pengolahan barang pakai habis. Aplikasi ini dirancangan dengan semudah mungkin mulai dari pencatatan nota pengadaan barang, pengeluaran barang yang akan didistribusikan kepada bidang atau unit kerja.
										</p>
										<ul class="actions">
											<li><a href="{{ url('login') }}" class="button big" style="width: 100%">Masuk Ke Persediaan</a></li>
											<li><a href="{{ url('') }}" class="button big" style="width: 100%">Alur Persediaan</a></li>
										</ul>
									</div>
									<span class="image object">
										<img src="{{ asset('walpaper.jpg') }}" alt="" />
									</span>
								</section>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Fitur</h2>
									</header>
									<div class="features">
										<article>
											<span class="icon solid fa-image"></span>
											<div class="content">
												<h3>Tampilan</h3>
												<p>Sistem ini didesaign dengan tampilan yang simple dan responsif anda dapat mengakses sistem menggunakan komputer,laptop dan smartphone.</p>
											</div>
										</article>
										<article>
											<span class="icon solid fa-road"></span>
											<div class="content">
												<h3>Alur Sistem</h3>
												<p>Pendataan transaksi penerimaan dan pengeluaran sangat mudah. hanya tiga tahapan dalam pendataan transaksi dari nota pesanan, barang pembelian, barang pengeluaran</p>
											</div>
										</article>
										<article>
											<span class="icon solid fa-search"></span>
											<div class="content">
												<h3>Filter</h3>
												<p>Didalam sistem akan disediakan beberapa fitur dalam pengecekan stok secara ketat dan pengelompokkan nota dengan optimal</p>
											</div>
										</article>
										<article>
											<span class="icon solid fa-book-reader"></span>
											<div class="content">
												<h3>Laporan</h3>
												<p>Sistem menyediakan 12 laporan dalam memonitoring alur penerimaan barang, pengeluaran barang dan stok barang</p>
											</div>
										</article>
									</div>
								</section>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Laporan</h2>
									</header>
									<div class="posts">
										<article>
											{{--<a href="#" class="image"><img src="images/pic01.jpg" alt="" /></a>--}}
											<h3>Daftar Nota</h3>
											<p>
												Daftar nota  menampilkan semua pembelian anda yang telah dimasukan.
											</p>
										</article>
										<article>
											{{--<a href="#" class="image"><img src="images/pic02.jpg" alt="" /></a>--}}
											<h3>Rekapitulasi Persediaan</h3>
											<p>
												Rekapitulasi persediaan digunakan untuk menampilkan jumlah total pembelian surat pertanggung jawaban dan
												jumlah total uang belanja tanda bukti kas.
											</p>
										</article>
										<article>
											{{--<a href="#" class="image"><img src="images/pic03.jpg" alt="" /></a>--}}
											<h3>Rekapitulasi Persediaan Perjenis Belanja</h3>
											<p>
												Rekapitulasi persediaan digunakan untuk menampilkan jumlah total pembelian surat pertanggun jawaban dan
												jumlah total uang belanja tanda bukti kas berdasarkan jenis tanda bukti pembelian.
											</p>
										</article>
										<article>
											{{--<a href="#" class="image"><img src="images/pic04.jpg" alt="" /></a>--}}
											<h3>Persediaan Barang</h3>
											<p>Persediaan barang adalah laporan semua barang yang telah dimasukan kedalam nota pesanan.</p>
										</article>
										<article>
											{{--<a href="#" class="image"><img src="images/pic05.jpg" alt="" /></a>--}}
											<h3>Pengeluaran Barang</h3>
											<p>Pengeluaran barang adalah untuk menampilkan semua data penerimaan yang telah dikeluarkan atau dibagikan ke semua bidang/bagian/unit.</p>
										</article>
										<article>
											{{--<a href="#" class="image"><img src="images/pic05.jpg" alt="" /></a>--}}
											<h3>Pengeluaran Barang PerBidang</h3>
											<p>Pengeluaran barang adalah digunakan untuk menampilkan penerimaan yang telah dikeluarkan di bidang/bagian/unit masing-masing.</p>
										</article>
										<article>
											{{--<a href="#" class="image"><img src="images/pic06.jpg" alt="" /></a>--}}
											<h3>Barang Pakai Habis</h3>
											<p>Barang pakai habis menampilkan data penerimaan dan pengeluaran kesemua bidang secara detail.</p>
										</article>
										<article>
											{{--<a href="#" class="image"><img src="images/pic06.jpg" alt="" /></a>--}}
											<h3>Monitoring Barang Semester</h3>
											<p>Monitoring barang semester menampilkan data penerimaan dan pengeluaran kesemua bidang secara detail per semester.</p>
										</article>
										<article>
											{{--<a href="#" class="image"><img src="images/pic06.jpg" alt="" /></a>--}}
											<h3>Kartu Barang</h3>
											<p>Kartu barang akan menampilkan sisa stok barang pada setiap dikeluarkan.</p>
										</article>
										<article>
											{{--<a href="#" class="image"><img src="images/pic06.jpg" alt="" /></a>--}}
											<h3>Mutasi Barang</h3>
											<p>Mutasi Barang akan melampilkan yang barang masuk, barang keluar dan sisa
												barang baik untuk semua barang.</p>
										</article>
										<article>
											{{--<a href="#" class="image"><img src="images/pic06.jpg" alt="" /></a>--}}
											<h3>Stok Barang</h3>
											<p>Stok barang untuk menampilkan sisa stok barang yang telah dikeluarkan untuk semua barang pembelian.</p>
										</article>
										<article>
											{{--<a href="#" class="image"><img src="images/pic06.jpg" alt="" /></a>--}}
											<h3>Stok Opname</h3>
											<p>Stok opname digunakan untuk mengetahui sisa barang dan jumlah
												uangnya yang dikeluarkan.</p>
										</article>
									</div>
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