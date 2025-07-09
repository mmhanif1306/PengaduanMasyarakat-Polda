<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    // Preview notifikasi untuk dropdown (5 item)
    public function preview()
    {
        $notifikasis = Notifikasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $unreadCount = Notifikasi::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json([
            'notifikasis' => $notifikasis,
            'unread_count' => $unreadCount
        ]);
    }

    // Halaman lengkap notifikasi dengan pagination 10
    public function index()
    {
        $notifikasis = Notifikasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $unreadCount = Notifikasi::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return view('user.notifikasi.index', compact('notifikasis', 'unreadCount'));
    }

    // Menandai notifikasi sebagai dibaca
    public function markAsRead(Notifikasi $notifikasi)
    {
        if ($notifikasi->user_id != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notifikasi->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi telah ditandai sebagai dibaca',
            'notifikasi' => $notifikasi
        ]);
    }

    public function show(Notifikasi $notifikasi)
    {
        if ($notifikasi->user_id != Auth::id()) {
            return redirect()->route('notifikasi.index')->with('error', 'Anda tidak memiliki akses ke notifikasi ini');
        }
        $notifikasi->update(['is_read' => true]);
        return view('user.notifikasi.show', compact('notifikasi'));
    }

    public function destroy(Notifikasi $notifikasi)
    {
        if ($notifikasi->user_id != Auth::id()) {
            return redirect()->route('notifikasi.index')->with('error', 'Anda tidak memiliki akses ke notifikasi ini');
        }
        $notifikasi->delete();
        return redirect()->route('notifikasi.index')->with('success', 'Notifikasi berhasil dihapus');
    }
}
