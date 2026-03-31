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
            $table->unsignedBigInteger('user_id')->nullable()->after('id_reservasi');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('total_harga', 12, 2)->default(0)->after('catatan');
            $table->enum('status_pembayaran', ['unpaid', 'paid', 'failed'])->default('unpaid')->after('total_harga');
            $table->string('metode_pembayaran')->nullable()->after('status_pembayaran');
        });

        Schema::create('reservasi_menu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_reservasi');
            $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi')->onDelete('cascade');
            $table->unsignedBigInteger('id_menu');
            $table->foreign('id_menu')->references('id_menu')->on('menu')->onDelete('cascade');
            $table->integer('jumlah');
            $table->decimal('harga_saat_ini', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi_menu');

        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'total_harga', 'status_pembayaran', 'metode_pembayaran']);
        });
    }
};
