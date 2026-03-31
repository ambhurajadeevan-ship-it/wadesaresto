<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('meja', function (Blueprint $table) {
            $table->id('id_meja');
            $table->string('kode_meja');
            $table->integer('kapasitas');
            $table->unsignedBigInteger('id_area');
            $table->timestamps();

            $table->foreign('id_area')
                ->references('id_area')
                ->on('area')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meja');
    }
};
