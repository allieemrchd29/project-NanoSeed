<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // This duplicate migration stub has been neutralized.
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_notifications');
    }
};