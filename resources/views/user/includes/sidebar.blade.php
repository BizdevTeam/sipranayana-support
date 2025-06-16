<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('user.dashboard') }}" class="brand-link text-center d-block py-4">
        <div class="text-center">
            <img src="{{ asset('images/logo.png')}}" 
                alt="Sistem Pengaduan Logo" 
                class="img-fluid" 
                style="max-width: 70px; opacity: 0.95; background-color: transparent;">
        </div>
        <span class="brand-text font-weight-bold text-dark d-block fs-5">
            Sistem Pengaduan <br> <span class="text-primary">Sipranayana</span>
        </span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.report') ? 'active' : '' }}" href="{{ route('user.report') }}">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Pengaduan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-danger text-white text-left w-100">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>
            </ul>          
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>