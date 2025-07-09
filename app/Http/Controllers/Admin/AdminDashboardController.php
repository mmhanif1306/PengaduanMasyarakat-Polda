<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Statistik umum
        $totalLaporan = Laporan::count();
        $totalUser = User::where('role', '!=', 'admin')->count();
        $laporanMenunggu = Laporan::where('status', 'menunggu')->count();
        $laporanDiproses = Laporan::where('status', 'diproses')->count();
        $laporanSelesai = Laporan::where('status', 'selesai')->count();
        
        // Laporan terbaru yang perlu ditangani
        $laporanTerbaru = Laporan::with('user')
            ->latest()
            ->take(10)
            ->get();
        
        // Statistik berdasarkan bulan (untuk chart)
        $monthlyStats = Laporan::selectRaw('EXTRACT(MONTH FROM created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        // Statistik berdasarkan status (untuk pie chart)
        $statusStats = Laporan::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();
        
        // Laporan berdasarkan provinsi (top 5)
        $provinsiStats = Laporan::selectRaw('provinsi, COUNT(*) as count')
            ->groupBy('provinsi')
            ->orderByDesc('count')
            ->take(5)
            ->get();
        
        // User paling aktif (top 5)
        $activeUsers = User::withCount('laporan')
            ->where('role', '!=', 'admin')
            ->orderByDesc('laporan_count')
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalLaporan',
            'totalUser',
            'laporanMenunggu',
            'laporanDiproses',
            'laporanSelesai',
            'laporanTerbaru',
            'monthlyStats',
            'statusStats',
            'provinsiStats',
            'activeUsers'
        ));
    }
}