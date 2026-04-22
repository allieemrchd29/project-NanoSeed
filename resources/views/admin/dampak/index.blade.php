@extends('components.layout-admin')

@section('content')
    @include('components.navbar-admin')

    <div class="page-wrapper">
     <div class="container-xl py-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="page-title">Dampak Penanaman Pohon NanoSeed</h2>
                <a href="{{ route('admin.dampak.create') }}" class="btn btn-success">
                    <i class="ti ti-plus me-1"></i> Tambah Data Dampak
                </a>
            </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-bordered mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">NO</th>
                            <th style="width: 80px;">ICON</th>
                            <th>JUDUL DAMPAK</th>
                            <th>DESKRIPSI</th>
                            <th style="width: 150px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dampaks as $dampak)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                <span class="d-inline-flex align-items-center justify-content-center bg-success rounded-circle text-white"
                                      style="width:38px; height:38px;">
                                    {{-- pakai fas jika default --}}
                                    <i class="fas {{ $dampak->icon ?? 'fa-info-circle' }}"></i>
                                </span>
                            </td>
                            <td><strong>{{ $dampak->judul }}</strong></td>
                            <td>{{ Str::limit($dampak->deskripsi, 80) }}</td>
                            <td>
                                <a href="{{ route('admin.dampak.edit', $dampak) }}"
                                   class="btn btn-warning btn-sm">Edit</a>

                                 <form id="delete-form-{{ $dampak->id }}"
                                            action="{{ route('admin.dampak.destroy', $dampak->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        {{-- Tombol trigger modal --}}
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmDelete({{ $dampak->id }}, '{{ $dampak->judul }}')">
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

<script>
    function confirmDelete(id, judul) {
        Swal.fire({
            title: 'Hapus Dampak?',
            text: "Data '" + judul + "' akan dihapus.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

@endsection

