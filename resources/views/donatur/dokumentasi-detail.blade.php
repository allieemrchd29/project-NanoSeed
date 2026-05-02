@extends('components.layout-donatur')

@section('title', $dokumentasi->keterangan . ' - Nanoseed')

@section('content')
    @include('components.navbar-donatur')

    <div class="page-body py-6">
        <div class="container-xl">
            <div class="row g-4">

                {{-- Slider Foto --}}
                <div class="col-lg-7">
                    @if ($dokumentasi->fotos->count() > 0)
                        <div id="carouselFoto" class="carousel slide rounded-4 overflow-hidden shadow" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach ($dokumentasi->fotos as $i => $foto)
                                    <button type="button" data-bs-target="#carouselFoto"
                                        data-bs-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}">
                                    </button>
                                @endforeach
                            </div>

                            <div class="carousel-inner">
                                @foreach ($dokumentasi->fotos as $i => $foto)
                                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $foto->foto) }}" class="d-block w-100"
                                            style="height: 450px; object-fit: cover;" alt="Foto {{ $i + 1 }}">
                                    </div>
                                @endforeach
                            </div>

                            @if ($dokumentasi->fotos->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselFoto"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselFoto"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            @endif
                        </div>

                        {{-- Thumbnail foto --}}
                        @if ($dokumentasi->fotos->count() > 1)
                            <div class="d-flex gap-2 mt-3 flex-wrap">
                                @foreach ($dokumentasi->fotos as $i => $foto)
                                    <img src="{{ asset('storage/' . $foto->foto) }}"
                                        class="rounded-3 border border-2 {{ $i === 0 ? 'border-success' : 'border-transparent' }}"
                                        style="width:70px;height:70px;object-fit:cover;cursor:pointer;"
                                        onclick="goToSlide({{ $i }})" id="thumb-{{ $i }}">
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="bg-light rounded-4 d-flex align-items-center justify-content-center"
                            style="height:450px;">
                            <span class="text-muted">Tidak ada foto</span>
                        </div>
                    @endif
                </div>

                {{-- Detail Info --}}
                <div class="col-lg-5">
                    <div class="mb-2">
                        <span class="badge bg-success">
                            <i class="ti ti-map-pin me-1"></i>
                            {{ $dokumentasi->kampanye->nama_kampanye ?? '-' }}
                        </span>
                    </div>

                    <h2 class="fw-bold mb-3">{{ $dokumentasi->keterangan }}</h2>

                    <div class="card border-0 bg-light rounded-4 p-3 mb-4">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="text-muted small">Tanggal Kegiatan</div>
                                <div class="fw-bold">
                                    {{ \Carbon\Carbon::parse($dokumentasi->tanggal_dokumentasi)->format('d M Y') }}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted small">Waktu</div>
                                <div class="fw-bold">
                                    {{ \Carbon\Carbon::parse($dokumentasi->tanggal_dokumentasi)->format('H:i') }} WIB
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted small">Jumlah Foto</div>
                                <div class="fw-bold">{{ $dokumentasi->fotos->count() }} Foto</div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted small">Kampanye</div>
                                <div class="fw-bold">{{ $dokumentasi->kampanye->nama_kampanye ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('views.donatur.dokumentasi') }}" class="btn btn-outline-secondary w-100">
                        ← Kembali ke Dokumentasi
                    </a>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const carousel = document.getElementById('carouselFoto');

            function goToSlide(index) {
                const bsCarousel = bootstrap.Carousel.getInstance(carousel) || new bootstrap.Carousel(carousel);
                bsCarousel.to(index);
            }

            if (carousel) {
                carousel.addEventListener('slid.bs.carousel', function(e) {
                    document.querySelectorAll('[id^="thumb-"]').forEach((el, i) => {
                        el.classList.remove('border-success');
                        el.classList.add('border-transparent');
                    });
                    const active = document.getElementById('thumb-' + e.to);
                    if (active) {
                        active.classList.add('border-success');
                        active.classList.remove('border-transparent');
                    }
                });
            }
        </script>
    @endpush
@endsection
