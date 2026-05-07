<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
            $table->string('order_id')->nullable()->unique()->after('nomor_telepon');
            $table->string('snap_token')->nullable()->after('order_id');
            $table->string('status')->default('pending')->after('snap_token');
            // status: pending | success | failed
        });
    }

    public function down(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
            $table->dropColumn(['order_id', 'snap_token', 'status']);
        });
    }
};