<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Base query for user's reports
        $query = Laporan::where('user_id', Auth::id());
        
        // Search functionality (adopted from LaporanController)
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
        
        // Statistik laporan user (menggunakan query yang sudah difilter)
        $totalLaporan = $user->laporan->count();
        $laporanMenunggu = $user->laporan->where('status', 'menunggu')->count();
        $laporanDiproses = $user->laporan->where('status', 'diproses')->count();
        $laporanSelesai = $user->laporan->where('status', 'selesai')->count();
        
        // Laporan berdasarkan filter (untuk dashboard yang lebih interaktif)
        $laporanTerbaru = $query->latest()->take(10)->get();
        
        // Data untuk filter dropdown
        $statuses = Laporan::where('user_id', Auth::id())
            ->distinct('status')
            ->pluck('status')
            ->filter();
            
        $provinces = Laporan::where('user_id', Auth::id())
            ->distinct('provinsi')
            ->pluck('provinsi')
            ->filter();
        
        // Current filter status
        $currentFilters = [
            'search' => $request->search ?? '',
            'status' => $request->status ?? '',
            'provinsi' => $request->provinsi ?? '',
            'kota' => $request->kota ?? '',
            'total_filtered' => $query->count()
        ];
        
        // Statistik berdasarkan bulan (untuk chart)
        $monthlyStats = Laporan::where('user_id', Auth::id())
            ->selectRaw('EXTRACT(MONTH FROM created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        return view('user.dashboard', compact(
            'totalLaporan',
            'laporanMenunggu',
            'laporanDiproses',
            'laporanSelesai',
            'laporanTerbaru',
            'statuses',
            'provinces',
            'currentFilters',
            'monthlyStats'
        ));
    }
}