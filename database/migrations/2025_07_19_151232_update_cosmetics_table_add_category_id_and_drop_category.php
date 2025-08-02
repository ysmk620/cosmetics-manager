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
            // 1. 新しい外部キー用カラムを追加
            $table->foreignId('category_id')
                ->nullable()               // 必要に応じて null 許容
                ->after('name')            // 挿入位置
                ->constrained('categories') // categories テーブルを参照
                ->onUpdate('cascade')
                ->onDelete('set null');

            // 2. 旧カラムを削除
            if (Schema::hasColumn('cosmetics', 'category')) {
                $table->dropColumn('category');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cosmetics', function (Blueprint $table) {
            // 1. 外部キー制約を削除
            $table->dropForeign(['category_id']);
            // 2. 新しいカラムを削除
            $table->dropColumn('category_id');
            // 3. 旧カラムを復活
            $table->string('category')->nullable()->after('name');
        });
    }
};
