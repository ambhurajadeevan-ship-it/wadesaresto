<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('admin.setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        if(!$setting){
            $setting = Setting::create([]);
        }

        $data = [
            'rekening' => $request->rekening,
        ];

        // upload QRIS
        if($request->hasFile('qris')){
            $path = $request->file('qris')->store('qris','public');
            $data['qris'] = $path;
        }

        $setting->update($data);

        return back()->with('success','Setting berhasil disimpan');
    }
}