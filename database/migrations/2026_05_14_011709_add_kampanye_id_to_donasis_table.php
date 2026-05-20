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
        Schema::table('donasis', function (Blueprint $table) {
            $table->unsignedBigInteger('kampanye_id')->nullable();
            $table->foreign('kampanye_id')->references('id')->on('kampanyes')->onDelete('set null');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
            $table->dropForeign(['kampanye_id']);
            $table->dropColumn('kampanye_id');
        });
    }
};
