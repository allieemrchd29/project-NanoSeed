<header class="navbar navbar-expand-md d-print-none sticky-top navbar-light">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu-donatur"
            aria-controls="navbar-menu-donatur" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/" class="text-decoration-none d-flex align-items-center">
                <span class="fs-2">🌱</span>
                <span class="ms-2 fw-bold text-dark">NanoSeed</span>
            </a>
        </h1>

        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item">
                <a href="#" class="nav-link px-2 text-muted">
                    <i class="ti ti-bell icon"></i>
                </a>
            </div>
        </div>
                <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar navbar-light">
                    <div class="container-xl">
                        <ul class="navbar-nav">

        <div class="collapse navbar-collapse" id="navbar-menu-donatur">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->routeIs('donatur.dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="/">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-home icon"></i>
                            </span>
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('donatur.aboutus') ? 'active' : '' }}">
                        <a class="nav-link" href="#aboutus">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-users icon"></i>
                            </span>
                            <span class="nav-link-title">About Us</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('donatur.kampanye') || request()->is('donatur/kampanye*') ? 'active' : '' }}">
                        <a class="nav-link" href="kampanye">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-sparkles icon"></i>
                            </span>
                            <span class="nav-link-title">Kampanye</span>
                        </a>
                    </li>
                   
                    <li class="nav-item {{ request()->routeIs('donatur.donasi') || request()->is('donatur/donasi*') ? 'active' : '' }}">
                        <a class="nav-link" href="donatur.donasi">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-seeding icon"></i>
                            </span>
                            <span class="nav-link-title">Donasi</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('donatur.dokumentasi') || request()->is('donatur/dokumentasi*') ? 'active' : '' }}">
                        <a class="nav-link" href="dokumentasi">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-file-text icon"></i>
                            </span>
                            <span class="nav-link-title">Dokumentasi</span>
                        </a>
                    </li>

                    <!-- fitur search -->
                    <li class="nav-item d-flex align-items-center" style="margin-left: 15px;">
                        <form action="{{ route('donatur.dashboard') }}" method="GET" class="m-0">
                            <div class="input-group"
                                style="border-radius: 30px; overflow: hidden; box-shadow: 0 2px 8px rgba(34, 197, 94, 0.15); border: 1px solid #f3f7f5;">
                                <input type="text" name="keyword" class="form-control border-0 px-3"
                                    placeholder="Cari kebaikan 🌱..." value="{{ request('keyword') }}"
                                    style="background-color: #f2fdf5; font-size: 0.9rem; outline: none; box-shadow: none; min-width: 330px;">
                                <!-- tombol bersihkan pencarian -->
                                @if (request('keyword'))
                                    <a href="{{ url('/') }}" class="btn border-0 d-flex align-items-center px-2"
                                        style="background-color: #f2fdf5; color: #dc3545; text-decoration: none;"
                                        title="Hapus pencarian">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                @endif

                                <button class="btn border-0 px-3" type="submit"
                                    style="background-color: #cef3db; color: #04440f; transition: 0.3s;">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
