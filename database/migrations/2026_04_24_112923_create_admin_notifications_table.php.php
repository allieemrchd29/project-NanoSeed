<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('nama_donatur');
            $table->decimal('jumlah_donasi', 15, 2);
            $table->unsignedBigInteger('donasi_id');
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->foreign('donasi_id')->references('id')->on('donasis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_notifications');
    }
};