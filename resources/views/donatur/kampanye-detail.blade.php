@extends('components.layout-donatur')

@section('title', $kampanye->nama_kampanye . ' - Nanoseed')

@section('content')
    @include('components.navbar-donatur')

    <div class="page-body py-6">
        <div class="container-xl">
            <div class="row g-4">

                {{-- Gambar Kampanye --}}
                <div class="col-lg-6">
                    @if ($kampanye->gambar_kampanye)
                        <img src="{{ asset('storage/' . $kampanye->gambar_kampanye) }}"
                            class="img-fluid rounded-4 shadow w-100" style="max-height: 450px; object-fit: cover;">
                    @else
                        <img src="{{ asset('assets/img/kampanye-1.jpg') }}" class="img-fluid rounded-4 shadow w-100"
                            style="max-height: 450px; object-fit: cover;">
                    @endif
                </div>

                {{-- Detail Kampanye --}}
                <div class="col-lg-6">
                    <div class="mb-2">
                        <span
                            class="badge {{ $kampanye->status_kampanye === 'aktif' ? 'bg-success' : 'bg-secondary' }} me-2">
                            {{ ucfirst($kampanye->status_kampanye) }}
                        </span>
                    </div>

                    <h1 class="fw-bold mb-3">{{ $kampanye->nama_kampanye }}</h1>

                    <p class="text-muted fs-4 mb-4">{{ $kampanye->deskripsi }}</p>

                    <div class="card border-0 bg-light rounded-4 p-3 mb-4">
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="text-muted small">Tanggal Mulai</div>
                                <div class="fw-bold">{{ \Carbon\Carbon::parse($kampanye->tanggal_mulai)->format('d M Y') }}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted small">Tanggal Selesai</div>
                                <div class="fw-bold">
                                    {{ \Carbon\Carbon::parse($kampanye->tanggal_selesai)->format('d M Y') }}</div>
                            </div>
                        </div>
                    </div>
                    {{-- Stats Donasi --}}
                    <div class="row g-2 mb-4">
                        <div class="col-4">
                            <div class="p-3 rounded-3 text-center" style="background:#f2fdf5;">
                                <div class="fw-bold text-success fs-4">
                                    Rp {{ number_format($totalDonasi, 0, ',', '.') }}
                                </div>
                                <div class="text-muted small">Total Terkumpul</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 rounded-3 text-center" style="background:#f2fdf5;">
                                <div class="fw-bold text-success fs-4">{{ $jumlahPohon }}</div>
                                <div class="text-muted small">Pohon Terdanai</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 rounded-3 text-center" style="background:#f2fdf5;">
                                <div class="fw-bold text-success fs-4">{{ $jumlahDonatur }}</div>
                                <div class="text-muted small">Donatur</div>
                            </div>
                        </div>
                    </div>

                    {{-- Countdown --}}
                    @php
                        $sisaHari = (int) \Carbon\Carbon::now()->diffInDays(
                            \Carbon\Carbon::parse($kampanye->tanggal_selesai),
                            false,
                        );
                    @endphp
                    <div class="p-3 rounded-3 mb-4 d-flex align-items-center gap-3"
                        style="background: #fff8e1; border-left: 4px solid #f59e0b;">
                        <i class="ti ti-clock text-warning fs-3"></i>
                        <div>
                            <div class="fw-bold text-warning">
                                {{ $sisaHari > 0 ? $sisaHari . ' hari lagi' : 'Kampanye berakhir' }}
                            </div>
                            <div class="text-muted small">menuju akhir kampanye</div>
                        </div>
                    </div>

                    <a href="{{ route('views.donatur.donasi') }}?kampanye_id={{ $kampanye->id }}"
                        class="btn btn-success btn-lg w-100 fw-bold mb-3">
                        💚 Donasi Sekarang
                    </a>
                    <a href="{{ route('views.donatur.kampanye') }}" class="btn btn-outline-secondary w-100">
                        ← Kembali ke Semua Kampanye
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
