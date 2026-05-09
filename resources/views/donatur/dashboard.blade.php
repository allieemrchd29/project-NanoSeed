@extends('components.layout-donatur')
@push('styles')
    <style>
        html {
            scroll-behavior: smooth;
        }

        section {
            scroll-margin-top: 80px;
        }
    </style>
@endpush
@section('content')
    @include('components.navbar-donatur')
    <div class="page-wrapper">

        @if (!request('keyword'))
            <section id="dashboard" class="py-6 py-lg-8 border-bottom bg-white">
                <div class="container-xl">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-6">
                            <div class="mb-3 text-success fw-bold">🌱 Tentang NanoSeed</div>
                            <h1 class="display-3 fw-bold mb-3" style="color: #04440f;">
                                Tanam Harapan, <br>Hijaukan Bumi.
                            </h1>
                            <p class="fs-2 text-muted mb-5">
                                Nanoseed adalah jembatan digital bagi siapa saja yang ingin berkontribusi nyata pada alam.
                                Melalui sistem informasi <strong>NanoSeed</strong>, kami memastikan setiap donasi bibit
                                pohon
                                tertanam di lokasi yang tepat dan dipantau pertumbuhannya.
                            </p>
                            <div class="btn-list">
                                <a href="#kampanye" class="btn btn-success btn-lg px-5 shadow-sm">Lihat Kampanye</a>
                                <a href="#dampak" class="btn btn-outline-success btn-lg px-5">Lihat Dampak</a>
                            </div>
                        </div>
                        <div class="col-lg-6 text-center">
                            <img src="{{ asset('assets/img/hero.jpg') }}" class="img-fluid rounded-4 shadow-lg"
                                alt="Nanoseed Action">
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-5" style="background: linear-gradient(135deg, #beee83 0%, #80d459 100%);">
                <div class="container-xl">
                    <div class="row row-cards text-center">
                        <div class="col-6 col-sm-3">
                            <div class="h1 mb-0 fw-bold text-dark">1.2k+</div>
                            <div class="text-dark-light small">Pohon Ditanam</div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="h1 mb-0 fw-bold text-dark">850</div>
                            <div class="text-dark-light small">Donatur Aktif</div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="h1 mb-0 fw-bold text-dark">12</div>
                            <div class="text-dark-light small">Lokasi Hutan</div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="h1 mb-0 fw-bold text-dark">4.2 Ton</div>
                            <div class="text-dark-light small">Oksigen Dihasilkan</div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="aboutus" class="py-5 bg-light" style="scroll-margin-top: 80px;">
                <div class="container-xl">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="fw-bold mb-4 text-dark">About Us</h2>
                            <div class="card shadow-sm border-0 rounded-4">
                                <div class="card-body p-4 p-md-5">
                                    <div class="row align-items-center g-4">
                                        <div class="col-md-7">
                                            <h3 class="text-success fw-bold mb-3">Menanam untuk Masa Depan</h3>
                                            <p class="text-muted fs-3">
                                                NanoSeed adalah jembatan digital bagi siapa saja yang ingin berkontribusi
                                                nyata pada alam.
                                                Kami memastikan setiap donasi bibit pohon tertanam di lokasi yang tepat dan
                                                dipantau pertumbuhannya.
                                            </p>
                                            <div class="mt-4">
                                                <a href="{{ route('donatur.aboutus') }}"
                                                    class="btn btn-success btn-pill px-4">
                                                    Baca Selengkapnya <i class="ti ti-arrow-right ms-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="bg-success-lt rounded-4 p-4 text-center">
                                                <img src="{{ asset('assets/img/monitoring-preview.png') }}" alt="Monitoring"
                                                    class="img-fluid rounded-3 shadow-sm" style="max-height: 200px;">
                                                <p class="mt-3 mb-0 fw-medium text-success">
                                                    <i class="ti ti-device-analytics me-1"></i> Terpantau Real-time
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- Search --}}
        <section id="kampanye" class="py-6 bg-white">
            <div class="container-xl">
                @if (request('keyword'))
                    <div class="mb-5">
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                            style="background-color: #f2fdf5; border-left: 5px solid #22c55e;">
                            <p class="m-0 text-dark">
                                Menampilkan hasil untuk: <strong>"{{ request('keyword') }}"</strong>
                            </p>
                            <a href="{{ url('/') }}" class="btn btn-sm btn-outline-success gap-2">
                                <i class="fa-solid fa-xmark"></i> Bersihkan Pencarian
                            </a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <h2 class="mb-0 fw-bold">Kampanye</h2>
                        <span class="badge bg-success-lt text-success ms-2">{{ $kampanye->count() }} hasil</span>
                    </div>
                @else
                    <div class="d-flex align-items-center mb-4">
                        <h2 class="mb-0 fw-bold">Kampanye Penanaman</h2>
                        <div class="ms-auto">
                            <a href="{{ route('views.donatur.kampanye') }}" class="text-decoration-none fw-bold">Lihat Semua
                                Kampanye →</a>
                        </div>
                    </div>
                @endif

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
                                                Selesai:
                                                {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
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
                        @if (request('keyword'))
                            <div class="col-12">
                                <p class="text-muted fst-italic">Tidak ada kampanye yang cocok dengan
                                    "<strong>{{ request('keyword') }}</strong>"</p>
                            </div>
                        @else
                            <div class="col-12">
                                <div class="alert alert-info">Belum ada kampanye aktif.</div>
                            </div>
                        @endif
                    @endforelse
                </div>
            </div>
        </section>

        @if (request('keyword'))
            <section class="py-6 bg-light">
                <div class="container-xl">
                    <div class="d-flex align-items-center mb-4">
                        <h2 class="mb-0 fw-bold">Dampak</h2>
                        <span class="badge bg-success-lt text-success ms-2">{{ $dampak->count() }} hasil</span>
                    </div>
                    <div class="row g-4">
                        @forelse($dampak as $d)
                            <div class="col-md-6">
                                <div class="card p-4 border-0 shadow-sm h-100">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="avatar avatar-md bg-success-lt rounded-circle text-success me-3">
                                            <i class="fas {{ $d->icon ?? 'fa-leaf' }}"></i>
                                        </span>
                                        <h4 class="text-success fw-bold mb-0">{{ $d->judul }}</h4>
                                    </div>
                                    <p class="text-muted small mb-0">{{ Str::limit($d->deskripsi, 120) }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted fst-italic">Tidak ada dampak yang cocok dengan
                                    "<strong>{{ request('keyword') }}</strong>"</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="py-6 bg-white">
                <div class="container-xl">
                    <div class="d-flex align-items-center mb-4">
                        <h2 class="mb-0 fw-bold">Dokumentasi</h2>
                        <span class="badge bg-blue-lt text-blue ms-2">{{ $dokumentasi->count() }} hasil</span>
                    </div>
                    <div class="row g-3">
                        @forelse($dokumentasi as $item)
                            @foreach ($item->fotos->take(1) as $foto)
                                <div class="col-md-4">
                                    <a href="{{ route('views.donatur.dokumentasi.detail', $item->id_dokumentasi) }}">
                                        <div class="img-responsive img-responsive-1by1 rounded-3 shadow-sm"
                                            style="background-image: url({{ asset('storage/' . $foto->foto) }})">
                                        </div>
                                        @if ($item->keterangan)
                                            <div class="mt-2 text-muted small text-center">{{ $item->keterangan }}</div>
                                        @endif
                                    </a>
                                </div>
                            @endforeach
                        @empty
                            <div class="col-12">
                                <p class="text-muted fst-italic">Tidak ada dokumentasi yang cocok dengan
                                    "<strong>{{ request('keyword') }}</strong>"</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        @endif

        @if (!request('keyword'))
            <section id="dampak" class="py-6 bg-light">
                <div class="container-xl">
                    <div class="d-flex align-items-center mb-4">
                        <h2 class="mb-0 fw-bold">Dampak Nyata</h2>
                        <div class="ms-auto">
                            <a href="{{ route('views.donatur.dampak') }}"
                                class="text-decoration-none fw-bold text-success">
                                Lihat Detail Dampak →
                            </a>
                        </div>
                    </div>
                    <div class="row g-4">
                        @forelse($dampaks as $d)
                            <div class="col-md-6">
                                <div class="card p-4 border-0 shadow-sm h-100">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="avatar avatar-md bg-success-lt rounded-circle text-success me-3">
                                            <i class="fas {{ $d->icon ?? 'fa-leaf' }}"></i>
                                        </span>
                                        <h4 class="text-success fw-bold mb-0">{{ $d->judul }}</h4>
                                    </div>
                                    <p class="text-muted small mb-0">{{ Str::limit($d->deskripsi, 120) }}</p>
                                    <div class="mt-auto pt-3 border-top mt-3">
                                        <small class="text-muted italic">Data NanoSeed</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">Belum ada informasi dampak</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            <section id="dokumentasi" class="py-6 bg-white">
                <div class="container-xl">
                    <div class="d-flex align-items-center mb-4">
                        <h2 class="mb-0 fw-bold">Dokumentasi Kegiatan</h2>
                        <div class="ms-auto">
                            <a href="{{ route('views.donatur.dokumentasi') }}" class="text-decoration-none fw-bold">Lihat
                                Semua Dokumentasi →</a>
                        </div>
                    </div>
                    <div class="row g-3">
                        @forelse($dokumentasiDashboard as $item)
                            @foreach ($item->fotos->take(1) as $foto)
                                <div class="col-md-4">
                                    <a href="{{ route('views.donatur.dokumentasi.detail', $item->id_dokumentasi) }}">
                                        <div class="img-responsive img-responsive-1by1 rounded-3 shadow-sm"
                                            style="background-image: url({{ asset('storage/' . $foto->foto) }})">
                                        </div>
                                        @if ($item->keterangan)
                                            <div class="mt-2 text-muted small text-center">{{ $item->keterangan }}</div>
                                        @endif
                                    </a>
                                </div>
                            @endforeach
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">Belum ada dokumentasi.</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        @endif

    </div>
@endsection
