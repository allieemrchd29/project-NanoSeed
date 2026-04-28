@extends('components.layout-donatur')

@section('content')
    @include('components.navbar-donatur')

    {{-- SECTION: About Us --}}
    <section id="aboutus" class="py-5">
        <div class="container-xl">
            {{-- HEADER --}}
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="fw-bold display-6 text-dark">Kami hadir untuk menjembatani kepedulian dengan aksi nyata</h2>
                    <p class="text-muted mt-3">NanoSeed lahir dari keprihatinan terhadap laju deforestasi di Indonesia. Kami
                        percaya bahwa setiap individu bisa berkontribusi — mulai dari satu bibit pohon.</p>
                    <blockquote class="blockquote border-start border-success border-4 ps-3 mt-3">
                        <p class="fst-italic text-muted">"Alam bukan warisan dari leluhur kita, melainkan pinjaman dari anak
                            cucu kita."</p>
                    </blockquote>
                </div>
            </div>

            {{-- VISI MISI --}}
            <div class="mb-5">
                <p class="text-uppercase text-success fw-semibold small mb-3">Visi & Misi</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card h-100 bg-success-lt border-success">
                            <div class="card-body">
                                <h5 class="fw-bold mb-2">🌍 Visi</h5>
                                <p class="text-muted mb-0">Menjadi platform donasi bibit terpercaya yang mendorong gerakan
                                    penghijauan masif di seluruh Indonesia melalui teknologi dan transparansi data.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 bg-success-lt border-success">
                            <div class="card-body">
                                <h5 class="fw-bold mb-2">🎯 Misi</h5>
                                <ul class="list-unstyled text-muted mb-0">
                                    <li class="mb-1">• Menghubungkan donatur dengan lokasi tanam terverifikasi</li>
                                    <li class="mb-1">• Memantau pertumbuhan bibit secara transparan & real-time</li>
                                    <li class="mb-1">• Melibatkan komunitas lokal sebagai garda terdepan</li>
                                    <li>• Menghasilkan laporan dampak lingkungan yang terukur</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARA KERJA --}}
            <div class="mb-5">
                <p class="text-uppercase text-success fw-semibold small mb-3">Cara Kerja</p>
                <div class="row g-3 text-center">
                    <div class="col-6 col-md-3">
                        <div class="avatar avatar-lg rounded-circle bg-success text-white mx-auto mb-2">1</div>
                        <h6 class="fw-semibold">Pilih Kampanye</h6>
                        <p class="text-muted small">Pilih lokasi dan jenis bibit yang ingin kamu dukung</p>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="avatar avatar-lg rounded-circle bg-success text-white mx-auto mb-2">2</div>
                        <h6 class="fw-semibold">Donasi Bibit</h6>
                        <p class="text-muted small">Donasikan sejumlah bibit sesuai kemampuan kamu</p>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="avatar avatar-lg rounded-circle bg-success text-white mx-auto mb-2">3</div>
                        <h6 class="fw-semibold">Bibit Ditanam</h6>
                        <p class="text-muted small">Tim lapangan menanam & mendokumentasikan hasilnya</p>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="avatar avatar-lg rounded-circle bg-success text-white mx-auto mb-2">4</div>
                        <h6 class="fw-semibold">Pantau Dampak</h6>
                        <p class="text-muted small">Kamu bisa memantau pertumbuhan & dampak lingkungan</p>
                    </div>
                </div>
            </div>

            {{-- NILAI-NILAI --}}
            <div class="mb-5">
                <p class="text-uppercase text-success fw-semibold small mb-3">Nilai-Nilai Kami</p>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="mb-2 text-success"><i class="ti ti-shield-check fs-3"></i></div>
                                <h6 class="fw-bold">Transparansi</h6>
                                <p class="text-muted small mb-0">Setiap donasi dapat dilacak dan dipertanggungjawabkan
                                    secara terbuka.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="mb-2 text-primary"><i class="ti ti-users fs-3"></i></div>
                                <h6 class="fw-bold">Komunitas</h6>
                                <p class="text-muted small mb-0">Melibatkan masyarakat lokal dan donatur dalam satu
                                    ekosistem yang solid.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="mb-2 text-purple"><i class="ti ti-refresh fs-3"></i></div>
                                <h6 class="fw-bold">Keberlanjutan</h6>
                                <p class="text-muted small mb-0">Program dirancang jangka panjang — bukan sekadar tanam lalu
                                    tinggalkan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TIM DEV --}}
            <div class="mb-5">
                <p class="text-uppercase text-success fw-semibold small mb-3">Tim Pengembang</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center gap-3">
                                <span class="avatar rounded-circle bg-success-lt text-success">M</span>
                                <div>
                                    <div class="fw-semibold">Misar</div>
                                    <div class="text-muted small">Product Owner</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center gap-3">
                                <span class="avatar rounded-circle bg-blue-lt text-blue">AM</span>
                                <div>
                                    <div class="fw-semibold">Aliya Marcelia Dewi</div>
                                    <div class="text-muted small">Scrum Master</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center gap-3">
                                <span class="avatar rounded-circle bg-blue-lt text-blue">FF</span>
                                <div>
                                    <div class="fw-semibold">Fara Firoza</div>
                                    <div class="text-muted small">Developers 1</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center gap-3">
                                <span class="avatar rounded-circle bg-success-lt text-success">FK</span>
                                <div>
                                    <div class="fw-semibold">Fatin Khairunnisa</div>
                                    <div class="text-muted small">Developers 2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mx-auto">
                        <div class="card">
                            <div class="card-body d-flex align-items-center gap-3">
                                <span class="avatar rounded-circle bg-success-lt text-success">JH</span>
                                <div>
                                    <div class="fw-semibold">Jennia Hanarum</div>
                                    <div class="text-muted small">Developers 3</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
