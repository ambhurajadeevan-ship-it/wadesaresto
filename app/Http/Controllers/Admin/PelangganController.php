<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $query = User::withCount('reservasi')
            ->with(['reservasi' => function($q){
                $q->latest(); // 🔥 ambil terbaru dulu
            }]);

        // SEARCH
        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('name','like','%'.$request->search.'%')
                  ->orWhere('email','like','%'.$request->search.'%');
            });
        }

        // SORT berdasarkan jumlah reservasi (lebih relevan sekarang)
        $pelanggan = $query->orderByDesc('reservasi_count')->get();

        return view('admin.pelanggan.index', compact('pelanggan'));
    }

    public function show($id)
    {
        $pelanggan = \App\Models\User::with(['reservasi' => function($q){
            $q->latest();
        }])->findOrFail($id);

        return view('admin.pelanggan.show', compact('pelanggan'));
    }
}