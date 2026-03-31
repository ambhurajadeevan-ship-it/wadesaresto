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
            ->leftJoin('area','reservasi.id_area','=','area.id_area')
            ->leftJoin('meja','reservasi.id_meja','=','meja.id_meja')
            ->select(
                'reservasi.*',
                'area.nama_area',
                'meja.kode_meja'
            )
            ->orderBy('reservasi.created_at','desc')
            ->get();

        return view('admin.reservasi.index', compact('reservasi'));
    }

    public function getJson()
    {
        $data = DB::table('reservasi')
            ->leftJoin('area','reservasi.id_area','=','area.id_area')
            ->leftJoin('meja','reservasi.id_meja','=','meja.id_meja')
            ->select(
                'reservasi.*',
                'area.nama_area',
                'meja.kode_meja'
            )
            ->orderBy('reservasi.created_at','desc')
            ->get();
        

        $stats = [
            'total'     => Reservasi::count(),
            'pending'   => Reservasi::where('status','pending')->count(),
            'confirmed' => Reservasi::where('status','confirmed')->count(),
            'cancelled' => Reservasi::where('status','cancelled')->count(),
        ];

        return response()->json([
            'data'  => $data,
            'stats' => $stats
        ]);
    }

    public function update(Request $request, $id)
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

        return back()->with('success', 'Status reservasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $reservasi = \App\Models\Reservasi::findOrFail($id);
        $reservasi->delete();

        return redirect()->back()->with('success', 'Reservasi berhasil dihapus.');
    }

    

    public function dashboard()
    {
        $totalReservasi = Reservasi::count();

        $hariIni = Reservasi::whereDate('tanggal_reservasi', today())->count();

        $totalOrang = Reservasi::sum('jumlah_orang');

        $confirmed = Reservasi::where('status', 'confirmed')->count();
        $pending = Reservasi::where('status', 'pending')->count();
        $cancelled = Reservasi::where('status', 'cancelled')->count();

        // Grafik 7 hari terakhir
        $chartData = Reservasi::selectRaw('DATE(tanggal_reservasi) as tanggal, COUNT(*) as total')
            ->where('tanggal_reservasi', '>=', now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('admin.dashboard', compact(
            'totalReservasi',
            'hariIni',
            'totalOrang',
            'confirmed',
            'pending',
            'cancelled',
            'chartData'
        ));
    }

}