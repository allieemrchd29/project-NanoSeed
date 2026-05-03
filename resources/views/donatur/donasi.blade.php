@extends('components.layout-donatur')

@section('content')
@include('components.navbar-donatur')

<div class="page-wrapper">
    <div class="container-xl py-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <form action="{{ route('donatur.donasi.store') }}" method="POST" class="card border-0 shadow-sm">
                    @csrf
                    <div class="card-status-top bg-success"></div>
                    <div class="card-header py-3">
                        <h3 class="card-title fw-bold text-success">
                            <i class="ti ti-heart me-2"></i>Formulir Identitas Donatur
                        </h3>
                    </div>
                    
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-important alert-success alert-dismissible" role="alert">
                                <div class="d-flex">
                                    <div><i class="ti ti-check icon alert-icon"></i></div>
                                    <div>{{ session('success') }}</div>
                                </div>
                                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Donatur <span class="text-danger">*</span></label>
                            <input type="text" name="nama_donatur" class="form-control form-control-light" placeholder="Nama Lengkap / Anonim" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email_donatur" class="form-control form-control-light" placeholder="nama@email.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">No. Telepon <span class="text-danger">*</span></label>
                                <input type="text" name="nomor_telepon" class="form-control form-control-light" placeholder="08xxxx" required>
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-semibold">Nominal <span class="text-danger">*</span></label>
                            <div class="input-group input-group-flat">
                                <span class="input-group-text bg-light border-end-0">Rp</span>
                                <input type="number" name="jumlah_donasi" class="form-control ps-1" min="1000" placeholder="0" required>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent border-0 text-end p-4 pt-0">
                       <!-- Button buat munculin Modal -->
                    <button type="button" class="btn btn-success w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#modal-konfirmasi">
                        Lanjutkan Pembayaran
                    </button>

                    <!-- Modal Konfirmasi (Backlog: Pop Up Konfirmasi) -->
                    <div class="modal modal-blur fade" id="modal-konfirmasi" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center py-4">
                                    <i class="ti ti-alert-circle mb-2 text-warning" style="font-size: 3rem;"></i>
                                    <h3>Konfirmasi Donasi</h3>
                                    <div class="text-muted">Apakah data yang Anda masukkan sudah benar?</div>
                                </div>
                                <div class="modal-footer">
                                    <div class="w-100">
                                        <div class="row">
                                            <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">Cek Lagi</a></div>
                                            <div class="col">
                                                <!-- Button Submit asli ada di sini sekarang -->
                                                <button type="submit" class="btn btn-success w-100">Ya, Bayar!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection