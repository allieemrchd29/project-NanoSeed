@extends('components.layout-admin')

@section('content')
@include('components.navbar-admin')

<div class="page-wrapper">
    {{-- Page Header --}}
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title text-green">Notifikasi Donasi</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            {{-- Navigasi Atas & Aksi Massal --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-link text-secondary ps-0">
                    ← Kembali ke Dashboard
                </a>
                {{-- Modifikasi ke Button biasa untuk AJAX --}}
                <button type="button" id="btn-mark-all" class="btn btn-sm btn-outline-success">
                    ✓ Tandai Semua Telah Dibaca
                </button>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h3 class="card-title fw-bold">Riwayat Notifikasi</h3>
                </div>
                
                <div class="card-body"> 
                    <div class="table-responsive">
                        <table id="table-notifikasi" class="table table-vcenter card-table w-100">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Nama Donatur</th>
                                    <th>Jumlah Donasi</th>
                                    <th>Waktu Terima</th>
                                    <th class="text-end">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notifications as $notif)
                                <tr id="notif-row-{{ $notif->id }}">
                                    <td class="status-cell">
                                        @if(!$notif->is_read)
                                            <span class="badge bg-green-lt">Baru</span>
                                        @else
                                            <span class="badge bg-gray-lt">Dibaca</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold text-dark">{{ $notif->nama_donatur }}</td>
                                    <td class="text-green fw-bold">Rp {{ number_format($notif->jumlah_donasi, 0, ',', '.') }}</td>
                                    <td data-sort="{{ $notif->created_at->timestamp }}">
                                        {{ $notif->created_at->translatedFormat('d M Y, H:i') }}
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-1 alignment-container">
                                            {{-- Tombol Centang AJAX --}}
                                            @if(!$notif->is_read)
                                                <button type="button" 
                                                        class="btn btn-sm btn-icon btn-ghost-green btn-mark-read" 
                                                        data-id="{{ $notif->id }}" 
                                                        title="Tandai sudah dibaca">
                                                    ✓
                                                </button>
                                            @else
                                                <button class="btn btn-sm btn-icon btn-ghost-green btn-disabled-check" disabled style="opacity: 0.4;">✓</button>
                                            @endif

                                            {{-- Form Hapus --}}
                                            <form id="delete-form-{{ $notif->id }}" action="{{ route('admin.notifications.destroy', $notif->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-icon btn-ghost-danger" title="Hapus Notifikasi" onclick="confirmDeleteNotif('{{ $notif->id }}')">
                                                    ✕
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
{{-- Library DataTables --}}
<link href="https://cdn.datatables.net/v/bs5/dt-2.0.7/datatables.min.css" rel="stylesheet">
<style>
    /* Flexbox */
    .dt-container .dt-layout-row {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 1rem 0 !important;
    }

    /* search box*/
    .dt-search input {
        border: 1px solid #e6e7e9 !important;
        border-radius: 6px !important;
        padding: 0.4rem 0.75rem !important;
        outline: none !important;
    }

    /* dropdown entries */
    .dt-length select {
        border: 1px solid #e6e7e9 !important;
        border-radius: 6px !important;
        margin-right: 5px !important;
    }

    .text-green { color: #2fb344 !important; }
    .bg-green-lt { background-color: #dff6e5 !important; color: #2fb344 !important; }
    .bg-gray-lt { background-color: #f1f5f9 !important; color: #64748b !important; }
    .btn-ghost-green { color: #2fb344; background: transparent; border: none; }
    .btn-ghost-green:hover { background: #f0fdf4; color: #1e8a31; }
    .btn-ghost-danger { color: #d63939; background: transparent; border: none; }
    .btn-ghost-danger:hover { background: #fef2f2; color: #b91c1c; }

    /* Header tabel agar elegan */
    #table-notifikasi thead th {
        background: #f8f9fa;
        color: #616876;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .04em;
        border-bottom: 1px solid #eee !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

{{-- Library DataTables JS Bundle --}}
<script src="https://cdn.datatables.net/v/bs5/dt-2.3.8/af-2.7.1/b-3.2.6/date-1.6.3/fc-5.0.5/fh-4.0.6/kt-2.12.2/r-3.0.8/rg-1.6.0/rr-1.5.1/sc-2.4.3/sb-1.8.4/sp-2.3.5/sl-3.1.3/sr-1.4.3/datatables.min.js"></script>

{{-- CDN SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Konfigurasi template Toast global
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true
    });

    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#table-notifikasi')) {
            $('#table-notifikasi').DataTable().destroy();
        }

        let table = $('#table-notifikasi').DataTable({
            "pageLength": 10,
            "dom": '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
            "language": {
                "lengthMenu": "_MENU_ <span class='text-muted small'>data per halaman</span>",
                "search": "Cari:",
                "searchPlaceholder": "Ketik nama...",
                "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                "paginate": {
                    "next": "›",
                    "previous": "‹"
                }
            },
            "order": [[3, "desc"]]
        });

        // AJAX Klik Centang Per Item
        $(document).on('click', '.btn-mark-read', function(e) {
            e.preventDefault();
            let button = $(this);
            let id = button.data('id');
            let container = button.parent();
            let row = button.closest('tr');

            $.ajax({
                url: `/admin/notifications/${id}/read`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // menampilkan Toast Sukses
                    Toast.fire({
                        icon: 'success',
                        title: 'Notifikasi berhasil dibaca'
                    });

                    // mengupdate UI kolom Status tanpa reload halaman
                    row.find('.status-cell').html('<span class="badge bg-gray-lt">Dibaca</span>');

                    button.remove();
                    container.prepend('<button class="btn btn-sm btn-icon btn-ghost-green btn-disabled-check" disabled style="opacity: 0.4;">✓</button>');
                },
                error: function(xhr) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal memperbarui status'
                    });
                }
            });
        });

        // 2. AJAX klik tandai semua dibaca
        $('#btn-mark-all').on('click', function(e) {
            e.preventDefault();
            
            $.ajax({
                url: "{{ route('admin.notifications.readAll') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'PATCH'
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Semua notifikasi ditandai dibaca'
                    });

                    // Ubah seluruh badge baru  menjadi dibaca
                    $('.status-cell').html('<span class="badge bg-gray-lt">Dibaca</span>');
                    
                    // Ubah semua tombol centang aktif menjadi disabled
                    $('.btn-mark-read').each(function() {
                        let container = $(this).parent();
                        $(this).remove();
                        container.prepend('<button class="btn btn-sm btn-icon btn-ghost-green btn-disabled-check" disabled style="opacity: 0.4;">✓</button>');
                    });
                },
                error: function(xhr) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal memproses permintaan'
                    });
                }
            });
        });
    });

    // Jalur Konfirmasi Hapus Data
    function confirmDeleteNotif(id) {
        Swal.fire({
            title: 'Hapus Notifikasi?',
            text: 'Apakah kamu yakin ingin menghapus notifikasi donasi ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d63939',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endpush
@endsection