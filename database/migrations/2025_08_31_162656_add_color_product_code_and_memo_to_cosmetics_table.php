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
        Schema::table('cosmetics', function (Blueprint $table) {
            $table->string('color_product_code', 50)->nullable();
            $table->string('memo',120)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cosmetics', function (Blueprint $table) {
            $table->dropColumn(['color_product_code', 'memo']);
        });
    }
};
