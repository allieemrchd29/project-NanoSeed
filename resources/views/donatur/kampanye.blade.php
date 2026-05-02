@extends('components.layout-donatur')

@section('title', 'Semua Kampanye - Nanoseed')

@section('content')
    @include('components.navbar-donatur')

    <div class="page-header py-4 bg-white border-bottom">
        <div class="container-xl">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-0">Semua Kampanye Penanaman</h2>
                    <p class="text-muted mt-1 mb-0">Pilih kampanye yang ingin kamu dukung</p>
                </div>
                <a href="{{ route('donatur.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
    <div class="page-body py-6 bg-light">
        <div class="container-xl">
            <div class="row row-cards">
                @forelse($kampanye as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-stacked shadow-sm h-100">
                            <div class="card-img-top img-responsive img-responsive-21by9"
                                style="background-image: url(
                            {{ $item->gambar_kampanye ? asset('storage/' . $item->gambar_kampanye) : asset('assets/img/kampanye-1.jpg') }}
                        )">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">{{ $item->nama_kampanye }}</h3>
                                <p class="text-muted">{{ Str::limit($item->deskripsi, 120) }}</p>
                                <div class="mt-3">
                                    <div class="d-flex align-items-center text-muted small">
                                        <span
                                            class="badge {{ $item->status_kampanye === 'aktif' ? 'bg-success' : 'bg-secondary' }} me-2">
                                            {{ ucfirst($item->status_kampanye) }}
                                        </span>
                                        <div class="ms-auto">
                                            Selesai: {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <a href="{{ route('views.donatur.kampanye.detail', $item->id) }}"
                                    class="btn btn-success w-100 fw-bold">
                                    Lihat & Donasi
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">Belum ada kampanye aktif saat ini.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
