@extends('components.layout-admin')

@section('content')
@include('components.navbar-admin')

<div class="container-xl mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="mb-0">Rekapitulasi Donasi Masuk</h2>
                <div class="d-flex gap-2 align-items-center">
                <span class="badge bg-green-lt text-success fs-6">
                    <span class="me-1">●</span> Live Autorefresh
                </span>
                <!-- tombol download PDF -->
                <a href="{{ route('admin.donasi.export-pdf') }}" 
                class="btn btn-danger btn-sm fw-semibold" 
                target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="16" height="16" 
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M14 3v4a1 1 0 0 0 1 1h4"/>
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"/>
                        <path d="M9 17h6"/>
                        <path d="M9 13h6"/>
                    </svg>
                    Download PDF
                </a>
            </div>
        </div>
                    </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="tabel-donasi">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4">#</th>
                                    <th>Nama Donatur</th>
                                    <th>Email</th>
                                    <th>No. Telepon</th>
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
                                    <td class="px-4 text-muted">{{ $i + 1 }}</td>
                                    <td class="fw-bold">{{ $data->nama_donatur }}</td>
                                    <td>{{ $data->email_donatur }}</td>
                                    <td>{{ $data->nomor_telepon }}</td>
                                    <td>
                                        <span class="text-success fw-semibold">
                                            Rp {{ number_format($data->jumlah_donasi, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td>🌱 {{ $data->jumlah_pohon ?? (int) floor($data->jumlah_donasi / 10000) }} pohon</td>
                                    <td>
                                        @if($data->status === 'success')
                                            <span class="badge bg-success">Berhasil</span>
                                        @elseif($data->status === 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($data->status === 'failed')
                                            <span class="badge bg-danger">Gagal</span>
                                        @else
                                            <span class="badge bg-secondary">-</span>
                                        @endif
                                    </td>
                                    <td class="text-muted">{{ $data->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.donasi.destroy', $data->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Hapus permanen data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr id="empty-row">
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        Belum ada record donasi yang tersimpan.
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

        {{-- Tombol Download PDF --}}
        <a href="{{ route('admin.donasi.export-pdf') }}" 
           class="btn btn-danger btn-sm fw-semibold" 
           target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="16" height="16" 
                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M14 3v4a1 1 0 0 0 1 1h4"/>
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"/>
                <path d="M9 17h6"/>
                <path d="M9 13h6"/>
            </svg>
            Download PDF
        </a>
    </div>
</div>

@push('scripts')
<script>
// Auto refresh tabel setiap 10 detik
setInterval(function () {
    fetch('/admin/donasi/latest')
        .then(r => r.json())
        .then(data => {
            const tbody = document.getElementById('tbody-donasi');

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            Belum ada record donasi yang tersimpan.
                        </td>
                    </tr>`;
                return;
            }

            tbody.innerHTML = data.map((d, i) => `
                <tr>
                    <td class="px-4 text-muted">${i + 1}</td>
                    <td class="fw-bold">${d.nama_donatur}</td>
                    <td>${d.email_donatur}</td>
                    <td>${d.nomor_telepon}</td>
                    <td><span class="text-success fw-semibold">Rp ${parseInt(d.jumlah_donasi).toLocaleString('id-ID')}</span></td>
                    <td>🌱 ${Math.floor(d.jumlah_donasi / 10000)} pohon</td>
                    <td>${badgeStatus(d.status)}</td>
                    <td class="text-muted">${formatTanggal(d.created_at)}</td>
                    <td class="text-center">
                        <form action="/admin/donasi/${d.id}" method="POST" 
                              onsubmit="return confirm('Hapus permanen data ini?')">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            `).join('');
        })
        .catch(err => console.log('Auto-refresh error:', err));
}, 10000);

function badgeStatus(status) {
    const map = {
        success: '<span class="badge bg-success">Berhasil</span>',
        pending: '<span class="badge bg-warning text-dark">Pending</span>',
        failed:  '<span class="badge bg-danger">Gagal</span>',
    };
    return map[status] || '<span class="badge bg-secondary">-</span>';
}

function formatTanggal(dateStr) {
    const d = new Date(dateStr);
    return d.toLocaleDateString('id-ID', {
        day: '2-digit', month: '2-digit', year: 'numeric',
        hour: '2-digit', minute: '2-digit'
    });
}
</script>
@endpush

@endsection