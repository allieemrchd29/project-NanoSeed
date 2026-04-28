@extends('components.layout-admin')

@section('content')
    @include('components.navbar-admin')

    <div class="page-wrapper">
        <div class="container-xl py-4">

            <div class="mb-4">
                <h2 class="page-title">Hasil Pencarian</h2>
                <p class="text-muted">
                    Menampilkan hasil untuk: <strong>"{{ $query }}"</strong>
                </p>
            </div>

            {{-- Form search ulang --}}
            <form action="{{ route('admin.search') }}" method="GET" class="mb-4">
                <div class="input-group" style="max-width: 400px;">
                    <input type="text" name="q" class="form-control" value="{{ $query }}"
                        placeholder="Cari lagi...">
                    <button class="btn btn-success" type="submit">
                        <i class="ti ti-search"></i> Cari
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                        <i class="ti ti-x"></i> Reset
                    </a>
                </div>
            </form>

            {{-- HASIL KAMPANYE --}}
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="ti ti-speakerphone text-success"></i>
                    <strong>Kampanye</strong>
                    <span class="badge bg-success-lt text-success ms-1">{{ $kampanye->count() }}</span>
                </div>
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kampanye as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
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
                                        <a href="{{ route('admin.kampanye.index', $item->id) }}"
                                            class="btn btn-sm btn-warning">Lihat</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="ti ti-search-off me-1"></i>
                                        Tidak ada kampanye yang cocok dengan "<strong>{{ $query }}</strong>"
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- HASIL DOKUMENTASI --}}
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="ti ti-file-text text-primary"></i>
                    <strong>Dokumentasi</strong>
                    <span class="badge bg-blue-lt text-blue ms-1">{{ $dokumentasi->count() }}</span>
                </div>
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
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $item->kampanye->nama_kampanye ?? '-' }}</td>
                                    <td>
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                style="width:50px;height:50px;object-fit:cover;" class="rounded">
                                        @else
                                            <span class="text-muted fst-italic">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($item->keterangan, 60) }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>
                                        <a href="{{ route('admin.dokumentasi.index') }}"
                                            class="btn btn-sm btn-warning">Lihat</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="ti ti-search-off me-1"></i>
                                        Tidak ada dokumentasi yang cocok dengan "<strong>{{ $query }}</strong>"
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Kalau semua hasil kosong --}}
            @if ($kampanye->isEmpty() && $dokumentasi->isEmpty())
                <div class="empty">
                    <div class="empty-icon">
                        <i class="ti ti-search-off" style="font-size: 3rem; color: #ccc;"></i>
                    </div>
                    <p class="empty-title">Tidak ada hasil ditemukan</p>
                    <p class="empty-subtitle text-muted">
                        Kata kunci "<strong>{{ $query }}</strong>" tidak cocok dengan data apapun.
                    </p>
                    <div class="empty-action">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-success">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
