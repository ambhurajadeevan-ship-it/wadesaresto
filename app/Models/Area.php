<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';
    protected $primaryKey = 'id_area';
    public $timestamps = false;

    protected $fillable = [
        'nama_area',
        'kapasitas',
        'tipe',
        'harga'
    ];

    public function meja()
    {
        return $this->hasMany(Meja::class,'id_area','id_area');
    }
}
