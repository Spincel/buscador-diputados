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
            $table->string('type')->default('distrito');
            $table->integer('distrito')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diputados', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->integer('distrito')->nullable(false)->change();
        });
    }
};
