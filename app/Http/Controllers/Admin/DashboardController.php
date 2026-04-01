<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\Menu;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        /* ================================
           FILTER PERIODE
        ================================= */

        $periode = $request->periode ?? 7;

        if ($periode == 30) {
            $startDate = now()->subDays(30);
        } elseif ($periode == 'bulan') {
            $startDate = now()->startOfMonth();
        } else {
            $startDate = now()->subDays(7);
        }


        /* ================================
           QUERY DASAR BERDASARKAN FILTER
        ================================= */

        $baseQuery = Reservasi::whereDate('tanggal_reservasi', '>=', $startDate);


        /* ================================
           STATISTIK UTAMA
        ================================= */

        $totalReservasi = $baseQuery->count();

        $totalMenu   = Menu::count();
        $totalGaleri = Galeri::count();

        $hariIni = Reservasi::whereDate('tanggal_reservasi', today())->count();

        $totalOrang = Reservasi::whereDate('tanggal_reservasi', '>=', $startDate)
                        ->sum('jumlah_orang');

        $confirmed = Reservasi::whereDate('tanggal_reservasi', '>=', $startDate)
                        ->where('status', 'confirmed')
                        ->count();

        $pending = Reservasi::whereDate('tanggal_reservasi', '>=', $startDate)
                        ->where('status', 'pending')
                        ->count();

        $cancelled = Reservasi::whereDate('tanggal_reservasi', '>=', $startDate)
                        ->where('status', 'cancelled')
                        ->count();


        /* ================================
           PERSENTASE STATUS
        ================================= */

        $totalStatus = $confirmed + $pending + $cancelled;

        $confirmedPercent = $totalStatus > 0 ? round(($confirmed / $totalStatus) * 100) : 0;
        $pendingPercent   = $totalStatus > 0 ? round(($pending / $totalStatus) * 100) : 0;
        $cancelledPercent = $totalStatus > 0 ? round(($cancelled / $totalStatus) * 100) : 0;


        /* ================================
           TREND BERDASARKAN PERIODE
        ================================= */

        $chartData = Reservasi::selectRaw("tanggal_reservasi as tanggal, COUNT(*) as total")
            ->whereDate('tanggal_reservasi', '>=', $startDate)
            ->groupBy('tanggal_reservasi')
            ->orderBy('tanggal_reservasi')
            ->get();


        /* ================================
           PERBANDINGAN MINGGU
        ================================= */

        $mingguIni = Reservasi::whereBetween('tanggal_reservasi', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();

        $mingguLalu = Reservasi::whereBetween('tanggal_reservasi', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek()
        ])->count();

        $persentase = $mingguLalu > 0
            ? (($mingguIni - $mingguLalu) / $mingguLalu) * 100
            : 0;


        /* ================================
           RESERVASI TERBARU
        ================================= */

        $latest = Reservasi::with('user')
                    ->whereDate('tanggal_reservasi', '>=', $startDate)
                    ->latest()
                    ->limit(5)
                    ->get();


        /* ================================
           DATA TAMBAHAN ANALISIS
        ================================= */

        $jamRamai = Reservasi::selectRaw("jam_reservasi as jam, COUNT(*) as total")
            ->whereDate('tanggal_reservasi', '>=', $startDate)
            ->groupBy('jam_reservasi')
            ->orderByDesc('total')
            ->limit(5)
            ->get();


        $tamuPerBulan = Reservasi::selectRaw("
            DATE_FORMAT(tanggal_reservasi, '%Y-%m') as bulan,
            SUM(jumlah_orang) as total_tamu
        ")
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();


        return view('admin.dashboard', compact(
            'periode',
            'totalReservasi',
            'totalMenu',
            'totalGaleri',
            'hariIni',
            'totalOrang',
            'confirmed',
            'pending',
            'cancelled',
            'confirmedPercent',
            'pendingPercent',
            'cancelledPercent',
            'chartData',
            'mingguIni',
            'persentase',
            'latest',
            'jamRamai',
            'tamuPerBulan'
        ));
    }


    /* ================================
       SEARCH GLOBAL
    ================================= */

    public function search(Request $request)
    {
        $keyword = trim($request->q);

        if (!$keyword) {
            return redirect()->route('admin.dashboard');
        }

        $menus = Menu::where('nama_menu', 'like', "%{$keyword}%")
                    ->orWhere('kategori', 'like', "%{$keyword}%")
                    ->get();

        // Cari reservasi melalui relasi user (nama & email ada di tabel users)
        $reservasis = Reservasi::with('user')
                        ->where(function ($query) use ($keyword) {
                            $query->where('status', 'like', "%{$keyword}%")
                                  ->orWhereHas('user', function ($q) use ($keyword) {
                                      $q->where('name', 'like', "%{$keyword}%")
                                        ->orWhere('email', 'like', "%{$keyword}%");
                                  });
                        })
                        ->get();

        $total = $menus->count() + $reservasis->count();

        return view('admin.search-result', compact(
            'menus',
            'reservasis',
            'keyword',
            'total'
        ));
    }


    public function latestReservasi()
    {
        $latest = Reservasi::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($r) {
                return [
                    'nama_pelanggan'   => $r->user->name ?? '-',
                    'tanggal_reservasi'=> $r->tanggal_reservasi,
                    'email'            => $r->user->email ?? '-',
                    'jam_reservasi'    => $r->jam_reservasi,
                    'status'           => $r->status,
                ];
            });

        return response()->json($latest);
    }
}