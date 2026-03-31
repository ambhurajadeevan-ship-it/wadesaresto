<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MenuAdminController extends Controller
{
    /* ==============================
        LIST MENU
    ============================== */
    public function index(Request $request)
    {
        $query = Menu::query();

        // FILTER KATEGORI
        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        // SEARCH
        if ($request->q) {
            $query->where('nama_menu', 'like', '%' . $request->q . '%');
        }

        $menus = $query->latest()->paginate(10);

        // MINI STATS
        $total = Menu::count();
        $makanan = Menu::where('kategori', 'makanan')->count();
        $minuman = Menu::where('kategori', 'minuman')->count();

        return view('admin.menu.index', compact(
            'menus',
            'total',
            'makanan',
            'minuman'
        ));
    }

    /* ==============================
        FORM CREATE
    ============================== */
    public function create()
    {
        return view('admin.menu.create');
    }

    /* ==============================
        STORE MENU
    ============================== */
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string',
            'kategori' => 'required|string',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = null;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('menu', 'public');
        }

        Menu::create([
            'nama_menu' => $request->nama_menu,
            'kategori'  => strtolower($request->kategori), // 🔥 normalisasi
            'harga'     => $request->harga,
            'foto'      => $path
        ]);

        return redirect()->route('admin.menu')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    /* ==============================
        FORM EDIT
    ============================== */
    public function toggle($id)
    {
        $menu = Menu::findOrFail($id);

        $menu->is_available = !$menu->is_available;
        $menu->save();

        return back()->with('success','Status menu berhasil diubah');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    /* ==============================
        UPDATE MENU
    ============================== */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_menu' => 'required|string',
            'kategori'  => 'required|string',
            'harga'     => 'required|numeric',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $menu = Menu::findOrFail($id);

        $menu->nama_menu = $request->nama_menu;
        $menu->kategori  = strtolower($request->kategori); // 🔥 konsisten lowercase
        $menu->harga     = $request->harga;

        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($menu->foto && Storage::disk('public')->exists($menu->foto)) {
                Storage::disk('public')->delete($menu->foto);
            }

            // Upload foto baru
            $menu->foto = $request->file('foto')->store('menu', 'public');
        }

        $menu->save();

        return redirect()->route('admin.menu')
            ->with('success','Menu berhasil diupdate');
    }

    /* ==============================
        DELETE MENU
    ============================== */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // Hapus foto jika ada
        if ($menu->foto && Storage::disk('public')->exists($menu->foto)) {
            Storage::disk('public')->delete($menu->foto);
        }

        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus.');
    }

    /* ==============================
        DASHBOARD
    ============================== */
    public function dashboard()
    {
        $today = Carbon::today();

        $totalReservasi     = Reservasi::count();
        $reservasiHariIni   = Reservasi::whereDate('tanggal_reservasi', $today)->count();
        $confirmed          = Reservasi::where('status', 'confirmed')->count();
        $cancelled          = Reservasi::where('status', 'cancelled')->count();
        $pengunjungHariIni  = Reservasi::whereDate('tanggal_reservasi', $today)
                                ->sum('jumlah_orang');

        $chart = Reservasi::select(
                    DB::raw('DATE(tanggal_reservasi) as tanggal'),
                    DB::raw('COUNT(*) as total')
                )
                ->whereDate('tanggal_reservasi', '>=', Carbon::now()->subDays(7))
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get();

        return view('admin.dashboard', compact(
            'totalReservasi',
            'reservasiHariIni',
            'confirmed',
            'cancelled',
            'pengunjungHariIni',
            'chart'
        ));
    }
}
