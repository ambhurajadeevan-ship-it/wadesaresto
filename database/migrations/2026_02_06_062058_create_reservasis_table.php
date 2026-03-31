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
        Schema::create('reservasi', function (Blueprint $table) {
        $table->id('id_reservasi');

        $table->string('kode_booking')->unique();

        $table->string('nama_pelanggan');
        $table->string('email');
        $table->string('no_hp');

        $table->date('tanggal_reservasi');
        $table->time('jam_reservasi');

        $table->integer('jumlah_orang');
        $table->unsignedBigInteger('id_area');
        $table->unsignedBigInteger('id_meja')->nullable();

        $table->text('catatan')->nullable();

        $table->enum('status', ['pending', 'confirmed', 'cancelled'])
            ->default('pending');

        $table->boolean('is_read')->default(false);

        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};