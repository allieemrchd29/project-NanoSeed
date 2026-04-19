{{-- BARIS ATAS: Brand + Notif + Avatar --}}
<header class="navbar navbar-expand-md d-print-none sticky-top">
  <div class="container-xl">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
      <span class="fs-2">🌱</span>
      <span class="ms-1">Nanoseed</span>
    </h1>

    <div class="navbar-nav flex-row order-md-last">

      {{-- Notifikasi --}}
      <div class="nav-item me-3">
        <a href="#" class="nav-link px-0 text-muted">
          <i class="ti ti-bell icon"></i>
        </a>
      </div>

      {{-- Profile Dropdown --}}
      <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">
          <span class="avatar avatar-sm bg-success text-white fw-bold">
            {{ strtoupper(substr('Admin', 0, 1)) }}
          </span>
          <div class="d-none d-xl-block ps-2">
            <div class="fw-bold">{{ 'Admin' }}</div>
            <div class="mt-1 small text-secondary">Administrator</div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <div class="dropdown-header">
            <div class="fw-bold">{{ 'Admin' }}</div>
            {{-- <div class="text-muted small">{{ $admin->email }}</div> --}}
          </div>
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

          <li class="nav-item {{ request()->routeIs('views.admin.kampanye') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('views.admin.kampanye') }}">
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

         <li class="nav-item {{ request()->routeIs('views.admin.dokumentasi') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('views.admin.dokumentasi') }}">
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
</div>