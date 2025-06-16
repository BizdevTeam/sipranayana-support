<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto mr-3">
        @if(Auth::check())
        <span class="brand-text font-weight-bold text-dark d-block fs-5">
            {{ Auth::user()->name }} <strong class="text-primary">({{ Auth::user()->status }})</strong>
        </span>
    @endif
    </ul>
    
</nav>
