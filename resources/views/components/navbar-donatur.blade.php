<header class="navbar navbar-expand-md d-print-none sticky-top navbar-light">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/" class="text-decoration-none d-flex align-items-center">
                <span class="fs-2">🌱</span>
                <span class="ms-2 fw-bold text-dark">Nanoseed</span>
            </a>
        </h1>

        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav nav-pills">
                    <li class="nav-item {{ request()->routeIs('donatur.dashboard') ? 'active' : '' }}">
                        <a class="nav-link px-3" href="{{ route('donatur.dashboard') }}">
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('views.donatur.kampanye') ? 'active' : '' }}">
                        <a class="nav-link px-3" href="{{ route('views.donatur.kampanye') }}">
                            <span class="nav-link-title">Kampanye</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('views.donatur.donasi') ? 'active' : '' }}">
                        <a class="nav-link px-3" href="{{ route('views.donatur.donasi') }}">
                            <span class="nav-link-title">Donasi</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('views.donatur.dampak') ? 'active' : '' }}">
                        <a class="nav-link px-3" href="{{ route('views.donatur.dampak') }}">
                            <span class="nav-link-title">Dampak</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('views.donatur.dokumentasi') ? 'active' : '' }}">
                        <a class="nav-link px-3" href="{{ route('views.donatur.dokumentasi') }}">
                            <span class="nav-link-title">Dokumentasi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
                <form action="{{ route('admin.search') }}" method="GET">
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <i class="ti ti-search"></i>
                        </span>
                        <input type="text" name="q" class="form-control" placeholder="Cari..." aria-label="Search">
                    </div>
                </form>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link px-0 text-muted" title="Notifikasi">
                    <i class="ti ti-bell icon"></i>
                </a>
            </div>
        </div>
    </div>
</header>