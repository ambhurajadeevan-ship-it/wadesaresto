<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            // Tambahkan index untuk mempercepat query pengecekan double booking
            $table->index(['id_meja', 'tanggal_reservasi', 'jam_reservasi', 'status'], 'idx_reservasi_booking_check');
            $table->index(['id_area', 'tanggal_reservasi', 'jam_reservasi', 'status'], 'idx_reservasi_area_check');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropIndex('idx_reservasi_booking_check');
            $table->dropIndex('idx_reservasi_area_check');
        });
    }
};
