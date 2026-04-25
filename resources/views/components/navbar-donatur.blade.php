<header class="navbar navbar-expand-md d-print-none sticky-top navbar-light">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
        data-bs-target="#navbar-menu-donatur"   {{-- ← fix: tambah -donatur --}}
        aria-controls="navbar-menu-donatur"     {{-- ← fix: tambah -donatur --}}
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/" class="text-decoration-none d-flex align-items-center">
                <span class="fs-2">🌱</span>
                <span class="ms-2 fw-bold text-dark">Nanoseed</span>
            </a>
        </h1>

        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item">
                <a href="#" class="nav-link px-2 text-muted">
                    <i class="ti ti-bell icon"></i>
                </a>
            </div>
            </div>

        <div class="collapse navbar-collapse" id="navbar-menu-donatur">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->routeIs('donatur.dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('donatur.dashboard') }}">
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('views.donatur.kampanye') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('views.donatur.kampanye') }}">
                            <span class="nav-link-title">Kampanye</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('views.donatur.donasi') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('views.donatur.donasi') }}">
                            <span class="nav-link-title">Donasi</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('views.donatur.dampak') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('views.donatur.dampak') }}">
                            <span class="nav-link-title">Dampak</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('views.donatur.dokumentasi') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('views.donatur.dokumentasi') }}">
                            <span class="nav-link-title">Dokumentasi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
