<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservasiMail;
use App\Models\Setting;

class PaymentController extends Controller
{
    public function index($id)
    {
        $reservasi = Reservasi::with(['area', 'meja', 'menus'])->findOrFail($id);
        $setting = Setting::first();

        if ($reservasi->status_pembayaran == 'paid') {
            return redirect()->route('booking.confirmation', $id);
        }

        return view('payment.index', compact('reservasi', 'setting'));
    }

    public function process(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string|in:M-Banking,QRIS',
            'bukti_pembayaran' => 'required|file|mimes:jpeg,jpg,png,pdf|max:2048'
        ]);

        $reservasi = Reservasi::findOrFail($id);
        
        // Handle file upload
        $buktiPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $fileName = $reservasi->kode_booking . '_' . time() . '.' . $file->getClientOriginalExtension();
            $buktiPath = $file->storeAs('bukti_pembayaran', $fileName, 'public');
        }
        
        $reservasi->update([
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $buktiPath,
            'status_pembayaran' => 'paid'
        ]);

        // Kirim Email setelah lunas
        Mail::to($reservasi->email)->send(new ReservasiMail($reservasi));

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dikonfirmasi',
            'redirect' => route('booking.confirmation', $id)
        ]);
    }
}
