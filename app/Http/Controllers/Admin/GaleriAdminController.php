<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriAdminController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = $request->file('foto')->store('galeri', 'public');

        Galeri::create([
            'foto' => $path
        ]);

        return redirect()->route('admin.galeri')
            ->with('success', 'Foto berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        Storage::disk('public')->delete($galeri->foto);

        $galeri->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
