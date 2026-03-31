<?php

namespace App\Mail;

use App\Models\Reservasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservasiCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservasi;

    public function __construct(Reservasi $reservasi)
    {
        $this->reservasi = $reservasi;
    }

    public function build()
    {
        return $this->subject('Reservasi Dibatalkan - Wadesa Resto')
            ->view('emails.reservasi_cancelled')
            ->with([
                'reservasi'=>$this->reservasi
            ]);
    }
}