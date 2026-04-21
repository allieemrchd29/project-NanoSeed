@extends('components.layout-admin')

@section('content')
    @include('components.navbar-admin')

    <div class="page-wrapper">
        <div class="container-xl py-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="page-title">Data Dokumentasi</h2>
                <a href="{{ route('admin.dokumentasi.create') }}" class="btn btn-success">
                    <i class="ti ti-plus me-1"></i> Tambah Dokumentasi
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
                                <th>Kampanye</th>
                                <th>Foto</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dokumentasi as $i => $item)
                                <tr>
                                    <td>{{ $dokumentasi->firstItem() + $i }}</td>
                                    <td>{{ $item->kampanye->nama_kampanye ?? '-' }}</td>
                                    <td>
                                        @if ($item->fotos->count() > 0)
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach ($item->fotos as $foto)
                                                    <img src="{{ asset('storage/' . $foto->foto) }}" class="rounded"
                                                        style="width:50px;height:50px;object-fit:cover;">
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-muted fst-italic">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ $item->tanggal_dokumentasi }}</td>
                                    <td>
                                        <a href="{{ route('admin.dokumentasi.edit', $item->id_dokumentasi) }}"
                                            class="btn btn-sm btn-warning me-1">Edit</a>

                                        <form id="delete-form-{{ $item->id_dokumentasi }}"
                                            action="{{ route('admin.dokumentasi.destroy', $item->id_dokumentasi) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmDelete({{ $item->id_dokumentasi }}, '{{ $item->kampanye->nama_kampanye ?? $item->keterangan }}')">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada data dokumentasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $dokumentasi->links() }}
                </div>
            </div>

        </div>
    </div>

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

        function confirmDelete(id, keterangan) {
            deleteFormId = id;
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
