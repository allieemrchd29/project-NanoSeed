@extends('components.layout-admin')

@section('content')
    @include('components.navbar-admin')

    <div class="page-wrapper">
        <div class="container-xl mt-4">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h2 class="mb-0 text-dark">Rekapitulasi Donasi Masuk</h2>
                        <div class="d-flex gap-2 align-items-center">
                            <span class="badge bg-green-lt text-success fs-6">
                                <span class="status-dot status-dot-animated bg-green me-1"></span> Live Autorefresh
                            </span>
                            <a href="{{ route('admin.donasi.export-pdf') }}"
                                class="btn btn-danger btn-sm fw-semibold shadow-sm" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="16" height="16"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                    <path d="M9 17h6" />
                                    <path d="M9 13h6" />
                                </svg>
                                Download PDF
                            </a>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-important alert-success alert-dismissible shadow-sm mb-4" role="alert">
                            <div class="d-flex">
                                <div><svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg></div>
                                <div>{{ session('success') }}</div>
                            </div>
                            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    @endif

                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h3 class="card-title fw-bold text-green">Daftar Transaksi Donasi</h3>
                        </div>
                        <div class="card-body"> {{-- Set p-0 tapi tambah py-2 --}}
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle w-100" id="tabel-donasi">
                                    <thead
                                        class="table-light>
                                        <tr>
                                            <th class="w-1">
                                        <th>#</th>
                                        <th>Nama Donatur</th>
                                        <th>Email / No. Telp</th>
                                        <th>Nominal</th>
                                        <th>Jumlah Pohon</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-donasi">
                                        @forelse($semuaDonasi as $i => $data)
                                            <tr>
                                                <td class="text-muted">{{ $i + 1 }}</td>
                                                <td class="fw-bold text-dark">{{ $data->nama_donatur }}</td>
                                                <td>
                                                    <div class="text-dark">{{ $data->email_donatur }}</div>
                                                    <div class="text-muted small">{{ $data->nomor_telepon }}</div>
                                                </td>
                                                <td>
                                                    <span class="text-green fw-bold">
                                                        Rp {{ number_format($data->jumlah_donasi, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td><span class="badge bg-green-lt text-green">🌱
                                                        {{ $data->jumlah_pohon ?? (int) floor($data->jumlah_donasi / 10000) }}
                                                        pohon</span></td>
                                                <td>
                                                    @if ($data->status === 'success')
                                                        <span class="badge bg-success">Berhasil</span>
                                                    @elseif($data->status === 'pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @else
                                                        <span class="badge bg-danger">Gagal</span>
                                                    @endif
                                                </td>
                                                <td data-sort="{{ $data->created_at->timestamp }}" class="text-muted">
                                                    {{ $data->created_at->translatedFormat('d M Y, H:i') }}
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{ route('admin.donasi.destroy', $data->id) }}"
                                                        method="POST" class="delete-donasi-form">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-ghost-danger btn-sm btn-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M4 7l16 0" />
                                                                <path d="M10 11l0 6" />
                                                                <path d="M14 11l0 6" />
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link href="https://cdn.datatables.net/v/bs5/dt-2.3.8/datatables.min.css" rel="stylesheet">
        <style>
            #tabel-donasi thead th {
                background-color: #fff;
                color: #616876;
                text-transform: uppercase;
                font-size: 11px;
                letter-spacing: .04em;
                padding: 12px 10px;
                border-bottom: 1px solid #f1f1f1 !important;
            }

            #tabel-donasi tbody td {
                padding: 16px 10px;
                border-bottom: 1px solid #f8f9fa;
            }

            /* Input Search style */
            .dt-search input {
                border: 1px solid #e6e7e9 !important;
                border-radius: 8px !important;
                padding: 5px 10px !important;
                margin-left: 8px !important;
            }

            .form-select-sm {
                border-radius: 8px !important;
                border: 1px solid #e6e7e9 !important;
            }

            .text-green {
                color: #2fb344 !important;
            }

            .bg-green-lt {
                background-color: #dff6e5 !important;
                color: #2fb344 !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/dt-2.3.8/datatables.min.js"></script>

        <script>
            let table;
            $(document).ready(function() {
                table = $('#tabel-donasi').DataTable({
                    "pageLength": 10,
                    "dom": '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
                    "language": {
                        "lengthMenu": "_MENU_ <span class='text-muted small'>entri per halaman</span>",
                        "search": "Cari:",
                        "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        "paginate": {
                            "next": "›",
                            "previous": "‹"
                        },
                        "emptyTable": "Belum ada record donasi yang tersimpan."
                    },
                    "order": [
                        [6, "desc"]
                    ]
                });

                setInterval(refreshTable, 10000);

                $(document).on('submit', '.delete-donasi-form', function(event) {
                    event.preventDefault();
                    const form = this;

                    Swal.fire({
                        title: 'Hapus data donasi?',
                        text: 'Data ini akan dihapus permanen.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });

                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: @json(session('success')),
                        timer: 2500,
                        showConfirmButton: false,
                        position: 'top-end',
                        toast: true
                    });
                @endif
            });

            function refreshTable() {
                fetch('/admin/donasi/latest')
                    .then(r => r.json())
                    .then(data => {
                        let currentPage = table.page();
                        table.clear();
                        data.forEach((d, i) => {
                            table.row.add([
                                `<span class="text-muted">${i + 1}</span>`,
                                `<div class="fw-bold text-dark">${d.nama_donatur}</div>`,
                                `<div>${d.email_donatur}</div><div class="text-muted small">${d.nomor_telepon}</div>`,
                                `<span class="text-green fw-bold">Rp ${parseInt(d.jumlah_donasi).toLocaleString('id-ID')}</span>`,
                                `<span class="badge bg-green-lt text-green">🌱 ${Math.floor(d.jumlah_donasi / 10000)} pohon</span>`,
                                badgeStatus(d.status),
                                formatTanggal(d.created_at),
                                `<div class="text-center">
                            <form action="/admin/donasi/${d.id}" method="POST" class="delete-donasi-form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-ghost-danger btn-sm btn-icon">✕</button>
                            </form>
                        </div>`
                            ]);
                        });
                        table.draw(false);
                        table.page(currentPage).draw('page');
                    });
            }

            function badgeStatus(status) {
                const map = {
                    success: '<span class="badge bg-success">Berhasil</span>',
                    pending: '<span class="badge bg-warning text-dark">Pending</span>',
                    failed: '<span class="badge bg-danger">Gagal</span>',
                };
                return map[status] || '<span class="badge bg-secondary">-</span>';
            }

            function formatTanggal(dateStr) {
                const d = new Date(dateStr);
                return d.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
        </script>
    @endpush
@endsection
