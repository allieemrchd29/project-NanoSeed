<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
            $table->string('order_id')->nullable()->unique();
            $table->string('snap_token')->nullable();
            $table->string('status')->default('pending');
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