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
        Schema::create('presensi_pikets', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim');
            $table->dateTime('jam_datang');
            $table->dateTime('jam_pulang');
            $table->string('tugas');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_pikets');
    }
};
