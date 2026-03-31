<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Image;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:6',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $admin = Auth::guard('admin')->user();

        // Update nama
        $admin->nama_admin = $request->nama_admin;

        // Update password jika diisi
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // Upload foto jika ada
        if ($request->hasFile('photo')) {

            // Hapus foto lama kalau ada
            if ($admin->photo && Storage::exists('public/'.$admin->photo)) {
                Storage::delete('public/'.$admin->photo);
            }
            $path = $request->file('photo')->store('admin', 'public');
            $admin->photo = $path;
        }

        $admin->save();

        return back()->with('success', 'Profile berhasil diperbarui');
    }
}
