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
        Schema::table('diputados', function (Blueprint $table) {
            $table->string('partido_logo')->nullable()->after('partido_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diputados', function (Blueprint $table) {
            $table->dropColumn('partido_logo');
        });
    }
};
