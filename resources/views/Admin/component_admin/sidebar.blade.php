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
                <li class="nav-item">
                    <a href="{{ url('langganan') }}" class="nav-link @if(Session::get('menu') == 'langganan') active @else  @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Berlangganan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dokumentasi') }}" class="nav-link @if(Session::get('menu') == 'dokumentasi') active @else  @endif">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Dokumentasi</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>