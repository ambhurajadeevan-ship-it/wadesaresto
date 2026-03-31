<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update sisa data pending (jika ada) ke confirmed
        DB::table('reservasi')
            ->where('status', 'pending')
            ->update(['status' => 'confirmed']);

        // Ubah enum: hapus 'pending'
        DB::statement("ALTER TABLE reservasi MODIFY COLUMN status ENUM('confirmed','cancelled') NOT NULL DEFAULT 'confirmed'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE reservasi MODIFY COLUMN status ENUM('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending'");
    }
};