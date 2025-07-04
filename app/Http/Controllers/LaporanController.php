<?php

namespace App\Http\Controllers;

use App\Http\Requests\Laporan\CreateRequest;
use App\Http\Requests\Laporan\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::all();
        return view('laporan.index', compact('laporan'));
    }

    public function riwayatLaporan()
    {
        $laporan = Laporan::where('user_id', Auth::id())->get();
        return view('laporan.riwayat', compact('laporan'));
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
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus');
    }
}
