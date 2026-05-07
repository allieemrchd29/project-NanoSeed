<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi Donasi NanoSeed</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #1a1a1a;
            padding: 30px 36px;
            background: #fff;
        }

        /* ===== HEADER ===== */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        .header-left h1 {
            font-size: 16px;
            font-weight: bold;
            color: #1a1a1a;
            line-height: 1.3;
            text-transform: uppercase;
        }
        .header-left p {
            font-size: 10px;
            color: #555;
            margin-top: 2px;
        }
        .logo-img {
            width: 55px;
            height: 55px;
            object-fit: contain;
        }

        /* ===== META INFO ===== */
        .meta-box {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 2px solid #1a6b35;
        }
        .meta-name {
            font-size: 15px;
            font-weight: bold;
            color: #1a6b35;
        }
        .meta-right table { border: none; }
        .meta-right td {
            font-size: 10px;
            padding: 1px 4px;
            border: none;
            background: transparent;
            color: #333;
        }
        .meta-right td:first-child {
            color: #555;
            padding-right: 2px;
        }

        /* ===== NOTE BOX ===== */
        .note-box {
            border: 1px solid #b7dfc4;
            border-left: 3px solid #1a6b35;
            padding: 7px 10px;
            font-size: 9.5px;
            color: #444;
            margin-bottom: 14px;
            line-height: 1.5;
            background: #f9fefb;
        }

        /* ===== TABLE ===== */
        table { width: 100%; border-collapse: collapse; }
        thead tr {
            border-top: 2px solid #1a6b35;
            border-bottom: 2px solid #1a6b35;
        }
        thead th {
            padding: 7px 8px;
            text-align: left;
            font-size: 10.5px;
            font-weight: bold;
            color: #1a1a1a;
            background: #fff;
        }
        thead th.text-right  { text-align: right; }
        thead th.text-center { text-align: center; }

        tbody td {
            padding: 7px 8px;
            font-size: 10.5px;
            border-bottom: 1px solid #e8e8e8;
            color: #1a1a1a;
            vertical-align: middle;
        }
        tbody td.text-right  { text-align: right; }
        tbody td.text-center { text-align: center; }
        tbody td.text-muted  { color: #777; }

        /* ===== TOTAL ===== */
        .total-section {
            border-top: 2px solid #1a1a1a;
            border-bottom: 2px solid #1a1a1a;
        }
        .total-row td {
            padding: 7px 8px;
            font-size: 11px;
            font-weight: bold;
            text-align: right;
        }
        .total-row td:first-child { text-align: left; }
        .total-row.success td { color: #1a6b35; }
        .total-row.pending td { color: #92400e; }

        /* ===== BADGES ===== */
        .badge {
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
            display: inline-block;
        }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-failed  { background: #fee2e2; color: #991b1b; }
        .badge-default { background: #e5e7eb; color: #374151; }

        /* ===== FOOTER ===== */
        .footer {
            margin-top: 10px;
            font-size: 9px;
            color: #aaa;
            text-align: right;
        }
    </style>
</head>
<body>

@php
    $logoPath = public_path('assets/img/logo-nanoseed.jpeg');
    if (file_exists($logoPath)) {
        $ext      = pathinfo($logoPath, PATHINFO_EXTENSION);
        $mime     = $ext === 'png' ? 'image/png' : 'image/jpeg';
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoSrc  = 'data:' . $mime . ';base64,' . $logoData;
    } else {
        $logoSrc = '';
    }

    $totalBerhasil = $semuaDonasi->where('status', 'success')->sum('jumlah_donasi');
    $totalPending  = $semuaDonasi->where('status', 'pending')->sum('jumlah_donasi');
    $totalPohon    = $semuaDonasi->where('status', 'success')->sum(fn($d) => floor($d->jumlah_donasi / 50000));
    $totalSemua    = $semuaDonasi->count();
@endphp

{{-- HEADER --}}
<div class="header">
    <div class="header-left">
        <h1>Laporan Transaksi Donasi Pohon</h1>
        <p>NanoSeed : Platform Donasi Pohon Digital</p>
    </div>
    @if($logoSrc)
        <img src="{{ $logoSrc }}" class="logo-img">
    @endif
</div>

{{-- META --}}
<div class="meta-box">
    <div class="meta-name">ADMIN NANOSEED</div>
    <div class="meta-right">
        <table>
            <tr><td>Periode</td><td>: Semua Waktu</td></tr>
            <tr><td>Tanggal Cetak</td><td>: {{ now()->format('d M Y') }}</td></tr>
            <tr><td>Total Transaksi</td><td>: {{ $totalSemua }} transaksi</td></tr>
        </table>
    </div>
</div>

{{-- NOTE --}}
<div class="note-box">
    Laporan ini menampilkan seluruh riwayat transaksi donasi pohon melalui sistem NanoSeed.
    Donasi dinyatakan sah apabila berstatus <strong>Berhasil</strong>. Setiap Rp50.000 setara dengan 1 pohon yang ditanam.
</div>

{{-- TABEL --}}
<table>
    <thead>
        <tr>
            <th style="width:4%">#</th>
            <th style="width:12%">Tanggal</th>
            <th style="width:13%">Nama Donatur</th>
            <th style="width:19%">Email</th>
            <th style="width:12%">No. Telepon</th>
            <th style="width:10%" class="text-center">Pohon</th>
            <th style="width:9%"  class="text-center">Status</th>
            <th style="width:12%" class="text-right">Nominal</th>
        </tr>
    </thead>
    <tbody>
        @forelse($semuaDonasi as $i => $data)
        <tr>
            <td class="text-muted">{{ $i + 1 }}</td>
            <td class="text-muted">{{ $data->created_at->format('d M Y') }}</td>
            <td><strong>{{ $data->nama_donatur }}</strong></td>
            <td class="text-muted">{{ $data->email_donatur }}</td>
            <td>{{ $data->nomor_telepon }}</td>
            <td class="text-center">{{ (int) floor($data->jumlah_donasi / 50000) }} pohon</td>
            <td class="text-center">
                @if($data->status === 'success')
                    <span class="badge badge-success">Berhasil</span>
                @elseif($data->status === 'pending')
                    <span class="badge badge-pending">Pending</span>
                @elseif($data->status === 'failed')
                    <span class="badge badge-failed">Gagal</span>
                @else
                    <span class="badge badge-default">-</span>
                @endif
            </td>
            <td class="text-right">Rp{{ number_format($data->jumlah_donasi, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align:center; padding:20px; color:#aaa;">
                Belum ada data transaksi.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- TOTAL --}}
<table class="total-section">
    <tr class="total-row success">
        <td>TOTAL DONASI BERHASIL ({{ $totalPohon }} Pohon)</td>
        <td>Rp{{ number_format($totalBerhasil, 0, ',', '.') }}</td>
    </tr>
    <tr class="total-row pending">
        <td>TOTAL DONASI PENDING</td>
        <td>Rp{{ number_format($totalPending, 0, ',', '.') }}</td>
    </tr>
</table>

{{-- FOOTER --}}
<div class="footer">
    Hal 1 dari 1 &nbsp;|&nbsp; © {{ date('Y') }} NanoSeed &nbsp;|&nbsp; Dicetak: {{ now()->format('d M Y, H:i') }} WIB
</div>

</body>
</html>
