<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'pengaturan_pembayaran';

    protected $fillable = [
        'rekening',
        'qris',
    ];
}