@extends('components.layout-donatur')

@section('content')
    @include('components.navbar-donatur')

    <div class="page-wrapper">
        <div class="container-xl py-5">
            {{-- Header --}}
            <div class="text-center mb-5">
                <h2 class="display-6 text-success fw-bold">Dampak Ekologi NanoSeed</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">
                    Kontribusi nyata dari setiap pohon yang Anda tanam untuk keberlangsungan ekosistem dan penghijauan bumi.
                </p>
            </div>

            <div class="row row-cards">
                @forelse($dampaks as $d)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-stacked shadow-sm">
                            <div class="card-status-top bg-success"></div>
                            <div class="card-body text-center py-4">
                                <div class="mb-3">
                                    <span class="avatar avatar-xl bg-success-lt rounded-circle text-success mx-auto">
                                        <i class="fas {{ $d->icon ?? 'fa-seedling' }} fs-1"></i>
                                    </span>
                                </div>

                                {{-- Judul --}}
                                <h3 class="card-title h2 mb-3">{{ $d->judul }}</h3>
                                {{-- Deskripsi --}}
                                <p class="text-secondary mb-0" style="line-height: 1.6;">
                                    {{ $d->deskripsi }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- blm ada data --}}
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="empty">
                            <div class="empty-icon text-muted">
                                <i class="ti ti-ghost fs-1"></i>
                            </div>
                            <p class="empty-title">Belum ada data</p>
                            <p class="empty-subtitle text-muted">Data dampak akan muncul setelah Admin mengisi informasi.
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
