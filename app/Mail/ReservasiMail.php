<?php

namespace App\Mail;

use App\Models\Reservasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class ReservasiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservasi;
    public $cancelUrl;

    public function __construct(Reservasi $reservasi)
    {
        $this->reservasi = $reservasi;

        $this->cancelUrl = URL::temporarySignedRoute(
            'reservasi.cancel',
            Carbon::now()->addHours(2),
            ['kode' => $reservasi->kode_booking]
        );
    }

    public function build()
    {
        // email diambil dari accessor $reservasi->email → $reservasi->user->email
        return $this->subject('Konfirmasi Reservasi - Wadesa Resto')
            ->view('emails.reservasi')
            ->with([
                'reservasi' => $this->reservasi,
                'cancelUrl' => $this->cancelUrl
            ]);
    }
}