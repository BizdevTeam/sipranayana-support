<aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="{{route('admin.dashboard')}}" class="brand-link text-center d-block py-4">
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
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.report') ? 'active' : '' }}" href="{{ route('admin.report') }}">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Pengaduan</p>
                    </a>
                </li>          
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Master Data<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.sistem') }}" class="nav-link {{ request()->routeIs('admin.sistem') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>System</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.topic') }}" class="nav-link {{ request()->routeIs('admin.topic') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Topik Permasalahan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.accountType') }}" class="nav-link {{ request()->routeIs('admin.accountType') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Akun</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
        
                <!-- Tombol Logout -->
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