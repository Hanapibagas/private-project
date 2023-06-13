<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a href="" class=" navbar-brand">
            <img src="{{ asset('assets/frontend/images/logo.svg') }}" alt="Logo" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ route('index1') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item {{ request()->is('prodcut-home') ? 'active' : '' }}">
                    <a href="{{ route('category1') }}" class="nav-link">Categories</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('get-index') }}" class="nav-link">My Transaksi</a>
                </li>
                <li class="nav-item">
                    <a>{{ Auth::user()->name }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>