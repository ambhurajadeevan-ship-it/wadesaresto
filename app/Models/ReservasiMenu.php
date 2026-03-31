<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ReservasiMenu extends Pivot
{
    protected $table = 'reservasi_menu';

    protected $fillable = [
        'id_reservasi',
        'id_menu',
        'jumlah',
        'harga_saat_ini'
    ];
}
