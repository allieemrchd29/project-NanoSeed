<style>
    :root {
        --tblr-primary: #198f2c;
        --tblr-navbar-active-border-color: #198f2c;
    }

    .nav-item.active .nav-link,
    .nav-item.active .nav-link-icon,
    .nav-item.active .nav-link-title {
        color: #198f2c !important;
        font-weight: 600;
    }
</style>

{{-- BARIS ATAS: Brand + Notif + Avatar --}}
<header class="navbar navbar-expand-md d-print-none sticky-top">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <span class="fs-2">🌱</span>
            <span class="ms-1">Nanoseed</span>
        </h1>

        <div class="navbar-nav flex-row order-md-last">

            {{-- Kolom Pencarian --}}
            <div class="nav-item d-none d-md-flex me-3">
                <form action="{{ route('admin.search') }}" method="GET" class="d-flex">
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <i class="ti ti-search"></i>
                        </span>
                        <input type="text" name="q" class="form-control" placeholder="Cari..."
                            aria-label="Search">
                    </div>
                </form>
            </div>

            {{-- Notifikasi --}}
            <div class="nav-item me-3">
                <a href="#" class="nav-link px-0 text-muted">
                    <i class="ti ti-bell icon"></i>
                </a>
            </div>

            {{-- Profile Dropdown --}}
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">

                    @if (auth('admin')->user()->profile)
                        <span class="avatar avatar-sm"
                            style="background-image: url('{{ asset('storage/' . auth('admin')->user()->profile) }}')"></span>
                    @else
                        <span class="avatar avatar-sm bg-success text-white fw-bold">
                            {{ strtoupper(substr(auth('admin')->user()->name, 0, 1)) }}
                        </span>
                    @endif

                    <div class="d-none d-xl-block ps-2">
                        <div class="fw-bold">{{ auth('admin')->user()->name }}</div>
                        <div class="mt-1 small text-secondary">Administrator</div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="dropdown-header">
                        <div class="fw-bold">{{ auth('admin')->user()->name }}</div>
                        <div class="text-muted small">{{ auth('admin')->user()->email }}</div>
                    </div>

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">
                        <i class="ti ti-settings me-2"></i> Pengaturan Profil
                    </a>

                    <div class="dropdown-divider"></div>

                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="ti ti-logout me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
</header>

{{-- BARIS BAWAH: Menu Navigasi Utama --}}
<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">

                    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-home icon"></i>
                            </span>
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('admin.kampanye.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.kampanye.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-sparkles icon"></i>
                            </span>
                            <span class="nav-link-title">Kampanye</span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('views.admin.donasi') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('views.admin.donasi') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-heart icon"></i>
                            </span>
                            <span class="nav-link-title">Donasi</span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('views.admin.dampak') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('views.admin.dampak') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-seeding icon"></i>
                            </span>
                            <span class="nav-link-title">Dampak</span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('admin.dokumentasi.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.dokumentasi.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-file-text icon"></i>
                            </span>
                            <span class="nav-link-title">Dokumentasi</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
