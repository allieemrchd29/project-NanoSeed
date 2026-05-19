<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Halaman daftar semua notifikasi
     */
    public function index()
    {
        $notifications = AdminNotification::latest()->get(); 
        $unreadCount   = AdminNotification::unread()->count();

        // agar status " baru" tetap muncul sebelum tombol centang diklik.

        return view('admin.notifications.index', compact('notifications', 'unreadCount'));
    }

    /**
     * Tandai satu notifikasi sebagai sudah dibaca 
     */
    public function markRead($id)
    {
        AdminNotification::findOrFail($id)->update(['is_read' => true]);

        // Berikan respon JSON agar ditangkap oleh SweetAlert2 di Blade
        return response()->json([
            'success' => true,
            'message' => 'Notifikasi ditandai sudah dibaca.'
        ]);
    }

    /**
     * Tandai semua notifikasi sebagai sudah dibaca
     */
    public function markAllRead()
    {
        AdminNotification::unread()->update(['is_read' => true]);

        // Berikan respon JSON agar ditangkap oleh SweetAlert2 di Blade
        return response()->json([
            'success' => true,
            'message' => 'Semua notifikasi telah ditandai sebagai dibaca.'
        ]);
    }

    /**
     * Hapus notifikasi
     */
    public function destroy($id)
    {
        AdminNotification::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Notifikasi berhasil dihapus.');
    }

    /**
     * API: jumlah notifikasi belum dibaca (untuk polling AJAX)
     */
    public function unreadCount()
    {
        return response()->json([
            'count' => AdminNotification::unread()->count(),
        ]);
    }

    /**
     * API: 5 notifikasi terbaru untuk dropdown
     */
    public function latest()
    {
        $notifications = AdminNotification::latest()
            ->take(5)
            ->get()
            ->map(fn($n) => [
                'id'            => $n->id,
                'nama_donatur'  => $n->nama_donatur,
                'jumlah_donasi' => 'Rp ' . number_format($n->jumlah_donasi, 0, ',', '.'),
                'is_read'       => $n->is_read,
                'time'          => $n->created_at->diffForHumans(),
                'read_url' => route('admin.notifications.read', $n->id),
            ]);

        return response()->json(['notifications' => $notifications]);
    }
}