@extends('components.layout-admin')

@section('content')
    @include('components.navbar-admin')

    <div class="page-wrapper">
        <div class="container-xl py-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="page-title">Data Dampak</h2>
                <a href="{{ route('admin.dampak.create') }}" class="btn btn-success">
                    <i class="ti ti-plus me-1"></i> Tambah Data Dampak
                </a>
            </div>

            <div class="card">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title fw-bold text-green">Daftar Dampak NanoSeed</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabel-dampak" class="table table-bordered table-hover align-middle w-100">
                            <thead class="table-light">
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <span
                                            class="d-inline-flex align-items-center justify-content-center bg-success rounded-circle text-white"
                                            style="width:38px; height:38px;">
                                            <i class="fas {{ $dampak->icon ?? 'fa-info-circle' }}"></i>
                                        </span>
                                    </td>
                                    <td><strong>{{ $dampak->judul }}</strong></td>
                                    <td>{{ Str::limit($dampak->deskripsi, 80) }}</td>
                                    <td>
                                        <a href="{{ route('admin.dampak.edit', $dampak->_id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>

                                        {{-- 💎 1. PERBAIKAN: Gunakan _id untuk form --}}
                                        <form id="delete-form-{{ $dampak->_id }}"
                                            action="{{ route('admin.dampak.destroy', $dampak->_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        {{-- 💎 2. PERBAIKAN: Tambahkan tanda petik tunggal ('') pada parameter ID dan gunakan _id --}}
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmDelete('{{ $dampak->_id }}', '{{ addslashes($dampak->judul) }}')">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Belum ada data dampak.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- CDN SweetAlert2 memastikan library ter-load --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false,
                });
            });
        @endif

        document.addEventListener('DOMContentLoaded', function() {
            $('#tabel-dampak').DataTable({
                language: {
                    search: "Cari:",
                    lengthMenu: "_MENU_ entri per halaman",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: {
                        first: "«",
                        last: "»",
                        next: "›",
                        previous: "‹"
                    }
                },
                columnDefs: [{
                        orderable: false,
                        targets: [5, 6]
                    } // kolom gambar & aksi tidak bisa di-sort
                ]
            });
        });

        function confirmDelete(id, nama) {
            Swal.fire({
                title: 'Hapus Dampak?',
                text: 'Apakah kamu yakin ingin menghapus dampak "' + nama + '"?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
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
@endsection