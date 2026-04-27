    @extends('components.layout-donatur')

    @section('content')
    @include('components.navbar-donatur')

    <div class="page-wrapper">
        <section id="dashboard" class="py-6 py-lg-8 border-bottom bg-white">
            <div class="container-xl">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6" id="aboutus"> 
                        <div class="mb-3 text-success fw-bold">🌱 Tentang NanoSeed</div>
                        <h1 class="display-3 fw-bold mb-3" style="color: #04440f;">
                            Tanam Harapan, <br>Hijaukan Bumi.
                        </h1>
                        <p class="fs-2 text-muted mb-5">
                            Nanoseed adalah jembatan digital bagi siapa saja yang ingin berkontribusi nyata pada alam. Melalui sistem informasi <strong>NanoSeed</strong>, kami memastikan setiap donasi bibit pohon tertanam di lokasi yang tepat dan dipantau pertumbuhannya.
                        </p>
                        <div class="btn-list">
                            <a href="#kampanye" class="btn btn-success btn-lg px-5 shadow-sm">Lihat Kampanye</a>
                            <a href="#dampak" class="btn btn-outline-success btn-lg px-5">Lihat Dampak</a>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="{{ asset('assets/img/hero.jpg') }}" 
                            class="img-fluid rounded-4 shadow-lg" alt="Nanoseed Action">
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

        <section id="kampanye" class="py-6 bg-white">
            <div class="container-xl">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="mb-0 fw-bold">Kampanye Penanaman</h2>
                    <div class="ms-auto">
                        <a href="{{ route('views.donatur.kampanye') }}" class="text-decoration-none fw-bold">Lihat Semua Kampanye →</a>
                    </div>
                </div>
                
                <div class="row row-cards">
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-stacked shadow-sm">
                            <div class="card-img-top img-responsive img-responsive-21by9" 
                                style="background-image: url({{ asset('assets/img/kampanye-1.jpg') }})"></div>
                            <div class="card-body">
                                <h3 class="card-title">1000 Ketapang Kencana</h3>
                                <p class="text-muted">Reboisasi lahan kritis di pinggiran kota untuk paru-paru dunia.</p>
                                <div class="mt-3">
                                    <div class="progress progress-sm mb-2">
                                        <div class="progress-bar bg-green" style="width: 65%"></div>
                                    </div>
                                    <div class="d-flex text-muted small">
                                        <div>Terkumpul: 65%</div>
                                        <div class="ms-auto">12 Hari lagi</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('views.donatur.donasi') }}" class="btn btn-success w-100 fw-bold">Donasi Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="dampak" class="py-6 bg-light">
            <div class="container-xl">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="mb-0 fw-bold">Dampak Nyata</h2>
                    <div class="ms-auto">
                        <a href="{{ route('views.donatur.dampak') }}" class="text-decoration-none fw-bold">Lihat Detail Dampak →</a>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card p-4 border-0 shadow-sm h-100">
                            <h4 class="text-success fw-bold">Monitoring Pertumbuhan</h4>
                            <p class="text-muted small">Kami memastikan setiap pohon yang kamu tanam dipantau secara berkala melalui sistem monitoring kami.</p>
                            <img src="{{ asset('assets/img/monitoring.jpg') }}" class="rounded-3 img-fluid mt-auto" alt="Monitoring">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-4 border-0 shadow-sm h-100">
                            <h4 class="text-success fw-bold">Kontribusi Oksigen</h4>
                            <p class="text-muted small">Cek seberapa besar kontribusi oksigen yang telah dihasilkan dari hasil donasimu.</p>
                            <div class="mt-auto pt-5 text-center">
                                <div class="display-4 fw-bold text-success">98%</div>
                                <div class="text-muted">Bibit Tumbuh Sempurna</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="dokumentasi" class="py-6 bg-white">
            <div class="container-xl">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="mb-0 fw-bold">Dokumentasi Kegiatan</h2>
                    <div class="ms-auto">
                        <a href="{{ route('views.donatur.dokumentasi') }}" class="text-decoration-none fw-bold">Lihat Semua Dokumentasi →</a>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="img-responsive img-responsive-1by1 rounded-3 shadow-sm" style="background-image: url({{ asset('assets/img/doc1.jpg') }})"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="img-responsive img-responsive-1by1 rounded-3 shadow-sm" style="background-image: url({{ asset('assets/img/doc2.jpg') }})"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="img-responsive img-responsive-1by1 rounded-3 shadow-sm" style="background-image: url({{ asset('assets/img/doc3.jpg') }})"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- CSS UNTUK SMOOTH SCROLL -->
    <style>
        html {
            scroll-behavior: smooth;
        }
        section {
            scroll-margin-top: 80px;
        }
    </style>
    @endsection