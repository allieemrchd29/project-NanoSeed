@extends('components.layout-admin')

@section('content')
@include('components.navbar-admin')

    <div class="container-xl mt-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Rekapitulasi Donasi Masuk</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4">ID</th>
                                    <th>Nama Donatur</th>
                                    <th>Email</th>
                                    <th>No. Telepon</th>
                                    <th>Nominal</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($semuaDonasi as $data)
                                <tr>
                                    <td class="px-4">{{ $data->id }}</td>
                                    <td>
                                        <span class="fw-bold">{{ $data->nama_donatur }}</span>
                                    </td>
                                    <td>{{ $data->email_donatur }}</td>
                                    <td>{{ $data->nomor_telepon }}</td>
                                    <td>
                                        <span class="badge bg-success-soft text-success">
                                            Rp {{ number_format($data->jumlah_donasi, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td>{{ $data->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.donasi.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Hapus permanen data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        Belum ada record donasi yang tersimpan di database.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection