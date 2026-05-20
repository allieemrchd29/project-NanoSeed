@extends('components.layout-admin')

@section('content')
    @include('components.navbar-admin')

    <div class="page-wrapper">
        <div class="container-xl py-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="page-title">Data Dokumentasi</h2>
                <a href="{{ route('admin.dokumentasi.create') }}" class="btn btn-success">
                    <i class="ti ti-plus me-1"></i> Tambah Data Dokumentasi
                </a>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="text-success fw-bold">Daftar Dokumentasi Kegiatan</div>
                </div>
                <div class="card-body">
                    <table id="tabel-dokumentasi" class="table table-bordered table-hover align-middle w-100">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Kampanye</th>
                                <th>Foto</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokumentasi as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $item->kampanye->nama_kampanye ?? '-' }}</td>
                                    <td>
                                        {{-- Cek apakah relasi fotos ada isi datanya --}}
                                        @if ($item->fotos && $item->fotos->count() > 0)
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach ($item->fotos as $foto)
                                                    <img src="{{ asset('storage/' . $foto->foto) }}" class="rounded"
                                                        style="width:50px;height:50px;object-fit:cover;">
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-muted fst-italic">Tidak ada</span>
                                            <div style="font-size: 10px; color: red;">(Data di DB: {{ $item->fotos->count() }})</div>
                                        @endif
                                    </td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_dokumentasi)->translatedFormat('d F Y, H:i') }} WIB</td>
                                    <td style="white-space:nowrap;">
                                        <a href="{{ route('admin.dokumentasi.edit', $item->_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        
                                        {{-- 💎 1. PERBAIKAN: Tombol memanggil fungsi dengan parameter MongoDB _id & Keterangan --}}
                                        <button type="button" class="btn btn-sm btn-danger" 
                                            onclick="confirmDelete('{{ $item->_id }}', '{{ addslashes($item->keterangan) }}')">
                                            Hapus
                                        </button>

                                        {{-- 💎 2. PERBAIKAN: Menyediakan Form Hidden untuk eksekusi hapus data --}}
                                        <form id="delete-form-{{ $item->_id }}" 
                                            action="{{ route('admin.dokumentasi.destroy', $item->_id) }}" 
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- Pastikan SweetAlert2 ter-load sempurna --}}
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
            $('#tabel-dokumentasi').DataTable({
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
                    targets: [2, 5]
                }]
            });
        });

        // 💎 3. PERBAIKAN: Fungsi diletakkan secara global (di luar DOMContentLoaded) agar tombol onclick bisa menjangkau
        function confirmDelete(id, keterangan) {
            Swal.fire({
                title: 'Hapus Dokumentasi?',
                text: 'Apakah kamu yakin ingin menghapus dokumentasi "' + keterangan + '"?',
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