@extends('components.layout-donatur')

@section('title', 'Dokumentasi - Nanoseed')

@section('content')
    @include('components.navbar-donatur')

    <div class="page-header py-4 bg-white border-bottom">
        <div class="container-xl">
            <div class="d-flex justify-content-between align-items-center">
                <div class="container-xl">
                    <h2 class="fw-bold mb-0">Dokumentasi Kegiatan</h2>
                    <p class="text-muted mt-1">Lihat semua kegiatan penanaman yang telah dilakukan</p>
                </div>
                <a href="{{ route('donatur.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="page-body py-6 bg-light">
        <div class="container-xl">
            <div class="row g-4">
                @forelse($dokumentasi as $item)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('views.donatur.dokumentasi.detail', $item->id_dokumentasi) }}"
                            class="text-decoration-none">
                            <div class="card shadow-sm h-100 border-0 rounded-4 overflow-hidden">
                                {{-- Foto thumbnail --}}
                                @if ($item->fotos->count() > 0)
                                    <div class="img-responsive img-responsive-21by9"
                                        style="background-image: url({{ asset('storage/' . $item->fotos->first()->foto) }})">
                                    </div>
                                @else
                                    <div
                                        class="img-responsive img-responsive-21by9 bg-light d-flex align-items-center justify-content-center">
                                        <span class="text-muted">Tidak ada foto</span>
                                    </div>
                                @endif

                                <div class="card-body">
                                    <div class="text-success fw-bold small mb-1">
                                        <i class="ti ti-map-pin me-1"></i>
                                        {{ $item->kampanye->nama_kampanye ?? '-' }}
                                    </div>
                                    <h4 class="fw-bold text-dark mb-1">{{ $item->keterangan }}</h4>
                                    <div class="text-muted small">
                                        <i class="ti ti-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($item->tanggal_dokumentasi)->format('d M Y') }}
                                    </div>
                                    <div class="mt-2">
                                        <span class="badge bg-success-lt text-success">
                                            {{ $item->fotos->count() }} Foto
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">Belum ada dokumentasi.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
