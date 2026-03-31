<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    public function index()
    {
        $areas = \App\Models\Area::all();

        return view('admin.area.index', compact('areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required',
            'kapasitas' => 'required|integer',
            'harga'     => 'required|numeric|min:0'
        ]);

        Area::create([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
            'harga'     => $request->harga
        ]);

        return redirect()->route('admin.area')
        ->with('success','Area berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return redirect()
            ->back()
            ->with('success','Area berhasil dihapus');
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'nama_area' => 'required',
            'kapasitas' => 'required|integer',
            'harga'     => 'required|numeric|min:0'
        ]);

        $area = Area::findOrFail($id);

        $area->update([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
            'harga'     => $request->harga
        ]);

        return redirect()->route('admin.area')
        ->with('success','Area berhasil diupdate');
    }

    public function create()
    {
        return view('admin.area.create');
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('admin.area.edit', compact('area'));
    }
}