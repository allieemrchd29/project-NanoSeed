@component('mail::message')
    # Pembayaran Anda Telah Berhasil! 🌳

    Halo, **{{ $donasi->nama_donatur }}**

    Kami informasikan bahwa pembayaran donasi pohon Anda telah **berhasil diterima**.

    ---

    **Detail Pembayaran:**

    | Keterangan | Detail |
    |---|---|
    | Order ID :| {{ $donasi->order_id }} |
    | Nominal :| Rp {{ number_format($donasi->jumlah_donasi, 0, ',', '.') }} |
    | Jumlah Pohon :| {{ (int) floor($donasi->jumlah_donasi / 50000) }} pohon 🌱 |
    | Kampanye :| {{ $donasi->kampanye->nama_kampanye }} |
    | Status :| Lunas |
    | Tanggal :| {{ $donasi->updated_at->format('d M Y, H:i') }} WIB |

    ---

    Terima kasih telah berkontribusi untuk penghijauan bumi bersama **NanoSeed**.
    Pohon yang Anda donasikan akan segera kami tanam! 🌍

    Salam hangat,<br>
    **Tim NanoSeed**
@endcomponent
