@extends('components.layout-admin')

@section('content')

@include('components.navbar-admin')
  
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