<aside class="main-sidebar sidebar-dark-warning elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('dashboard') }}" class="brand-link">
        <img src="https://icons-for-free.com/iconfiles/png/512/archive-131965017300175986.png"  alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8; background-color:deepskyblue">
        <span class="brand-text font-weight-light">Persediaan Barang</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://cdn0.iconfinder.com/data/icons/set-ui-app-android/32/8-512.png" class="img-circle elevation-2" style="background-color: ghostwhite" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Session::get('name') }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link @if(Session::get('menu') == 'dashboard') active @else  @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link @if(Session::get('menu') == 'data_master') active @endif">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('instansi') }}" class="nav-link  @if(Session::get('sub_menu') == 'instansi') active @endif" >
                                <i class="far fa-building nav-icon"></i>
                                <p>Instansi </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('bidang') }}" class="nav-link @if(Session::get('sub_menu') == 'bidang') active @endif">
                                <i class="far fa fa-puzzle-piece nav-icon"></i>
                                <p>Bidang/Bagian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('tahun-anggaran') }}" class="nav-link @if(Session::get('sub_menu') == 'tahun_anggaran') active @endif">
                                <i class="far fa-calendar nav-icon"></i>
                                <p>Tahun Anggaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('jenis-tbk') }}" class="nav-link @if(Session::get('sub_menu') == 'jenis_tbk') active @endif">
                                <i class="far fa fa-paperclip nav-icon"></i>
                                <p>Jenis TBK</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('penyedia') }}" class="nav-link @if(Session::get('sub_menu') == 'penyedia') active @endif">
                                <i class="far fa fa-store nav-icon"></i>
                                <p>Penyedia</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('gudang') }}" class="nav-link @if(Session::get('sub_menu') == 'gudang') active @endif">
                                <i class="far fa fa-warehouse nav-icon"></i>
                                <p>Gudang</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link  @if(Session::get('menu') == 'data_pengguna') active @endif">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Data Pengguna
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('berwenang') }}" class="nav-link @if(Session::get('sub_menu') == 'berwenang') active @endif">
                                <i class="far fa-user nav-icon"></i>
                                <p>Berwenang</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('nota') }}" class="nav-link @if(Session::get('menu') == 'nota') active @endif">
                        <i class="nav-icon fas fa fa-paperclip"></i>
                        <p>Nota Pesanan</p>
                    </a>
                </li>

                {{--<li class="nav-item has-treeview">--}}
                    {{--<a href="#" class="nav-link ">--}}
                        {{--<i class="nav-icon fas fa-envelope"></i>--}}
                        {{--<p>--}}
                            {{--Surat--}}
                            {{--<i class="right fas fa-angle-left"></i>--}}
                        {{--</p>--}}
                    {{--</a>--}}
                    {{--<ul class="nav nav-treeview">--}}
                        {{--<li class="nav-item">--}}
                            {{--<a href="#" class="nav-link ">--}}
                                {{--<i class="far fa-circle nav-icon"></i>--}}
                                {{--<p>Surat Pesanan</p>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                            {{--<a href="#" class="nav-link ">--}}
                                {{--<i class="far fa-circle nav-icon"></i>--}}
                                {{--<p>B.A Hasil Penerimaan</p>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                            {{--<a href="#" class="nav-link ">--}}
                                {{--<i class="far fa-circle nav-icon"></i>--}}
                                {{--<p>B.A Penerimaan Barang</p>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                            {{--<a href="#" class="nav-link ">--}}
                                {{--<i class="far fa-circle nav-icon"></i>--}}
                                {{--<p>B.A Serah Terima</p>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                <li class="nav-item">
                    <a href="{{ url('spj-tbk') }}" class="nav-link @if(Session::get('menu')=='spj-tbk') active @endif">
                        <i class="nav-icon fas fa fa-book"></i>
                        <p>Penentuan SPJ/TBK</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('distribusi') }}" class="nav-link @if(Session::get('menu')=='distribusi') active @endif">
                        <i class="nav-icon fas fa fa-share"></i>
                        <p>Distribusi Barang</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link @if(Session::get('menu')=='surat') active @endif">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Surat
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('surat-permintaan') }}" class="nav-link @if(Session::get('sub_menu')=='surat_permintaan') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Surat Permintaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('surat-pengeluaran') }}" class="nav-link @if(Session::get('sub_menu')=='surat_pengeluaran') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Surat Pengeluaran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('laporan') }}" class="nav-link @if(Session::get('menu')=='laporan') active @endif">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Laporan</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>