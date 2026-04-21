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
    Schema::create('kampanye', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kampanye');
        $table->text('deskripsi')->nullable();
        $table->enum('status_kampanye', ['aktif', 'nonaktif', 'selesai'])->default('aktif');
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai');
        $table->string('gambar_kampanye')->nullable();
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('kampanye');
    }
};
