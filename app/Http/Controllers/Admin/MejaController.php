<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meja;
use App\Models\Area;

class MejaController extends Controller
{
    public function index()
    {
        $mejas = Meja::join('area','meja.id_area','=','area.id_area')
            ->select('meja.*','area.nama_area')
            ->get();

        return view('admin.meja.index', compact('mejas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_area'   => 'required',
            'kode_meja' => 'required',
            'kapasitas' => 'required|integer|min:1',
            'harga'     => 'required|numeric|min:0'
        ]);

        $area = Area::findOrFail($request->id_area);

        // 🚨 Meeting Room tidak boleh tambah meja
        if($area->tipe == 'ruangan'){
            return back()->with('error',
            'Area ruangan tidak menggunakan meja');
        }

        // 🔢 TOTAL MEJA SEKARANG
        $totalKapasitasMeja = Meja::where('id_area', $area->id_area)
            ->sum('kapasitas');

        // 🔢 TOTAL JIKA DITAMBAH MEJA BARU
        $totalBaru = $totalKapasitasMeja + $request->kapasitas;

        // ❌ CEK MELEBIHI KAPASITAS AREA
        if($totalBaru > $area->kapasitas){

            return back()
            ->withErrors([
                'kapasitas' => 'Total kapasitas meja melebihi kapasitas area!'
            ])
            ->withInput();
        }

        // ✅ AMAN BUAT MEJA
        Meja::create([
            'id_area'   => $request->id_area,
            'kode_meja' => $request->kode_meja,
            'kapasitas' => $request->kapasitas,
            'harga'     => $request->harga
        ]);

        return back()->with('success',
        'Meja berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Meja::findOrFail($id)->delete();
        return back();
    }

    public function edit($id)
    {
        $meja = \App\Models\Meja::findOrFail($id);
        $areas = \App\Models\Area::all();

        return view('admin.meja.edit', compact('meja','areas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_meja' => 'required',
            'kapasitas' => 'required|integer|min:1',
            'id_area'   => 'required',
            'harga'     => 'required|numeric|min:0'
        ]);

        $meja = \App\Models\Meja::findOrFail($id);

        $meja->update([
            'kode_meja' => $request->kode_meja,
            'kapasitas' => $request->kapasitas,
            'id_area'   => $request->id_area,
            'harga'     => $request->harga
        ]);

        return redirect()->route('admin.meja')
        ->with('success','Meja berhasil diedit');
    }

    public function create()
    {
        $areas = Area::all();

        return view('admin.meja.create', compact('areas'));
    }
}