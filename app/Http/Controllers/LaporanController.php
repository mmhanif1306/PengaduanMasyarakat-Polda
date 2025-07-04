<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Laporan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Laporan\CreateRequest;
use App\Http\Requests\Laporan\UpdateRequest;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('provinsi', 'like', "%{$search}%")
                  ->orWhere('kota', 'like', "%{$search}%")
                  ->orWhere('kecamatan', 'like', "%{$search}%")
                  ->orWhere('kelurahan', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Location filter
        if ($request->has('provinsi') && $request->provinsi != '') {
            $query->where('provinsi', $request->provinsi);
        }

        if ($request->has('kota') && $request->kota != '') {
            $query->where('kota', $request->kota);
        }

        // Get unique status for filter dropdown
        $statuses = Laporan::distinct('status')->pluck('status')->filter();

        // Get unique provinces for filter dropdown
        $provinces = Laporan::distinct('provinsi')->pluck('provinsi')->filter();

        // Get total items for current filter
        $totalItems = $query->count();

        // Paginate results with 9 items per page
        $laporan = $query->paginate(9)->withQueryString();

        // Get current filter status
        $currentFilters = [
            'search' => $request->search ?? '',
            'status' => $request->status ?? '',
            'provinsi' => $request->provinsi ?? '',
            'kota' => $request->kota ?? '',
            'total_items' => $totalItems
        ];

        return view('dashboard', compact('laporan', 'statuses', 'provinces', 'currentFilters'));
    }

    public function riwayatLaporan(Request $request)
    {
        $query = Laporan::where('user_id', Auth::id());

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('provinsi', 'like', "%{$search}%")
                  ->orWhere('kota', 'like', "%{$search}%")
                  ->orWhere('kecamatan', 'like', "%{$search}%")
                  ->orWhere('kelurahan', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Location filter
        if ($request->has('provinsi') && $request->provinsi != '') {
            $query->where('provinsi', $request->provinsi);
        }

        if ($request->has('kota') && $request->kota != '') {
            $query->where('kota', $request->kota);
        }

        // Get unique status for filter dropdown (only from user's reports)
        $statuses = Laporan::where('user_id', Auth::id())
                          ->distinct('status')
                          ->pluck('status')
                          ->filter();

        // Get unique provinces for filter dropdown (only from user's reports)
        $provinces = Laporan::where('user_id', Auth::id())
                           ->distinct('provinsi')
                           ->pluck('provinsi')
                           ->filter();

        // Get total items for current filter
        $totalItems = $query->count();

        // Paginate results with 9 items per page
        $laporan = $query->paginate(9)->withQueryString();

        // Get current filter status
        $currentFilters = [
            'search' => $request->search ?? '',
            'status' => $request->status ?? '',
            'provinsi' => $request->provinsi ?? '',
            'kota' => $request->kota ?? '',
            'total_items' => $totalItems
        ];

        return view('laporan.riwayat', compact('laporan', 'statuses', 'provinces', 'currentFilters'));
    }

    public function detailLaporan(int $id)
    {
        $laporan = Laporan::findOrFail($id);
        if (!$laporan) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan');
        }
        return view('laporan.detail', compact('laporan'));
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();

        $image = cloudinary()->uploadApi()->upload($data['image']->getRealPath(), [
            'folder' => 'laporan',
            'transformation' => [
                'quality' => 'auto',
                'fetch_format' => 'auto',
                'compression' => 'low',
            ],
        ]);
        if (!$image) {
            return redirect()->back()->with('error', 'Gagal mengunggah gambar');
        }

        $laporan = new Laporan();
        $laporan->user_id = Auth::id();
        $laporan->judul = $data['judul'];
        $laporan->deskripsi = $data['deskripsi'];
        $laporan->provinsi = $data['provinsi'];
        $laporan->kota = $data['kota'];
        $laporan->kecamatan = $data['kecamatan'];
        $laporan->kelurahan = $data['kelurahan'];
        $laporan->alamat = $data['alamat'];
        $laporan->longitude = $data['longitude'];
        $laporan->latitude = $data['latitude'];
        $laporan->public_id = $image['public_id'];
        $laporan->url_file = $image['secure_url'];
        $laporan->save();
        if (!$laporan) {
            cloudinary()->uploadApi()->destroy($image['public_id']);
            return redirect()->back()->with('error', 'Gagal membuat laporan');
        }

        $notifikasi = new Notifikasi();
        $notifikasi->user_id = $laporan->user_id;
        $notifikasi->judul = "Laporan berhasil dibuat";
        $notifikasi->deskripsi = "Laporan dengan judul " . $laporan->judul . " berhasil dibuat";
        $notifikasi->save();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat');
    }

    public function edit (int $id) {
        $laporan = Laporan::findOrFail($id);
        return response()->json($laporan);
    }

    public function update(int $id, UpdateRequest $request)
    {
        $data = $request->validated();
        $laporan = Laporan::findOrFail($id);
        if (!$laporan) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan');
        }
        if ($laporan->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses');
        }
        if ($laporan->status != 'menunggu') {
            return redirect()->back()->with('error', 'Laporan tidak dapat diubah karena status tidak menunggu');
        }

        if ($request->has('image')) {
            $image = cloudinary()->uploadApi()->upload($data['image']->getRealPath(), [
                'folder' => 'laporan',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                    'compression' => 'low',
                ],
            ]);
            if (!$image) {
                return redirect()->back()->with('error', 'Gagal mengunggah gambar');
            }
            $oldImage = $laporan->public_id;
            $laporan->public_id = $image['public_id'];
            $laporan->url_file = $image['secure_url'];
        } else {
            $oldImage = null;
        }

        $laporan->judul = $data['judul'];
        $laporan->deskripsi = $data['deskripsi'];
        $laporan->provinsi = $data['provinsi'];
        $laporan->kota = $data['kota'];
        $laporan->kecamatan = $data['kecamatan'];
        $laporan->kelurahan = $data['kelurahan'];
        $laporan->alamat = $data['alamat'];
        $laporan->longitude = $data['longitude'];
        $laporan->latitude = $data['latitude'];
        $laporan->save();
        if (!$laporan) {
            cloudinary()->uploadApi()->destroy($image['public_id']);
            return redirect()->back()->with('error', 'Gagal mengubah laporan');
        }
        if ($oldImage) {
            cloudinary()->uploadApi()->destroy($oldImage);
        }

        $notifikasi = new Notifikasi();
        $notifikasi->user_id = $laporan->user_id;
        $notifikasi->judul = "Laporan berhasil diupdate";
        $notifikasi->deskripsi = "Laporan dengan judul " . $laporan->judul . " berhasil diupdate";
        $notifikasi->save();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diubah');
    }

    public function delete(int $id)
    {
        $laporan = Laporan::findOrFail($id);
        if (!$laporan) {
            return redirect()->back()->with('error', 'Laporan tidak ditemukan');
        }
        if ($laporan->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses');
        }
        if ($laporan->status != 'menunggu') {
            return redirect()->back()->with('error', 'Laporan tidak dapat dihapus karena status tidak menunggu');
        }
        if (!cloudinary()->uploadApi()->destroy($laporan->public_id)) {
            return redirect()->back()->with('error', 'Gagal menghapus laporan');
        }
        $laporan->delete();
        if (!$laporan) {
            return redirect()->back()->with('error', 'Gagal menghapus laporan');
        }

        $notifikasi = new Notifikasi();
        $notifikasi->user_id = $laporan->user_id;
        $notifikasi->judul = "Laporan berhasil dihapus";
        $notifikasi->deskripsi = "Laporan dengan judul " . $laporan->judul . " berhasil dihapus";
        $notifikasi->save();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus');
    }
}
