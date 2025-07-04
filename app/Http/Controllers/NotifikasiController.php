<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasis = Notifikasi::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('notifikasi.index', compact('notifikasis'));
    }

    public function show(Notifikasi $notifikasi)
    {
        if ($notifikasi->user_id != Auth::id()) {
            return redirect()->route('notifikasi.index')->with('error', 'Anda tidak memiliki akses ke notifikasi ini');
        }
        $notifikasi->update(['is_read' => true]);
        return view('notifikasi.show', compact('notifikasi'));
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
