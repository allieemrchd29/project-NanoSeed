@extends('components.layout-donatur')

@section('content')
@include('components.navbar-donatur')

<div class="page-wrapper">
  <div class="page-body">
    <div class="container-xl py-5">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">

          <div class="card border-0 shadow-sm p-5">
            <div class="mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24"
                   fill="none" stroke="#2fb344" stroke-width="1.5">
                <path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2z"/>
                <path d="M8 12l3 3l5 -5"/>
              </svg>
            </div>

            <h2 class="fw-bold text-success mb-2">Pembayaran Berhasil! 🌳</h2>
            <p class="text-muted mb-4">Terima kasih, <strong>{{ $donasi->nama_donatur }}</strong>!</p>

            <div class="table-responsive mb-4">
              <table class="table table-borderless text-start">
                <tr>
                  <td class="text-muted">Order ID</td>
                  <td class="fw-semibold">{{ $donasi->order_id }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Nominal</td>
                  <td class="fw-semibold text-success">
                    Rp {{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}
                  </td>
                </tr>
                <tr>
                  <td class="text-muted">Jumlah Pohon</td>
                  <td class="fw-semibold">
                    🌱 {{ (int) floor($donasi->jumlah_donasi / 10000) }} pohon
                  </td>
                </tr>
                <tr>
                  <td class="text-muted">Status</td>
                  <td><span class="badge bg-success">Lunas</span></td>
                </tr>
              </table>
            </div>

            <p class="text-muted small mb-4">
              Email konfirmasi telah dikirim ke <strong>{{ $donasi->email_donatur }}</strong>
            </p>

            <a href="{{ route('donatur.dashboard') }}" class="btn btn-success w-100 fw-bold">
              Kembali ke Beranda
            </a>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection