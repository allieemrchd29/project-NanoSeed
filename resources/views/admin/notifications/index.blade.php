@extends('components.layout-admin')

@section('content')

@include('components.navbar-admin')

<div class="page-wrapper">

  {{-- Page Header --}}
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Notifikasi</li>
            </ol>
          </nav>
          <h2 class="page-title">Notifikasi</h2>
          <div class="text-muted mt-1">
            @if($unreadCount > 0)
              <span class="badge bg-red me-1">{{ $unreadCount }}</span> notifikasi belum dibaca
            @else
              Semua notifikasi sudah dibaca
            @endif
          </div>
        </div>
        <div class="col-auto ms-auto">
          @if($unreadCount > 0)
          <form action="{{ route('admin.notifications.mark-all') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-secondary btn-sm">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="16" height="16" viewBox="0 0 24 24"
                   stroke-width="2" stroke="currentColor" fill="none">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M7 12l5 5l10 -10"/>
                <path d="M2 12l5 5m5 -5l5 -5"/>
              </svg>
              Tandai Semua Dibaca
            </button>
          </form>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="page-body">
    <div class="container-xl">

      @if(session('success'))
        <div class="alert alert-success alert-dismissible mb-3" role="alert">
          <div class="d-flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24"
                 stroke-width="2" stroke="currentColor" fill="none">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M5 12l5 5l10 -10"/>
            </svg>
            <div>{{ session('success') }}</div>
          </div>
          <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
      @endif

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Riwayat Notifikasi Donasi</h3>
        </div>
        <div class="card-body p-0">
          @forelse($notifications as $notif)
          <div class="d-flex align-items-center px-4 py-3 border-bottom {{ !$notif->is_read ? 'bg-blue-lt' : '' }}">
            
            {{-- Ikon donasi --}}
            <span class="avatar me-3 flex-shrink-0" style="background: {{ !$notif->is_read ? '#206bc4' : '#e9ecef' }}; color: {{ !$notif->is_read ? '#fff' : '#6c757d' }};">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                   stroke-width="2" stroke="currentColor" fill="none">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"/>
                <path d="M12 8v4l3 3"/>
              </svg>
            </span>

            {{-- Konten --}}
            <div class="flex-grow-1">
              <div class="d-flex align-items-center justify-content-between">
                <span class="fw-semibold {{ !$notif->is_read ? 'text-dark' : 'text-muted' }}">
                  {{ $notif->nama_donatur }}
                  @if(!$notif->is_read)
                    <span class="badge bg-red ms-1" style="font-size:10px; padding: 2px 6px;">Baru</span>
                  @endif
                </span>
                <span class="text-muted small ms-3 flex-shrink-0">
                  {{ $notif->created_at->diffForHumans() }}
                </span>
              </div>
              <div class="text-muted mt-1" style="font-size:13px;">
                Donasi masuk sebesar 
                <strong class="text-success">
                  Rp {{ number_format($notif->jumlah_donasi, 0, ',', '.') }}
                </strong>
              </div>
            </div>

            {{-- Aksi --}}
            <div class="d-flex align-items-center ms-3 gap-2">
              @if(!$notif->is_read)
              <form action="{{ route('admin.notifications.read', $notif->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-ghost-primary" title="Tandai dibaca">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                       stroke-width="2" stroke="currentColor" fill="none">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 12l5 5l10 -10"/>
                  </svg>
                </button>
              </form>
              @endif

              <form action="{{ route('admin.notifications.destroy', $notif->id) }}" method="POST"
                    onsubmit="return confirm('Hapus notifikasi ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-ghost-danger" title="Hapus">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                       stroke-width="2" stroke="currentColor" fill="none">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 7l16 0"/>
                    <path d="M10 11l0 6"/>
                    <path d="M14 11l0 6"/>
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                  </svg>
                </button>
              </form>
            </div>

          </div>
          @empty
          <div class="text-center py-5 text-muted">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 opacity-50" width="48" height="48" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" fill="none">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M9.346 5.353c.18 -.16 .376 -.3 .586 -.42"/>
              <path d="M3 3l18 18"/>
              <path d="M10.685 6.913a7 7 0 0 1 8.315 7.087v3a4 4 0 0 0 2 3h-14.685"/>
              <path d="M9 17v1a3 3 0 0 0 6 0v-1h-6z"/>
            </svg>
            <p class="mt-2 mb-0">Belum ada notifikasi donasi</p>
          </div>
          @endforelse
        </div>

        @if($notifications->hasPages())
        <div class="card-footer d-flex align-items-center">
          {{ $notifications->links() }}
        </div>
        @endif
      </div>

    </div>
  </div>

  <footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
      <div class="row text-center align-items-center flex-row-reverse">
        <div class="col-lg-auto ms-lg-auto">
          <ul class="list-inline list-inline-dots mb-0">
            <li class="list-inline-item">&copy; {{ date('Y') }} <strong>Nanoseed Admin</strong>.</li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

</div>

@endsection