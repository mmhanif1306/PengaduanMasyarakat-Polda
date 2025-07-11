<?php

namespace App\Http\Controllers\Admin;

use App\Models\Laporan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $laporan = $query->paginate(10)->withQueryString();

        // Get current filter status
        $currentFilters = [
            'search' => $request->search ?? '',
            'status' => $request->status ?? '',
            'provinsi' => $request->provinsi ?? '',
            'kota' => $request->kota ?? '',
            'total_items' => $totalItems
        ];

        return view('admin.laporan.index', compact('laporan', 'statuses', 'provinces', 'currentFilters'));
    }

    public function show(Laporan $laporan)
    {
        return view('admin.laporan.show', compact('laporan'));
    }

    public function updateStatus(Laporan $laporan, Request $request)
    {

        $request->validate([
            'status' => 'required|in:diproses,selesai',
        ]);

        $laporan->update([
            'status' => $request->status,
        ]);

        $notifikasi = new Notifikasi();
        $notifikasi->user_id = $laporan->user_id;
        if ($request->status == 'diproses') {
            $notifikasi->judul = "Laporan sedang diproses";
            $notifikasi->deskripsi = "Laporan dengan judul " . $laporan->judul . " sedang diproses";
        }
        if ($request->status == 'selesai') {
            $notifikasi->judul = "Laporan selesai";
            $notifikasi->deskripsi = "Laporan dengan judul " . $laporan->judul . " selesai";
        }
        $notifikasi->save();

        return redirect()->route('admin.laporan.index')->with('success', 'Status laporan berhasil diupdate');
    }

    public function downloadPdf(Laporan $laporan)
    {
        $pdf = Pdf::loadView('admin.laporan.pdf', compact('laporan'));
        
        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');
        
        // Configure dompdf options to allow external images
        $pdf->getDomPDF()->getOptions()->setIsRemoteEnabled(true);
        $pdf->getDomPDF()->getOptions()->setIsHtml5ParserEnabled(true);
        $pdf->getDomPDF()->getOptions()->setIsPhpEnabled(true);
        
        // Generate filename with report ID and current date
        $filename = 'laporan_' . $laporan->id . '_' . date('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }
}
