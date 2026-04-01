<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Mail\ReservasiMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class ReservasiAdminController extends Controller
{
    public function index()
    {
        $reservasi = DB::table('reservasi')
            ->leftJoin('area', 'reservasi.id_area', '=', 'area.id_area')
            ->leftJoin('meja', 'reservasi.id_meja', '=', 'meja.id_meja')
            ->leftJoin('users', 'reservasi.user_id', '=', 'users.id')
            ->select(
                'reservasi.*',
                'area.nama_area',
                'meja.kode_meja',
                'users.name as nama_pelanggan',
                'users.email as email',
                'users.no_hp as no_hp'
            )
            ->orderBy('reservasi.created_at', 'desc')
            ->get();

        return view('admin.reservasi.index', compact('reservasi'));
    }

    public function getJson()
    {
        // Eager load relasi user + menus (pivot: jumlah, harga_saat_ini)
        $reservasi = Reservasi::with([
                'user',
                'area',
                'meja',
                'menus' => function ($q) {
                    $q->select('menu.id_menu', 'menu.nama_menu', 'menu.kategori', 'menu.harga')
                      ->withPivot('jumlah', 'harga_saat_ini');
                }
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        $data = $reservasi->map(function ($r) {
            $arr = $r->toArray();
            // Data pelanggan diambil dari relasi user
            $arr['nama_pelanggan'] = $r->user->name ?? '-';
            $arr['email']          = $r->user->email ?? '-';
            $arr['no_hp']          = $r->user->no_hp ?? '-';
            $arr['nama_area']      = $r->area->nama_area ?? null;
            $arr['kode_meja']      = $r->meja->kode_meja ?? null;
            return $arr;
        });

        $stats = [
            'total'     => Reservasi::count(),
            'pending'   => Reservasi::where('status', 'pending')->count(),
            'confirmed' => Reservasi::where('status', 'confirmed')->count(),
            'cancelled' => Reservasi::where('status', 'cancelled')->count(),
        ];

        return response()->json([
            'data'  => $data,
            'stats' => $stats
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled'
        ]);

        $reservasi = Reservasi::findOrFail($id);

        $previousStatus = $reservasi->status;

        $reservasi->status = $request->status;
        $reservasi->save();

        // Kirim email hanya jika berubah dari pending → confirmed
        if ($previousStatus !== 'confirmed' && $request->status === 'confirmed') {
            Mail::to($reservasi->email)
                ->send(new ReservasiMail($reservasi));
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        return $this->updateStatus($request, $id);
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();

        return response()->json(['success' => true]);
    }

    public function dashboard()
    {
        $totalReservasi = Reservasi::count();
        $hariIni        = Reservasi::whereDate('tanggal_reservasi', today())->count();
        $totalOrang     = Reservasi::sum('jumlah_orang');
        $confirmed      = Reservasi::where('status', 'confirmed')->count();
        $pending        = Reservasi::where('status', 'pending')->count();
        $cancelled      = Reservasi::where('status', 'cancelled')->count();

        $chartData = Reservasi::selectRaw('DATE(tanggal_reservasi) as tanggal, COUNT(*) as total')
            ->where('tanggal_reservasi', '>=', now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('admin.dashboard', compact(
            'totalReservasi', 'hariIni', 'totalOrang',
            'confirmed', 'pending', 'cancelled', 'chartData'
        ));
    }
}