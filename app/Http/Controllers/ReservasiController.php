<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Area;

class ReservasiController extends Controller
{

    public function create()
    {
        $now   = Carbon::now();
        $today = $now->format('Y-m-d');

        $areas = Area::with('meja')->get();

        $mejaByArea = [];
        foreach ($areas as $area) {
            $mejaByArea[$area->id_area] = $area->meja;
        }

        $menus = \App\Models\Menu::where('is_available', true)->get();

        return view('booking', compact(
            'today',
            'areas',
            'mejaByArea',
            'menus'
        ));
    }

    // ================= CHECK AVAILABILITY =================

    public function checkAvailability(Request $request)
    {
        $jamMulai = \Carbon\Carbon::createFromFormat('H:i', $request->jam)
                ->format('H:i:s');

        $jamSelesai = \Carbon\Carbon::createFromFormat('H:i', $request->jam_selesai)
                ->format('H:i:s');

        $area = Area::find($request->id_area);

        // ================= AREA TANPA MEJA =================
        if ($request->id_meja == null) {

            $total = Reservasi::where('id_area', $request->id_area)
                ->where('tanggal_reservasi', $request->tanggal)
                ->where(function ($q) use ($jamMulai, $jamSelesai) {
                    $q->whereBetween('jam_reservasi', [$jamMulai, $jamSelesai])
                      ->orWhereBetween('jam_selesai', [$jamMulai, $jamSelesai])
                      ->orWhere(function ($q2) use ($jamMulai, $jamSelesai) {
                          $q2->where('jam_reservasi', '<=', $jamMulai)
                             ->where('jam_selesai', '>=', $jamSelesai);
                      });
                })
                ->whereIn('status', ['confirmed', 'pending'])
                ->sum('jumlah_orang');

            if (($total + $request->jumlah_orang) > $area->kapasitas) {
                return response()->json([
                    'available' => false,
                    'message'   => 'Kapasitas area sudah penuh'
                ]);
            }

            return response()->json(['available' => true]);
        }

        // ================= AREA PUNYA MEJA =================
        $cekMeja = Reservasi::where('id_meja', $request->id_meja)
            ->where('tanggal_reservasi', $request->tanggal)
            ->where(function ($q) use ($jamMulai, $jamSelesai) {
                $q->whereBetween('jam_reservasi', [$jamMulai, $jamSelesai])
                  ->orWhereBetween('jam_selesai', [$jamMulai, $jamSelesai])
                  ->orWhere(function ($q2) use ($jamMulai, $jamSelesai) {
                      $q2->where('jam_reservasi', '<=', $jamMulai)
                         ->where('jam_selesai', '>=', $jamSelesai);
                  });
            })
            ->whereIn('status', ['confirmed', 'pending'])
            ->exists();

        if ($cekMeja) {
            return response()->json([
                'available' => false,
                'message'   => 'Meja sudah dibooking pada rentang jam tersebut'
            ]);
        }

        return response()->json(['available' => true]);
    }

    // ================= STORE =================

    public function store(Request $request)
    {
        // Data pelanggan diambil dari user yang login,
        // tidak perlu lagi nama_pelanggan / email / no_hp di request
        $request->validate([
            'tanggal_reservasi' => 'required|date',
            'jam_reservasi'     => 'required',
            'jumlah_orang'      => 'required|integer|min:1',
            'id_area'           => 'required',
            'id_meja'           => 'nullable',
            'catatan'           => 'nullable|string',
            'menus'             => 'nullable|array',
            'menus.*.id_menu'   => 'required_with:menus|exists:menu,id_menu',
            'menus.*.jumlah'    => 'required_with:menus|integer|min:1'
        ]);

        DB::beginTransaction();

        try {

            $jam = Carbon::createFromFormat('H:i', $request->jam_reservasi)
                ->format('H:i:s');

            $jamSelesai = Carbon::createFromFormat('H:i', $request->jam_selesai)
                ->format('H:i:s');

            // ================= CEK MEJA SUDAH ADA =================
            if ($request->id_meja) {
                $cek = Reservasi::where('id_meja', $request->id_meja)
                    ->where('tanggal_reservasi', $request->tanggal_reservasi)
                    ->where(function ($q) use ($jam, $jamSelesai) {
                        $q->whereBetween('jam_reservasi', [$jam, $jamSelesai])
                          ->orWhereBetween('jam_selesai', [$jam, $jamSelesai])
                          ->orWhere(function ($q2) use ($jam, $jamSelesai) {
                              $q2->where('jam_reservasi', '<=', $jam)
                                 ->where('jam_selesai', '>=', $jamSelesai);
                          });
                    })
                    ->whereIn('status', ['confirmed', 'pending'])
                    ->lockForUpdate()
                    ->exists();

                if ($cek) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Meja sudah dibooking pada rentang jam tersebut'
                    ]);
                }
            } else {
                // ================= CEK KAPASITAS AREA =================
                $area = Area::findOrFail($request->id_area);

                $totalOrangTerpakai = Reservasi::where('id_area', $request->id_area)
                    ->where('tanggal_reservasi', $request->tanggal_reservasi)
                    ->where(function ($q) use ($jam, $jamSelesai) {
                        $q->whereBetween('jam_reservasi', [$jam, $jamSelesai])
                          ->orWhereBetween('jam_selesai', [$jam, $jamSelesai])
                          ->orWhere(function ($q2) use ($jam, $jamSelesai) {
                              $q2->where('jam_reservasi', '<=', $jam)
                                 ->where('jam_selesai', '>=', $jamSelesai);
                          });
                    })
                    ->whereNull('id_meja')
                    ->whereIn('status', ['confirmed', 'pending'])
                    ->lockForUpdate()
                    ->sum('jumlah_orang');

                if (($totalOrangTerpakai + $request->jumlah_orang) > $area->kapasitas) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Kapasitas area sudah penuh pada waktu tersebut'
                    ]);
                }
            }

            // ================= HITUNG TOTAL HARGA =================
            $totalHarga = 0;

            $area = \App\Models\Area::findOrFail($request->id_area);
            $totalHarga += $area->harga;

            if ($request->id_meja) {
                $meja = \App\Models\Meja::findOrFail($request->id_meja);
                $totalHarga += $meja->harga;
            }

            // ================= SIMPAN MENU =================
            $menuDetails = [];
            if ($request->menus && count($request->menus) > 0) {
                foreach ($request->menus as $item) {
                    $menu = \App\Models\Menu::findOrFail($item['id_menu']);
                    $menuDetails[] = [
                        'id_menu'        => $menu->id_menu,
                        'jumlah'         => $item['jumlah'],
                        'harga_saat_ini' => $menu->harga
                    ];
                }
            }

            // ================= SIMPAN RESERVASI =================
            // nama_pelanggan, email, no_hp sudah dihapus dari tabel
            // data diambil dari relasi user via accessor
            $reservasi = Reservasi::create([
                'user_id'           => auth()->id(),
                'tanggal_reservasi' => $request->tanggal_reservasi,
                'jam_reservasi'     => $jam,
                'jam_selesai'       => $jamSelesai,
                'jumlah_orang'      => $request->jumlah_orang,
                'id_area'           => $request->id_area,
                'id_meja'           => $request->id_meja,
                'catatan'           => $request->catatan,
                'total_harga'       => $totalHarga,
                'status_pembayaran' => 'unpaid',
                'status'            => 'confirmed'
            ]);

            if (!empty($menuDetails)) {
                $reservasi->menus()->attach($menuDetails);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'id'      => $reservasi->id_reservasi
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    // ================= CONFIRM PAGE =================

    public function confirmation($id)
    {
        $reservasi = Reservasi::with(['user', 'area', 'meja', 'menus'])->findOrFail($id);

        return view('booking_confirmation', compact('reservasi'));
    }

    // ================= CANCEL =================

    public function cancelFromEmail($kode)
    {
        $reservasi = Reservasi::where('kode_booking', $kode)->firstOrFail();

        $reservasi->update(['status' => 'cancelled']);

        Mail::to($reservasi->email)
            ->send(new \App\Mail\ReservasiCancelledMail($reservasi));

        return view('emails.reservasi_cancelled');
    }

    public function cancelFromPage($kode)
    {
        $reservasi = Reservasi::where('kode_booking', $kode)->firstOrFail();

        $reservasi->update(['status' => 'cancelled']);

        Mail::to($reservasi->email)
            ->send(new \App\Mail\ReservasiCancelledMail($reservasi));

        return view('emails.reservasi_cancelled');
    }

    public function history()
    {
        $reservasi = Reservasi::where('user_id', auth()->id())
            ->with(['area', 'meja'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reservasi.history', compact('reservasi'));
    }
}