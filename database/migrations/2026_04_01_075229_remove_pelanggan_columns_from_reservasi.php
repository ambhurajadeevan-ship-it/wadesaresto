<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropColumn(['nama_pelanggan', 'email', 'no_hp']);
        });
    }

    public function down(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->string('nama_pelanggan')->nullable()->after('user_id');
            $table->string('email')->nullable()->after('nama_pelanggan');
            $table->string('no_hp')->nullable()->after('email');
        });
    }
};