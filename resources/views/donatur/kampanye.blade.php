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
                                            <span class="badge {{ strtolower($item->status_kampanye) === 'aktif' ? 'bg-success' : 'bg-secondary' }} text-white me-2">
                                                {{ ucfirst($item->status_kampanye) }}
                                            </span>                                        <div class="ms-auto">
                                            Selesai: {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                        </div>
                                    </div>
                                    {{-- countdown --}}
                                    @php
                                        $sisaHari = (int) \Carbon\Carbon::now()->diffInDays(
                                            \Carbon\Carbon::parse($item->tanggal_selesai),
                                            false,
                                        );
                                    @endphp
                                    <div class="mt-2 d-flex align-items-center gap-2"
                                        style="background:#fff8e1; border-left: 3px solid #f59e0b; border-radius:6px; padding: 6px 10px;">
                                        <i class="ti ti-clock text-warning" style="font-size:14px;"></i>
                                        <span class="small fw-semibold text-warning">
                                            {{ $sisaHari > 0 ? $sisaHari . ' hari lagi' : 'Kampanye berakhir' }}
                                        </span>
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
                        <!-- Backlog Button dan Konfirmasi Donasi (uji coba) -->
                        <div class="alert alert-info d-flex align-items-center justify-content-between">
                            <div>Belum ada kampanye aktif saat ini.</div>
                            <button type="button" class="btn btn-outline-success btn-lg px-5" data-bs-toggle="modal"
                                data-bs-target="#modal-preview-donasi">
                                Donasi Sekarang
                            </button>
                        </div>
                    </div>

                    <!-- pop up konfirmasi donasi yang bakal ngarah ke formulir donasi -->
                    <div class="modal modal-blur fade" id="modal-preview-donasi" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center py-4">
                                    <div class="mb-3 text-success"><i class="ti ti-leaf icon-lg"></i></div>
                                    <h3 class="fw-bold">Konfirmasi Donasi</h3>
                                    <div class="text-muted small mb-2">Anda akan mendukung kampanye:</div>
                                    <div class="p-2 bg-green-lt rounded mb-3 text-success fw-bold">
                                        Menanam di Gunung Rinjani Batch 2
                                    </div>
                                    <p class="small text-muted">Tekan "Lanjutkan" untuk mengisi data formulir dan lakukan
                                        pembayaran donasi.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link link-secondary me-auto"
                                        data-bs-dismiss="modal">Batal</button>
                                    <a href="{{ route('views.donatur.donasi') }}" class="btn btn-success">Lanjutkan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
