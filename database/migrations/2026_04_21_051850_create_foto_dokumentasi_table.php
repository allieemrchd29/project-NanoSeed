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
        Schema::create('foto_dokumentasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dokumentasi')->constrained('dokumentasi', 'id_dokumentasi')->onDelete('cascade');
            $table->string('foto');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foto_dokumentasi');
    }
};
