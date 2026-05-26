@extends('components.layout-donatur')

@section('content')
    @include('components.navbar-donatur')

    <div class="page-wrapper">
        {{-- Header --}}
        <div class="page-header py-4 bg-white border-bottom">
            <div class="container-xl">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold mb-0">Dampak Ekologi NanoSeed</h2>
                        <p class="text-muted mt-1 mb-0">Dampak dan kontribusi untuk lingkungan.</p>
                    </div>
                    <a href="{{ route('donatur.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="ti ti-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="container-xl py-5">
            <div class="row row-cards">
                @forelse($dampaks as $index => $d)
                    <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-4">
                        {{-- Card Utama pakai cursor pointer --}}
                        <div class="card card-hover shadow-sm border-0 border-top border-3 border-success h-100" 
                            data-bs-toggle="modal" data-bs-target="#modal-dampak-{{ $index }}"
                            style="cursor: pointer; border-radius: 12px;" title="Klik untuk melihat detail lengkap">
                            
                            <div class="card-body p-4 d-flex flex-column justify-content-between text-center">
                                <div>
                                    {{-- Lingkaran Ikon --}}
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div class="d-flex align-items-center justify-content-center bg-success text-white rounded-circle shadow-xs" 
                                             style="width: 64px; height: 64px;">
                                            @if(Str::contains($d->icon, '.'))
                                                <img src="{{ asset('storage/' . $d->icon) }}" alt="icon" class="rounded-circle" style="width: 32px; height: 32px; object-fit: contain; filter: brightness(0) invert(1);">
                                            @else
                                                <i class="fas {{ $d->icon ?? 'fa-seedling' }} fs-2"></i>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Judul Halaman Depan --}}
                                    <span class="badge bg-green-lt mb-3 px-2 py-1" style="font-size: 13px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px;">
                                        {{ $d->judul }}
                                    </span>
                                    
                                    {{-- Deskripsi Halaman Depan --}}
                                    <p class="text-muted small mb-0" style="line-height: 1.6; font-size: 13px;">
                                        {{ Str::limit($d->deskripsi, 100, '...') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KOTAK POP-UP DETAIL DAMPAK --}}
                    <div class="modal modal-blur fade" id="modal-dampak-{{ $index }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content shadow-lg border-0" style="border-radius: 16px;">
                                {{-- Garis Hijau Atas Modal --}}
                                <div class="modal-status bg-success"></div>
                                
                                <div class="modal-body text-center py-5 px-4">
                                    {{-- Tombol Close popup --}}
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 15px; right: 15px;"></button>
                                    
                                    {{-- Ikon di pop-up --}}
                                    <div class="mb-4 d-flex justify-content-center">
                                        <div class="d-flex align-items-center justify-content-center bg-success-lt text-success rounded-circle" 
                                             style="width: 80px; height: 80px;">
                                            @if(Str::contains($d->icon, '.'))
                                                <img src="{{ asset('storage/' . $d->icon) }}" alt="icon" class="rounded-circle" style="width: 40px; height: 40px; object-fit: contain;">
                                            @else
                                                <i class="fas {{ $d->icon ?? 'fa-seedling' }} fs-1"></i>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Judul Pop-up --}}
                                    <span class="badge bg-green-lt mb-4 px-3 py-1" style="font-size: 15px; font-weight: bold;">{{ $d->judul}}</span>
                                    
                                    {{-- Deskripsi Full --}}
                                    <p class="text-secondary p-2 mb-0" style="font-size: 14px; line-height: 1.7; text-align: justify; text-justify: inter-word; background: #f8fafc; border-radius: 8px;">
                                        {{ $d->deskripsi }}
                                    </p>
                                </div>

                                <div class="modal-footer bg-light d-flex justify-content-center py-3" style="border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;">
                                    <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal" style="border-radius: 8px;">
                                        Tutup Informasi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-12 text-center py-5">
                        <div class="empty">
                            <div class="empty-icon text-success border border-success border-2 rounded-circle p-3 mx-auto mb-3" style="width: 64px; height: 64px; display: flex; align-items: center; justify-content: center;">
                                <i class="ti ti-leaf fs-1"></i>
                            </div>
                            <p class="empty-title fw-bold text-dark">Belum Ada Data Dampak</p>
                            <p class="empty-subtitle text-muted">Data kontribusi lingkungan akan segera diperbarui oleh tim admin NanoSeed.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
