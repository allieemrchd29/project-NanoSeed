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
                                    <th>#</th>
                                    <th>Nama Dampak</th>
                                    <th>Deskripsi</th>
                                    {{-- <th>Status</th> --}}
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Icon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dampaks as $i => $item)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $item->judul}}</td>
                                        <td>{{ Str::limit($item->deskripsi, 60) }}</td>
                                        {{-- <td>
                                            <span
                                                class="badge
                                            {{ $item->status_dampak === 'aktif'
                                                ? 'bg-success text-white'
                                                : ($item->status_dampak === 'selesai'
                                                    ? 'bg-secondary text-white'
                                                    : 'bg-danger text-white') }}">
                                                {{ ucfirst($item->status_dampak) }}
                                            </span>
                                        </td> --}}
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}
                                        </td>
                                        <td class="text-center">
                                            <span class="d-inline-flex align-items-center justify-content-center bg-green-lt text-green rounded-circle" 
                                                style="width:35px; height:35px;">
                                                <i class="fas {{ $item->icon ?? 'fa-tree' }}"></i>
                                            </span>
                                        </td>
                                        <td style="white-space:nowrap;">
                                            <a href="{{ route('admin.dampak.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning me-1">Edit</a>

                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ route('admin.dampak.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="confirmDelete({{ $item->id }}, '{{ $item->nama_dampak }}')">
                                                Hapus
                                            </button>
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
