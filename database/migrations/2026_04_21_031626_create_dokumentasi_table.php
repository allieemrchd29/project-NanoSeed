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
        Schema::create('dokumentasi', function (Blueprint $table) {
            $table->id('id_dokumentasi');
            $table->foreignId('id_kampanye')->constrained('kampanye', 'id')->onDelete('cascade');
            $table->string('foto_dokumentasi')->nullable();
            $table->string('keterangan')->nullable();
            $table->datetime('tanggal_dokumentasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumentasi');
    }
};
