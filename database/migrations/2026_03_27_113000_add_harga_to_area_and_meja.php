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
        Schema::table('area', function (Blueprint $table) {
            $table->decimal('harga', 12, 2)->default(0)->after('tipe');
        });

        Schema::table('meja', function (Blueprint $table) {
            $table->decimal('harga', 12, 2)->default(0)->after('kapasitas');
        });

        // Set Average Prices for Area
        \Illuminate\Support\Facades\DB::table('area')->where('id_area', 1)->update(['harga' => 50000]); // Indoor
        \Illuminate\Support\Facades\DB::table('area')->where('id_area', 3)->update(['harga' => 30000]); // Outdoor
        \Illuminate\Support\Facades\DB::table('area')->where('id_area', 4)->update(['harga' => 200000]); // Meeting Room
        \Illuminate\Support\Facades\DB::table('area')->where('id_area', 5)->update(['harga' => 150000]); // VIP
        \Illuminate\Support\Facades\DB::table('area')->where('id_area', 6)->update(['harga' => 100000]); // Garden

        // Set Prices for Meja
        \Illuminate\Support\Facades\DB::table('meja')->update(['harga' => 10000]); // Default
        \Illuminate\Support\Facades\DB::table('meja')->whereIn('kode_meja', ['V1', 'V2', 'V3', 'V4'])->update(['harga' => 50000]); // VIP Meja
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('area', function (Blueprint $table) {
            $table->dropColumn('harga');
        });

        Schema::table('meja', function (Blueprint $table) {
            $table->dropColumn('harga');
        });
    }
};
