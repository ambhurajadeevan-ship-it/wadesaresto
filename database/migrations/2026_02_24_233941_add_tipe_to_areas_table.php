<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('area', function (Blueprint $table) {
            $table->enum('tipe',['meja','ruangan'])
            ->default('meja')
            ->after('kapasitas');
        });
    }

    public function down(): void
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->dropColumn('tipe');
        });
    }
};
