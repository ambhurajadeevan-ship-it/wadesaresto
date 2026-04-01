<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Meja;

class Reservasi extends Model
{
    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';

    protected $fillable = [
        'user_id',
        'kode_booking',
        'tanggal_reservasi',
        'jam_reservasi',
        'jam_selesai',
        'jumlah_orang',
        'id_area',
        'id_meja',
        'catatan',
        'total_harga',
        'status_pembayaran',
        'status',
        'metode_pembayaran',
        'bukti_pembayaran'
    ];

    protected static function booted()
    {
        static::creating(function ($reservasi) {
            do {
                $kode = 'WD-' . strtoupper(substr(md5(uniqid()), 0, 8));
            } while (self::where('kode_booking', $kode)->exists());

            $reservasi->kode_booking = $kode;
        });
    }

    // =============================================
    // ACCESSOR — ambil data dari relasi user
    // sehingga kode lama $reservasi->nama_pelanggan
    // tetap berfungsi tanpa perlu ubah view
    // =============================================

    public function getNamaPelangganAttribute(): string
    {
        return $this->user->name ?? '-';
    }

    public function getEmailAttribute(): string
    {
        return $this->user->email ?? '-';
    }

    public function getNoHpAttribute(): string
    {
        return $this->user->no_hp ?? '-';
    }

    // =============================================
    // RELASI
    // =============================================

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area', 'id_area');
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class, 'id_meja', 'id_meja');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'reservasi_menu', 'id_reservasi', 'id_menu')
                    ->withPivot('jumlah', 'harga_saat_ini')
                    ->withTimestamps();
    }
}