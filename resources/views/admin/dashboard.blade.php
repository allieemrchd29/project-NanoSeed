@extends('components.layout-admin')

@section('content')

{{-- Navbar --}}
<header class="navbar navbar-expand-md d-print-none">
  <div class="container-xl">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
      <span class="fs-2">🌱</span> <span class="ms-1">Nanoseed</span>
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
            {{ strtoupper(substr($admin->name, 0, 1)) }}
          </span>
          <div class="d-none d-xl-block ps-2">
            <div class="fw-bold">{{ $admin->name }}</div>
            <div class="mt-1 small text-secondary">Administrator</div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <div class="dropdown-header">
            <div class="fw-bold">{{ $admin->name }}</div>
            <div class="text-muted small">{{ $admin->email }}</div>
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

{{-- Sidebar / Menu Horizontal --}}
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
        </ul>
      </div>
    </div>
  </div>
</div>

{{-- Page Wrapper (Main Content) --}}
<div class="page-wrapper">

  {{-- Page Header --}}
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">Dashboard</h2>
          <div class="text-muted mt-1">Selamat datang kembali, <strong>{{ $admin->name }}</strong></div>
        </div>
      </div>
    </div>
  </div>

  {{-- Page Body --}}
  <div class="page-body">
    <div class="container-xl">

      {{-- Session Success Message --}}
      @if(session('success'))
        <div class="alert alert-success alert-dismissible mb-4" role="alert">
          <div class="d-flex">
            <i class="ti ti-check icon me-2"></i>
            <div>{{ session('success') }}</div>
          </div>
          <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
      @endif

      {{-- Stats Cards --}}
      <div class="row row-deck row-cards mb-4">
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="bg-primary text-white avatar"><i class="ti ti-user"></i></span>
                </div>
                <div class="col">
                  <div class="font-weight-medium">1 Admin</div>
                  <div class="text-muted">Status Aktif</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="bg-success text-white avatar"><i class="ti ti-leaf"></i></span>
                </div>
                <div class="col">
                  <div class="font-weight-medium">Nanoseed</div>
                  <div class="text-muted">v1.0.0</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="bg-warning text-white avatar"><i class="ti ti-calendar"></i></span>
                </div>
                <div class="col">
                  <div class="font-weight-medium">{{ now()->format('d M Y') }}</div>
                  <div class="text-muted">{{ now()->format('H:i') }} WIB</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="card card-sm">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="bg-info text-white avatar"><i class="ti ti-world"></i></span>
                </div>
                <div class="col">
                  <div class="font-weight-medium">Sistem Online</div>
                  <div class="text-muted">Running Well</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Welcome Card --}}
      <div class="card">
        <div class="card-status-top bg-success"></div>
        <div class="card-body">
          <h3 class="card-title">Login Berhasil!</h3>
          <p class="text-muted mb-0">
            Kamu berhasil masuk sebagai <strong>{{ $admin->name }}</strong> 
            dengan email <strong>{{ $admin->email }}</strong>. 
            Semua modul administrasi Nanoseed siap dikelola di sini.
          </p>
        </div>
      </div>

    </div>
  </div>

  {{-- Footer --}}
  <footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
      <div class="row text-center align-items-center flex-row-reverse">
        <div class="col-lg-auto ms-lg-auto">
          <ul class="list-inline list-inline-dots mb-0">
            <li class="list-inline-item">
              &copy; {{ date('Y') }} <strong>Nanoseed Admin</strong>.
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

</div>

@endsection