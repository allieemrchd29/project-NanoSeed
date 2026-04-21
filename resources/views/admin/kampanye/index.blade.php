@extends('components.layout-admin')

@section('content')
    @include('components.navbar-admin')

    <div class="page-wrapper">
        <div class="container-xl py-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="page-title">Data Kampanye</h2>
                <a href="{{ route('admin.kampanye.create') }}" class="btn btn-success">
                    <i class="ti ti-plus me-1"></i> Tambah Kampanye
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter table-bordered card-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kampanye</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kampanye as $i => $item)
                                <tr>
                                    <td>{{ $kampanye->firstItem() + $i }}</td>
                                    <td>{{ $item->nama_kampanye }}</td>
                                    <td>{{ Str::limit($item->deskripsi, 60) }}</td>
                                    <td>
                                        <span
                                            class="badge 
                                            {{ $item->status_kampanye === 'aktif'
                                                ? 'bg-success text-white'
                                                : ($item->status_kampanye === 'selesai'
                                                    ? 'bg-secondary text-white'
                                                    : 'bg-danger text-white') }}">
                                            {{ ucfirst($item->status_kampanye) }}
                                        </span>
                                    </td>
                                    <td>{{ $item->tanggal_mulai }}</td>
                                    <td>{{ $item->tanggal_selesai }}</td>
                                    <td>
                                        @if ($item->gambar_kampanye)
                                            <img src="{{ asset('storage/' . $item->gambar_kampanye) }}" class="rounded"
                                                style="width:60px;height:60px;object-fit:cover;">
                                        @else
                                            <span class="text-muted fst-italic">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.kampanye.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning me-1">Edit</a>

                                        {{-- Form hapus terpisah --}}
                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('admin.kampanye.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        {{-- Tombol trigger modal --}}
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmDelete({{ $item->id }}, '{{ $item->nama_kampanye }}')">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Belum ada data kampanye.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $kampanye->links() }}
                </div>
            </div>

        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div class="modal modal-blur fade" id="modal-hapus" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title fw-bold">Konfirmasi Hapus</div>
                    <div id="modal-hapus-text" class="text-muted mt-1"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-50" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger w-50" id="btn-confirm-delete">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let deleteFormId = null;

        function confirmDelete(id, nama) {
            deleteFormId = id;
            Swal.fire({
                title: 'Hapus Kampanye?',
                text: 'Apakah kamu yakin ingin menghapus kampanye "' + nama + '"?',
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
