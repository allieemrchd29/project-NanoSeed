@extends('components.layout-donatur')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center py-5">
                        <div id="loading-state">
                            <div class="spinner-border text-success mb-3" role="status"></div>
                            <p class="text-muted">Menyiapkan halaman pembayaran...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== POPUP KONFIRMASI (PBI 9) ===== --}}
    <div class="modal fade" id="confirmModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h4 class="modal-title fw-bold">🌳 Konfirmasi Donasi</h4>
                </div>
                <div class="modal-body text-center px-4">
                    <p class="text-muted mb-1">Anda telah berdonasi sebesar:</p>
                    <h2 class="text-success fw-bold mb-1" id="confirm-nominal">-</h2>
                    <p class="text-muted">Setara dengan <strong id="confirm-pohon">-</strong> pohon yang akan ditanam.</p>
                    <div id="status-result" class="alert mt-3 d-none"></div>
                </div>
                <div class="modal-footer border-0 justify-content-center gap-2">
                    <button class="btn btn-outline-secondary" id="btn-batal">Kembali ke Beranda</button>
                    <button class="btn btn-success px-4" id="btn-konfirmasi">
                        <span id="konfirmasi-text">✅ Ya, Konfirmasi!</span>
                        <span id="konfirmasi-spinner" class="spinner-border spinner-border-sm ms-1 d-none"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const snapToken = "{{ session('snap_token') }}";
            const orderId = "{{ session('order_id') }}";
            const nominal = {{ session('jumlah_donasi', 0) }};
            const pohon = {{ session('jumlah_pohon', 0) }};

            // Isi data di modal konfirmasi
            document.getElementById('confirm-nominal').textContent = 'Rp ' + nominal.toLocaleString('id-ID');
            document.getElementById('confirm-pohon').textContent = pohon + ' pohon';

            // Perbaikan Redirect URL agar konsisten
            const successRedirectUrl =
                `/donation/payment?order_id=${orderId}&status_code=200&transaction_status=capture`;

            // ===== Buka Snap Midtrans otomatis =====
            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    tampilkanModal();
                    tampilkanStatus('info', '⏳ Sedang memverifikasi pembayaran Anda, mohon tunggu...');
                    document.getElementById('btn-konfirmasi').disabled = true;
                    document.getElementById('konfirmasi-spinner').classList.remove('d-none');
                    checkStatusAutomatically();
                },
                onPending: function(result) {
                    tampilkanModal();
                    tampilkanStatus('warning',
                        '⏳ Pembayaran sedang diproses. Segera selesaikan sesuai instruksi.');
                    checkStatusAutomatically();
                },
                onError: function(result) {
                    tampilkanModal();
                    tampilkanStatus('danger', '❌ Pembayaran gagal. Silakan coba lagi.');
                },
                onClose: function() {
                    // Jika ditutup tanpa bayar, balik ke form donasi
                    window.location.href = "{{ route('views.donatur.donasi') }}";
                }
            });

            // ===== Fungsi Cek Status Otomatis =====
            function checkStatusAutomatically() {
                let attempts = 0;
                const maxAttempts = 15;

                const interval = setInterval(() => {
                    attempts++;
                    // PERBAIKAN: Penulisan objek fetch yang benar
                    fetch(`/donation/status/${orderId}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(r => r.json())
                        .then(data => {
                            if (data.status === 'success') {
                                clearInterval(interval);
                                tampilkanStatus('success',
                                '✅ Pembayaran terkonfirmasi! Mengalihkan...');
                                setTimeout(() => {
                                    window.location.href = successRedirectUrl;
                                }, 1500);
                            } else if (attempts >= maxAttempts) {
                                clearInterval(interval);
                                tampilkanStatus('warning',
                                    'Konfirmasi otomatis memakan waktu. Silakan klik tombol Konfirmasi manual.'
                                    );
                                document.getElementById('btn-konfirmasi').disabled = false;
                                document.getElementById('konfirmasi-spinner').classList.add('d-none');
                            }
                        })
                        .catch(err => console.error("Gagal cek status:", err));
                }, 3000);
            }

            // ===== Tombol Konfirmasi Manual =====
            document.getElementById('btn-konfirmasi').addEventListener('click', function() {
                this.disabled = true;
                document.getElementById('konfirmasi-text').textContent = 'Memproses...';
                document.getElementById('konfirmasi-spinner').classList.remove('d-none');

                fetch(`/donation/status/${orderId}`)
                    .then(r => r.json())
                    .then(data => {
                        if (data.status === 'success') {
                            tampilkanStatus('success', '✅ Donasi Anda telah diterima! Terima kasih 🌳');
                            setTimeout(() => {
                                window.location.href = successRedirectUrl;
                            }, 1000);
                        } else {
                            tampilkanStatus('danger',
                                '❌ Pembayaran belum terdeteksi. Silakan tunggu atau hubungi kami.');
                            this.disabled = false;
                            document.getElementById('konfirmasi-text').textContent =
                            '✅ Ya, Konfirmasi!';
                            document.getElementById('konfirmasi-spinner').classList.add('d-none');
                        }
                    })
                    .catch(() => {
                        this.disabled = false;
                        tampilkanStatus('danger', '❌ Terjadi kesalahan teknis.');
                    });
            });

            document.getElementById('btn-batal').addEventListener('click', function() {
                window.location.href = "{{ route('donatur.dashboard') }}";
            });

            function tampilkanModal() {
                if (typeof bootstrap !== 'undefined') {
                    const modalElement = document.getElementById('confirmModal');
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                    document.getElementById('loading-state').classList.add('d-none');
                }
            }

            function tampilkanStatus(type, message) {
                const el = document.getElementById('status-result');
                el.className = `alert alert-${type} mt-3`;
                el.textContent = message;
                el.classList.remove('d-none');
            }
        });
    </script>
@endpush
