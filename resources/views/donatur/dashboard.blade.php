@extends('components.layout-donatur')

@section('content')
@include('components.navbar-donatur')
<div class="page-wrapper">
    <section class="py-6 py-lg-8 border-bottom bg-white">
        <div class="container-xl">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <h1 class="display-3 fw-bold mb-3" style="color: #04440f;">
                        Tanam Harapan, <br>Hijaukan Bumi.
                    </h1>
                    <p class="fs-2 text-muted mb-5">
                        Bersama Nanoseed, setiap bibit yang kamu donasikan akan menolog ribuan makhluk. Mari hijaukan bumi bersama kami.
                    </p>
                    <div class="btn-list">
                        <a href="#kampanye" class="btn btn-success btn-lg px-5">Lihat Kampanye</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('assets/img/hero.jpg') }}" 
                         class="img-fluid rounded-4 shadow-lg" alt="Penghijauan">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light"  style="background: linear-gradient(135deg, #beee83 0%, #80d459 100%);">
        <div class="container-xl">
            <div class="row row-cards text-center">
                <div class="col-6 col-sm-3">
                    <div class="h1 mb-0">1.2k+</div>
                    <div class="text-muted small">Pohon Ditanam</div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="h1 mb-0">850</div>
                    <div class="text-muted small">Donatur Aktif</div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="h1 mb-0">12</div>
                    <div class="text-muted small">Lokasi Hutan</div>
                </div>
                <div class="col-6 col-sm-3">
                    <div class="h1 mb-0">4.2 Ton</div>
                    <div class="text-muted small">Oksigen Dihasilkan</div>
                </div>
            </div>
        </div>
    </section>

    <section id="kampanye" class="py-6">
        <div class="container-xl">
            <div class="d-flex align-items-center mb-4">
                <h2 class="mb-0">Kampanye Penanaman</h2>
                <div class="ms-auto"><a href="{{ route('views.donatur.kampanye') }}" class="text-decoration-none">Lihat Semua →</a></div>
            </div>
            
            <div class="row row-cards">
                <div class="col-md-6 col-lg-4">
                    <div class="card card-stacked">
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
                           <a href="{{ route('views.donatur.donasi') }}" class="btn btn-outline-primary w-100">Donasi Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection